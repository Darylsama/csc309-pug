<?php

include_once("include/session.php");
session_start();
$user = get_loggedin_user();


if (isset($user)) {
    // if the user is currently logged in
    
    include_once("controller/rating.php");
    $rating_controller = new RatingController();
    $rating_controller->invoke_give_rating_organizer();
    
} else {
    // if the user is currently not logged in
    
    header("Location: login.php");
}
?>