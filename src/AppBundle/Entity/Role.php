<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Glavweb\UploaderBundle\Entity\Media;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Glavweb\UploaderBundle\Mapping\Annotation as Glavweb;

/**
 * Class Role
 * @package AppBundle\Entity
 * @ORM\Table(name="role")
 * @ORM\Entity
 * @Vich\Uploadable
 * @Glavweb\Uploadable
 */
class Role
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
     * @ORM\Column(name="url", type="string")
     */
    protected $url;

    /**
     * @var string
     * @ORM\Column(name="actor", type="string", nullable=true)
     */
    protected $actor;

    /**
     * @var string
     * @ORM\Column(name="country_of_origin", type="string", nullable=true)
     */
    protected $countryOfOrigin;

    /**
     * @var string
     * @ORM\Column(name="agent_company", type="string", nullable=true)
     */
    protected $agentCompany;

    /**
     * @var string
     * @ORM\Column(name="language", type="string", nullable=true)
     */
    protected $language;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    protected $trailer;

    /**
     * @Vich\UploadableField(mapping="base_images", fileNameProperty="trailer")
     * @var File
     */
    protected $trailerFile;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Glavweb\UploaderBundle\Entity\Media", orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Glavweb\UploadableField(mapping="entity_images")
     */
    protected $image;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Outfit")
     * @ORM\JoinTable(name="role_outfit",
     *      joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")}
     *      )
     */
    protected $outfits;

    /**
     * @var string
     * @ORM\Column(name="age", type="string", nullable=true)
     */
    protected $age;

    /**
     * @var string
     * @ORM\Column(name="appearance", type="string", nullable=true)
     */
    protected $appearance;

    /**
     * @var string
     * @ORM\Column(name="gender", type="string")
     */
    protected $gender;

    /**
     * @var string
     * @ORM\Column(name="hobby", type="string", nullable=true)
     */
    protected $hobby;

    /**
     * Role constructor.
     */
    public function __construct()
    {
        $this->outfits = new ArrayCollection();
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * @return Role
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * @param string $actor
     * @return Role
     */
    public function setActor($actor)
    {
        $this->actor = $actor;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryOfOrigin()
    {
        return $this->countryOfOrigin;
    }

    /**
     * @param string $countryOfOrigin
     * @return Role
     */
    public function setCountryOfOrigin($countryOfOrigin)
    {
        $this->countryOfOrigin = $countryOfOrigin;
        return $this;
    }

    /**
     * @return string
     */
    public function getAgentCompany()
    {
        return $this->agentCompany;
    }

    /**
     * @param string $agentCompany
     * @return Role
     */
    public function setAgentCompany($agentCompany)
    {
        $this->agentCompany = $agentCompany;
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return Role
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * @param string $trailer
     * @return Role
     */
    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
        return $this;
    }

    /**
     * @return File
     */
    public function getTrailerFile()
    {
        return $this->trailerFile;
    }

    /**
     * @param File $trailerFile
     * @return Role
     */
    public function setTrailerFile($trailerFile)
    {
        $this->trailerFile = $trailerFile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOutfits()
    {
        return $this->outfits;
    }

    /**
     * @param mixed $outfits
     * @return Role
     */
    public function setOutfits($outfits)
    {
        $this->outfits = $outfits;
        return $this;
    }

    /**
     * @return string
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param string $age
     * @return Role
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppearance()
    {
        return $this->appearance;
    }

    /**
     * @param string $appearance
     * @return Role
     */
    public function setAppearance($appearance)
    {
        $this->appearance = $appearance;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return Role
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getHobby()
    {
        return $this->hobby;
    }

    /**
     * @param string $hobby
     * @return Role
     */
    public function setHobby($hobby)
    {
        $this->hobby = $hobby;
        return $this;
    }

    /**
     * @param $outfit
     * @return $this
     */
    public function addOutfit($outfit)
    {
        $this->outfits->add($outfit);

        return $this;
    }

    /**
     * @param $outfit
     * @return $this
     */
    public function removeOutfit($outfit)
    {
        $this->outfits->removeElement($outfit);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

}