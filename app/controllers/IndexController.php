<?php

namespace app\controllers;

use app\core\Controller;
use app\database\Db;

use app\models\Objects;

class IndexController extends Controller
{
	public function show()
	{
		$object=new Objects;
		$data= $object->get();
		//упорядочиваем объекты
		$data=$object->createTree($data);
		$data=$object->print_objects($data);
		return $this->view->render('show',$data);
	}	
	
}