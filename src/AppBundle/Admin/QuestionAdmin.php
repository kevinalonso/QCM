<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\QueryBuilder;
use Sonata\DoctrineORMAdminBundle\Model\ModelManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Questions;
use AppBundle\Entity\QCMs;
use AppBundle\Controller\QCMController;
use AppBundle\Entity\QCMsRepository;
use AppBundle\Controller\UserQcmController;
 
class QuestionAdmin extends Admin
{
	// Fields to be shown on create/edit forms
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->add('textQuestion')
		->add('nameQcm', 'entity', array('class' => 'AppBundle\Entity\QCMs', 'property' => 'nameQcm'))
			;
	}
	
	// Fields to be shown on filter forms
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('textQuestion')
		->add('question')
		;
	}
	
	// Fields to be shown on lists
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('textQuestion')
		;
	}
	
	
}