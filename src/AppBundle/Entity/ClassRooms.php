<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassRooms
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ClassRoomsRepository")
 */
class ClassRooms
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="NameRoom", type="string", length=150)
     */
    private $nameRoom;
    
    /**
     * @ORM\OneToMany(targetEntity="UsersQcm", mappedBy="$user_qcm")
     */
    private $id_ClassRooms;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameRoom
     *
     * @param string $nameRoom
     *
     * @return ClassRooms
     */
    public function setNameRoom($nameRoom)
    {
        $this->nameRoom = $nameRoom;

        return $this;
    }

    /**
     * Get nameRoom
     *
     * @return string
     */
    public function getNameRoom()
    {
        return $this->nameRoom;
    }
}

