<?php

include_once("model/Model.php");

/**
 * user controller
 * encapsulate actions related to the user entity
 */
class UserController {

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

	/**
	 * login handler
     * can be called from login.php
     * maybe sanitize user input?
	 */
	public function invoke_login() {

		if (isset($_POST["username"]) && isset($_POST["password"])) {
			// user submitted login information

			$username = htmlspecialchars($_POST["username"]);
			$password = htmlspecialchars($_POST["password"]);

			$user = $this->user_model->get_user($username, $password);

			if ($user == false) {
			    
                $this->page["page"] = "view/login_page.php";
                $this->page["title"] = "Login";
                $this->page["err"] = "Username/Password Incorrect.";
                
				include "view/template.php";
                
			} else {
			    
				set_loggedin_user($user);
                header("Location: profile.php");
			}

		} else {
			// user hasn't submit any login information
			
            $this->page["page"] = "view/login_page.php";
            $this->page["title"] = "Login";
            include "view/template.php";
		}
	}


	/**
	 * register handler
     * can called from register.php
     * should create a checking function
	 */
	public function invoke_register() {

		if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
			    
			
            $uid = 0;
            // new user uses 0 as uid
			// another id will be generated for the user when this instance is persisted
			
            $username = htmlspecialchars($_POST["username"]);
			if ($this->user_model->username_exist($username)){
				$this->page["page"] = "view/register_page.php";
				$this->page["title"] = "Register";
				$this->page["err"] = "the user name already exist, please choose anthor username";
				include "view/template.php";
			}
			
			else {
				
            	$password = htmlspecialchars($_POST["password"]);
            	$permission = 1;
            	$firstname = htmlspecialchars($_POST["firstname"]);
            	$lastname = htmlspecialchars($_POST["lastname"]);
		
			
            	$user = $this->user_model->create_user(
               		$uid, 
                	$username,
                	$password, 
                	$permission, 
                	$firstname,
                	$lastname
            	);
				$this->user_model->persist_user($user);
				// redirect user to the login page
				// can be handled better
				include "login.php";
			}

		} else {
		    
		    $this->page["page"] = "view/register_page.php";
			$this->page["title"] = "Register";
			include "view/template.php";
		}
	}

    
    /**
     * invokes the profile handler
     * called by profile.php
     */
	public function invoke_profile() {
		
		$user = get_loggedin_user();
		
        $this->page["page"] = "view/profile_page.php";
        $this->page["title"] = "Dashboard";
		$this->page["current_sports"] = $this->sport_model->get_sports($user);
        include "view/template.php";
	}
	
	
	public function invoke_list_users() {
		$uid = get_loggedin_user()->uid;
		$this->page["page"] = "view/list_user_page.php";
		$this->page["title"] = "Genneral Users Information";
		$this->page["users"] = $this->user_model->get_all_users();
		$this->page["friends"] = $this->user_model->get_friends($uid); 

		include "view/template.php";
	}
	
	
	
	public function invoke_view_user() {
		
		$userid1 = get_loggedin_user()->uid;
		$userid2 = $_GET["uid"];
		
		
		if (! ($this->user_model->is_friend($userid1, $userid2))) {
			//if not friend
			
			$this->page["page"] = "view/view_user_page.php";
			$this->page["title"] = "User Information";	
			$uid = $userid2;
			$this->page["user"] = $this->user_model->get_user_by_id($uid);
			$this->page["rating"] = $this->rating_model->get_user_avg_rating($uid);
			
			$this->page["joined_game"] = $this->game_model->get_joined_games($uid);

			$this->page["interested_game"] = $this->game_model->get_interested_games($uid);
			$this->page["organized_game"] = $this->game_model->get_games($this->user_model->get_user_by_id($uid));
			include "view/template.php";
		}
		else {
			//if they're friends
			
			$this->page["page"] = "view/view_friend_page.php";
			$this->page["title"] = "User Information: friend";
			$uid = $userid2;
			$this->page["user"] = $this->user_model->get_user_by_id($uid);
			$this->page["player_rates"] = $this->rating_model->get_user_avg_rating($uid);
			$this->page["organizer_rates"] = $this->rating_model->get_organizer_avg_rating($uid);
			$this->page["joined_game"] = $this->game_model->get_joined_games($uid);
			$this->page["interested_game"] = $this->game_model->get_interested_games($uid);
			$this->page["organized_game"] = $this->game_model->get_games($this->user_model->get_user_by_id($uid));
		
			$this->page["rate_player_before"] = $this->rating_model->rate_player_before($userid1, $uid);
		
			$this->page["rate_organizer_before"] = $this->rating_model->rate_organizer_before($userid1, $uid);
	
			$this->page["can_rate_organizer"] = $this->rating_model->can_rate_organizer($userid1, $userid2);

			include "view/template.php";
			
		}
	}
	
}

?>