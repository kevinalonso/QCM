<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BadAnswers
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BadAnswersRepository")
 */
class BadAnswers
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
     * @ORM\Column(name="BadAnswerQuestion", type="string", length=255)
     */
    private $badAnswerQuestion;
    
   /**
     * @ORM\ManyToOne(targetEntity="Questions", inversedBy="id_question_bad_foreign_key")
     * @ORM\JoinColumn(name="id_Question", referencedColumnName="id")
     */
    private $question_bad_answer;


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
     * Set badAnswerQuestion
     *
     * @param string $badAnswerQuestion
     *
     * @return BadAnswers
     */
    public function setBadAnswerQuestion($badAnswerQuestion)
    {
        $this->badAnswerQuestion = $badAnswerQuestion;

        return $this;
    }

    /**
     * Get badAnswerQuestion
     *
     * @return string
     */
    public function getBadAnswerQuestion()
    {
        return $this->badAnswerQuestion;
    }
    
    public function getQuestion(){
    	$question = new Questions();
    	return $question->getTextQuestion();
    }
    
    public function setQuestion($question_bad_answer){
    	$this->question_bad_answer = $question_bad_answer;
    	return $this;
    }
    
    public function getEntityQuestion()
    {
    	return  $this->question_bad_answer->getId();
    }
}

