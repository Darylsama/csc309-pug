<?php

include_once("include/session.php");
session_start();
$user = get_loggedin_user();


if (isset($user)) {
    // if the user is currently logged in
    
    include_once("controller/game.php");
    $game_controller = new GameController();
    $game_controller->invoke_view_game();
    
} else {
    // if the user is currently not logged in
    
    header("Location: login.php");
}
?>