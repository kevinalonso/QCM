<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;
use AppBundle\Entity\Questions;
use AppBundle\Entity\QCMs;
use JMS\Serializer\Annotation\VirtualProperty;
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
	 * return all Question in json and the qcm id
	 */
	public function getAllQuestionAction(){
	
		$question = $this->getDoctrine()
		->getRepository('AppBundle\Entity\Questions')
		->findAll();
		
		$data = array();
		/**
		 * foreach findAll and build result in array from entity
		 */
		foreach ($question as $questions)
		{
			$data[] = array('idQuestion'=>$questions->getId(),
					'textQuestion' => $questions->getTextQuestion(),
					'idQcm' => $questions->getQcmEntity()
			);
		}
		/**
		 * return my question and his Qcm
		 */
		return array( 'questions' => $data);
	}
}