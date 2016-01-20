<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * Persons
 * @Entity
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="adminqcm", type="string")
 * @DiscriminatorColumn(name="userqcm", type="string")
 * @DiscriminatorMap({"person" = "Persons", "administrator" = "Administrators", "usersqcm" = "UsersQcm"})
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PersonsRepository")
 * @ExclusionPolicy("ALL")
 */
class Persons
{
    /**
     * @var integer
     * @Groups({"Users"})
     * @Expose
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Expose
     * @ORM\Column(name="FirstName", type="string", length=150, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     * @Expose
     * @ORM\Column(name="LastName", type="string", length=150, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     * @Expose
     * @ORM\Column(name="Email", type="string", length=150, nullable=false)
     */
    private $email;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
    	$this->id = $id;
    
    	return $this;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Persons
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Persons
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Persons
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}

