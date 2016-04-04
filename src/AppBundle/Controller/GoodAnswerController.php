<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;
use AppBundle\Entity\GoodAnswers;

/**
 * This controller retunr JSON for mobile.
 * @author kevin
 *
 */
class GoodAnswerController extends Controller
{
	var $entityGoodAnswer = 'AppBundle:GoodAnswers';
	
	/**
	 * return just the Good Answer where id is selected
	 */
	public function getGoodAnswerAction($id){
		$goodAnswer = $this->getDoctrine()->getManager()
		->createQueryBuilder('ga')
		->select('ga.answerQuestion')
		->from($this->entityGoodAnswer, 'ga')
		->where('ga.id ='.$id)
		->getQuery()
		->getResult();
	
		return $goodAnswer;
	}
	
	/**
	 * return all Good Answer in json
	 */
	public function getAllGoodAnswerAction(){
		$goodAnswer = $this->getDoctrine()
		->getRepository('AppBundle\Entity\GoodAnswers')
		->findAll();
		
		$data = array();
		
		foreach ($goodAnswer as $item)
		{
			$data[] = array('id'=>$item->getId(),
					'answerQuestion' => $item->getAnswerQuestion(),
					'idQuestion' => $item->getEntityQuestion()
			);
		}
	
		return array( 'goodAnswers' => $data);
	}
}