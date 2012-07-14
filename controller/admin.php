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
	
	public function invoke_view_sports() {
		$user = get_loggedin_user();
		if ($user -> type != 2) {
			$this -> page["err"] = "You are not the admin user so use do not have the privilege to use this functionality.";
		}
		else {
			$this->page["page"] = "view/admin_dashboard_page.php";
			$this -> page["sports"] = $sport_model->get_all_sports();
			$this->page["title"] = "Dashboard";
			include "view/template.php";
		}
		
	}
	

	
	public function invoke_add_sport() {
		$user = get_loggedin_user();
		if ($user -> type != 2) {
			$this->page["err"] = "You are not the admin user so use do not have the privilege to use this functionality.";	
		}
		
		else if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
			$sportsname = htmlspecialchars($_POST["sportsname"]);
			$description = htmlspecialchars($_POST["description"]);
			
			if (! isset($sportsname)){
				$this->page["err"] = "Please give the name of the sport you want to create.";
			} 
			else if (! isset($description)){
				$this->page["err"] = "Please give the description of this sport.";
			}
			else if (strlen($sportsname) > 64) {
				$this->page["err"] = "The length of the name should be less then 64 characters.";
			}
			else if (strlen($description) > 1024){
				$this->page["err"] = "The length of the description should be less then 1024 characters.";
			}
			else if ((strlen($description) <= 1024) && strlen($sportsname) <=64 ) {
						
				$sports = $this->sport_model->create_sport(0, $sportsname, $description);
				$this->sport_model->persist_sport($sports);
			}
			
		}
			
		else {
			$this->page["page"] = "view/admin_dashboard_page.php";
			$this->page["title"] = "Dashboard";
			include "view/template.php";
			
		}
		
	}
	
		
		
	
    
}

?>