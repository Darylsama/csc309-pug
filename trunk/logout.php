<?php

include_once("include/session.php");
session_start();
$user = get_loggedin_user();

clear_current_user();
header("Location: login.php");

?>