<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAnswers
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserAnswersRepository")
 */
class UserAnswers
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
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer")
     */
    private $sendAnswer;
    
    /**
     * @var unknown
     * @ORM\Column(name="id_question", type="integer")
     */
    private $id_question;
    
    /**
     * @var unknown
     * @ORM\Column(name="id_answer", type="integer")
     */
    private $id_answer;

     /**
     * @var unknown
     * @ORM\Column(name="point", type="integer")
     */
    private $point;
    
    /**
     * @ORM\ManyToOne(targetEntity="QCMs", inversedBy="answer_user")
     * @ORM\JoinColumn(name="Id_Qcm", referencedColumnName="id")
     */
    private $id_qcm;


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
     * Set sendAnswer
     *
     * @param string $sendAnswer
     *
     * @return UserAnswers
     */
    public function setSendAnswer($sendAnswer)
    {
        $this->sendAnswer = $sendAnswer;

        return $this;
    }

    /**
     * Get sendAnswer
     *
     * @return string
     */
    public function getSendAnswer()
    {
        return $this->sendAnswer;
    }
    
    public function getIdQcm()
    {
    	return $this->id_qcm;
    }
    
    public function getIdAnswer()
    {
    	return $this->id_answer;
    }
    
    public function getIdQuestion()
    {
    	return $this->id_question;
    }
    
    public function setQcm($qcm)
    {
    	$this->id_qcm = $qcm;
    }
    
    public function setIdQcm($id_qcm)
    {
    	$this->id_qcm = $id_qcm;
    	return $this;
    }
    
    public function setIdQuestion($id_question)
    {
    	$this->id_question = $id_question;
    	return $this;
    }
    
    public function setIdAnswer($id_answer)
    {
    	$this->id_answer = $id_answer;
    	return $this;
    }

    public function setPoint($point)
    {
        $this->point = $point;
        return $this;
    }
    
    public function getPoint()
    {
       return $this->point;
    }
}

