<?php 

namespace Manager;

use \W\Manager\Manager;

class DepartementsManager extends Manager 
{
	public function findByName($name)
	{
		$sql = "SELECT * FROM departements WHERE name = :name LIMIT 1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":name", $name);
		$sth->execute();

		return $sth->fetch();
	}
}