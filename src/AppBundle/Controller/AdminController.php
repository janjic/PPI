<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;


class AdminController extends EasyAdminController
{
    /**
     * @Route("/", name="easyadmin")
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }
}
