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

	/**
	 * login handler
     * can be called from login.php
     * sanitize the user input and 
	 * verify the username and password
	 * of the user
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
                
			} else if($user->status == 1){
				$this->page["page"] = "view/login_page.php";
                $this->page["title"] = "Login";
                $this->page["err"] = "Your account has been deleted.";
                
				include "view/template.php";
				
			}
			
			else{
			    
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
                	$lastname,
                	0
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

	public function invoke_delete_account(){
		$uid = get_loggedin_user()->uid;
		$this->user_model->delete_user($uid);
		$this->page["page"] = "view/login_page.php";
        $this->page["title"] = "Login";
        include "view/template.php";

	}
    
    /**
     * invokes the profile handler
     * called by profile.php
	 * and set the page content for 
	 * profile_page.php
     */
	public function invoke_profile() {
		
	    // retrieving user ids
	    if (isset($_GET["uid"])) {
    	    $profile_owner_id = htmlspecialchars($_GET["uid"]);
	    }
	    $loggedin_user = get_loggedin_user();
        $loggedin_user_id = $loggedin_user->uid;
		
		// general page information
        $this->page["page"] = "view/profile_page.php";
        $this->page["title"] = "Profile : " . $loggedin_user -> username;
        
        // if the viewer is the profile owner
        if (!isset($profile_owner_id) || $profile_owner_id == $loggedin_user_id) {
            
    		$this->page["current_sports"] = $this->sport_model->get_sports($loggedin_user);
    		$this->page["organized_game"] = $this->game_model->get_games($this->user_model->get_user_by_id($loggedin_user_id));
    		$this->page["joined_game"] = $this->game_model->get_joined_games($loggedin_user_id);
    		$this->page["interested_game"] = $this->game_model->get_interested_games($loggedin_user_id);
    		$this->page["player_rates"] = $this->rating_model->get_user_avg_rating($loggedin_user_id);
    		$this->page["organizer_rates"] = $this->rating_model->get_organizer_avg_rating($loggedin_user_id);
    		
    		// use the owner template
    		$this->page["page"] = "view/profile_page.php";
    		
    	// if the viewer of the profile is a friend of the owner of the profile
        } else if ($this->user_model->is_friend($loggedin_user_id, $profile_owner_id)) {
            
            $this->page["css"] = array("view/css/rating.css");
            $this->page["js"] = array(
                "view/js/rating.js",
                "view/js/player_rating.js"
            );
             
            $this->page["user"] = $profile_owner = $this->user_model->get_user_by_id($profile_owner_id);
            $this->page["player_rates"] = $this->rating_model->get_user_avg_rating($profile_owner_id);
            $this->page["organizer_rates"] = $this->rating_model->get_organizer_avg_rating($profile_owner_id);
            $this->page["joined_game"] = $this->game_model->get_joined_games($profile_owner_id);
            $this->page["interested_game"] = $this->game_model->get_interested_games($profile_owner_id);
            $this->page["organized_game"] = $this->game_model->get_games($profile_owner);
            //if this user rated this friend before, he/she can't rate this friend again
            $this->page["rate_player_before"] = $this->rating_model->rate_player_before($loggedin_user_id, $profile_owner_id);
            //if this user rated this friend as organizer before, he/she can't rate this friend as organizer again
            $this->page["rate_organizer_before"] = $this->rating_model->rate_organizer_before($loggedin_user_id, $profile_owner_id);
            //an user can only rate a friend as organizer if he/she joined the game organized by this friend before
            $this->page["can_rate_organizer"] = $this->rating_model->can_rate_organizer($loggedin_user_id, $profile_owner_id);
           
            // use the friend page template
            $this->page["page"] = "view/view_friend_page.php";
            
        // if the viewer of the profile has no relation with the owner of the profile
        } else {
            
            $this->page["user"] = $profile_owner = $this->user_model->get_user_by_id($profile_owner_id);
            $this->page["player_rates"] = $this->rating_model->get_user_avg_rating($profile_owner_id);
            $this->page["organizer_rates"] = $this->rating_model->get_organizer_avg_rating($profile_owner_id);
            $this->page["joined_game"] = $this->game_model->get_joined_games($profile_owner_id);
            $this->page["interested_game"] = $this->game_model->get_interested_games($profile_owner_id);
            $this->page["organized_game"] = $this->game_model->get_games($profile_owner);
            
            // use the default template
            $this->page["page"] = "view/view_user_page.php";
        }
        
        include "view/template.php";
	}
	
	
	/** 
	 * invokes the list user handler
	 * called by list_user.php
	 * set the content for page of list_user_pages.php
	 */
	public function invoke_list_users() {
		$uid = get_loggedin_user()->uid;
		$this->page["page"] = "view/list_users_page.php";
		$this->page["js"] = array("view/js/list_users.js");
		$this->page["css"]= array("view/css/list_users.css");
		$this->page["title"] = "Genneral Users Information";
		$this->page["user_info"] = array();
		$users = $this->user_model->get_all_valid_users();
		foreach ($users as $user){
			$this->page["user_info"][$user->uid]["username"] = $user->username;
			$this->page["user_info"][$user->uid]["player_rates"] = $this->rating_model->get_user_avg_rating($uid);
			$this->page["user_info"][$user->uid]["organizer_rates"] = $this->rating_model->get_organizer_avg_rating($uid);
		}
		$friends = $this->user_model->get_friends($uid);
		$this->page["friend_info"] =array();
		
		foreach ($friends as $user){
			$this->page["friend_info"][$user->uid]["username"] = $user->username;
			$this->page["friend_info"][$user->uid]["player_rates"] = $this->rating_model->get_user_avg_rating($uid);
			$this->page["friend_info"][$user->uid]["organizer_rates"] = $this->rating_model->get_organizer_avg_rating($uid);
		} 

		include "view/template.php";
	}
	
	
	
	/*
	 *invoke the edit_profile handler 
	 * and set the page content of edit_profile.php page
	 * on which can let user to edit their profile  
	 */
	function invoke_edit_profile() {
		
		$user = get_loggedin_user();
		$this->page["title"]="Edit Profile";
		$this->page["page"]="edit_profile_page.php";
		$this->page["js"] = array("view/js/select_sports.js");
		
		$this->page["username"] = $user->username;
		$this->page["firstname"] = $user->firstname;
		$this->page["lastname"] = $user->lastname;
		
		$this->page["current_sports"] = $this->sport_model->get_sports($user);
		$this->page["all_sports"] = $this->sport_model->get_all_sports();
		
		include "view/template.php";
		
	}
	
	/*
	 * 
	 */
	function invoke_update_profile() {
		
		$user= get_loggedin_user();
		$uid=$user->uid;
		
	    $update_password = false;
        $update_sports = false;
	    
        $username = htmlspecialchars($_POST["username"]);
        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]);
        
        $oldpass = $_POST["oldpass"];
        $newpass = $_POST["newpass"];
        $confirm = $_POST['confirm'];
        
        if (isset($_POST["sports"])) {
            $sports = $_POST["sports"];
            $update_sports = true;
        }
        
	    // error checking user name
		if ($this->user_model->username_exist($username) and $username!=$user->username) {
		    
			$this->page["title"] = "Edit Profile";
			$this->page["page"] = "view/edit_profile_page.php";
			$this->page["js"] = array("view/js/select_sports.js");
			$this->page["err"] = "the user name already exist, please choose anthor username";
			$this->invoke_edit_profile();
		}
		
		// error checking edit profile
		if (strlen($oldpass) && strlen($newpass) && strlen($confirm)) {
		    $user = $this->user_model->get_user($username, $_POST["oldpass"]);
		    if ($user == false){
		        // error message here
		        $this->invoke_edit_profile();
		    }
		    else if ($newpass != $confirm){
		        // error message here
		        $this->invoke_edit_profile();
		    }
		    else{
		        $update_password = true;
		    }
		}
		
		// update user
		$user_new = $this->user_model->update_profile($uid, $username, $firstname, $lastname);
		set_loggedin_user($user_new);
		
		// update password
		if ($update_password) {
		    $this->user_model->update_password($uid, $newpass);
		}
		
		// update newly selected sports
		if ($update_sports) {
    		
    		foreach ($sports as $sid){
    		    $sport = $this->sport_model->get_sport($sid);
    		    $this->sport_model->add_sports($user, $sport);
    		}
		}
		
		header("Location: profile.php");
	
	}
}

?>