<?php

include_once("include/session.php");
session_start();
$user = get_loggedin_user();


if (isset($user)) {
    // if the user is currently logged in
    
    include_once("controller/message.php");
    $message_controller = new MessageController();
    $message_controller->invoke_message_box();
    
} else {
    // if the user is currently not logged in
    
    header("Location: login.php");
}
?>