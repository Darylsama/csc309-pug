<?php

include_once("include/session.php");
session_start();
$user = get_loggedin_user();


if (isset($user)) {
    // if the user is currently logged in
    
    include_once("controller/rating.php");
    $user_controller = new RatingController();
    $user_controller->invoke_give_rating();
    
} else {
    // if the user is currently not logged in
    
    header("Location: login.php");
}
?>