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
     * @var string
     *
     * @ORM\Column(name="SendAnswer", type="string", length=255)
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
}

