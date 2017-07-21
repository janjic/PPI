<?php

/*
 * This file is part of the Doctrine-TestSet project created by
 * https://github.com/MacFJA
 *
 * For the full copyright and license information, please view the LICENSE
 * at https://github.com/MacFJA/Doctrine-TestSet
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Product.
 *
 * @author MacFJA
 *
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Product
{

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="alternate_name", type="string", nullable=true)
     */
    protected $alternateName;

    /**
     * @var string
     * @ORM\Column(name="description", type="string")
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(name="disambiguating_description", type="string", nullable=true)
     */
    protected $disambiguatingDescription;

    /**
     * @var string
     * @ORM\Column(name="potential_action", type="string", nullable=true)
     */
    protected $potentialAction;

    /**
     * @var string
     * @ORM\Column(name="same_as", type="string", nullable=true)
     */
    protected $sameAs;

    /**
     * @var string
     * @ORM\Column(name="url", type="string", nullable=true)
     */
    protected $url;

    /**
     * @var Image[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Image", cascade={"all"})
     * @ORM\JoinTable(name="product_images",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $images;


    /**
     * @Vich\UploadableField(mapping="base_images", fileNameProperty="logo")
     *
     * @var File $logoFile
     */
    protected $logoFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $logo;

    /**
     * @var string
     * @ORM\Column(name="provision_contact_name", type="string", nullable=true)
     */
    protected $provisionContactName;

    /**
     * @var string
     * @ORM\Column(name="provision_contact_phone", type="simple_array", nullable=true)
     */
    protected $provisionContactPhone;

    /**
     * @var string
     * @ORM\Column(name="provision_contact_email", type="simple_array", nullable=true)
     */
    protected $provisionContactEmail;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Product
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlternateName()
    {
        return $this->alternateName;
    }

    /**
     * @param string $alternateName
     * @return Product
     */
    public function setAlternateName($alternateName)
    {
        $this->alternateName = $alternateName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDisambiguatingDescription()
    {
        return $this->disambiguatingDescription;
    }

    /**
     * @param string $disambiguatingDescription
     * @return Product
     */
    public function setDisambiguatingDescription($disambiguatingDescription)
    {
        $this->disambiguatingDescription = $disambiguatingDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Product
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     * @return Product
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvisionContactName()
    {
        return $this->provisionContactName;
    }

    /**
     * @param string $provisionContactName
     * @return Product
     */
    public function setProvisionContactName($provisionContactName)
    {
        $this->provisionContactName = $provisionContactName;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvisionContactPhone()
    {
        return $this->provisionContactPhone;
    }

    /**
     * @param string $provisionContactPhone
     * @return Product
     */
    public function setProvisionContactPhone($provisionContactPhone)
    {
        $this->provisionContactPhone = $provisionContactPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getProvisionContactEmail()
    {
        return $this->provisionContactEmail;
    }

    /**
     * @param string $provisionContactEmail
     * @return Product
     */
    public function setProvisionContactEmail($provisionContactEmail)
    {
        $this->provisionContactEmail = $provisionContactEmail;
        return $this;
    }

    /**
     * Get images
     *
     * @return Image[]|ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image $image
     * @return $this
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;


        return $this;
    }

    /**
     * @param Image $image
     * @return $this
     */
    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setLogoFile(File $image = null)
    {
        $this->logoFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getLogoFile()
    {
        return $this->logoFile;
    }

}
