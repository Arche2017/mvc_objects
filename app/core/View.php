<?php
namespace app\core;

class View
{
	public $path;
	public $layout='app';
	public function __construct($view)
	{
		$this->view=$view;

	}
	public function render($page=null,$data=null)
	{
		//если есть файл страницы в запросе
		ob_start();
		if($page&&file_exists('app/views/'.$page.'.php')) require 'app/views/'.$page.'.php';
		//если не передана страница, то ищем по имени контроллера и action
		elseif(file_exists('app/views/'.$this->view.'.php')) require 'app/views/'.$this->view.'.php';
		else echo 'вью не найден';
		$content=ob_get_clean();
		require_once 'app/views/layouts/'.$this->layout.'.php';
	}
}