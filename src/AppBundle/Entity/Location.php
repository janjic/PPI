<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Glavweb\UploaderBundle\Entity\Media;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;
use Glavweb\UploaderBundle\Mapping\Annotation as Glavweb;

/**
 * Class Location
 * @package AppBundle\Entity
 * @ORM\Table(name="location")
 * @ORM\Entity
 * @Vich\Uploadable
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @Glavweb\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Location implements CostInterface
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
     * @ORM\Column(type="string")
     */
    protected $url;

    /**
     * @var Project[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinTable(name="location_product",
     *      joinColumns={@ORM\JoinColumn(name="location_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     *      )
     */
    protected $props;

    /**
     * @var string
     * @ORM\Column(name="amenity_feature", type="string", nullable=true)
     */
    protected $amenityFeature;

    /**
     * @var string
     * @ORM\Column(name="branch_code", type="string", nullable=true)
     */
    protected $branchCode;

    /**
     * @var string
     * @ORM\Column(name="contained_in_place", type="string", nullable=true)
     */
    protected $containedInPlace;

    /**
     * @var string
     * @ORM\Column(name="contains_place", type="string", nullable=true)
     */
    protected $containsPlace;

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
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    protected $address;

    /**
     * @var string
     * @ORM\Column(name="address_country", type="string", nullable=true)
     */
    protected $addressCountry;

    /**
     * @var string
     * @ORM\Column(name="elevation", type="string", nullable=true)
     */
    protected $elevation;

    /**
     * @var string
     * @ORM\Column(name="latitude", type="string", nullable=true)
     */
    protected $latitude;

    /**
     * @var string
     * @ORM\Column(name="longitude", type="string", nullable=true)
     */
    protected $longitude;

    /**
     * @var string
     * @ORM\Column(name="postal_code", type="string", nullable=true)
     */
    protected $postalCode;

    /**
     * @var string
     * @ORM\Column(name="global_location_number", type="string")
     */
    protected $globalLocationNumber;

    /**
     * @var string
     * @ORM\Column(name="has_map", type="string", nullable=true)
     */
    protected $hasMap;

    /**
     * @var string
     * @ORM\Column(name="isic_v4", type="string", nullable=true)
     */
    protected $isicV4;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Glavweb\UploaderBundle\Entity\Media", orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Glavweb\UploadableField(mapping="entity_images")
     */
    protected $image;

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
     * @ORM\Column(name="review", type="string", nullable=true)
     */
    protected $review;

    /**
     * @var string
     * @ORM\Column(name="smoking_allowed", type="boolean")
     */
    protected $smokingAllowed;

    /**
     * @var string
     * @ORM\Column(name="location_contact_name", type="string", nullable=true)
     */
    protected $locationContactName;

    /**
     * @var string
     * @ORM\Column(name="location_contact_phone", type="string", nullable=true)
     */
    protected $locationContactPhone;

    /**
     * @var string
     * @ORM\Column(name="location_contact_email", type="string", nullable=true)
     */
    protected $locationContactEmail;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Location", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @var float
     * @ORM\Column(name="cost", type="float")
     */
    protected $cost;

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

    /**
     * Set the parent category.
     *
     * @param Category $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get the parent category.
     *
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function getAmenityFeature()
    {
        return $this->amenityFeature;
    }

    /**
     * @param string $amenityFeature
     * @return Location
     */
    public function setAmenityFeature($amenityFeature)
    {
        $this->amenityFeature = $amenityFeature;
        return $this;
    }

    /**
     * @return string
     */
    public function getContainedInPlace()
    {
        return $this->containedInPlace;
    }

    /**
     * @param string $containedInPlace
     * @return Location
     */
    public function setContainedInPlace($containedInPlace)
    {
        $this->containedInPlace = $containedInPlace;
        return $this;
    }

    /**
     * @return string
     */
    public function getContainsPlace()
    {
        return $this->containsPlace;
    }

    /**
     * @param string $containsPlace
     * @return Location
     */
    public function setContainsPlace($containsPlace)
    {
        $this->containsPlace = $containsPlace;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return Location
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressCountry()
    {
        return $this->addressCountry;
    }

    /**
     * @param string $addressCountry
     * @return Location
     */
    public function setAddressCountry($addressCountry)
    {
        $this->addressCountry = $addressCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getHasMap()
    {
        return $this->hasMap;
    }

    /**
     * @param string $hasMap
     * @return Location
     */
    public function setHasMap($hasMap)
    {
        $this->hasMap = $hasMap;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsicV4()
    {
        return $this->isicV4;
    }

    /**
     * @param string $isicV4
     * @return Location
     */
    public function setIsicV4($isicV4)
    {
        $this->isicV4 = $isicV4;
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
    public function getReview()
    {
        return $this->review;
    }

    /**
     * @param string $review
     * @return Location
     */
    public function setReview($review)
    {
        $this->review = $review;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * @param mixed $lft
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
    }

    /**
     * @return mixed
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * @param mixed $lvl
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;
    }

    /**
     * @return mixed
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * @param mixed $rgt
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;
    }

    /**
     * @return mixed
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param mixed $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return Location
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @ORM\PreFlush()
     */
    public function calculateCosts()
    {
        $this->cost = 0;
        if ($this->props) {
            /** @var Product $outfit */
            foreach ($this->props as $prop) {
                $this->cost += $prop->getCost();
            }
        }
    }



}