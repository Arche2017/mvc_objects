<?php

namespace app\controllers;

use app\core\Controller;
use app\database\Db;

use app\models\Objects;

class ObjectController extends Controller
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

	public function insert()
	{
		$object=new Objects;
		$object->insert($_POST);
		return header('Location:/admin/show');
	}

	public function delete()
	{
		$object=new Objects;
		$object->delete($_POST['object_id']);
		return header('Location:/admin/show');
	}

	//возврат на предыдущую страницу
	public function back()
	{
		return header('Location:'.$_SERVER['HTTP_REFERER']);
	}
}