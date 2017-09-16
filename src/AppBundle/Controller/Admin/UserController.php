<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Project;
use Bnbc\UploadBundle\Form\Type\AjaxfileType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Glavweb\UploaderDropzoneBundle\Form\ImageCollectionType;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * This is an example of how to use a custom controller for a backend entity.
 */
class UserController extends BaseAdminController
{
    const MAX_RESULTS = 15;

    protected $forEntity;


    /**
     * Creates the form builder of the form used to create or edit the given entity.
     *
     * @param object $entity
     * @param string $view   The name of the view where this form is used ('new' or 'edit')
     *
     * @return FormBuilder
     */
//    protected function createEntityFormBuilder($entity, $view)
//    {
//        $formBuilder = parent::createEntityFormBuilder($entity, $view);
//        $formBuilder->add('images', ImageCollectionType::class, [
//            'label'            => 'Image Gallery',
//            'context'          => 'entity_images'
//        ]
//        );
//
//        return $formBuilder;
//    }



    /**
     * The method that returns the values displayed by an autocomplete field
     * based on the user's input.
     *
     * @return JsonResponse
     */
    protected function autocompleteAction()
    {
        $this->get('security.token_storage')->getToken()->getUser()->getRoles();
        $entity = $this->request->query->get('entity');
        $query = $this->request->query->get('query');
        $page = $this->request->query->get('page', 1);

        $this->forEntity = $this->request->query->get('currentEntity');

        if (empty($entity) || empty($query)) {

            return new JsonResponse(array('results' => array()));
        }

        $backendConfig = $this->get('easyadmin.config.manager')->getBackendConfig();

        if (!isset($backendConfig['entities'][$entity])) {
            throw new \InvalidArgumentException(sprintf('The "entity" argument must contain the name of an entity managed by EasyAdmin ("%s" given).', $entity));
        }

        $paginator = $this->findByAllProperties($backendConfig['entities'][$entity], $query, $page, $backendConfig['show']['max_results']);


        return new JsonResponse(array('results' => $this->processResults($paginator->getCurrentPageResults(), $backendConfig['entities'][$entity])));
    }


    private function findByAllProperties(array $entityConfig, $searchQuery, $page = 1, $maxResults = self::MAX_RESULTS, $sortField = null, $sortDirection = null)
    {
        $queryBuilder = $this->createAutoSearchQueryBuilder($entityConfig, $searchQuery, $sortField, $sortDirection);

        return $this->get('easyadmin.paginator')->createOrmPaginator($queryBuilder, $page, $maxResults);

    }

    /**
     * @return array
     */
    private function processResults($entities, array $targetEntityConfig)
    {
        $results = array();

        foreach ($entities as $entity) {
            $results[] = array(
                'id' => $this->get('property_accessor')->getValue($entity, $targetEntityConfig['primary_key_field_name']),
                'text' => (string) $entity,
            );
        }

        return $results;
    }


    /**
     * Creates the query builder used to get the results of the search query
     * performed by the user in the "search" view.
     *
     * @param array       $entityConfig
     * @param string      $searchQuery
     * @param string|null $sortField
     * @param string|null $sortDirection
     * @param string|null $dqlFilter
     *
     * @return QueryBuilder
     */
    public function createAutoSearchQueryBuilder(array $entityConfig, $searchQuery, $sortField = null, $sortDirection = null, $dqlFilter = null)
    {
        /* @var EntityManager */
        $em = $this->get('doctrine')->getManagerForClass($entityConfig['class']);
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $em->createQueryBuilder()
            ->select('entity')
            ->from($entityConfig['class'], 'entity')
        ;

        $isSortedByDoctrineAssociation = false !== strpos($sortField, '.');
        if ($isSortedByDoctrineAssociation) {
            $sortFieldParts = explode('.', $sortField);
            $queryBuilder->leftJoin('entity.'.$sortFieldParts[0], $sortFieldParts[0]);
        }

        $isSearchQueryNumeric = is_numeric($searchQuery);
        $isSearchQuerySmallInteger = (is_int($searchQuery) || ctype_digit($searchQuery)) && abs($searchQuery) <= 32767;
        $isSearchQueryInteger = (is_int($searchQuery) || ctype_digit($searchQuery)) && abs($searchQuery) <= PHP_INT_MAX;
        $isSearchQueryUuid = 1 === preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $searchQuery);
        $lowerSearchQuery = mb_strtolower($searchQuery);

        $queryParameters = array();
        foreach ($entityConfig['search']['fields'] as $name => $metadata) {
            $isSmallIntegerField = 'smallint' === $metadata['dataType'];
            $isIntegerField = 'integer' === $metadata['dataType'];
            $isNumericField = in_array($metadata['dataType'], array('number', 'bigint', 'decimal', 'float'));
            $isTextField = in_array($metadata['dataType'], array('string', 'text'));
            $isGuidField = 'guid' === $metadata['dataType'];

            // this complex condition is needed to avoid issues on PostgreSQL databases
            if (
                $isSmallIntegerField && $isSearchQuerySmallInteger ||
                $isIntegerField && $isSearchQueryInteger ||
                $isNumericField && $isSearchQueryNumeric
            ) {
                $queryBuilder->orWhere(sprintf('entity.%s = :numeric_query', $name));
                // adding '0' turns the string into a numeric value
                $queryParameters['numeric_query'] = 0 + $searchQuery;
            } elseif ($isGuidField && $isSearchQueryUuid) {
                $queryBuilder->orWhere(sprintf('entity.%s = :uuid_query', $name));
                $queryParameters['uuid_query'] = $searchQuery;
            } elseif ($isTextField) {
                $queryBuilder->orWhere(sprintf('LOWER(entity.%s) LIKE :fuzzy_query', $name));
                $queryParameters['fuzzy_query'] = '%'.$lowerSearchQuery.'%';

                $queryBuilder->orWhere(sprintf('LOWER(entity.%s) IN (:words_query)', $name));
                $queryParameters['words_query'] = explode(' ', $lowerSearchQuery);
            }
        }

        /**
         * CHANGED Branko
         */
        if (($this->forEntity === (new \ReflectionClass(Project::class))->getShortName()) && $this->get('security.token_storage')->getToken()->getUser()->isAdmin()) {
//            $queryBuilder->andwhere("entity.isAdmin = 0");
         }

        if (0 !== count($queryParameters)) {
            $queryBuilder->setParameters($queryParameters);
        }

        if (!empty($dqlFilter)) {
            $queryBuilder->andWhere($dqlFilter);
        }

        if (null !== $sortField) {
            $queryBuilder->orderBy(sprintf('%s%s', $isSortedByDoctrineAssociation ? '' : 'entity.', $sortField), $sortDirection ?: 'DESC');
        }



        return $queryBuilder;
    }
}
