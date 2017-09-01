<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Manager\UserManager;

class UserController extends Controller 
{
	public function profile ()
	{
		// Recupere les donnée de la session 
		$email=$_SESSION['email'];
		$firstname
		$lastname



		$this->show('user/profile',[
				'email'=>$email
			]);
	}
	public function signin ()
	{
		$email=null;
		$firstname=null;
		$lastname=null;
		$birthdate=null;

		$this->show('user/signin',
				'email'=>$email,
				'firstname'=>$firstname,
				'lastname'=>$lastname,
				'birthdate'=>$birthdate
			)
	}
	public function signup ()
	{
		
	}
	public function lost_pwd ()
	{
		
	}
	public function reset_pwd ()
	{
		
	}
}