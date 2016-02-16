<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\QCMs;

/**
 * Questions
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\QuestionsRepository")
 */
class Questions
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
     * @ORM\Column(name="TextQuestion", type="string", length=255)
     */
    private $textQuestion;
    
    /**
     * @ORM\ManyToOne(targetEntity="QCMs", inversedBy="question")
     * @ORM\JoinColumn(name="Id_Qcm", referencedColumnName="id")
     */
    private $qcm;
    
    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="id_Type")
     * @ORM\JoinColumn(name="Id_Type", referencedColumnName="id")
     */
    private $question_qcm_type;
    
    /**
     * @ORM\OneToMany(targetEntity="GoodAnswers", mappedBy="question_good_answer")
     */
    private $id_question_good_foreign_key;
    
    /**
     * @ORM\OneToMany(targetEntity="BadAnswers", mappedBy="question_bad_answer")
     */
    private $id_question_bad_foreign_key;
    

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
     * Set textQuestion
     *
     * @param string $textQuestion
     *
     * @return Questions
     */
    public function setTextQuestion($textQuestion)
    {
        $this->textQuestion = $textQuestion;

        return $this;
    }

    /**
     * Get textQuestion
     *
     * @return string
     */
    public function getTextQuestion()
    {
        return $this->textQuestion;
    }
    
    public function getNameQcm(){
    	$qcm = new QCMs();
    	return $qcm->getNameQcm();
    }
    
    public function setNameQcm($question){
    	$this->question = $question;
    	return $this;
    }
    
    /**
     * Use to display name QCM in combobox
     * @return string
     */
    public function __toString(){
    	return $this->textQuestion;
    }
    
    /*public function setQcm(QCMs $qcm)
    {
    	$this->qcm = $qcm;
    }*/
    
    public function getQcmEntity(){
    	return $this->qcm->getId();
    }
}

