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
    
    // page array, used to encapsulate some page data
    private $page;

	public function __construct() {
	    
		$this->user_model = new UserModel();
		$this->sport_model = new SportModel();
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

			$username = $_POST["username"];
			$password = $_POST["password"];

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
            $username = $_POST["username"];
            $password = $_POST["password"];
            $permission = 1;
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];

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
		
		$this->page["page"] = "view/list_user_page.php";
		$this->page["title"] = "Genneral Users Information";
		$this->page["users"] = $this->user_model->get_all_users();
		include "view/template.php";
	}
	
	public function invoke_view_user() {
		
		$this->page["page"] = "view/view_user_page.php";
		$this->page["title"] = "User Information";
		
		$uid = $_GET["uid"];
		$this->page["user"] = $this->user_model->get_user_by_id($uid);
		
		include "view/template.php";
		
	}
}

?>