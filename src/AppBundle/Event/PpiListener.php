<?php
namespace AppBundle\Event;

use AppBundle\Entity\CostInterface;
use AppBundle\Entity\Location;
use AppBundle\Entity\Outfit;
use AppBundle\Entity\Project;
use AppBundle\Entity\Role;
use AppBundle\Entity\Scene;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Class PpiListener
 * @package AppBundle\Event
 */
class PpiListener
{
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * @var object
     */
    private  $entity;

    /**
     * PpiListener constructor.
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }


    /**
     * @param GenericEvent $event
     */
    public function postUpdate(GenericEvent $event)
    {
        if (($entity = $event->getArgument('entity')) instanceof CostInterface) {
            $this->entity = $entity;
        }
    }

    public function doOnTerminate()
    {
        if ($this->entity) {
            $this->{$this->getMethodName()}();
        }
    }

    public function calculateSceneCost($sceneIds = null)
    {
        /* @var EntityManager $pm */
        $pm = $this->doctrine->getManagerForClass(Project::class);
        $pmqb = $pm->createQueryBuilder()
            ->select('p')
            ->from(Project::class, 'p')
            ->leftJoin('p.scenes', 's');
        if ($sceneIds) {
            $pmqb->where('s.id IN (' . implode(',', $sceneIds ) . ')');
        } else {
            $pmqb->where('s.id = ?1')->setParameter(1, $this->entity->getId());
        }
        if ($projects = $pmqb->getQuery()->getResult()) {
            /** @var Scene $project */
            foreach ($projects as $project) {
                $project->calculateCosts();
                $pm->merge($project);
            }
            $pm->flush();
        }
    }

    public function calculateLocationCost($locationIds = null)
    {
        /* @var EntityManager $sm */
        $sm = $this->doctrine->getManagerForClass(Scene::class);
        $smqb = $sm->createQueryBuilder()
            ->select('s')
            ->from(Scene::class, 's')
            ->leftJoin('s.location', 'l');
        if ($locationIds) {
            $smqb->where('l.id IN (' . implode(',', $locationIds ) . ')');
        } else {
            $smqb->where('l.id = ?1')->setParameter(1, $this->entity->getId());
        }
        if ($scenes = $smqb->getQuery()->getResult()) {
            $sceneIds = [];
            /** @var Scene $scene */
            foreach ($scenes as $scene) {
                $sceneIds[] = $scene->getId();
                $scene->calculateCosts();
                $sm->merge($scene);
            }
            $sm->flush();
            $this->calculateSceneCost($sceneIds);
        }
    }

    public function calculateRoleCost($roleIds = null)
    {
        /* @var EntityManager $sm */
        $sm = $this->doctrine->getManagerForClass(Scene::class);
        $smqb = $sm->createQueryBuilder()
            ->select('s')
            ->from(Scene::class, 's')
            ->leftJoin('s.roles', 'r');
        if ($roleIds) {
            $smqb->where('r.id IN (' . implode(',', $roleIds ) . ')');
        } else {
            $smqb->where('r.id = ?1')->setParameter(1, $this->entity->getId());
        }
        if ($scenes = $smqb->getQuery()->getResult()) {
            $sceneIds = [];
            /** @var Scene $scene */
            foreach ($scenes as $scene) {
                $sceneIds[] = $scene->getId();
                $scene->calculateCosts();
                $sm->merge($scene);
            }
            $sm->flush();
            $this->calculateSceneCost($sceneIds);
        }
    }

    /**
     * @param array|null $outfitIds
     */
    public function calculateOutfitCost($outfitIds = null)
    {
        /* @var EntityManager $rm */
        $rm = $this->doctrine->getManagerForClass(Role::class);
        $rmqb = $rm->createQueryBuilder()
            ->select('r')
            ->from(Role::class, 'r')
            ->leftJoin('r.outfits', 'o');
        if ($outfitIds) {
            $rmqb->where('o.id IN (' . implode(',', $outfitIds ) . ')');
        } else {
            $rmqb->where('o.id = ?1')->setParameter(1, $this->entity->getId());
        }
        if ($roles = $rmqb->getQuery()->getResult()) {
            $roleIds = [];
            /** @var Role $role */
            foreach ($roles as $role) {
                $roleIds[] = $role->getId();
                $role->calculateCosts();
                $rm->merge($role);
            }
            $rm->flush();
            $this->calculateRoleCost($roleIds);
        }
    }

    public function calculateProductCost()
    {
        /* @var EntityManager $lm */
        $lm = $this->doctrine->getManagerForClass(Location::class);
        $lmqb = $lm->createQueryBuilder()
            ->select('lm')
            ->from(Location::class, 'lm')
            ->leftJoin('lm.props', 'prop')
            ->where('prop.id = ?1')
            ->setParameter(1, $this->entity->getId());

        if ($locations = $lmqb->getQuery()->getResult()) {
            $locationIds = [];
            /** @var Location $location */
            foreach ($locations as $location) {
                $locationIds[] = $location->getId();
                $location->calculateCosts();
                $lm->merge($location);

            }
            $lm->flush();
            $this->calculateLocationCost($locationIds);
        }
        /* @var EntityManager $om */
        $om = $this->doctrine->getManagerForClass(Outfit::class);
        $omqb = $om->createQueryBuilder()
            ->select('o')
            ->from(Outfit::class, 'o')
            ->leftJoin('o.head', 'h')
            ->leftJoin('o.face', 'f')
            ->leftJoin('o.glasses', 'g')
            ->leftJoin('o.neck', 'n')
            ->leftJoin('o.upperBody', 'ub')
            ->leftJoin('o.lowerBody', 'lb')
            ->leftJoin('o.accessories', 'a')
            ->leftJoin('o.shoes', 's')
            ->where('h.id = ?1')
            ->orWhere('h.id = ?1')
            ->orWhere('f.id = ?1')
            ->orWhere('g.id = ?1')
            ->orWhere('n.id = ?1')
            ->orWhere('ub.id = ?1')
            ->orWhere('lb.id = ?1')
            ->orWhere('a.id = ?1')
            ->orWhere('s.id = ?1')
            ->setParameter(1, $this->entity->getId());
        if ($outfits = $omqb->getQuery()->getResult()) {
            $outfitIds = [];
            /** @var Outfit $outfit */
            foreach ($outfits as $outfit) {
                $outfitIds[] = $outfit->getId();
                $outfit->calculateCosts();
                $om->merge($outfit);
            }
            $om->flush();
            $this->calculateOutfitCost($outfitIds);
        }
    }

    /**
     * @return string
     */
    private function getMethodName()
    {
        return 'calculate'.(new \ReflectionClass($this->entity))->getShortName().'Cost';
    }
}