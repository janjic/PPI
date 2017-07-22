<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Glavweb\UploaderBundle\Entity\Media;
use Symfony\Component\HttpFoundation\File\File;
use Glavweb\UploaderBundle\Mapping\Annotation as Glavweb;


/**
 * Image
 *
 * @ORM\Table
 * @ORM\Entity
 * @Glavweb\Uploadable
 */
class Test
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Glavweb\UploaderBundle\Entity\Media", inversedBy="entities", orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * @Glavweb\UploadableField(mapping="entity_images")
     */
    private $images;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}
