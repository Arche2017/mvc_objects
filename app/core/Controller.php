<?php
namespace app\core;
use app\core\View;

class Controller 
{
	public $params;
	public $view;
	
	public function __construct($params)
	{
		$this->params=$params;
		$this->view=new View(mb_strtolower($this->params['controller'].'_'.$this->params['action']));
	}


}

