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


/**
 * encapsulate the information found in a game
 */
class Game {
    
    
    // foreign keys: organizer: sport
    // consider constructing those as object 
    public $gid;
    public $name;
    public $organizer;
    public $creation;
    public $sport;
    public $desc;
    
    public function __construct($gid, $name, $organizer, $creation, $sport, $desc) {
        
        $this->gid = $gid;
        $this->name = $name;
        $this->organizer = $organizer;
        $this->creation = $creation;
        $this->sport = $sport;
        $this->desc = $desc;
    }
}


class Rating {
	
	public $rid;
	public $rater;
	public $ratee;
	public $value;
	public $comment;
	public $type;
	
	
	public function __construct($rid, $rater, $ratee, $value, $comment, $type) {
		
		$this->rid = $rid;
		$this->ratee = $ratee;
		$this->rater = $rater;
		$this->value = $value;
		$this->comment = $comment;
		$this->type = $type;		
		
	}	
	
	
}

class Announcement {
	
}


class Messages {
	
	public $mid;
	public $to;
	public $from;
	public $content;
	
	public function __construct($mid, $to, $from, $content) {
		
		$this->mid = $mid;
		$this->to = $to;
		$this->from = $from;
		$this->content = $content;
		
	}
	
	
	
}



?>