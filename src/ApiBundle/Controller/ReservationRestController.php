<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Entity\Reservation;
use ApiBundle\Entity\ReservationUser;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ReservationRestController extends BaseController
{
	private $dateRetrait;
	private $idVoiture;
	private $dateRetour;
	private $adresseRetrait;
	private $adresseRetour;
	private $numReservation;
	
  /**
   * @ApiDoc(
   *    description="Permet de réserver une voiture",
   *    requirements={
   *      {"name"="token", "requirement"="obligatory", "dataType"="string"},
   *      {"name"="idVoiture","requirement"="obligatory", "dataType"="integer"},
   *      {"name"="adresseRetour","requirement"="nonobligatory", "dataType"="string"},
   *      {"name"="adresseRetrait","requirement"="nonobligatory", "dataType"="string"},
   *      {"name"="dateRetour","requirement"="obligatory", "dataType"="datetime"},
   *      {"name"="dateRetrait","requirement"="obligatory", "dataType"="datetime"}
   *  }
   * )
  */
  public function postReservationAction(Request $request){
  	$response = new Response();
  	//** Récupération des paramètres **//
   $this->token = $request->request->get('token');
   $this->idVoiture = $request->request->get('idVoiture');
   $this->adresseRetrait = $request->request->get('adresseRetrait');
   $this->adresseRetour = $request->request->get('adresseRetour');
   $this->dateRetour =  $this->createDate($request->request->get('dateRetour'));
   $this->dateRetrait = $this->createDate($request->request->get('dateRetrait'));
   $this->idVoiture = $request->request->get('idVoiture');
   
   //** Test si la date de retrait est valide **//
  if(!$this->dateRetrait) {
  	$response->setStatusCode(Response::HTTP_BAD_REQUEST);
  	$response->setContent("La date est mal renseignée ou manquante");
  	return $response;
  }
   
   //** Test si le token est valide **//
   // Si token invalide : accès refusé
   $response = new Response();
   if(!$this->isValid()) {
   	$response->setStatusCode(Response::HTTP_FORBIDDEN);
   	return $response;
   }
   //** Test si id la voiture existe **//   
   if(!$this->isVoitureDispo()) {
   	$response->setStatusCode(Response::HTTP_FORBIDDEN);
   	$response->setContent("Voiture non disponible pour cette periode");
   	return $response;
   }
   //** Si tout est OK => on valide la réservation + renvoie id de réservation **//
   if($this->adresseRetrait == null || $this->adresseRetrait == "" || $this->adresseRetour == null || $this->adresseRetour == "" || $this->dateRetour == null || $this->dateRetour == ""  ) {
   	$response->setStatusCode(Response::HTTP_BAD_REQUEST);
   	$response->setContent("Il manque des réservation pour assurer la réservation");
   	return $response;
   }
   
   $resa = new Reservation();
   $resa->setIdUser($this->idUser);
   $resa->setIdVoiture($this->idVoiture);
   $resa->setDateDebutRes($this->dateRetrait);
   $resa->setDateFinRes($this->dateRetour);
   $resa->setLieuRetrait($this->adresseRetrait);
   $resa->setLieuRetour($this->adresseRetour);
   $numResa = $this->generateString(5);
   $resa->setNumReservation($numResa);
   
   $em = $this->getDoctrine()->getManager();
   $em->persist($resa);
   $em->flush();
   
   $resaUser = new ReservationUser();
   $resaUser->setIdUser($this->idUser);
   $resaUser->setIdReservation($resa->getId());
   $em->persist($resaUser);
   $em->flush();
   
   $obj = new \stdClass();
   $obj->numeroReservation=$numResa;
   return json_encode($obj);
  }
  
  /**
   * @ApiDoc(
   *    description="Permet de consulter sa réservation",
   *    requirements={
   *      {"name"="token", "requirement"="obligatory", "dataType"="string"}
   *  }
   * )
  */
  public function getReservationMesreservationAction(Request $request) {
  	
  	$this->token = $request->query->get('token');
  	
  	//** Test si le token est valide **//
  	// Si token invalide : accès refusé
  	$response = new Response();
  	if(!$this->isValid()) {
  		$response->setStatusCode(Response::HTTP_FORBIDDEN);
  		return $response;
  	}

  	$UserReservations = $this->getUserReservations();

  	return $UserReservations;
  }
  
  /**
   * @ApiDoc(
   *    description="Permet de consulter les informations de ma réservation",
   *    requirements={
   *      {"name"="token", "requirement"="obligatory", "dataType"="string"},
   *      {"name"="numeroReservation", "requirement"="obligatory", "dataType"="string"}
   *  }
   * )
  */
  public function getReservationInfoAction(Request $request) {
  	
  	$this->token = $request->query->get('token');
  	$this->numReservation = $request->query->get('numeroReservation');
  	 
  	//** Test si le token est valide **//
  	// Si token invalide : accès refusé
  	$response = new Response();
  	if(!$this->isValid()) {
  		$response->setStatusCode(Response::HTTP_FORBIDDEN);
  		return $response;
  	}
  	
  	return $this->getinfoReservation();

  }
  /**
   * Test si la voiture recherché existe
   * @return boolean
   */
  private function isVoitureExist() {
  	$em = $this->getDoctrine()->getManager();
  	$query = $em->createQuery('SELECT v.id FROM ApiBundle:Voiture v WHERE v.id = :id')
  	->setParameter('id', $this->idVoiture);
  	
  	$result = $query->getResult();
  	// Si la voiture n'existe pas
  	if(empty($result)) {
  		return false;
  	}
  	return true;
  }
  /**
   * Récupère la voiture recherché parmis toutes les réservations
   */
  private function isVoitureDispo() {
  	$em = $this->getDoctrine()->getManager();
  	$query = $em->createQuery('SELECT r.dateDebutRes , r.dateFinRes FROM ApiBundle:Reservation r WHERE r.idVoiture = :idVoiture')
  	->setParameter('idVoiture', $this->idVoiture);
  	
  	$result = $query->getResult();
  	// Si il n'y a pas de réservation
  	if(empty($result)) {
  		echo"pas de result";
  		return true;
  	}
  	
  	foreach ($result as $key => $reservation){
  		//commandes
  		$datedeb = $reservation["dateDebutRes"]->format('Y-m-d H:i:s');
  		$datefin = $reservation["dateFinRes"]->format('Y-m-d H:i:s');
  		$dateretrait = $this->dateRetrait->format('Y-m-d H:i:s');
  		//echo "\r\n" .$datedeb ."||". $dateretrait ."||". $datefin;
  		if($datedeb <= $dateretrait && $dateretrait <= $datefin) {
  			return false;
  		}
  	}
  	return true;
  }
  /**
   * Récupère les réservation d'un utilisateur
   * @return unknown
   */
  private function getUserReservations() {
  	$em = $this->getDoctrine()->getManager();
  	$query = $em->createQuery('SELECT r.numReservation FROM ApiBundle:Reservation r WHERE r.idUser = :idUser')
  	->setParameter('idUser', $this->idUser);
  	
  	$result = $query->getResult();
  	return $result;
  }
  /**
   * Récupère les informations d'une réservation
   * @return unknown
   */
  private function getinfoReservation() {
  	$em = $this->getDoctrine()->getManager();
  	$query = $em->createQuery('SELECT r.dateDebutRes, r.dateFinRes , r.lieuRetrait, r.lieuRetour , r.numReservation , v.description , v.prix,v.boite,v.marque,v.modele,v.categorie,v.nbPorte,v.nbPassage FROM ApiBundle:Reservation r , ApiBundle:Voiture v WHERE r.numReservation = :num AND v.id = r.idVoiture ')
  	->setParameter('num', $this->numReservation);
  	$result = $query->getResult();
  	return $result;
  }
}