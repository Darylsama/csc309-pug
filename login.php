<?php

include_once("include/session.php");
// must include session.php which include the User class before calling session_start
// since we're storing an user object in the session variable, php needs a way to un-serialize
session_start();
$user = get_loggedin_user();

include_once("controller/user.php");

if (isset($user)) {
    // redirect the user if he/she had already logged in    
    
    header("Location: profile.php");
} else {

    $user_controller = new UserController();
    $user_controller->invoke_login();
}

?>