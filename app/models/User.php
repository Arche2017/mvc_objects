<?php

namespace app\models;

use app\core\Model;

use PDO;

class User extends Model
{
	protected $table='users';

	public function login($credentials)
	{
		try {
		    $result=$this->connect->query("SELECT * from ".$this->table." WHERE login='".$credentials['login']."' AND password='".$credentials['password']."'")->fetch(PDO::FETCH_ASSOC);
		    return $result;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}


}