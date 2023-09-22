<?php
namespace app\database;
use PDO;
class Db
{
	public $connect;
	public function __construct()
	{
		$config=require 'app/config/db.php';
		$this->connect = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'],$config['user'],$config['password']);
	}
}