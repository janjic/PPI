<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Test;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Glavweb\UploaderDropzoneBundle\Form\ImageCollectionType;
use Glavweb\UploaderDropzoneBundle\Form\ImageType;
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
        $test = new Test();
        $form = $this->createFormBuilder($test)
            ->add('images',  ImageCollectionType::class, [
                'label'            => 'Image Gallery',
                'context'          => 'entity_images'
            ]
            )->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();

            return $this->redirectToRoute('test_show', array('id' => $test->getId()));
        }

        return $this->render('@App/test.html.twig', array(
            'test' => $test,
            'form' => $form->createView(),
        ));
        return parent::indexAction($request);
    }


    /**
     * @Route("/dropzoneTest", name="testDropzone")
     */
    public function testAction(Request $request)
    {
        $test = new Test();
        $form = $this->createForm('AppBundle\Form\TestType', $test);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($test);
            $em->flush();

            return $this->redirectToRoute('test_show', array('id' => $test->getId()));
        }

        return $this->render('@App/test.html.twig', array(
            'test' => $test,
            'form' => $form->createView(),
        ));
    }
}
