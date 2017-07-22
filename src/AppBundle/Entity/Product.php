<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile as UploadedFile;

/**
 * Class Product.
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
     * @ORM\Column(name="additional_types", type="simple_array", nullable=true)
     */
    protected $additionalTypes;

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
     * @var string
     * @ORM\Column(name="main_entity_of", type="string", nullable=true)
     */
    protected $mainEntityOf;

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
     * @var string
     * @ORM\Column(name="additional_property", type="string", nullable=true)
     */
    protected $additionalProperty;

    /**
     * @var string
     * @ORM\Column(name="aggregate_rating", type="string", nullable=true)
     */
    protected $aggregateRating;

    /**
     * @var string
     * @ORM\Column(name="audience", type="string", nullable=true)
     */
    protected $audience;

    /**
     * @var string
     * @ORM\Column(name="award", type="string", nullable=true)
     */
    protected $award;

    /**
     * @var string
     * @ORM\Column(name="brand", type="string")
     */
    protected $brand;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $logo;

    /**
     * @Vich\UploadableField(mapping="base_images", fileNameProperty="logo")
     * @var File $logoFile
     */
    protected $logoFile;

    /**
     * @var Category[]
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     * @ORM\JoinTable(name="product_category")
     */
    private $categories;

    /**
     * The creation date of the product.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * The creation date of the product.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;

    /**
     * @var string
     * @ORM\Column(name="color", type="string", nullable=true)
     */
    protected $color;
    /**
     * @var string
     * @ORM\Column(name="depth", type="string", nullable=true)
     */
    protected $depth;
    /**
     * @var string
     * @ORM\Column(name="height", type="string", nullable=true)
     */
    protected $height;
    /**
     * @var string
     * @ORM\Column(name="gtin12", type="string", nullable=true)
     */
    protected $gtin12;
    /**
     * @var string
     * @ORM\Column(name="gtin8", type="string")
     */
    protected $gtin8;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinTable(name="product_part_of",
     *     joinColumns={@ORM\JoinColumn(name="is_part_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="for_part_id", referencedColumnName="id")}
     * )
     */
    private $isAccessoryOrSparePartFor;

//    /**
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product",  mappedBy="isAccessoryOrSparePartFor")
//     */
//    private $forAccessoryOrSparePartFor;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinTable(name="product_consumable_of",
     *     joinColumns={@ORM\JoinColumn(name="is_consumable_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="for_consumable_id", referencedColumnName="id")}
     * )
     */
    private $isConsumableFor;

//    /**
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product",  mappedBy="isConsumableFor")
//     */
//    private $forConsumableFor;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinTable(name="product_similar_of",
     *     joinColumns={@ORM\JoinColumn(name="is_similar_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="for_similar_id", referencedColumnName="id")}
     * )
     */
    private $isSimilarTo;

//    /**
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product",  mappedBy="isSimilarTo")
//     */
//    private $forSimilarTo;

    /**
     * @var string
     * @ORM\Column(name="material", type="string", nullable=true)
     */
    protected $material;

    /**
     * @var string
     * @ORM\Column(name="mpn", type="string", nullable=true)
     */
    protected $mpn;

    /**
     * @var string
     * @ORM\Column(name="offers", type="string", nullable=true)
     */
    protected $offers;

    /**
     * @var string
     * @ORM\Column(name="review", type="string", nullable=true)
     */
    protected $review;

    /**
     * @var string
     * @ORM\Column(name="weight", type="string", nullable=true)
     */
    protected $weight;

    /**
     * @var string
     * @ORM\Column(name="width", type="string", nullable=true)
     */
    protected $width;

    /**
     * @var string
     * @ORM\Column(name="purchase_workflow", type="string", nullable=true)
     */
    protected $purchaseWorkflow;
    /**
     * @var string
     * @ORM\Column(name="delivery_date", type="datetime", nullable=true)
     */
    protected $deliveryDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="provision", type="boolean")
     */
    private $provision;

    /**
     * @var string
     * @ORM\Column(name="location", type="string", nullable=true)
     */
    protected $location;

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


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->isAccessoryOrSparePartFor = new ArrayCollection();
        $this->isConsumableFor = new ArrayCollection();
        $this->isSimilarTo = new ArrayCollection();
//        $this->forAccessoryOrSparePartFor = new ArrayCollection();
//        $this->forConsumableFor = new ArrayCollection();
//        $this->forSimilarTo = new ArrayCollection();
    }

//    /**
//     * @param Product $entity
//     * @return $this
//     */
//    public function addForAccessoryOrSparePartFor($entity)
//    {
//        $this->forAccessoryOrSparePartFor->add($entity);
//
//        return $this;
//    }

    /**
     * @param Product $product
     * @return $this
     */
    public function addIsAccessoryOrSparePartFor($product)
    {
        $this->isAccessoryOrSparePartFor->add($product);
//        $product->addForAccessoryOrSparePartFor($this);

        return $this;
    }

//    /**
//     * @param Product $entity
//     * @return $this
//     */
//    public function addForConsumableFor($entity)
//    {
//        $this->forConsumableFor->add($entity);
//
//        return $this;
//    }

    /**
     * @param Product $product
     * @return $this
     */
    public function addIsConsumableFor($product)
    {
        $this->isConsumableFor->add($product);
//        $product->addForConsumableFor($this);

        return $this;
    }

//    /**
//     * @param Product $entity
//     * @return $this
//     */
//    public function addForSimilarTo($entity)
//    {
//        $this->forSimilarTo->add($entity);
//
//        return $this;
//    }

    /**
     * @param Product $product
     * @return $this
     */
    public function addIsSimilarTo($product)
    {
        $this->isSimilarTo->add($product);
//        $product->addForSimilarTo($this);

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add a category in the product association.
     * (Owning side).
     *
     * @param $category Category the category to associate
     */
    public function addCategory($category)
    {
        if ($this->categories->contains($category)) {
            return;
        }
        $this->categories->add($category);
        $category->addProduct($this);
    }
    /**
     * Remove a category in the product association.
     * (Owning side).
     *
     * @param $category Category the category to associate
     */
    public function removeCategory($category)
    {
        if (!$this->categories->contains($category)) {
            return;
        }
        $this->categories->removeElement($category);
        $category->removeProduct($this);
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * @return \DateTime
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
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
     * @param mixed $image
     */
    public function setLogoFile($image = null)
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

    /**
     * @return string
     */
    public function getAdditionalTypes()
    {
        return $this->additionalTypes;
    }

    /**
     * @param string $additionalTypes
     * @return Product
     */
    public function setAdditionalTypes($additionalTypes)
    {
        $this->additionalTypes = $additionalTypes;
        return $this;
    }

    /**
     * @return string
     */
    public function getMainEntityOf()
    {
        return $this->mainEntityOf;
    }

    /**
     * @param string $mainEntityOf
     * @return Product
     */
    public function setMainEntityOf($mainEntityOf)
    {
        $this->mainEntityOf = $mainEntityOf;
        return $this;
    }

    /**
     * @return string
     */
    public function getPotentialAction()
    {
        return $this->potentialAction;
    }

    /**
     * @param string $potentialAction
     * @return Product
     */
    public function setPotentialAction($potentialAction)
    {
        $this->potentialAction = $potentialAction;
        return $this;
    }

    /**
     * @return string
     */
    public function getSameAs()
    {
        return $this->sameAs;
    }

    /**
     * @param string $sameAs
     * @return Product
     */
    public function setSameAs($sameAs)
    {
        $this->sameAs = $sameAs;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalProperty()
    {
        return $this->additionalProperty;
    }

    /**
     * @param string $additionalProperty
     * @return Product
     */
    public function setAdditionalProperty($additionalProperty)
    {
        $this->additionalProperty = $additionalProperty;
        return $this;
    }

    /**
     * @return string
     */
    public function getAggregateRating()
    {
        return $this->aggregateRating;
    }

    /**
     * @param string $aggregateRating
     * @return Product
     */
    public function setAggregateRating($aggregateRating)
    {
        $this->aggregateRating = $aggregateRating;
        return $this;
    }

    /**
     * @return string
     */
    public function getAudience()
    {
        return $this->audience;
    }

    /**
     * @param string $audience
     * @return Product
     */
    public function setAudience($audience)
    {
        $this->audience = $audience;
        return $this;
    }

    /**
     * @return string
     */
    public function getAward()
    {
        return $this->award;
    }

    /**
     * @param string $award
     * @return Product
     */
    public function setAward($award)
    {
        $this->award = $award;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category[] $categories
     * @return Product
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     * @return Product
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param string $depth
     * @return Product
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param string $height
     * @return Product
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return string
     */
    public function getGtin12()
    {
        return $this->gtin12;
    }

    /**
     * @param string $gtin12
     * @return Product
     */
    public function setGtin12($gtin12)
    {
        $this->gtin12 = $gtin12;
        return $this;
    }

    /**
     * @return string
     */
    public function getGtin8()
    {
        return $this->gtin8;
    }

    /**
     * @param string $gtin8
     * @return Product
     */
    public function setGtin8($gtin8)
    {
        $this->gtin8 = $gtin8;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getisAccessoryOrSparePartFor()
    {
        return $this->isAccessoryOrSparePartFor;
    }

    /**
     * @param mixed $isAccessoryOrSparePartFor
     * @return Product
     */
    public function setIsAccessoryOrSparePartFor($isAccessoryOrSparePartFor)
    {
        $this->isAccessoryOrSparePartFor = $isAccessoryOrSparePartFor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getisConsumableFor()
    {
        return $this->isConsumableFor;
    }

    /**
     * @param mixed $isConsumableFor
     * @return Product
     */
    public function setIsConsumableFor($isConsumableFor)
    {
        $this->isConsumableFor = $isConsumableFor;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getisSimilarTo()
    {
        return $this->isSimilarTo;
    }

    /**
     * @param mixed $isSimilarTo
     * @return Product
     */
    public function setIsSimilarTo($isSimilarTo)
    {
        $this->isSimilarTo = $isSimilarTo;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param string $material
     * @return Product
     */
    public function setMaterial($material)
    {
        $this->material = $material;
        return $this;
    }

    /**
     * @return string
     */
    public function getMpn()
    {
        return $this->mpn;
    }

    /**
     * @param string $mpn
     * @return Product
     */
    public function setMpn($mpn)
    {
        $this->mpn = $mpn;
        return $this;
    }

    /**
     * @return string
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * @param string $offers
     * @return Product
     */
    public function setOffers($offers)
    {
        $this->offers = $offers;
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
     * @return Product
     */
    public function setReview($review)
    {
        $this->review = $review;
        return $this;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param string $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param string $width
     * @return Product
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurchaseWorkflow()
    {
        return $this->purchaseWorkflow;
    }

    /**
     * @param string $purchaseWorkflow
     * @return Product
     */
    public function setPurchaseWorkflow($purchaseWorkflow)
    {
        $this->purchaseWorkflow = $purchaseWorkflow;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param string $deliveryDate
     * @return Product
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isProvision()
    {
        return $this->provision;
    }

    /**
     * @param bool $provision
     * @return Product
     */
    public function setProvision($provision)
    {
        $this->provision = $provision;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Product
     */
    public function setLocation($location)
    {
        $this->location = $location;
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
