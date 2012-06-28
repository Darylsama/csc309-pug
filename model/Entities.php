<?php

// gloal entities used by the application


/**
 * user entity
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
        $this->username = $password;
        $this->permission = $permission;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
}

?>