<?php
namespace app\core;

class Router 
{
	protected $routes=[];
	protected $params=[];

	public function __construct()
	{
		//преобразуем путь в регулярное выражение
		$arr = require 'app/config/routes.php';
		foreach($arr as $key=>$val)
		{
			$this->routes['#^'.$key.'$#']=$val;
		}
	}
//сравниваем с регулярным выражением
	public function match()
	{
		$url=trim($_SERVER['REQUEST_URI'],'/');
		if(!$url||$url=="/") return header('Location:/objects/show');
		foreach($this->routes as $route=>$params)
		{
			if(preg_match($route,$url,$matches))
			{
				$this->params=$params;
				return true;
			}

		}
		return false;
	}
//запусккаем роутер
	public function run()
	{
		if($this->match())
		{
			$path='app\controllers\\'.ucfirst($this->params['controller'].'Controller');
			if(class_exists($path))
			{
				$action=$this->params['action'];
				if(method_exists($path,$action))
				{
					$controller=new $path($this->params);
					$controller->$action();
				}
				else echo 'Метод не найден';
			}
		else echo 'Не найден контроллер '.$path;
		}
		else echo 'Страница не найдена';
	}

}

