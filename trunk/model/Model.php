<?php

include_once("Entities.php");
include_once("include/db.php");

// universal entity management module
// all model actions goes here
// consider split this up later on

class Model {

	/**
	 * create new user object
	 */
	public function create_user($uid, $username, $password, $permission, $firstname, $lastname) {
		return new User($uid, $username, $password, $permission, $firstname, $lastname);
	}


	/**
	 * save an existing user object into db
	 */
	public function persist_user($user) {

		$stmt = get_dao()->prepare("insert into users (username, password, type, lastname, firstname) values (:username, :password, :type, :lastname, :firstname)");

		$stmt->bindParam(':username', $user->username);
		$stmt->bindParam(':password', $user->password);
		$stmt->bindParam(':type', $user->permission);
		$stmt->bindParam(':lastname', $user->lastname);
		$stmt->bindParam(':firstname', $user->firstname);

		$stmt->execute();
        // error handling code goes here
	}




    /**
     * look up user in database base on user name and password
     * create application level user object and then return that object
     * return false if no user found (potentially more variants of error code?)
     * also would it be nice to hash the password?
     */
	public function get_user($username, $password) {

		$stmt = get_dao()->prepare("select * from users where username = :username and password = :password");

		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);

		if ($stmt->execute()) {

			$user_row = $stmt->fetch();

			if ($user_row != NULL) {
			    
				$user = $this->create_user(
				    $user_row["uid"], 
                    $user_row["username"],
                    $user_row["password"],
                    $user_row["type"],
				    $user_row["firstname"], 
				    $user_row["lastname"]
                );
				
				return $user;

			} else {
				return false;
			}
            
		} else {
		    // something wrong occured during query
		}
	}

	
	
}

?>