<?php

namespace AppBundle\Controller\Admin;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * This is an example of how to use a custom controller for a backend entity.
 */
class ProjectController extends BaseAdminController
{

    /**
     * Creates Query Builder instance for all the records.
     *
     * @param string      $entityClass
     * @param string      $sortDirection
     * @param string|null $sortField
     * @param string|null $dqlFilter
     *
     * @return QueryBuilder The Query Builder instance
     */
    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->get('easyadmin.query_builder')->createListQueryBuilder($this->entity, $sortField, $sortDirection, $dqlFilter);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if (!$user->isAdmin()) {
            $qb->innerJoin('entity.directors', 'directors');
            $qb->where('directors.id= ?1');
            $qb->setParameter(1, $user->getId());
        }

        return $qb;
    }
}
