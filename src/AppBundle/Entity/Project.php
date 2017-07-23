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

    /**
     * @var Location[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Location", mappedBy="props")
     **/
    protected $locations;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Scene", mappedBy="project", cascade={"all"})
     */
    private $scenes;




    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->directors = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->scenes = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getScenes()
    {
        return $this->scenes;
    }

    /**
     * @param mixed $scenes
     * @return $this
     */
    public function setScenes($scenes)
    {
        $this->scenes = $scenes;

        return $this;
    }

    /**
     * @return Location[]
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param Location[] $locations
     * @return $this
     */
    public function setLocations($locations)
    {
        $this->locations = $locations;

        return $this;
    }

    /**
     * @param Location $location
     */
    public function addLocation($location)
    {
        if ($this->locations->contains($location)) {
            return;
        }

        $this->directors->add($location);
    }

    /**
     * @param Location $location
     */
    public function removeLocation($location)
    {
        if (!$this->locations->contains($location)) {
            return;
        }

        $this->locations->removeElement($location);
    }

    /**
     * @param Scene $scene
     */
    public function addScene($scene)
    {
        if ($this->locations->contains($scene)) {
            return;
        }

        $this->directors->add($scene);
        $scene->setProject($this);
    }

    /**
     * @param Scene $scene
     */
    public function removeScene($scene)
    {
        if (!$this->scenes->contains($scene)) {
            return;
        }

        $this->scenes->removeElement($scene);
        $scene->setProject(null);
    }


}
