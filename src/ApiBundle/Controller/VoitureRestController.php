<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class VoitureRestController extends Controller
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
	
	private $token;
  public function getVoitureAction(Request $request){
   

  	$this->marque = $request->query->get('marque');
  	$this->modele = $request->query->get('modele');
  	$this->clim = $request->query->get('clim');
  	$this->boite = $request->query->get('boite');
  	$this->categorie = $request->query->get('categorie');
  	$this->nbPorte = $request->query->get('nbPorte');
  	$this->nbPassage = $request->query->get('nbPassage');
  	
  	$this->token = $request->query->get('token');
  	
  	// Si token invalide : accès refusé
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
  /**
   * Test si le token est valide
   * @return boolean
   */
  private function isValid(){
  	$em = $this->getDoctrine()->getManager();
  	$query = $em->createQuery('SELECT u.id, u.dateToken FROM ApiBundle:User u WHERE u.token = :token')
  	->setParameter('token', $this->token);
  
  	$result = $query->getResult();
  	// Si le token n'existe pas
  	if(empty($result)) {
  		return false;
  	}
  
  	// Comparaison de la date
  	$dateToken = new \DateTime($result[0]["dateToken"]->format('Y-m-d H:i:s'));
  	$now = new \DateTime(date('Y-m-d H:i:s'));
  	$interval = $dateToken->diff($now)->format('%d');
  	if($interval > 7) {
  		return false;
  	}
  	return true;
  }
  private function createDate($date) {
  
  	$dateformat = \DateTime::createFromFormat('j:m:Y:H:i',$date);
  	if($dateformat == false) {
  		return false;
  	}
  	return $dateformat;
  }
}