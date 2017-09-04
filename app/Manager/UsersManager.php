<?php 

namespace Manager;

use \W\Manager\Manager;

class UsersManager extends Manager 
{
	public function findByToken($token)
	{
		$sql = "SELECT * FROM " . $this->table . " WHERE $this->token = :token LIMIT 1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":token", $token);
		$sth->execute();

		return $sth->fetch();
	}
}

