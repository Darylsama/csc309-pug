<?php

class SportController {
	
	
	private $model;
	private $page;
	
	public function __construct() {
	    
		$this->model = new SportModel();
        $page = array();
	}
}

?>