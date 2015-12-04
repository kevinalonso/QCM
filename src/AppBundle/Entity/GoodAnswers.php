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
     * @ORM\OneToMany(targetEntity="Questions", mappedBy="$question_good_answer")
     */
    private $id_Good_Answer;


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

