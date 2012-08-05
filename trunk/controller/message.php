<?php

include_once("model/Model.php");

class MessageController{
	private $user_model;
    private $sport_model;
    private $rating_model;
    private $game_model;
    private $message_model;
    
    
    private $page;
    
    public function __construct() {
         
        $this->user_model = new UserModel();
        $this->sport_model = new SportModel();
        $this->game_model = new GameModel();
        $this->rating_model = new RatingModel();
        $this->message_model = new MessageModel();
        $page = array();
    }
    
    public function invoke_message_box(){
    	$user = get_loggedin_user();
    	$uid = $user->uid;
    	

    	$this->page["page"] = "view/message_box_page.php";
    	$this->page["js"] = "view/message_box.js";
    	
    	include "view/template.php";
    }
    
    public function invoke_get_receive_messages(){
    	$user = get_loggedin_user();
    	$uid = $user->uid;
    	
    	$this->page["messages"] = $this->message_model->get_receive_messages($uid);
    	
    	
    	include "view/receive_messages_part.php";
    }
    
    public function invoke_get_send_messages(){
    	$user = get_loggedin_user();
    	$uid = $uer->uid;
    	
    	$this->page["messages"] = $this->message_model->get_send_messages($uid);
    	
    	
    	include "view/send_messages_part.php";
    }
    
    
    public function invoke_view_message(){
    	
    	if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0){
			$mid = htmlspecialchars($_POST["mid"]);
			
			$message = $this->message_model->get_message($mid);
			$this->page["message"] = $message;
			
			include "view/view_message_part.php";	
				
		}
		else{
			
			return "This message does not exist";
		}
    	
    	
    }
    
    public function invoke_send_message(){
    	
    	
    	
    }
    
	
	
}


?>