<?php
namespace app\core;
use app\database\Db;
use PDO;

class Model 
{
	public $connect;
	protected $table='table';
	
	public function __construct()
	{
		$db=new Db;
		$this->connect=$db->connect;
	}

	public function get()
	{
		try {
		    $result=$this->connect->query('SELECT * from '.$this->table)->fetchAll(PDO::FETCH_ASSOC);
		    return $result;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}

	}

	public function findById($id)
	{
		try {
		    $result=$this->connect->query('SELECT * from '.$this->table.' WHERE id='.$id)->fetch(PDO::FETCH_ASSOC);
		    return $result;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}

	}
	public function findByData($column,$data)
	{
		try {
		    $result=$this->connect->query('SELECT * from '.$this->table.' WHERE '.$column.'='.$data)->fetch(PDO::FETCH_ASSOC);
		    return $result;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}

	}

	public function delete($id)
	{
		try {
		    $result=$this->connect->query('DELETE from '.$this->table.' WHERE id='.$id);
		    return $result;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}

	}

	public function insert($data)
	{
		$columns='';
		$values='';
		foreach($data as $key=>$val)
		{
			$columns.=$key.",";
			$values.="'".$val."',";
		}
		$columns=substr($columns,0,-1);
		$values=substr($values,0,-1);
		$sql='INSERT into '.$this->table.'('.$columns.') VALUES ('.$values.')';
		try {
		    $result=$this->connect->query($sql);
		    return $result;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}


}

