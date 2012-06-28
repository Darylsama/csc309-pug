<?php

// global entities used by the application


/**
 * user entity
 * used to represent a single user
 * also stored in session for the ease of access the current logged in user
 */
class User {

    public $uid;
    public $username;
    public $password;
    // password is apart of the entity because persist function uses it to save the user information into a database
    public $permission;
    public $firstname;
    public $lastname;
  
    public function __construct($uid, $username, $password, $permission, $firstname, $lastname) {

        $this->uid = $uid;
        $this->username = $username;
        $this->password = $password;
        $this->permission = $permission;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
}


/**
 * sport entity
 * used to represent a static sport object
 */
class Sport {
	
    public $sid;
	public $name;
	public $description;
	
	public function __construct($sid, $name, $description) {
		
		$this->sid = $sid;
		$this->name = $name;
		$this->description = $description;
	}
}

?>