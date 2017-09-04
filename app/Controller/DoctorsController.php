<?php

namespace Controller;

use \W\Controller\Controller;

class DoctorsController extends Controller 
{
	public function create ()
	{
		$this->allowTo('modo');

		$this->show('doctors/create');
	}
	public function update ($id)
	{
		$this->allowTo('modo');

		$this->show('doctors/update');
	}
	public function delete ($id)
	{
		$this->allowTo('modo');

		$this->show('doctors/delete');
	}
}