<?php

include_once("model/Model.php");

/**
 * game controller
 * encapsulate actions related to the game entity
 */
class GameController {

	// model objects
    private $game_model;
    private $sport_model;
	private $user_model;
	
	// page array, used to encapsulate some page data
    private $page;

    public function __construct() {

        $this->game_model = new GameModel();
        $this->sport_model = new SportModel();
		$this->user_model = new UserModel();
        $page = array();
    }

	/*
	 * invokes the list game called 
	 * by list_games.php and set the
	 * detail content of page for list_games_page.php
	 * */
    public function invoke_list_games() {
		
		// set games to be an array of game object that use their gid as the key
        $games = $this->game_model->get_all_games();

        $this->page["page"] = "view/list_games_page.php";
        $this->page["title"] = "Pick-up Games";

        $this->page["games"] = $games;

        include "view/template.php";
    }


    /**
     * handler for creating a new game
	 * can called by new_game.php
	 * should create a checking function
     */
    public function invoke_new_game() {

        if (isset($_SERVER['CONTENT_LENGTH']) &&
                        (int) $_SERVER['CONTENT_LENGTH'] > 0) {

            $gid = 0;
            $name = htmlspecialchars($_POST["gamename"]);
            $organizer = get_loggedin_user()->uid;
            $creation = date("Y-m-d");
            $sport = htmlspecialchars($_POST["sport"]);
            $description = htmlspecialchars($_POST["description"]);
			
			// set the gid to be 0 as default
            $game = $this->game_model->create_game($gid, $name, $organizer, NULL, NULL, $creation, $sport, $description);
            // another id will be generated automatically by mysql for the game when this instance is persisted
            $this->game_model->persist_game($game);

            header("Location: view_game.php?gid=" . $game->gid);

        } else {	// the client dosen't send anything, so stay on this page
			
            $this->page["page"] = "view/create_game_page.php";
            $this->page["title"] = "Create New Game";

            $sports = $this->sport_model->get_sports(get_loggedin_user());
            $this->page["sports"] = $sports;
            // the create new game form has a drop down for selecting sports
            // thus the games for the current user is required

            include "view/template.php";
        }
    }

    /**
     * invoked when the user opened the view game page
	 * and set the detail content of page for view_game_page.php
     */
    public function invoke_view_game() {

        // general information about the page
        $this->page["page"] = "view/view_game_page.php";
        $this->page["title"] = "View Game";
        $this->page["js"] = array("view/js/select_player.js");

        // the game to be displayed on the page
        $gid = $_GET["gid"];
        $game = $this->game_model->get_game($gid);
        $this->page["game"] = $game;

        // status of the current player related to the game
        $participation_status = $this->game_model->get_user_selected_status(get_loggedin_user(), $gid);
        $this->page["status"] = $participation_status;
        
        // a list of interested players
        $interested_players = $this->game_model->get_interested_players($gid);
        $this->page["interested_players"] = $interested_players;
        // var_dump($interested_players);
        // die();        
        
        // a list of selected players
        $selected_players = $this->game_model->get_selected_players($gid);
        $this->page["selected_players"] = $selected_players;
        
        include "view/template.php";
    }

    /**
     * invoke this when a user express interest for a particular game
	 * and wait for being selected by the organizer
	 * need to write the checking method to verify the parameters given by the client later
     */
    public function invoke_interest() {

        if (isset($_SERVER['CONTENT_LENGTH']) &&
            (int) $_SERVER['CONTENT_LENGTH'] > 0) {
            
            $gid = htmlspecialchars($_POST["gid"]);
            $this->game_model->express_interest(get_loggedin_user(), $gid);
            
            header("Location: view_game.php?gid=" . $gid);
        }
    }

	public function invoke_cancel_interest() {
		
		if (isset($_SERVER['CONTENT_LENGTH']) &&
			(int) $_SERVER['CONTENT_LENGTH'] > 0) {
				
			$gid = htmlspecialchars($_POST["gid"]);
			$this->game_model->cancel_interest(get_loggedin_user(), $gid);	
			
			header("Location: view_game.php?gid=" . $gid);
		}
	}
	
    
    /**
     * invoked this when a game organizer select a player to participate in a game
	 * need to write the checking method to verify the parameters given by the client later
     */
    public function invoke_select_player() {
        
        if (isset($_SERVER['CONTENT_LENGTH']) &&
            (int) $_SERVER['CONTENT_LENGTH'] > 0) {
        
            $gid = htmlspecialchars($_POST["gid"]);
            $pid = htmlspecialchars($_POST["pid"]);
			
			// all other users in this game before become a friend of this user
            $this->user_model->create_friendships($pid, $gid);
            $this->game_model->join_game($pid, $gid);

            header("Location: view_game.php?gid=" . $gid);
        }
    }
}

?>