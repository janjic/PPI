<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product.
 *
 * @author Branko Janjic
 *
 * @ORM\Entity
 */
class Project
{
    /**
     *
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id = null;

    /**
     * The creation date of the project.
     *
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt = null;

    /**
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $alternateName;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $disambiguatingDescription;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $url;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $summary;

    /**
     * The description of the product.
     *
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;


    /**
     * @var User[]
     * @ORM\ManyToMany(targetEntity="User", mappedBy="projects")
     **/
    protected $directors;



    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->directors = new ArrayCollection();
    }


    /**
     * Set the description of the product.
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * The the full description of the product.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the product name.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Retrieve the name of the product.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get the id of the product.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return mixed
     */
    public function getAlternateName()
    {
        return $this->alternateName;
    }

    /**
     * @param mixed $alternateName
     */
    public function setAlternateName($alternateName)
    {
        $this->alternateName = $alternateName;
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
     */
    public function setDisambiguatingDescription($disambiguatingDescription)
    {
        $this->disambiguatingDescription = $disambiguatingDescription;
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
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @param $users
     */
    public function setDirectors($users)
    {
        $this->directors->clear();
        $this->directors = new ArrayCollection($users);
    }

    /**
     * @return User[]|ArrayCollection
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * @param User $user
     */
    public function addDirector($user)
    {
        if ($this->directors->contains($user)) {
            return;
        }

        $this->directors->add($user);
        $user->addProject($this);
    }

    /**
     * @param User $user
     */
    public function removeDirector($user)
    {
        if (!$this->directors->contains($user)) {
            return;
        }

        $this->directors->removeElement($user);
        $user->removeProject($this);
    }


}
