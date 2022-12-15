<?php

namespace app\controllers;

use app\core\Controller;
use app\database\Db;

use app\models\User;
use app\models\Objects;

class AdminController extends Controller
{
	public function login()
	{
		return $this->view->render();
	}
	public function auth()
	{
		$user=new User;
		$data['login']=$_POST['login'];
		$data['password']=$_POST['password'];
		$auth= $user->login($data);
		//если есть такие данные, то сохраняем данные в сессии и загружаем страницу администратора
		if(isset($auth)&&$auth) 
		{
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['password'] = $_POST['password'];
			return $this->show();
		}
		return $this->back();	
	}
	//возврат на предыдущую страницу
	public function back()
	{
		return header('Location:'.$_SERVER['HTTP_REFERER']);
	}
	public function show()
	{
		$object=new Objects;
		$data= $object->get();
		//упорядочиваем объекты
		$data=$object->createTree($data);
		$data=$object->print_objects($data);
		return $this->view->render('admin_show',$data);
	}
	
	public function exitFromAdmin()
	{
		unset($_SESSION['login']);
		unset($_SESSION['password']);
		return header('Location:/');
	}
}