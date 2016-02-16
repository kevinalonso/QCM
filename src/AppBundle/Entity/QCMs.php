<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;

/**
 * QCMs
 * @Entity
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\QCMsRepository")
 */
class QCMs
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
     * @ORM\Column(name="NameQcm", type="string", length=150, nullable=false)
     */
    private $nameQcm;

    /**
     * @var \Date
     *
     * @ORM\Column(name="DateStart", type="datetime", nullable=true)
     */
    private $dateStart;

    /**
     * @var \Date
     *
     * @ORM\Column(name="DateEnd", type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IsActive", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="id_Type")
     * @ORM\JoinColumn(name="Id_Type", referencedColumnName="id")
     */
     private $type_qcm;
     
    /**
     * @ORM\OneToMany(targetEntity="Questions", mappedBy="qcm")
     */
     private $question;


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
     * Set nameQcm
     *
     * @param string $nameQcm
     *
     * @return QCMs
     */
    public function setNameQcm($nameQcm)
    {
        $this->nameQcm = $nameQcm;

        return $this;
    }

    /**
     * Get nameQcm
     *
     * @return string
     */
    public function getNameQcm()
    {
        return $this->nameQcm;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return QCMs
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return QCMs
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return QCMs
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    /**
     * Use to display name QCM in combobox
     * @return string
     */
    public function __toString(){
    	return $this->nameQcm;
    }
    
}

