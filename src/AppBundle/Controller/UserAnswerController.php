<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use AppBundle\Entity\UserAnswers;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;

use AppBundle\Controller\QCMController;
use AppBundle\Entity\QCMs;

class UserAnswerController extends Controller
{
	//http://stackoverflow.com/questions/6916324/access-post-values-in-symfony2-request-object
	public function newAnswerUserAction(Request $request) {
		//var_dump("test");
		$userAnswer = null;
		if ($request->getMethod() == 'POST')
		{
			
			$id_qcm = $request->get('idQcm');
			$qcm = $this->getDoctrine()->getEntityManager()->getRepository("\AppBundle\Entity\QCMs")->find($id_qcm);
			
			$userAnswer = new UserAnswers();
			
			$userAnswer->setIdQuestion($request->get('idQuestion',1));
			$userAnswer->setIdAnswer($request->get('idAnswer',1));
			$userAnswer->setQcm($qcm);
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($userAnswer);
			$em->flush();
		}
		else{
			echo "not Post";
		}
		
		$response = new Response();
		$response->setStatusCode(201);
		$response->setContent($userAnswer->getId());
		return $response;
	}
}