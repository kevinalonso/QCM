<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;


class UserQcmAdmin extends Admin
{
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->add('login', 'text', array('label' => 'Login'))
		->add('password')
		->add('firstName')
		->add('lastName')
		->add('email')
		;
	}

	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('login')
		->add('password')
		->add('firstName')
		->add('lastName')
		->add('email')
		;
	}

	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('id','entity',array('class'=>'AppBundle\Entity\Persons'))
		->add('password')
		->add('firstName')
		->add('lastName')
		->add('email')
		;
	}
}