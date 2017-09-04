<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Manager\ContactManager;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home ()
	{
		$this->show('default/home');
	}
	public function contact ()
	{
		$email=null;
		$message=null;
		$error=array();
		//verifie si la requete php est post
		if($_SERVER['REQUEST_METHOD'] === "POST")
		{
			//prend les données du post
			$email=$_POST['email'];
			$message=$_POST['message'];
			$save=true;

			//Verfie si le champ email est renseigné
			if (!isset($email))
			{
				$save=false;
				$error['mail']="le champ mail est vide";
			}
			//vérifie si l'email est valide
			else if (!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$save=false;
				$error['mail']="l'email est incorrecte";
			}
			//Verfie si le champ message n'est pas vide 
			if (!isset($message))
			{
				$save=false;
				$error['message']="le champ message est vide";

			} 
			// Vérifie si le message fait au moins 200 caracteres
			else if (strlen($message) < 200)
			{
				$save=false;
				$error['message']="le message est trop court (200 caractere min)";
			}

			// Verifie si il n'y a aucune erreur 
			if ($save)	
			{
				//instancie le manager 
				$contactmanager=new ContactManager;

				//Enregistrer les données dans la BDD
				
				$contactmanager->insert([
						'email'=>$email,
						'message'=>$message
					]);

			}
		}	
	
		$this->show('default/contact',[
				'error'=>$error,
			]);
	}
	public function a_propos ()
	{
		$this->show('default/a_propos');
	}
}