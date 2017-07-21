<?php
namespace PropsApp\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Class Scene
 * @package PropsApp\Entity
 * @ORM\Table(name="ppi_product")
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
     * @ORM\Column(name="alternate_name", type="string")
     */
    protected $alternateName;

    /**
     * @var string
     * @ORM\Column(name="description", type="string")
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(name="disambiguating_description", type="string")
     */
    protected $disambiguatingDescription;

    /**
     * @var string
     * @ORM\Column(name="potential_action", type="string")
     */
    protected $potentialAction;

    /**
     * @var string
     * @ORM\Column(name="same_as", type="string", nullable=true)
     */
    protected $sameAs;

    /**
     * @var string
     * @ORM\Column(name="url", type="string")
     */
    protected $url;

    /**
     * @ORM\ManyToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="logo_id", referencedColumnName="id")
     */
    protected $logo;

    /**
     * @var string
     * @ORM\Column(name="provision_contact_name", type="string")
     */
    protected $provisionContactName;

    /**
     * @var string
     * @ORM\Column(name="provision_contact_phone", type="simple_array")
     */
    protected $provisionContactPhone;

    /**
     * @var string
     * @ORM\Column(name="provision_contact_email", type="simple_array")
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



}