<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Glavweb\UploaderBundle\Mapping\Annotation as Glavweb;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Glavweb\Uploadable
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $firstName;


    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $isAdmin = false;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $country;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $city;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $street;




    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $phones;

    /**
     *
     * @var Project[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Project", inversedBy="directors")
     * @ORM\JoinTable(name="project_directors")
     */
    private $projects;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Glavweb\UploaderBundle\Entity\Media", inversedBy="entities", orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     * @Glavweb\UploadableField(mapping="entity_images")
     */
    private $images;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * It only stores the name of the file which stores the contract subscribed
     * by the user.
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $contract;

    /**
     * This unmapped property stores the binary contents of the file which stores
     * the contract subscribed by the user.
     *
     * @Vich\UploadableField(mapping="user_contracts", fileNameProperty="contract")
     *
     * @var File
     */
    private $contractFile;

    /**
     * @var array
     */
    protected $files = array();


    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->purchases = new ArrayCollection();
        $this->isActive = true;
        $this->projects = new ArrayCollection();
        $this->images = new ArrayCollection();
    }



    /**
     * @return mixed
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * @param mixed $phones
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;
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
    public function getFiles()
    {
        return $this->files;
    }
    public function setFiles(array $files)
    {
        $this->files = $files;
    }


    public function __toString()
    {
        return $this->username;
    }

    /**
     * Set isActive.
     *
     * @param bool $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive.
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param File $contract
     */
    public function setContractFile(File $contract = null)
    {
        $this->contractFile = $contract;
    }

    /**
     * @return File
     */
    public function getContractFile()
    {
        return $this->contractFile;
    }

    /**
     * @param string $contract
     */
    public function setContract($contract)
    {
        $this->contract = $contract;
    }

    /**
     * @return string
     */
    public function getContract()
    {
        return $this->contract;
    }


    /**
     * @return Project[]|ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param $projects
     */
    public function setProjects($projects)
    {
        $this->projects->clear();
        $this->projects = new ArrayCollection($projects);
    }

    /**
     * @param Project $project
     */
    public function addProject($project)
    {
        if ($this->projects->contains($project)) {
            return;
        }

        $this->projects->add($project);
        $project->addDirector($this);
    }

    /**
     * @param Project $project
     */
    public function removeProject($project)
    {
        if (!$this->projects->contains($project)) {
            return;
        }

        $this->projects->removeElement($project);
        $project->removeDirector($this);
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }



    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isAdmin
        ));
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->isAdmin
            ) = unserialize($serialized);
    }

    /**
     * @return string
     */
    public static function getUploadRootDir()
    {
        return __DIR__.'/../../../web/uploads/documents/users';

    }

    /**
     * @param Image $image
     * @return $this
     */
    public function addImage($image)
    {
        $this->images[] = $image;


        return $this;
    }

    /**
     * @param Image $image
     * @return $this
     */
    public function removeImage($image)
    {
        $this->images->removeElement($image);

        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param bool $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }


    /**
     * @ORM\PreFlush()
     */
    public function setToBeAdmin()
    {
        if ($this->hasRole('ROLE_ADMIN')) {
            $this->isAdmin = true;

        }
    }



}
