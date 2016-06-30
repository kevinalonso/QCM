<?php

namespace userBundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as Controller;

class RegisterController extends Controller
{
	
	public function registerAction()
	{
		return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('AppBundle\Entity\UsersQcm');
	}
}