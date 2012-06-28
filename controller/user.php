<?php

include_once("model/Model.php");

/**
 * user controller
 * encapsulate actions related to the user entity
 */
class UserController {

    // model object
	private $model;
    
    // page array, used to encapsulate some page data
    private $page;

	public function __construct() {
	    
		$this->model = new Model();
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

			$user = $this->model->get_user($username, $password);

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
            $username = $_POST["username"];
            $password = $_POST["password"];
            $permission = $_POST["permission"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];

            $user = $this->model->create_user(
                $uid, 
                $username,
                $password, 
                $permission, 
                $firstname,
                $lastname
            );
            
			include "view/register_page.php";
			$this->model->persist_user($user);

		} else {
		    
		    $this->page["page"] = "view/register_page.php";
			include "view/template.php";
		}
	}

    
    /**
     * invokes the profile handler
     * called by profile.php
     */
	public function invoke_profile() {
	    
        $this->page["page"] = "view/profile_page.php";
        $this->page["title"] = "Dashboard";
        include "view/template.php";
	}
}

?>