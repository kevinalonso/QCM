<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GoodAnswers
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GoodAnswersRepository")
 */
class GoodAnswers
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
     * @ORM\Column(name="AnswerQuestion", type="string", length=255)
     */
    private $answerQuestion;
    
    /**
     * inversedBy vis le nom de la variable présente dans l'entity et non la colonne en base de données
     * @ORM\ManyToOne(targetEntity="Questions", inversedBy="id_question_good_foreign_key")
     * @ORM\JoinColumn(name="id_Question", referencedColumnName="id")
     */
    private $question_good_answer;


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
     * Set answerQuestion
     *
     * @param string $answerQuestion
     *
     * @return GoodAnswers
     */
    public function setAnswerQuestion($answerQuestion)
    {
        $this->answerQuestion = $answerQuestion;

        return $this;
    }
    
    public function getQuestion(){
    	$question = new Questions();
    	return $question->getTextQuestion();
    }
    
    public function setQuestion($question_good_answer){
    	$this->question_good_answer = $question_good_answer;
    	return $this;
    }

    /**
     * Get answerQuestion
     *
     * @return string
     */
    public function getAnswerQuestion()
    {
        return $this->answerQuestion;
    }
    
    
}

