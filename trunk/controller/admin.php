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
    private $game_model;
    
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
        
         $this->page["js"] = array( "view/js/admin_dashboard.js");
         $this->page["page"] = "view/admin_dashboard_page.php";
         $this->page["title"] = "Administrivia";
         
         include "view/template.php";
    }
	
	

	public function invoke_edit_sport(){
		$user = get_loggedin_user();
		if ($user -> permission != 2) {
			return "You are not the admin user so use do not have the privilege to use this functionality.";	
		}
		else if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
			$sid = htmlspecialchars($_POST["sid"]);
			$sport = $this->sport_model->get_sport($sid);
			$this->page["sid"] = $sid;	
			$this->page["name"] = $sport->name;
			$this->page["description"] = $sport->description;
			include "view/admin_edit_sport_part.php";
		}
		
	}
	
	
	public function invoke_update_sport(){
		$user = get_loggedin_user();
		if ($user -> permission != 2) {
			return "You are not the admin user so use do not have the privilege to use this functionality.";	
		}
		else if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
			
			$sid = htmlspecialchars($_POST["sid"]);
			$name = htmlspecialchars($_POST["name"]);
			$description= htmlspecialchars($_POST["description"]);
			
			$this->sport_model->update_sport($sid, $name, $description);
			$this->invoke_manage_sports();
		}
		
	}
	
	public function invoke_delete_sport(){
		$user = get_loggedin_user();
		if ($user -> permission != 2){
			return "You are not the admin user so use do not have the privilege to use this functionality.";	
		}
		else if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
			
			$sid = htmlspecialchars($_POST["sid"]);
			$this->sport_model->delete_sport($sid);
			
			$this->invoke_manage_sports();
		}
		
	}

	/*
	 * add sport to the whole system, so the user can select 
	 * which sports of these they are experted at
	 */
	public function invoke_add_sport() {
		$user = get_loggedin_user();
		if ($user -> permission != 2) {
			return "You are not the admin user so use do not have the privilege to use this functionality.";	
		}
		
		else if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
			$sportsname = htmlspecialchars($_POST["name"]);
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
						
				$sports = $this->sport_model->create_sport(0, $sportsname, $description,0);
				$this->sport_model->persist_sport($sports);
				$this->invoke_manage_sports();
			}
			
		}
			
		
	}
	
	
	function invoke_manage_users(){
		$users = $this->user_model->get_all_users();
		$this->page["users_information"] = array();
		foreach ($users as $user) {
			$uid = $user->uid;
			$this->page["users_information"][$uid]= array();
			$this->page["users_information"][$uid]["username"] = $user->username;
			$this->page["users_information"][$uid]["type"] = $user->permission;
			$this->page["users_information"][$uid]["joined_games"]=count($this->game_model->get_joined_games($uid)) ;
			$this->page["users_information"][$uid]["interested_games"]= count($this->game_model->get_interested_games($uid));
			$this->page["users_information"][$uid]["organized_games"] = count($this->game_model->get_games($this->user_model->get_user_by_id($uid)));
			$this->page["users_information"][$uid]["player_rates"] = $this->rating_model->get_user_avg_rating($uid);
			$this->page["users_information"][$uid]["organizer_rates"] = $this->rating_model->get_organizer_avg_rating($uid);
			$this->page["users_information"][$uid]["friends"]	= count($this->user_model->get_friends($user->uid));	
		}
		
		include "view/admin_manage_users_part.php";
		
	}
	
	function invoke_delete_user(){
		
		$user = get_loggedin_user();
		if ($user -> permission != 2) {
			return "You are not the admin user so use do not have the privilege to use this functionality.";	
		}
		else if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
			
			$uid = htmlspecialchars($_POST["uid"]);
			$this->user_model->delete_user($uid);
			
			$this->invoke_manage_users();
		}
		
	}
		
	
	function invoke_manage_games(){
		$games = $this->game_model->get_all_games();
		$this->page["game_info"] = array();
		foreach ($games as $game){
			$gid = $game->gid;
			$this->page["game_info"][$gid]["name"] = $game->name;
			$this->page["game_info"][$gid]["organizer"] = $game->organizer->username;
			$this->page["game_info"][$gid]["start_time"]= $game->start_time;
			$this->page["game_info"][$gid]["duration"] = $game->duration;
		}
		include "view/admin_manage_games_part.php";
	}
	
	function invoke_manage_sports(){
		$sports = $this->sport_model->get_all_valid_sports();
		$this->page["sports_info"] = array();
		foreach ($sports as $sport){
			$sid = $sport->sid;
			$this->page["sports_info"][$sid]["name"] = $sport->name;
			$this->page["sports_info"][$sid]["description"] = $sport->description;
			
		}
		include "view/admin_manage_sports_part.php";
	}
	
	
	function invoke_delete_game(){
		
		$user = get_loggedin_user();
		if ($user -> permission != 2) {
			return "You are not the admin user so use do not have the privilege to use this functionality.";	
		}
		else if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
			
			$gid = htmlspecialchars($_POST["gid"]);
			$this->game_model->delete_game($gid);
			
			$this->invoke_manage_games();
		}
		
	}
	
	function invoke_manage_system(){
		
		$this->page["system_info"]=array();
		$this->page["system_info"]["total_users"] = count($this->user_model->get_all_users());
		$this->page["system_info"]["total_games"] = count($this->game_model->get_all_games());
		$this->page["system_info"]["total_sports"] = count($this->sport_model->get_all_sports());
		
		include "view/admin_manage_system_part.php";
		
		
	}
	

}

?>