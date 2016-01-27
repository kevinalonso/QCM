<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;
use AppBundle\Entity\Questions;
/**
 * This controller retunr JSON for mobile.
 * @author kevin
 *
 */
class QuestionController extends Controller
{
	var $entityQuestion = 'AppBundle:Questions';
	
	/**
	 * return just the quesion where id is selected
	 */
	public function getQuestionAction($id){
		$question = $this->getDoctrine()->getManager()
		->createQueryBuilder('q')
		->select('q.textQuestion')
		->from($this->entityQuestion, 'q')
		->where('q.id ='.$id)
		->getQuery()
		->getResult();
	
		return $question;
	}
	
	/**
	 * return all Question in json
	 */
	public function getAllQuestionAction(){
		$question = $this->getDoctrine()->getManager()
		->createQueryBuilder('q')
		->select('q.textQuestion')
		->from($this->entityQuestion, 'q')
		->getQuery()
		->getResult();
	
		return $question;
	}
}