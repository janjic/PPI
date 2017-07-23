<?php

namespace AppBundle\Form;

use AppBundle\Entity\Image;
use Glavweb\UploaderBundle\Entity\Media;
use Glavweb\UploaderDropzoneBundle\Form\ImageCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageArrayType extends ImageCollectionType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('images', ImageCollectionType::class, [
                'label'            => 'Image Gallery',
                'context'          => 'entity_images'
            ]
        );
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Media::class
        ));
    }
}