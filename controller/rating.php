<?php
include_once("model/Model.php");

class RatingController {
	
	private $user_model;
	private $rating_model;
	private $page;
	
	public function __construct(){
		$this->user_model = new UserModel();
		$this->rating_model  = new RatingModel();
		$page = array();
		
	}
	
	public function invoke_give_rating (){

		
		if (isset($_POST["ratee"]) && isset($_POST["value"])) {
			// user submitted login information

			$ratee = $_POST["ratee"];
			// we must check the value is 1.int 2.0-10 both on client side using js and server side 
			// js will play the main role, php as the second prevent
			$value = intval($_POST["value"]);
			$comment = $_POST["comment"];
			$rater = get_loggedin_user();
			
			// how to determine value is int?
			if ((! is_int($value)) || $value>10 || $value<0){
				$this->page["page"] = "";
				$this->page["title"] ="";
				$this->page["err"]= "the value should be an int between 0 and 10.";
				include "view/template.php";
			}
			
	
			elseif (strlen($comment) > 1024){
				$this->page["page"] = "";
				$this->page["title"] ="";
				$this->page["err"]= "the comment should less than 1024 characters.";
			}
	
			else {
				$rating = $this->rating_model->create_rating(0, $rater->uid, $ratee, $value, $comment, 1);
           		$rating = $this->rating_model->persist_rating($rating);
				header("Location: view_user.php?uid=" . $ratee);
			}

		} else {
			// user hasn't submit any login information
			
            $this->page["page"] = "view/login_page.php";
            $this->page["title"] = "Login";
            include "view/template.php";
		}
		
		
	}


	public function invoke_give_rating_organizer (){

		
		if (isset($_POST["ratee"]) && isset($_POST["value"])) {
			// user submitted login information

			$ratee = $_POST["ratee"];
			// we must check the value is 1.int 2.0-10 both on client side using js and server side 
			// js will play the main role, php as the second prevent
			$value = intval($_POST["value"]);
			$comment = $_POST["comment"];
			$rater = get_loggedin_user();
			
			// how to determine value is int?
			if ((! is_int($value)) || $value>10 || $value<0){
				$this->page["page"] = "";
				$this->page["title"] ="";
				$this->page["err"]= "the value should be an int between 0 and 10.";
				include "view/template.php";
			}
			
	
			elseif (strlen($comment) > 1024){
				$this->page["page"] = "";
				$this->page["title"] ="";
				$this->page["err"]= "the comment should less than 1024 characters.";
			}
	
			else {
				$rating = $this->rating_model->create_rating(0, $rater->uid, $ratee, $value, $comment, 0);
           		$rating = $this->rating_model->persist_rating($rating);
				header("Location: view_user.php?uid=" . $ratee);
			}

		} else {
			// user hasn't submit any login information
			
            $this->page["page"] = "view/login_page.php";
            $this->page["title"] = "Login";
            include "view/template.php";
		}
		
		
	}
	
	
	
}


?>


