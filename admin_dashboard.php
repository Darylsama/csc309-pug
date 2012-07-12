<?php 

include_once("include/session.php");
session_start();
$user = get_loggedin_user();


if (isset($user) && $user -> permission == 2) {
    // if the user is currently logged in

    include_once("controller/admin.php");
    $admin_controller = new AdminController();
    $admin_controller->invoke_dashboard();

} else {
    // if the user is currently not logged in

    header("Location: login.php");
}

?>