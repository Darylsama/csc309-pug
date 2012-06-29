<?php

include_once("model/Model.php");

class GameController {

    private $game_model;
    private $sport_model;
    private $page;

    public function __construct() {

        $this->game_model = new GameModel();
        $this->sport_model = new SportModel();
        $page = array();
    }

    public function invoke_list_games() {

        $games = $this->game_model->get_all_games();

        $this->page["page"] = "view/list_games_page.php";
        $this->page["title"] = "Pick-up Games";

        $this->page["games"] = $games;

        include "view/template.php";
    }


    /**
     * handler for creating a new game
     */
    public function invoke_new_game() {

        if (isset($_SERVER['CONTENT_LENGTH']) &&
                        (int) $_SERVER['CONTENT_LENGTH'] > 0) {

            $gid = 0;
            $name = $_POST["gamename"];
            $organizer = get_loggedin_user()->uid;
            $creation = date("Y-m-d");
            $sport = $_POST["sport"];
            $description = $_POST["description"];

            $game = $this->game_model->create_game($gid, $name, $organizer, $creation, $sport, $description);
            $this->game_model->persist_game($game);

            header("Location: view_game.php?gid=" . $game->gid);

        } else {

            $this->page["page"] = "view/create_game_page.php";
            $this->page["title"] = "Create New Game";

            $sports = $this->sport_model->get_sports(get_loggedin_user());
            $this->page["sports"] = $sports;
            // the create new game form has a drop down for selecting sports
            // thus the games for the current user is required

            include "view/template.php";
        }
    }

    public function invoke_view_game() {

        $this->page["page"] = "view/view_game_page.php";
        $this->page["title"] = "View Game";

        $gid = $_GET["gid"];
        $game = $this->game_model->get_game($gid);
        $this->page["game"] = $game;

        $is_interested = $this->game_model->is_interested(get_loggedin_user(), $gid);
        $this->page["is_interested"] = $is_interested; 
        
        $interested_players = $this->game_model->get_interested_players($gid);
        $this->page["interested_players"] = $interested_players;
        
        include "view/template.php";
    }

    public function invoke_interest() {

        if (isset($_SERVER['CONTENT_LENGTH']) &&
            (int) $_SERVER['CONTENT_LENGTH'] > 0) {
            
            $gid = $_POST["gid"];
            $this->game_model->express_interest(get_loggedin_user(), $gid);
            
            header("Location: view_game.php?gid=" . $gid);
        }
    }
}

?>