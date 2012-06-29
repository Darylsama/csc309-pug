<?php

include_once("Entities.php");
include_once("include/db.php");

// universal entity management module
// all model actions goes here
// consider split this up later on

class UserModel {

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


class SportModel {
	
	/**
	 * create a new sport
	 */
	public function create_sport($sid, $name, $description) {
		return new Sport($sid, $name, $description);
	}
	
	
	/**
	 * store a sport entity into the database
	 */
	public function persist_sport($sport) {
		
		$stmt = get_dao()->prepare("insert into sports (name, description) values (:name, :description)");
		
		$stmt->bindParam(':name', $sport->name);
		$stmt->bindParam(':description', $sport->description);
		
		$stmt->execute();
	}
	
	
	/**
	 * associate a sport for with a particualr user
	 */
	public function add_sports($user, $sport) {
		
		$stmt = get_dao()->prepare("insert into user_sports (uid, sid) values (:uid, :sid)");
		
		$stmt->bindParam(':uid', $user->uid);
		$stmt->bindParam(':sid', $sport->sid);
		
		$stmt->execute();
	}
	
	
	/**
	 * return all sports associate with a particular user
	 * return empty array if no sports associate with that user
	 * return false if query doesn't success // need more work
	 * 
	 */
	public function get_sports($user) {
		
		$user_sports = array();
		
		$stmt = get_dao()->prepare("select sports.sid as sid, sports.name as name, sports.description as description from user_sports inner join sports on user_sports.sid = sports.sid where uid = :uid;");
		$stmt->bindParam(':uid', $user->uid);
				
		if ($stmt->execute()) {
			
			while (($row = $stmt->fetch()) != null ) {
			    $sport = $this->create_sport($row["sid"], $row["name"], $row["description"]);
				$user_sports[] = $sport;
			}
			return $user_sports;
			
		} else {
			return false;
		}
	}
}


class GameModel {


    public function create_game($gid, $name, $organizer, $creation, $sport, $desc) {
        return new Game($gid, $name, $organizer, $creation, $sport, $desc);
    }


    /**
     * store a game entity into the db
     */    
    public function persist_game($game) {
        
        $stmt = get_dao()->prepare("insert into games (name, organizer, creation, sport, `desc`) values (:name, :organizer, :creation, :sport, :desc)");
        
        $stmt->bindParam(':name', $game->name);
        $stmt->bindParam(':organizer', $game->organizer);
        $stmt->bindParam(':creation', $game->creation);
        $stmt->bindParam(':sport', $game->sport);
        $stmt->bindParam(':desc', $game->desc);
        
        $stmt->execute();
    }
    
    
    
    /**
     * return all games created by a particular user
     * return empty array if no games associate with that user
     * return false if query doesn't success // need more work
     */
    public function get_games($user) {
        
        $user_games = array();
        
        $stmt = get_dao()->prepare("select * from games where organizer = :organizer");
        $stmt->bindParam(':organizer', $user->uid);
        
        if ($stmt->execute()) {
            
            while (($row = $stmt->fetch()) != null) {
                $game = $this->create_game($row["gid"], $row["name"], $row["organizer"], $row["creation"], $row["sport"], $row["desc"]);
                $user_games[] = $game;
            }
            
            return $user_games;
            
        } else {
            return false;
        }
    }
    
    
    
    /**
     * return a customized array containing information to be showed on the view game page
     */
    public function get_all_games() {
        
        $user_games = array();
        
        $stmt = get_dao()->prepare("select * from games");
        
        if ($stmt->execute()) {
            while (($row = $stmt->fetch()) != null) {
                $game = $this->create_game($row["gid"], $row["name"], $row["organizer"], $row["creation"], $row["sport"], $row["desc"]);
                $user_games[] = $game;
            }
            return $user_games;
        } else {
            return false;
        }
    }
    
    
}



?>