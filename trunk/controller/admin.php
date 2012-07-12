<?php

/**
 * default admin controller
 */

include_once("model/Model.php");

class AdminController {
    
    // model object
    private $user_model;
    private $sport_model;
    private $rating_model;
    
    // page array, used to encapsulate some page data
    private $page;
    
    public function __construct() {
         
        $this->user_model = new UserModel();
        $this->sport_model = new SportModel();
        $this->game_model = new GameModel();
        $this->rating_model = new RatingModel();
        $page = array();
    }
    
    public function invoke_dashboard() {
        
         $this->page["page"] = "view/admin_dashboard_page.php";
         $this->page["title"] = "Administrivia";
         
         include "view/template.php";
    }
    
}

?>