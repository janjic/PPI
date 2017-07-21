<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Location
 * @package AppBundle\Entity
 * @ORM\Table(name="ppi_location")
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

}