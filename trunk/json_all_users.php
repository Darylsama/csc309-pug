<?php

include_once("include/session.php");
session_start();
$user = get_loggedin_user();


if (isset($user)) {
    // if the user is currently logged in
    
    include_once("controller/user.php");
    $user_controller = new UserController();
    $user_controller->invoke_list_user_data_src();
    
} else {
    // if the user is currently not logged in
    
    header("Location: login.php");
}
?>