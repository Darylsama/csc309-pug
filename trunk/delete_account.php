<?php 

include_once("include/session.php");
// must include session.php which include the User class before calling session_start
// since we're storing an user object in the session variable, php needs a way to un-serialize
session_start();
$user = get_loggedin_user();
if (isset($user)) {

    include_once("controller/user.php");
    $user_controller = new UserController();
    $user_controller->invoke_delete_account();

} else {
    header("Location: login.php");
}

?>