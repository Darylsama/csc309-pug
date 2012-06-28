<?php

include_once("model/Entities.php");
// requires the user object
// Entities must be included before starting the session, as we're storing our own objects in the session var


/**
 * store the given user in session.
 * can only be called after session start
 */
function set_loggedin_user($user) {

    // must call session start prior to call this
	if (isset($_SESSION)) {
		$_SESSION["user"] = $user;
	}
}

/**
 * returned the currently logged in user
 */
function get_loggedin_user() {

    if (isset($_SESSION["user"])) {
        return $_SESSION["user"];
    } else {
        return null;
    }
}

/**
 * called when logging out
 */
function clear_current_user() {
    
    if (isset($_SESSION)) {
        session_destroy();
    }
}

?>