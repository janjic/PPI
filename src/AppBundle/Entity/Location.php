<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 * @package AppBundle\Entity
 * @ORM\Table(name="location")
 * @ORM\Entity
 */
class Location
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
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @var Project[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Project", inversedBy="locations")
     * @ORM\JoinTable(name="props")
     */
    protected $props;

    /**
     * @var string
     * @ORM\Column(name="branch_code", type="string")
     */
    protected $branchCode;

    /**
     * @var string
     * @ORM\Column(name="event", type="string")
     */
    protected $event;

    /**
     * @var string
     * @ORM\Column(name="fax_number", type="string")
     */
    protected $faxNumber;

    /**
     * @var string
     * @ORM\Column(name="elevation", type="string")
     */
    protected $elevation;

    /**
     * @var string
     * @ORM\Column(name="latitude", type="string")
     */
    protected $latitude;

    /**
     * @var string
     * @ORM\Column(name="longitude", type="string")
     */
    protected $longitude;

    /**
     * @var string
     * @ORM\Column(name="postal_code", type="string")
     */
    protected $postalCode;

    /**
     * @var string
     * @ORM\Column(name="global_location_number", type="string")
     */
    protected $globalLocationNumber;

    /**
     * @var string
     * @ORM\Column(name="maximum_attendee_capacity", type="integer")
     */
    protected $maximumAttendeeCapacity;

    /**
     * @var string
     * @ORM\Column(name="opening_hours_specification", type="string")
     */
    protected $openingHoursSpecification;

    /**
     * @var Image[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Image", cascade={"all"})
     * @ORM\JoinTable(name="location_images",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id", unique=true)}
     * )
     */
    private $images;

    /**
     * @var string
     * @ORM\Column(name="smoking_allowed", type="boolean")
     */
    protected $smokingAllowed;

    /**
     * @var string
     * @ORM\Column(name="location_contact_name", type="string")
     */
    protected $locationContactName;

    /**
     * @var string
     * @ORM\Column(name="location_contact_phone", type="simple_array")
     */
    protected $locationContactPhone;

    /**
     * @var string
     * @ORM\Column(name="location_contact_email", type="simple_array")
     */
    protected $locationContactEmail;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Location
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
     * @return Location
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
     * @return Location
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
     * @return Location
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
     * @return Location
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
     * @return Location
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * @param mixed $props
     * @return Location
     */
    public function setProps($props)
    {
        $this->props = $props;
        return $this;
    }

    /**
     * @return string
     */
    public function getBranchCode()
    {
        return $this->branchCode;
    }

    /**
     * @param string $branchCode
     * @return Location
     */
    public function setBranchCode($branchCode)
    {
        $this->branchCode = $branchCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $event
     * @return Location
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return string
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    /**
     * @param string $faxNumber
     * @return Location
     */
    public function setFaxNumber($faxNumber)
    {
        $this->faxNumber = $faxNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getElevation()
    {
        return $this->elevation;
    }

    /**
     * @param string $elevation
     * @return Location
     */
    public function setElevation($elevation)
    {
        $this->elevation = $elevation;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return Location
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return Location
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return Location
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getGlobalLocationNumber()
    {
        return $this->globalLocationNumber;
    }

    /**
     * @param string $globalLocationNumber
     * @return Location
     */
    public function setGlobalLocationNumber($globalLocationNumber)
    {
        $this->globalLocationNumber = $globalLocationNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaximumAttendeeCapacity()
    {
        return $this->maximumAttendeeCapacity;
    }

    /**
     * @param string $maximumAttendeeCapacity
     * @return Location
     */
    public function setMaximumAttendeeCapacity($maximumAttendeeCapacity)
    {
        $this->maximumAttendeeCapacity = $maximumAttendeeCapacity;
        return $this;
    }

    /**
     * @return string
     */
    public function getOpeningHoursSpecification()
    {
        return $this->openingHoursSpecification;
    }

    /**
     * @param string $openingHoursSpecification
     * @return Location
     */
    public function setOpeningHoursSpecification($openingHoursSpecification)
    {
        $this->openingHoursSpecification = $openingHoursSpecification;
        return $this;
    }

    /**
     * @return Image[]|ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image[]|ArrayCollection $images
     * @return Location
     */
    public function setImages($images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return string
     */
    public function getSmokingAllowed()
    {
        return $this->smokingAllowed;
    }

    /**
     * @param string $smokingAllowed
     * @return Location
     */
    public function setSmokingAllowed($smokingAllowed)
    {
        $this->smokingAllowed = $smokingAllowed;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocationContactName()
    {
        return $this->locationContactName;
    }

    /**
     * @param string $locationContactName
     * @return Location
     */
    public function setLocationContactName($locationContactName)
    {
        $this->locationContactName = $locationContactName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocationContactPhone()
    {
        return $this->locationContactPhone;
    }

    /**
     * @param string $locationContactPhone
     * @return Location
     */
    public function setLocationContactPhone($locationContactPhone)
    {
        $this->locationContactPhone = $locationContactPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocationContactEmail()
    {
        return $this->locationContactEmail;
    }

    /**
     * @param string $locationContactEmail
     * @return Location
     */
    public function setLocationContactEmail($locationContactEmail)
    {
        $this->locationContactEmail = $locationContactEmail;
        return $this;
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


}