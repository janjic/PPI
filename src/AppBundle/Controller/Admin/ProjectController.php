<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Location;
use AppBundle\Entity\Product;
use AppBundle\Entity\Project;
use AppBundle\Entity\Role;
use AppBundle\Entity\Scene;
use Doctrine\ORM\QueryBuilder;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
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

        $easyadmin = $this->request->attributes->get('easyadmin');
        /** @var Project $entity */
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
        $locationsCostSum = 0;
        $scenesCostSum = 0;
        $roleCostSum = 0;
        $scenes = array();
        $roleData = array();
        $locationData = array();
        $drilldown = array();
        /** @var Scene $scene */
        foreach ($entity->getScenes() as $scene) {
            $scenesCostSum = $scenesCostSum + $scene->getCost();
            $scenes[] = array(
                'name' => $scene->getName(),
                'y' => $scene->getCost(),
                'drilldown' => 'scene_'.$scene->getId(),
                'visible' => true
            );
            /** @var Location $subLocation */
            $rolesCost = 0;
            /** @var Role $role */
            foreach ($scene->getRoles() as $role) {
                $rolesCost = $rolesCost + $role->getCost();
                if (!array_key_exists($role->getId(), $roleData)) {
                    $roleData[$role->getId()] =  array($role->getName(), $role->getCost());
                } else {
                    $roleData[$role->getId()][1] =  $roleData[$role->getId()][1] + $role->getCost();
                }

                $roleCostSum = $roleCostSum + $role->getCost();
            }
            $drilldown [] = array(
                'name' => 'Roles',
                'id' => 'role_'.$scene->getId(),
                'data' => array_values($roleData)
            );
            $drilldown [] = array(
                'name' => $scene->getName(),
                'id' => 'scene_'.$scene->getId(),
                'data' => array(
                    array(
                        'name' => 'Roles',
                        'y' => $rolesCost,
                        'visible' => true,
                        'drilldown' => 'role_'.$scene->getId(),
                    ),
                    array(
                        'name' => 'Locations',
                        'y' => $scene->getLocation()->getCost(),
                        'visible' => true,
                        'drilldown' => 'location_'.$scene->getLocation()->getId(),
                    ),
                )
            );

            $propsCost = 0;
            $propsArray = [];
            /** @var Product $prop */
            foreach ($scene->getLocation()->getProps() as $prop) {
                $propsCost = $propsCost + $prop->getCost();
                $propsArray[] = array($prop->getName(), $prop->getCost());

            }

            $subsCost = 0;
            $subsArray = [];
            /** @var Location $subLocation */
            foreach ($scene->getSubLocations() as $subLocation) {
                $subsCost = $subsCost + $subLocation->getCost();
                $subsArray[] = array($subLocation->getName(), $subLocation->getCost());
            }

            $drilldown [] = array(
                'name' => $scene->getLocation()->getName() .' costs',
                'id' => 'location_'.$scene->getLocation()->getId(),
                'data' => array(
                    array(
                        'name' => 'Props',
                        'y' => $propsCost,
                        'visible' => true,
                        'drilldown' => 'props_'.$scene->getId(),
                    ),
                    array(
                        'name' => 'Sublocations',
                        'y' => $subsCost,
                        'visible' => true,
                        'drilldown' => 'subs_'.$scene->getId(),
                    ),
                )
            );

            $drilldown [] = array(
                'name' => $scene->getLocation()->getName() .' props costs',
                'id' => 'props_'.$scene->getId(),
                'data' => $propsArray
            );

            $drilldown [] = array(
                'name' => $scene->getLocation()->getName() .' sublocations costs',
                'subs_'.$scene->getId(),
                'data' => $subsArray
            );



            if (!array_key_exists($scene->getLocation()->getId(), $locationData)) {
                $locationData[$scene->getLocation()->getId()] =  array($scene->getLocation()->getName(), $scene->getLocation()->getCost());
            } else {
                $locationData[$scene->getLocation()->getId()][1] =  $locationData[$scene->getLocation()->getId()][1] + $scene->getLocation()->getCost();
            }
            $locationsCostSum = $locationsCostSum + $scene->getLocation()->getCost();

        }

        $scenesCost->series(
            array(
                array(
                    'name' => 'Scenes',
                    'colorByPoint' => true,
                    'data' => $scenes
                )
            )
        );



        $scenesCost->drilldown->series($drilldown);




        $locationsCost = new Highchart();
        $locationsCost->chart->renderTo('locationsCost');
        $locationsCost->title->text('Locations cost');
        $locationsCost->tooltip->headerFormat('<span style="font-size:11px">{series.name}</span><br>');
        $locationsCost->tooltip->pointFormat('<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> EUR<br/>');
        $locationsCost->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '{point.name}: {point.y} EUR'),
            'showInLegend'  => true
        ));

        $locationsCost->series(array(array('type' => 'pie','name' => 'Locations cost', 'data' => array_values($locationData))));


        $roleCost = new Highchart();
        $roleCost->chart->renderTo('rolesCost');
        $roleCost->title->text('Roles cost');
        $roleCost->tooltip->headerFormat('<span style="font-size:11px">{series.name}</span><br>');
        $roleCost->tooltip->pointFormat('<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> EUR<br/>');
        $roleCost->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '{point.name}: {point.y} EUR'),
            'showInLegend'  => true
        ));

        $roleCost->series(array(array('type' => 'pie','name' => 'Locations cost', 'data' => array_values($roleData))));

        return $this->render($this->entity['templates']['show'], array(
            'entity' => $entity,
            'fields' => $fields,
            'scenesCost' => $scenesCost,
            'locationsCost' => $locationsCost,
            'rolesCost' => $roleCost,
            'numberOfDirectors' => $entity->getDirectors()->count(),
            'totalCost' => $entity->getCost(),
            'numberOfLocations' => $entity->getLocations()->count(),
            'locationCost' => $locationsCostSum,
            'sceneNum' => $entity->getScenes()->count(),
            'sceneCost' => $scenesCostSum,
            'roleNum' => $scene->getRoles()->count(),
            'roleCost' => $roleCostSum,
        ));


    }
}
