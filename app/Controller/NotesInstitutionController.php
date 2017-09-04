<?php

namespace Controller;

use \W\Controller\Controller;
use \W\Manager\NotesInstitutionManager;

class NotesInstitutionController extends Controller 
{

	private $NotesInstutionManager;

	private function averageNotes ($arraynotes)
	{
		$max=null;
		$i=null;
		foreach ($arraynotes as $note)
		{
			$max+=int($note);
			$i++;
		}
		return $max/$i;
	}
	public function __construct()
	{

		$this->NotesInstitionManager= new NotesManager;
	}

	public function create ($id)
	{
		$note=null;
		$title=null;
		$comment=null;
		//Verifie si l'utilisateur est connecte 
		if (isset($_SESSION))
		{
			$user=$_SESSION['user'];
			//verifie si la requete HTTP est POST
			if ($_SERVER['REQUEST_METHOD'] === "POST")
			{
				$save=true;
				//Recupere les données du POST
				$note=$_POST['note'];
				$title=$_POST['title'];
				$comment=$_POST['commentaire'];
				//Recupere le nom de l'etablissement
				/*$institution=$this->NotesInstitutionManager->find($id);
				$institution_name=$institution['name'];*/
				//Controle les données 
				
				//Verifie les données sont correcte
				if ($save)
				{
					//Introduit les données vers la BDD
					$this->NotesInstitutionManager->insert([
							'note'=>$note,
							'title'=>$title,
							'comment'=>$comment
						])
					//Redirige vers la page de la note 
					$this->redirectToRoute('note_read');
				}
				
				
			}
			$this->show('note/create');
		} else {
			$this->redirectToRoute('user_signin');
		}
	}
	public function read ($id)
	{
		$this->show('note/read');
	}
	public function update ($id)
	{
		$this->show('note/update');
	}
	public function delete ($id)
	{
		$this->show('note/delete');
	}

}