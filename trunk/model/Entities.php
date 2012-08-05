<?php

// global entities used by the application


/**
 * user entity
 * used to represent a single user
 * also stored in session for the ease of access the current logged in user
 */
class User {

    public $uid; 		//unique id for each user
    public $username; 	//the username chosed by user, should be unique
    public $password; 	// password is apart of the entity because persist function uses it to save the user information into a database
    public $permission; // 1 is normal user and 2 is an admin
    public $firstname; 
    public $lastname;
    public $status;
  
    public function __construct($uid, $username, $password, $permission, $firstname, $lastname, $status) {

        $this->uid = $uid;
        $this->username = $username;
        $this->password = $password;
        $this->permission = $permission;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->status = $status;
    }
}


/**
 * sport entity
 * used to represent a static sport object
 */
class Sport {
	
    public $sid;		//unique id for a sport entity
	public $name;		//name of this sport
	public $description;//the description of this sport
	public $status;
	
	public function __construct($sid, $name, $description, $status) {
		
		$this->sid = $sid; 		
		$this->name = $name;	
		$this->description = $description; 
		$this->status = $status;
	}
}


/**
 * game entity
 * used to represent a game in this pick-up game system
 */
class Game {
    
    
    // foreign keys: organizer: sport
    // consider constructing those as object 
    public $gid; 	// unique id for game
    public $name;	// name of this game
    public $organizer;	//user id of the organizer of this game
    public $start_time; //the start time of this game
	public $duration;	//the end time of this game
    public $creation;	//the date of this creation
    public $sport;		//the sport type of this game
    public $desc;		//description of this game
    public $status;
    
    public function __construct($gid, $name, $organizer, $start_time, $duration, $creation, $sport, $desc, $status) {
        
        $this->gid = $gid;
        $this->name = $name;
        $this->organizer = $organizer;
		$this->start_time = $start_time;
		$this->duration = $duration;
        $this->creation = $creation;
        $this->sport = $sport;
        $this->desc = $desc;
        $this->status = $status;
    }
}


/*
 * rating entity 
 * used to represent a rating object given by a rater to ratee
 */
class Rating {
	
	public $rid;	//unique id for each rating entity
	public $rater;	//user id of the rater
	public $ratee;	//user id of the ratee
	public $value;	//the value given by the rater to ratee
	public $comment;//comment given by the rater to ratee
	public $type;	//0 is the rating for ratee as organizer, 1 is the rating for ratee as player
	
	
	public function __construct($rid, $rater, $ratee, $value, $comment, $type) {
		
		$this->rid = $rid;
		$this->ratee = $ratee;
		$this->rater = $rater;
		$this->value = $value;
		$this->comment = $comment;
		$this->type = $type;		
		
	}	
	
	
}

/*
 * message entity 
 * used to represent the message object sent by one user to another user
 */
class Messages {
	
	public $mid;	//unique id for messages
	public $to;		//the user id of the user this message is sent to
	public $from;	//the user id of the user this message is sent by
	public $subject;//the subject of this message
	public $body;//the content of this message
	public $create_time;
	
	
	public function __construct($mid, $to, $from, $subject, $body, $create_time) {
		
		$this->mid = $mid;
		$this->to = $to;
		$this->from = $from;
		$this->subject = $subject;
		$this->body = $body;
		$this->create_time = $create_time;
		
		
	}
	
	
	
}



?>