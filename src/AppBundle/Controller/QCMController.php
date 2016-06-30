<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;
use AppBundle\Entity\QCMs;

/**
 * This controller retunr JSON for mobile.
 * @author kevin
 *
 */
class QCMController extends Controller
{
	var $entityQcm = 'AppBundle:QCMs';
	
	/**
	 * return just the qcm where id is selected
	 */
	public function getQcmEntityAction($id){
		$qcm = $this->getDoctrine()->getManager()
		->createQueryBuilder('q')
		->select('q')
		->from($this->entityQcm, 'q')
		->where('q.id ='.$id)
		->getQuery()
		->getResult();
		
		return $qcm;
	}
	
	/**
	 * return just the qcm where id is selected
	 */
	public function getQcmAction($id){
		$qcm = $this->getDoctrine()->getManager()
		->createQueryBuilder('q')
		->select('q.nameQcm')
		->from($this->entityQcm, 'q')
		->where('q.id ='.$id)
		->getQuery()
		->getResult();
	
		return $qcm;
	}
	
	/**
	 * return all QCM in json
	 */
	public function getAllQcmAction(){
		/*$qcm = $this->getDoctrine()->getManager()
		->createQueryBuilder('q')
		->select('q.nameQcm,q.id,q.dateStart,q.dateEnd,q.isActive')
		->from($this->entityQcm, 'q')
		->getQuery()
		->getResult();
		
		return array('qcm' => $qcm);*/
		$qcm = $this->getDoctrine()
		->getRepository('AppBundle\Entity\QCMs')
		->findAll();
		
		$data = array();

		foreach ($qcm as $qcms)
		{
			$data[] = array('nameQcm'=>$qcms->getNameQcm(),
					'id' => $qcms->getId(),
					'dateStart' => $qcms->getDateStart(),
					'dateEnd' => $qcms->getDateEnd(),
					'isActive' => $qcms->getIsActive(),
					'idType' => $qcms->getTypeEntity()
			);
		}
		/**
		 * return my question and his Qcm
		 */
		return array( 'qcms' => $data);
	}
}