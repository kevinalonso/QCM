<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class VoitureRestController extends BaseController
{
	private $dateRetrait;
	private $dateRetour;
	private $adresseRetrait;
	private $adresseRetour;
	private $marque;
	private $modele;
	private $clim;
	private $boite;
	private $categorie;
	private $nbPorte;
	private $nbPassage;
	
  /**
  * @ApiDoc(
  *    description="Permet de consulter la liste des voiture",
  *    requirements={
  *      {"name"="marque", "requirement"="nonobligatory", "dataType"="string"},
  *      {"name"="modele","requirement"="nonobligatory", "dataType"="string"},
  *      {"name"="clim","requirement"="nonobligatory", "dataType"="string"},
  *      {"name"="boite","requirement"="nonobligatory", "dataType"="string"},
  *      {"name"="categorie","requirement"="nonobligatory", "dataType"="string"},
  *      {"name"="nbPorte","requirement"="nonobligatory", "dataType"="string"},
  *      {"name"="nbPassage","requirement"="nonobligatory", "dataType"="string"},
  *      {"name"="token","requirement"="obligatory", "dataType"="string"},
  *  }
  * )
  */
  public function getVoitureAction(Request $request){
   

  	$this->marque = $request->query->get('marque');
  	$this->modele = $request->query->get('modele');
  	$this->clim = $request->query->get('clim');
  	$this->boite = $request->query->get('boite');
  	$this->categorie = $request->query->get('categorie');
  	$this->nbPorte = $request->query->get('nbPorte');
  	$this->nbPassage = $request->query->get('nbPassage');
  	
  	$this->token = $request->query->get('token');
  	
  	// Si token invalide : acc�s refus�
  	 $response = new Response();
  	 $response->setStatusCode(Response::HTTP_FORBIDDEN);
  	 if(!$this->isValid()) {
  	 return $response;
  	 }
  	  
  	 // Test si des champs sont null : Bad request
  	/* if($this->dateRetrait == null || $this->dateRetrait == "" || $this->dateRetour == null || $this->dateRetour == "" ||  $this->adresseRetrait == null || $this->adresseRetrait == "" || $this->adresseRetour == null || $this->adresseRetour == "" ){
  	 $response->setStatusCode(Response::HTTP_BAD_REQUEST);
  	 $response->setContent("Veuillez fournir : date de retrait, date de retour");
  	 return $response;
  	 }
  	$dateRetrait = $this->createDate($this->dateRetrait);
  	if(!$dateRetrait) {
  		$response->setStatusCode(Response::HTTP_BAD_REQUEST);
  		return $response;
  	}
  	$dateRetour = $this->createDate($this->dateRetour);
  	if(!$dateRetour) {
  		$response->setStatusCode(Response::HTTP_BAD_REQUEST);
  		return $response;
  	}*/
  	
  	$repository = $this->getDoctrine()->getRepository('ApiBundle:Voiture');
  	$query = $repository->createQueryBuilder('v');
  	
  	$params = array();
  	
  	if($this->marque != null && $this->marque != "") {
  		$query->andWhere("v.marque = :marque");
  		$params["marque"] = $this->marque;
  	}
  	if($this->modele != null && $this->modele != "") {
  		$query->andWhere("v.modele = :modele");
  		$params["modele"] = $this->modele;
  	}
  	if($this->clim != null && $this->clim != "") {
  		$query->andWhere("v.clim = :clim");
  		$params["clim"] = $this->clim;
  	}
  	if($this->boite != null && $this->boite != "") {
  		$query->andWhere("v.boite = :boite");
  		$params["boite"] = $this->boite;
  	}
  	if($this->categorie != null && $this->categorie != "") {
  		$query->andWhere("v.categorie = :categorie");
  		$params["categorie"] = $this->categorie;
  	}
  	if($this->nbPorte != null && $this->nbPorte != "") {
  		$query->andWhere("v.nbPorte = :nbPorte");
  		$params["nbPorte"] = $this->nbPorte;
  	}
  	if($this->nbPassage != null && $this->nbPassage != "") {
  		$query->andWhere("v.nbPassage = :nbPassage");
  		$params["nbPassage"] = $this->nbPassage;
  	}

  	$voitures = $query->setParameters($params)->getQuery()->getResult();

  	
  	return $voitures;
  	
  }
}