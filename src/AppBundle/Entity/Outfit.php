<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Glavweb\UploaderBundle\Entity\Media;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Glavweb\UploaderBundle\Mapping\Annotation as Glavweb;

/**
 * Class Outfit.
 *
 * @ORM\Entity
 * @Vich\Uploadable
 * @Glavweb\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Outfit implements CostInterface
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
     * @ORM\Column(name="url", type="string", nullable=true)
     */
    protected $url;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", cascade={"remove"})
     * @ORM\JoinTable(name="head_product",
     *      joinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    protected $head;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", cascade={"remove"})
     * @ORM\JoinTable(name="glasses_product",
     *      joinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    protected $glasses;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", cascade={"remove"})
     * @ORM\JoinTable(name="face_product",
     *      joinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    protected $face;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", cascade={"remove"})
     * @ORM\JoinTable(name="neck_product",
     *      joinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    protected $neck;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", cascade={"remove"})
     * @ORM\JoinTable(name="uppper_body_product",
     *      joinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    protected $upperBody;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", cascade={"remove"})
     * @ORM\JoinTable(name="lower_body_product",
     *      joinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    protected $lowerBody;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", cascade={"remove"})
     * @ORM\JoinTable(name="accessories_product",
     *      joinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    protected $accessories;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product", cascade={"remove"})
     * @ORM\JoinTable(name="shoes_product",
     *      joinColumns={@ORM\JoinColumn(name="outfit_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     * )
     */
    protected $shoes;

    /**
     * @var string
     * @ORM\Column(name="gender", type="string")
     */
    protected $gender;

    /**
     * @var Media
     *
     * @ORM\OneToOne(targetEntity="Glavweb\UploaderBundle\Entity\Media", orphanRemoval=true)
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     * @Glavweb\UploadableField(mapping="entity_images")
     */
    protected $image;

    /**
     * @var float
     * @ORM\Column(name="cost", type="float")
     */
    protected $cost;

    /**
     * @return Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Media $image
     * @return Outfit
     */
    public function setImage($image)
    {
        $this->image = $image;
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
     * @param int $id
     * @return Outfit
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
     * @return Outfit
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
     * @return Outfit
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
     * @return Outfit
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
     * @return Outfit
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
     * @return Outfit
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @param Product[]|ArrayCollection $head
     * @return Outfit
     */
    public function setHead($head)
    {
        $this->head = $head;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getGlasses()
    {
        return $this->glasses;
    }

    /**
     * @param Product[]|ArrayCollection $glasses
     * @return Outfit
     */
    public function setGlasses($glasses)
    {
        $this->glasses = $glasses;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getFace()
    {
        return $this->face;
    }

    /**
     * @param Product[]|ArrayCollection $face
     * @return Outfit
     */
    public function setFace($face)
    {
        $this->face = $face;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getNeck()
    {
        return $this->neck;
    }

    /**
     * @param Product[]|ArrayCollection $neck
     * @return Outfit
     */
    public function setNeck($neck)
    {
        $this->neck = $neck;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getUpperBody()
    {
        return $this->upperBody;
    }

    /**
     * @param Product[]|ArrayCollection $upperBody
     * @return Outfit
     */
    public function setUpperBody($upperBody)
    {
        $this->upperBody = $upperBody;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getLowerBody()
    {
        return $this->lowerBody;
    }

    /**
     * @param Product[]|ArrayCollection $lowerBody
     * @return Outfit
     */
    public function setLowerBody($lowerBody)
    {
        $this->lowerBody = $lowerBody;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getAccessories()
    {
        return $this->accessories;
    }

    /**
     * @param Product[]|ArrayCollection $accessories
     * @return Outfit
     */
    public function setAccessories($accessories)
    {
        $this->accessories = $accessories;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getShoes()
    {
        return $this->shoes;
    }

    /**
     * @param Product[]|ArrayCollection $shoes
     * @return Outfit
     */
    public function setShoes($shoes)
    {
        $this->shoes = $shoes;
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
     * @return Outfit
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function addHeadProduct($element)
    {
        $this->head->add($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function addGlassesProduct($element)
    {
        $this->glasses->add($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function addNeckProduct($element)
    {
        $this->neck->add($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function addUpperBodyProduct($element)
    {
        $this->upperBody->add($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function addLowerBodyProduct($element)
    {
        $this->lowerBody->add($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function addAccessoriesProduct($element)
    {
        $this->accessories->add($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function addShoesProduct($element)
    {
        $this->shoes->add($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function removeHeadProduct($element)
    {
        $this->head->removeElement($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function removeGlassesProduct($element)
    {
        $this->glasses->removeElement($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function removeNeckProduct($element)
    {
        $this->neck->removeElement($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function removeUpperBodyProduct($element)
    {
        $this->upperBody->removeElement($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function removeLowerBodyProduct($element)
    {
        $this->lowerBody->removeElement($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function removeAccessoriesProduct($element)
    {
        $this->accessories->removeElement($element);

        return $this;
    }

    /**
     * @param $element
     * @return $this
     */
    public function removeShoesProduct($element)
    {
        $this->shoes->removeElement($element);

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
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return Outfit
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
        $this->handleProds($this->head);
        $this->handleProds($this->face);
        $this->handleProds($this->glasses);
        $this->handleProds($this->neck);
        $this->handleProds($this->upperBody);
        $this->handleProds($this->lowerBody);
        $this->handleProds($this->accessories);
        $this->handleProds($this->shoes);

    }

    /**
     * @param array $props
     */
    private function handleProds($props)
    {
        if (count($props)) {
            /** @var Product $prop */
            foreach ($props as $prop) {
                $this->cost += $prop->getCost();
            }
        }
    }



}