<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;

class UsersController extends Controller 
{

	private $AuthManager;
	private $UserManager;

	public function __construct()
	{
		$this->AuthManager= new AuthentificationManager;

		$this->UserManager= new UserManager;
	}
	public function profile ()
	{
		//Verifie si l'existence de la session 
		if (isset($_SESSION))
		{
			// Recupere les données de la session 
			$email=$_SESSION['user']['email'];
			$firstname=$_SESSION['user']['firstname'];
			$lastname=$_SESSION['user']['lastname'];
			$birthday=$_SESSION['user']['birthday'];
			$autism=$_SESSION['user']['autism'];

		} else {
			//redirige vers la page login
			$this->redirectToRoute('user_signin');
		}
		$this->show('user/profile',[
				'email'=>$email,
				'firstname'=>$firstname,
				'lastname'=>$lastname,
				'birthday'=>$birthday,
				'autism'=>$autism,
			]);
	}
	public function signin ()
	{
		$email=null;
		$error=null;

		// Si la requete HTTP est POST
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			//Recupere les données du POST
 			$email=$_POST['email'];
 			$password=$_POST['password'];
			//Controller les identifications 
 			if ($id=$this->AuthManager->isValidLoginInfo($email, $password))
      		{		
				//récupere les données de l'identfiant dans la bdd
      			$user=$this->UserManager->find($id);
				//Ajoute l'identifiant a la session 
      			$this->AuthManager->logUserIn($user);
				//redirige vers la page de profile
				$this->redirectToRoute('profile'); 
 			} 
 			else 
 			{
 				$error="l'email ou le mot de passe est incorrecte";
 			}
 		}	
		$this->show('user/signin',[
				'email'=>$email,
				'error'=>$error,
			]);
	}
	public function signup ()
	{
		$email=null;
		$firstname=null;
		$lastname=null;
		$birthday=null;
		$state=null;
		$situation=null;
		$autism=null;
		$error=null;

		//Si la requete HTTP est POST
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
 			$save = true;
 			//récuperer les données du post 
 			$email=strip_tags(trim($_POST['email']));
 			$password=strip_tags(trim($_POST['password']));
 			$repeat_password=strip_tags(trim($_POST['repeat_password']));
			$firstname=strip_tags(trim($_POST['firstname']));
			$lastname=strip_tags(trim($_POST['lastname']));
			$birthday=strip_tags(trim($_POST['birthday']));
			$departement=strip_tags(trim($_POST['departement']));
			$situation=strip_tags(trim($_POST['situation']));
			$autism=strip_tags(trim($_POST['autism']));

			//Controle des données 

			// ------ Email ------
			if (empty($email))
			{
				$save=false;
				$error['email']="le champ email est vide";
			}

			else if (!filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$save=false;
				$error['email']="l'email n'est pas valide";
			} 
			else if ($this->UserManager->emailExists($email))
			{
				$save=false;
				$error['email']="l'email a déjà été utilisée";
			} 

			// ---- Mot de passe ------
			if (empty($password))
			{
				$save=false;
				$error['password']="le champ mot de passe est vide";
			}
			
			else if ($password!==$repeat_password)
			{
				$save=false;
				$error['repeat_password']="Les mot de passe ne sont pas identique";
			}
			if (empty($firstname))
			{
				$save=false;
				$error['firstname']="le champ prenom est vide";
			}
			if (empty($lastname))
			{
				$save=false;
				$error['lastname']="le champ nom est vide";
			}
			if (empty($birthday))
			{
				$save=false;
				$error['birthday']="le champ date de naissance est vide";
			}
			// ----- Departement -----
			if (empty($departement))
			{
				$save=false;
				$error['departement']='le champ departement est vide';
			}else {
				//Instancier le Manager Departement
				$DepartementsManager= new \Manager\DepartementsManager;
				$id_departement=$DepartementsManager->findByName($departement);
			}
			
			if (empty($situation))
			{
				$save=false;
				$error['situation']='le champ situation est vide';
			}
			/*if (empty($autism))
			{
				$save=false;
				$error='le champs autisme est vide';
			}*/

			if ($save)
			{
				//Haschage du password
				$password=password_hash($password,PASSWORD_DEFAULT);
				//introduction des données dans la BDD
				$user=$this->UserManager->insert([
						'email'=>$email,
						'password'=>$password,
						'firstname'=>$firstname,
						'lastname'=>$lastname,
						'birthday'=>$birthday,
						'id_departement'=>$id_departement,
						'situation'=>$situation,
						'autism'=>$autism,
						'roles'=>'user'
					]);
				var_dump($user);
				exit;
				//Ajouter l'utilisateur dans la session 
				$this->AuthManager->logUserIn($user);
				//Rediriger vers la page de profile 
				$this->redirectToRoute('profile'); 				
			}
		}
		$this->show('user/signup',[
				'email'=>$email,
				'firstname'=>$firstname,
				'lastname'=>$lastname,
				'birthday'=>$birthday,
				'situation'=>$situation,
				'autism'=>$autism,
				'errors'=>$error
			]);
	}
	public function lost_pwd ()
	{
		$email=null;
		$error=null;
		// Verifie si la requete HTTP est POST
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			//Recupere les données du post
			$email=strip_tags(trim($_POST['email']));
			//Verifie l'existence du mail dans la bdd 
			if ($user =$this->userManager->getUserByUsernameOrEmail($email))
			{
				//Generation du token 
				$token=array(
              		'token'=>md5(\W\Security\StringUtils::randomString(10)),
              		'timeout'=>time()+strtotime('+1 hour'),
              		'user_id'=>$user['id']
            	);
				//Generation de l'url
				$url=$this->generateUrl('reset_pwd',['token'=>$token['token']]);
			}
		}
		$this->show('user/lost_pwd');
	}
	public function reset_pwd ($token)
	{
		$password=null;
		$repeat_password=null;
		// Verifie si la requete HTTP est POST
		if ($_SERVER['REQUEST_METHOD'] === "POST")
		{
			
			//Recupere les données du post
			$password=$_POST['password'];
			$repeat_password=$_POST['repeat_password'];
			//Récupere le token 
			$TokensManager= new \Manager\TokensManager;
			$token_data=$TokensManager->findByToken($token);
			//Verifier les mdp 
			if ($password!==$repeat_password)
			{
				$save=false;
				$error='les mots de passe ne sont pas identiques';
				
			} else {
				//Verifie la validite du token 
				if (time()<$token['timeout'])
				{

					//Haschage du nouveau mdp
					$password=password_hash($password,PASSWORD_DEFAULT);
					//changer l'ancien mdp par le nouveau 
					$this->UserManager->update(['password'=>$password],$user['id']);
					//redirige vers la page de connexion
					$this->redirectToRoute('user_signin');
				} 
				else 
				{
					$error="la session a expiré";
				}
			}		
		}
		$this->show('user/reset_pwd',[
			'error'=>$error
			]);
	}
}