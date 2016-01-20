<?php

namespace AppBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

class QCMController extends Controller
{
	public function getAllQcms(){
		$entity = 'AppBundle:QCMs';
		$qcms = $this->getDoctrine()->getRepository($entity)->findAll();
		 
		return array('qcms' => $qcms);
	}
}