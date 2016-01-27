<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;
use AppBundle\Entity\BadAnswers;

/**
 * This controller retunr JSON for mobile.
 * @author kevin
 *
 */
class BadAnswerController extends Controller
{
	var $entityBadAnswer = 'AppBundle:BadAnswers';
	
	/**
	 * return just the Bad Answer where id is selected
	 */
	public function getBadAnswerAction($id){
		$badAnswer = $this->getDoctrine()->getManager()
		->createQueryBuilder('ba')
		->select('ba.badAnswerQuestion')
		->from($this->entityBadAnswer, 'ba')
		->where('ba.id ='.$id)
		->getQuery()
		->getResult();
	
		return $badAnswer;
	}
	
	/**
	 * return all Good Answer in json
	 */
	public function getAllBadAnswerAction(){
		$badAnswer = $this->getDoctrine()->getManager()
		->createQueryBuilder('ba')
		->select('ba.badAnswerQuestion')
		->from($this->entityBadAnswer, 'ba')
		->getQuery()
		->getResult();
	
		return $badAnswer;
	}
}