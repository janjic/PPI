<?php

namespace AppBundle\Controller\Admin;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use JavierEguiluz\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * The method that is executed when the user performs a 'show' action on an entity.
     *
     * @return Response
     */
    protected function showAction()
    {

        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];
        $fields = $this->entity['show']['fields'];


        $scenesCost = new Highchart();
        $scenesCost->chart->renderTo('scenesCost');
        $scenesCost->chart->type('column');
        $scenesCost->title->text('Cost of scenes. ');
        $scenesCost->plotOptions->series(
            array(
                'dataLabels' => array(
                    'enabled' => true
                )
            )
        );

        $scenesCost->tooltip->headerFormat('<span style="font-size:11px">{series.name}</span><br>');
        $scenesCost->tooltip->pointFormat('<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> EUR<br/>');

        $scenes = array(
            array(
                'name' => 'Scene 1',
                'y' => 18.73,
                'drilldown' => 'Scene 1',
                'visible' => true
            ),
            array(
                'name' => 'Scene 2',
                'y' => 53.61,
                'drilldown' => 'Scene 2',
                'visible' => true
            )
        );

        $scenesCost->series(
            array(
                array(
                    'name' => 'Scenes',
                    'colorByPoint' => true,
                    'data' => $scenes
                )
            )
        );

        $drilldown = array(
            array(
                'name' => 'Scene 1',
                'id' => 'Scene 1',
                'data' => array(
                    array(
                        'name' => 'Roles',
                        'y' => 53.61,
                        'visible' => true,
                        'drilldown' => '1_ROLES',
                    ),
                    array(
                        'name' => 'Locations',
                        'y' => 53.61,
                        'drilldown' => '1_LOCATIONS',
                        'visible' => true
                    ),
                )
            ),
            array(
                'name' => 'Scene 2',
                'id' => '2',
                'data' => array(
                    array(
                        'name' => 'Roles',
                        'y' => 123131.23,
                        'visible' => true,
                        'drilldown' => '2_ROLES',
                    ),
                    array(
                        'name' => 'Locations',
                        'y' => 12123.3,
                        'drilldown' => '2_Locations',
                        'visible' => true
                    ),
                )
            ),
            array(
                'name' => 'Roles',
                'id' => '1_ROLES',
                'data' => array(
                    array("Role 1", 7.73),
                    array("Role 2", 1.13)
                )
            ),
            array(
                'name' => 'Locations',
                'id' => '1_LOCATIONS',
                'data' => array(
                    array("Location 1", 7.73),
                    array("Location 2", 7.54)
                )
            ),

            array(
                'name' => 'Roles',
                'id' => '2_ROLES',
                'data' => array(
                    array("Role 1", 7.73),
                    array("Role 2", 1.13)
                )
            ),
            array(
                'name' => 'Locations',
                'id' => '2_LOCATIONS',
                'data' => array(
                    array("Location 1", 7.73),
                    array("Location 2", 7.54)
                )
            ),

        );

        $scenesCost->drilldown->series($drilldown);




        $locationsCost = new Highchart();
        $locationsCost->chart->renderTo('locationsCost');
        $locationsCost->title->text('Locations cost');
        $locationsCost->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $locationData = array(
            array('Location 1', 45.0),
            array('Location 2', 26.8),
            array('Location 3', 12.8),
            array('Location 4', 8.5),
            array('Location 5', 6.2),
            array('Location 6', 0.7),
        );

        $locationsCost->series(array(array('type' => 'pie','name' => 'Locations cost', 'data' => $locationData)));


        $roleCost = new Highchart();
        $roleCost->chart->renderTo('rolesCost');
        $roleCost->title->text('Roles cost');
        $roleCost->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $roleData = array(
            array('Role 1', 45.0),
            array('Role 2', 26.8),
            array('Role 3', 12.8),
            array('Role 4', 8.5),
            array('Role 5', 6.2),
            array('Role 6', 0.7),
        );
        $roleCost->series(array(array('type' => 'pie','name' => 'Locations cost', 'data' => $roleData)));


        return $this->render($this->entity['templates']['show'], array(
            'entity' => $entity,
            'fields' => $fields,
            'scenesCost' => $scenesCost,
            'locationsCost' => $locationsCost,
            'rolesCost' => $roleCost,
        ));


    }
}
