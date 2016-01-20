<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use AppBundle\Entity\UsersQcm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Annotation\Route;

class UserQcmController extends Controller
{
	var $entityUser = 'AppBundle:UsersQcm';
	
	/**
	 * aide pour les groupe de données http://obtao.com/blog/2013/12/creer-une-api-rest-dans-une-application-symfony/
	 * Use to get one user in databases
	 * @param $id
	 */
	public function getUserAction($id)
    {
        //Return one user
        $user = $this->getDoctrine()->getRepository($this->entityUser)->find($id);
        return $user;
    
	}
	
	/**
	 * Use to get all user in databases
	 */
	public function getAllUsersAction()
	{
		//Return All user
		$users = $this->getDoctrine()->getRepository($this->entityUser)->findAll();
		
		return array('users' => $users);
		
	}

}