<?php

include_once("include/session.php");
session_start();
$user = get_loggedin_user();

if (isset($user)) { 
	include_once("controller/admin.php");
	$admin_controller = new AdminController();
	$admin_controller->invoke_manage_system();
}
else {
	header("Location: login.php");
}


?>