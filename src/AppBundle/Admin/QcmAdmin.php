<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
 
class QcmAdmin extends Admin
{
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->add('nameQcm', 'text', array('label' => 'Name qcm'))
		->add('dateStart')
		->add('dateEnd')
		->add('isActive')
		->add('category', 'entity', array('class' => 'AppBundle\Entity\Type', 'property' => 'category'))
		;
	}
	
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('nameQcm')
		->add('dateStart')
		->add('dateEnd')
		->add('isActive')
		;
	}
	
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('nameQcm')
		->add('dateStart')
		->add('dateEnd')
		->add('isActive')
		;
	}
}