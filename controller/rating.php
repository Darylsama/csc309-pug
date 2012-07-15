<?php
include_once("model/Model.php");


/**
 * rating controller
 * encapsulate actions related to the rating entity
 */
class RatingController {
	
	// model objects
	private $user_model;
	private $rating_model;
	
	// page array, used to encapsulate some page data
	private $page;
	
	public function __construct(){
		$this->user_model = new UserModel();
		$this->rating_model  = new RatingModel();
		$page = array();
		
	}
	
	/*
	 * give_rating handler called while 
	 * a user try to give rating to a friend as player
	 * and show the user view_user_page.php or view_friend_page.php
	 * after this opertion
	 */
	public function invoke_give_rating (){

		
		if (isset($_POST["ratee"]) && isset($_POST["value"])) {
			// user submitted login information

			$ratee = htmlspecialchars($_POST["ratee"]);
			// we must check the value is 1.int 2.0-10 both on client side using js and server side 
			// js will play the main role, php as the second prevent
			$value = intval(htmlspecialchars($_POST["value"]));
			$comment = htmlspecialchars($_POST["comment"]);
			$rater = get_loggedin_user();
			
			// how to determine value is int?
			if ((! is_int($value)) || $value>5 || $value<0){
				$this->page["page"] = "";
				$this->page["title"] ="";
				$this->page["err"]= "the value should be an int between 0 and 10.";
				include "view/template.php";
			}
			
			// the comment shouldn't more than 1024 characters
			elseif (strlen($comment) > 1024){
				$this->page["page"] = "";
				$this->page["title"] ="";
				$this->page["err"]= "the comment should less than 1024 characters.";
				include "view/template.php";
			}
	
			else {
				//set the id to be 0 as default, and the type to be 1(player)
				//the truly id will be associated to rating object after persist_rating is called
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

	/*
	 * give_rating handler called while 
	 * a user try to give rating to a friend as organizer
	 * and show the user view_user_page.php or view_friend_page.php
	 * after this opertion
	 */
	public function invoke_give_rating_organizer (){

		
		if (isset($_POST["ratee"]) && isset($_POST["value"])) {
			// user submitted login information

			$ratee = htmlspecialchars($_POST["ratee"]);
			// we must check the value is 1.int 2.0-10 both on client side using js and server side 
			// js will play the main role, php as the second prevent
			$value = intval(htmlspecialchars($_POST["value"]));
			$comment = "";// set comment to be empty as default, will implement later
			$rater = get_loggedin_user();
			// how to determine value is int?
			if ((! is_int($value)) || $value>5 || $value<0){
				$this->page["page"] = "";
				$this->page["title"] ="";
				$this->page["err"]= "the value should be an int between 0 and 10.";
				include "view/template.php";
			}
			
			// the comment shouldn't more than 1024 characters
			// the comment function will be imp
			elseif (strlen($comment) > 1024){
				$this->page["page"] = "";
				$this->page["title"] ="";
				$this->page["err"]= "the comment should less than 1024 characters.";
			}
			
			else {
				//set the id to be 0 as default, and the type to be organizer
				//the truly id will be associated to rating object after persist_rating is called
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


