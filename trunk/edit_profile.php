<?php

	include_once("include/session.php");
	session_start();
	$user = get_loggedin_user();

	include_once("controller/user.php");
	$user_controller = new UserController();
	$user_controller->invoke_edit_profile();

?>