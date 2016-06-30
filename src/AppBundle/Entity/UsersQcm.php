<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;


/**
 * UsersQcm
 * @Entity
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UsersQcmRepository")
 * @ExclusionPolicy("ALL")
 */
class UsersQcm extends Persons
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
     * @Expose
     * @ORM\Column(name="Login", type="string", length=150)
     */
    private $login;

    /**
     * @var string
     * @Expose
     * @ORM\Column(name="Password", type="string", length=20)
     */
    private $password;


    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="id_Type")
     * @ORM\JoinColumn(name="Id_Type", referencedColumnName="id")
     */
     private $type_qcm;
    
     
     /**
      * @ORM\ManyToMany(targetEntity="QCMs")
      * @ORM\JoinTable(name="User_QCM",
      *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
      *      inverseJoinColumns={@ORM\JoinColumn(name="qcm_id", referencedColumnName="id")}
      *      )
      */
     private $qcms;
     /**
      * Create n n relation
      */
     public function __construct() {
     	$this->qcms = new \Doctrine\Common\Collections\ArrayCollection();
     }
    

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
     * Set login
     *
     * @param string $login
     *
     * @return UsersQcm
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return UsersQcm
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function getCategory(){
        $type_qcm = new Type();
        return $type_qcm->getCategory();
    }

    public function setCategory($type_qcm){
        $this->type_qcm = $type_qcm;
        return $this;
    }

    public function getTypeEntity(){
        return $this->type_qcm->getId();
    }
}

