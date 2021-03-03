<?php namespace App\Controllers;

use App\Models\Menuweb_model;
use CodeIgniter\API\ResponseTrait;

class Menuweb extends BaseController
{
	use ResponseTrait;

	public function __construct()
    {
        $this->menus = new Menuweb_model();
    }

	public function getmenus()
	{
        $menu=$this->menus->main_menu();
        $data=array();
        $induks=array();
        foreach ($menu->getResultArray() as $row) {
        	$submenu=$this->menus->getSubMenus($row['_id']);
        	if (count($submenu->getResultArray()) > 0){
        		$subm=array();
        		foreach ($submenu->getResultArray() as $sub) {
	        		$subm[]=array(
	        				'uri'	=> $sub['uri'],
	        				'title'	=> $sub['title'],
	        				'icon'	=> $sub['icon']
	        			);
	        	}
        		$data[]=array(
        			'id'		=> $row['_id'],
	        		'uri'		=> $row['uri'],
    				'title'		=> $row['title'],
                    'numsub'    => count($submenu->getResultArray()),
    				'icon'		=> $row['icon'],
	        		'submenu'	=> $subm
        		);
        	}else{
        		$data[]=array(
        			'id'		=> $row['_id'],
	        		'uri'		=> $row['uri'],
    				'title'		=> $row['title'],
    				'icon'		=> $row['icon'],
	        		'numsub'	=> 0
        		);
        	}
        }
        return json_encode($data);
	}

}
