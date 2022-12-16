<?php

namespace app\models;

use app\core\Model;

use PDO;

class Objects extends Model
{
	protected $table='objects';

	public function createTree($data)
	 {
	    $parents = [];
	    foreach ($data as $key => $item)
	    {
	      $parents[$item['parent_id']][$item['id']] = $item;
	    }
	    $treeElem = $parents[0];
	    $this->generateElemTree($treeElem, $parents);
	    return $treeElem;
	 }
	private function generateElemTree(&$treeElem, $parents, $i=0)
	{
	    foreach ($treeElem as $key => $item)
	    {
	    	$treeElem[$key]['i']=$i;
	    	if (!isset($item['children'])) $treeElem[$key]['children'] = [];
	    	if (array_key_exists($key, $parents))
	    	{
	    		$treeElem[$key]['children'] = $parents[$key];
	    		$i++;
	        	$this->generateElemTree($treeElem[$key]['children'], $parents,$i);
	        	$i--;
	    	} 
	    }
	}
	public function print_objects($data,$str='',$i=0)
	{
		if(count($data)>0)
		{
			foreach($data as $val)
			{
				$str.='<tr parent_id='.$val['parent_id'].' hidden_children="true" class="object_row" id=object_'.$val['id'].'><td class="object_title" style="padding-left:'.($val['i']*2).'%">'.$val['title'].'</td><td align="center"><td></tr>';
				if(count($val['children'])>0) 
				{
					$i++;
					$str.=$this->print_objects($val['children'],null,$i);
				}
				elseif($i>0) $i=$i-1;
			}
		}
		return $str;
	}
	
}