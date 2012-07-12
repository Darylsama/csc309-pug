<?php

include_once ("Entities.php");
include_once ("include/db.php");

/**
 * universal entity management module
 * all model actions goes here
 * consider split this up later on
 */
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

		// insert user into database
		$stmt = get_dao() -> prepare("insert into users (username, password, type, lastname, firstname) values (:username, :password, :type, :lastname, :firstname);");
		$stmt -> bindParam(':username', $user -> username);
		$stmt -> bindParam(':password', $user -> password);
		$stmt -> bindParam(':type', $user -> permission);
		$stmt -> bindParam(':lastname', $user -> lastname);
		$stmt -> bindParam(':firstname', $user -> firstname);
		$stmt -> execute();

		// set the uid for the current user
		
		$stmt = get_dao() -> prepare("select uid from users where username = :username;");
		
		$stmt -> bindParam(':username', $user->username);
		
		if ($stmt->execute()) {
		
			$row = $stmt -> fetch();
			$user ->uid = $row["uid"];
		}

	}

	/*
	 * 
	 * */
	public function username_exist($username){
		
		$stmt = get_dao() -> prepare("select * from users where username = :username;");
		$stmt -> bindParam(":username", $username);
		
		if ($stmt->execute()) {
			$row = $stmt->fetch();
			if (isset($row["uid"])){
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
	}
	
	/**
	 * get a user by its user id
	 */
	public function get_user_by_id($uid) {

		$stmt = get_dao() -> prepare("select * from users where uid = :uid");
		$stmt -> bindParam(':uid', $uid);

		if ($stmt -> execute()) {
			$row = $stmt -> fetch();

			$username = $row["username"];
			$password = $row["password"];
			$permission = $row["type"];
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];

			$user = $this -> create_user($uid, $username, $password, $permission, $firstname, $lastname);

			return $user;
		}
	}

	/**
	 * look up user in database base on user name and password
	 * create application level user object and then return that object
	 * return false if no user found (potentially more variants of error code?)
	 * also would it be nice to hash the password?
	 */
	public function get_user($username, $password) {

		$stmt = get_dao() -> prepare("select * from users where username = :username and password = :password");

		$stmt -> bindParam(':username', $username);
		$stmt -> bindParam(':password', $password);

		if ($stmt -> execute()) {

			$user_row = $stmt -> fetch();

			if ($user_row != NULL) {

				$user = $this -> create_user($user_row["uid"], $user_row["username"], $user_row["password"], $user_row["type"], $user_row["firstname"], $user_row["lastname"]);

				return $user;

			} else {
				return false;
			}
		} else {
			// something wrong occured during query
		}
	}

	/**
	 * return a list of all users within the system
	 */
	public function get_all_users() {

		$stmt = get_dao() -> prepare("select * from users");

		if ($stmt -> execute()) {

			$users = array();

			while (($row = $stmt -> fetch()) != null) {

				$uid = $row["uid"];
				$username = $row["username"];
				$password = $row["password"];
				$permission = $row["type"];
				$firstname = $row["firstname"];
				$lastname = $row["lastname"];

				$users[$uid] = $this -> create_user($uid, $username, $password, $permission, $firstname, $lastname);
			}

			return $users;

		}

		return false;
	}
	
	
	public function is_friend($uid1, $uid2){
		$stmt = get_dao() -> prepare("select * from friendship where (uid1 = :uid1 and uid2 = :uid2) or (uid1 = :uid2 and uid2 = :uid1);"); 
		$stmt -> bindParam(":uid1", $uid1);
		$stmt -> bindParam(":uid2", $uid2);
		if ($stmt -> execute()){
			$friendship = $stmt -> fetch();
			if (strlen($friendship["uid1"]) != 0){
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		
	}
	
	public function create_friendships($uid, $gid){
		$stmt = get_dao() -> prepare("select uid from matches where gid = :gid and selected = 1;");
		$stmt -> bindParam(":gid", $gid);
		
		if($stmt -> execute()){
			$row = $stmt -> fetch();
			$player = $row["uid"];
			while (strlen($player) != 0){
				if (! $this->is_friend($uid, $player)) {
					//two users are not friends before
					
					$stmt2 = get_dao() -> prepare("insert into friendship (uid1, uid2) values (:uid1, :uid2);");
					$stmt2 -> bindParam(":uid1", $uid);
					$stmt2 -> bindParam(":uid2", $player);
						
					$stmt2->execute();
					$row = $stmt -> fetch();
					$player = $row["uid"];
				}
			} 
			
			
		}
		
	}
	
	public function get_friends($uid) {

		$stmt = get_dao() -> prepare("select * from friendship where uid1 = :uid or uid2 = :uid; ");
		// shouldn't really need this
		// we assume that the friendship table is diagnol: if (i, j) exist then (j, i) definitely exist
		$stmt -> bindParam(":uid", $uid);
		$friends = array();

		if ($stmt -> execute()){
			while (($row = $stmt -> fetch()) != null) {
				$uid1 = $row["uid1"];
				$uid2 = $row["uid2"];
				if ($uid1 != $uid) {
					$friends[$uid1] = $this->get_user_by_id($uid1); 	
				}
				else if ($uid2 != $uid) {
					
					$friends[$uid2] = $this->get_user_by_id($uid2); 
				}
				
			}
			return $friends;
			
		}
		else {
			return FALSE;
		}
		
	}
}

/**
 *
 */
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

		$stmt = get_dao() -> prepare("insert into sports (name, description) values (:name, :description)");
		$stmt -> bindParam(':name', $sport -> name);
		$stmt -> bindParam(':description', $sport -> description);
		$stmt -> execute();

		// set the sid for the current sport
		$stmt = get_dao() -> prepare("select sid from sports order by sid desc");
		if ($stmt->execute()) {
			$row = $stmt -> fetch();
			$sport ->sid = $row["sid"];
		}
	}

	/**
	 * associate a sport for with a particualr user
	 */
	public function add_sports($user, $sport) {

		$stmt = get_dao() -> prepare("insert into user_sports (uid, sid) values (:uid, :sid)");

		$stmt -> bindParam(':uid', $user -> uid);
		$stmt -> bindParam(':sid', $sport -> sid);

		$stmt -> execute();
	}

	/**
	 * return a sports by its sid
	 */
	public function get_sport($sid) {

		$stmt = get_dao() -> prepare("select * from sports where sid = :sid");
		$stmt -> bindParam(':sid', $sid);

		if ($stmt -> execute()) {

			$row = $stmt -> fetch();

			$name = $row["name"];
			$description = $row["description"];

			$user = $this -> create_sport($sid, $name, $description);

			return $user;
		}
	}

	/**
	 * return all sports associate with a particular user
	 * return empty array if no sports associate with that user
	 * return false if query doesn't success // need more work
	 */
	public function get_sports($user) {

		$user_sports = array();
		$stmt = get_dao() -> prepare("select sports.sid as sid, sports.name as name, sports.description as description from user_sports inner join sports on user_sports.sid = sports.sid where uid = :uid;");
		$stmt -> bindParam(':uid', $user -> uid);

		if ($stmt -> execute()) {
			while (($row = $stmt -> fetch()) != null) {
				$sport = $this -> create_sport($row["sid"], $row["name"], $row["description"]);
				$user_sports[$row["sid"]] = $sport;
			}
			return $user_sports;
		}
		return false;
	}

	/**
	 * return a list of all sports within the system
	 */
	public function get_all_sports() {

		$user_sports = array();
		$stmt = get_dao() -> prepare("select * from sports");

		if ($stmt -> execute()) {

			while (($row = $stmt -> fetch()) != null) {
				$sport = $this -> create_sport($row["sid"], $row["name"], $row["description"]);
				$user_sports[$row["sid"]] = $sport;
			}
			return $user_sports;
		}

		return false;
	}

}

/**
 *
 */
class GameModel {

	public function create_game($gid, $name, $organizer, $creation, $sport, $desc) {
		return new Game($gid, $name, $organizer, $creation, $sport, $desc);
	}

	/**
	 * store a game entity into the db
	 * also set the id for the given game
	 */
	public function persist_game($game) {

		$stmt = get_dao() -> prepare("insert into games (name, organizer, creation, sport, `desc`) values (:name, :organizer, :creation, :sport, :desc)");
		$stmt -> bindParam(':name', $game -> name);
		$stmt -> bindParam(':organizer', $game -> organizer);
		$stmt -> bindParam(':creation', $game -> creation);
		$stmt -> bindParam(':sport', $game -> sport);
		$stmt -> bindParam(':desc', $game -> desc);
		$stmt -> execute();

		// set the gid for the current sport
		$stmt = get_dao() -> prepare("select gid from games order by gid desc");
		if ($stmt->execute()) {
			$row = $stmt -> fetch();
			$game ->gid = $row["gid"];
		}
	}

	/**
	 *
	 */
	public function get_game($gid) {

		$stmt = get_dao() -> prepare("select * from games where gid = :gid");
		$stmt -> bindParam(':gid', $gid);

		if ($stmt -> execute()) {
			$row = $stmt -> fetch();

			$user_model = new UserModel();
			$sport_model = new SportModel();

			$name = $row["name"];
			$organizer = $user_model -> get_user_by_id($row["organizer"]);
			$creation = $row["creation"];
			$sport = $sport_model -> get_sport($row["sport"]);
			$desc = $row["desc"];

			$game = $this -> create_game($gid, $name, $organizer, $creation, $sport, $desc);

			return $game;

		}

		return false;
	}

	/**
	 * return all games created by a particular user
	 * return empty array if no games associate with that user
	 * return false if query doesn't success // need more work
	 */
	public function get_games($user) {

		// first get all sports associate with the current user
		$sport_model = new SportModel();
		$user_sports = $sport_model -> get_sports($user);

		// then create the corresponding game objects for the current user
		// note that the supposedly foreign key attribute is set to the entities themselves
		$user_games = array();
		$stmt = get_dao() -> prepare("select * from games where organizer = :organizer");
		$stmt -> bindParam(':organizer', $user -> uid);

		if ($stmt -> execute()) {
			while (($row = $stmt -> fetch()) != null) {

				$gid = $row["gid"];
				$name = $row["name"];
				$organizer = get_loggedin_user();
				$creation = $row["creation"];
				$sport = $user_sports[$row["sport"]];
				$desc = $row["desc"];

				$game = $this -> create_game($gid, $name, $organizer, $creation, $sport, $desc);
				$user_games[$gid] = $game;
			}
			return $user_games;
		}

		return false;
	}

	/**
	 * return a customized array containing information to be showed on the view game page
	 * very expensive
	 */
	public function get_all_games() {

		//  get all sports within the system
		$sport_model = new SportModel();
		$sports = $sport_model -> get_all_sports();

		// get all corresponding users within the system
		$user_model = new UserModel();
		$users = $user_model -> get_all_users();

		// then create the corresponding game objects
		$user_games = array();
		$stmt = get_dao() -> prepare("select * from games");
		if ($stmt -> execute()) {
			while (($row = $stmt -> fetch()) != null) {

				$gid = $row["gid"];
				$name = $row["name"];
				$organizer = $users[$row["organizer"]];
				$creation = $row["creation"];
				$sport = $sports[$row["sport"]];
				$desc = $row["desc"];

				$game = $this -> create_game($gid, $name, $organizer, $creation, $sport, $desc);
				$user_games[$gid] = $game;
			}
			return $user_games;
		} else {
			return false;
		}
	}
	
	public function express_interest($user, $gid) {
	    
	    $stmt = get_dao() -> prepare("insert into matches (uid, gid, selected) values (:uid, :gid, false)");
	    $stmt->bindParam(':uid', $user->uid);
	    $stmt->bindParam(':gid', $gid);
	    $stmt -> execute();
	}
	
	public function join_game($uid, $gid) {
	    
        $stmt = get_dao() -> prepare("update matches set selected = true where uid = :uid and gid = :gid");
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':gid', $gid);
        $stmt -> execute();
	}
	
	/**
	 * return 0 if user is the organizer of game with gid
	 * return 1 if user didn't express interest
	 * return 2 if user expressed interest
	 * return 3 if the game organizer selected the player to play
	 */
	public function get_user_selected_status($user, $gid) {

	    $game = $this->get_game($gid);
	    if ($game->organizer->uid == $user->uid) {
    	    // if the player is the organizer for the game
	        return 0;
	    }
	    
	    $stmt = get_dao() -> prepare("select * from matches where uid = :uid and gid = :gid");
	    $stmt->bindParam(':uid', $user->uid);
	    $stmt->bindParam(':gid', $gid);
	    
	    if ($stmt -> execute()) {
	        $row = $stmt->fetch();
	        if ($row == null) {
	            // player not interested in the game
	            return 1;
	        } else {
	            if ($row["selected"] == 0) {
    	            // player interest in the game
	                return 2;
	            } else {
	                // player selected by the game organizer
	                return 3;
	            }
	        }
	    }
	}
	
	
	
	public function get_interested_players($gid) {
	    
	    // an entry in the match table asserts that player with uid is interested in the game with gid if selected == false
	    // an entry in the match table asserts that player with uid is selected for the game with gid if selected == true
	    $stmt = get_dao() -> prepare("select * from users inner join matches on users.uid = matches.uid where gid = :gid and matches.selected = false;");
	    $stmt -> bindParam(':gid', $gid);
	    
	    if ($stmt->execute()) {
	        
	        $user_model = new UserModel();
	        $users = array();
	        
	        while (($row = $stmt->fetch()) != null) {
	            
	            $uid = $row["uid"];
	            $username = $row["username"];
	            $password = $row["password"];
	            $permission = $row["type"];
	            $firstname = $row["firstname"];
	            $lastname = $row["lastname"];
	            
	            $user = $user_model->create_user($uid, $username, $password, $permission, $firstname, $lastname);
	            $users[$uid] = $user;
	        }
	        
	        return $users;
	    }
	    return false;
	}
	
	public function get_selected_players($gid) {
	    
	    $stmt = get_dao() -> prepare("select * from users inner join matches on users.uid = matches.uid where gid = :gid and matches.selected = true;");
	    $stmt -> bindParam(':gid', $gid);
	     
	    if ($stmt->execute()) {
	         
	        $user_model = new UserModel();
	        $users = array();
	         
	        while (($row = $stmt->fetch()) != null) {
	             
	            $uid = $row["uid"];
	            $username = $row["username"];
	            $password = $row["password"];
	            $permission = $row["type"];
	            $firstname = $row["firstname"];
	            $lastname = $row["lastname"];
	             
	            $user = $user_model->create_user($uid, $username, $password, $permission, $firstname, $lastname);
	            $users[$uid] = $user;
	        }
	         
	        return $users;
	    }
	    return false;
	}
	
	/*  Return the an array of games that this user 
	 *  interested but not selected
	 */
	public function get_interested_games($uid){
		$game_list = array();
		$stmt = get_dao() -> prepare("select * from games inner join matches where games.gid = matches.gid and selected = 0 and uid = :uid;");
		$stmt -> bindParam(":uid", $uid);
		if ($stmt->execute()) {
			while (($row = $stmt->fetch()) != NULL) {
				$game_list[$row["gid"]] = $row["name"]; 
			}
			return $game_list;
		}
	}
	
	/*  Return an array of games that this user
	 *  joined */
	public function get_joined_games($uid){

		$game_list = array();
		$stmt = get_dao() -> prepare("select * from games inner join matches where games.gid = matches.gid and selected = 1 and uid = :uid;");
		$stmt -> bindParam(":uid", $uid);
		if ($stmt -> execute()) {
			while (($row = $stmt->fetch()) != NULL) {
				$game_list[$row["gid"]] = $row["name"];
			}
			return $game_list;
		}		
	} 
}


class RatingModel {
	
	public function create_rating($rid, $rater, $ratee, $value, $comment, $type){
		return new Rating($rid, $rater, $ratee, $value, $comment, $type);
	}
	
	/**
	 * store a rating entity into the db
	 * also set the id for the given rating
	 */
	public function persist_rating($rating) {
			
			
		// insert user into database
		$time = date("Y-m-d");
		$stmt = get_dao() -> prepare("insert into ratings (rater, ratee, value, comment, type, time) values (:rater, :ratee, :value, :comment, :type, :time);");
		$stmt -> bindParam(':rater', $rating -> rater);
		$stmt -> bindParam(':ratee', $rating -> ratee);
		$stmt -> bindParam(':value', $rating -> value);
		$stmt -> bindParam(':comment', $rating -> comment);
		$stmt -> bindParam(':type', $rating -> type);

		$stmt -> bindParam(':time', $time);
		$stmt -> execute();
		
		// set the id for the current user

		$stmt2 = get_dao() -> prepare("select rid from ratings where rater = :rater and ratee = :ratee and time = :time;");
		$stmt2 -> bindParam(':rater', $rating -> rater);
		$stmt2 -> bindParam(':ratee', $rating -> ratee);
		$stmt2 -> bindParam(':time', $time);
		echo 'aaab';
		if ($stmt2->execute()) {
			echo "ccc";
			$row = $stmt2 -> fetch();
			echo "fff";
			$rating ->rid = $row["rid"];
			return $rating;
		}			
		return false;
	}
	
	/* Return the average rating of this user
	 * as a player*/
	public function get_user_avg_rating($uid) {
		
		$stmt = get_dao() -> prepare("select avg(value) as avgvalue from ratings where ratee = :uid and type = 1;");
		$stmt -> bindParam(":uid", $uid);
		if ($stmt->execute()){
			$row = $stmt -> fetch();
			return $row["avgvalue"];
		}
		
	}
	
	public function get_organizer_avg_rating($uid) {
		$stmt = get_dao() -> prepare("select avg(value) as avgvalue from ratings where ratee = :uid and type = 0;");
		$stmt -> bindParam(":uid", $uid);
		if ($stmt -> execute()) {
			$row = $stmt -> fetch();
			return $row["avgvalue"];
		}
		
		
	}
	
	
	/* */
	public function rate_player_before($rater, $ratee){
		
		$stmt = get_dao() -> prepare("select * from ratings where ratee = :ratee and rater = :rater and type = 1;");
		$stmt -> bindParam(":rater", $rater);
		$stmt -> bindParam(":ratee", $ratee);
		if ($stmt->execute()) {
			$row = $stmt -> fetch();
			if (isset($row["rid"])){
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		
		
	}
	
	
	public function rate_organizer_before($rater, $ratee){

		$stmt = get_dao() -> prepare("select * from ratings where ratee = :ratee and rater = :rater and type = 0;");
		$stmt -> bindParam(":rater", $rater);
		$stmt -> bindParam(":ratee", $ratee);
		if ($stmt->execute()) {
			$row = $stmt -> fetch();
			if (isset($row["rid"])){
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
	
	}
	
	/* a user1 can rater another user2 as an organizer only 
	 * when this user1 joined the game organized by user2 before
	 * */
	public function can_rate_organizer($uid1, $uid2){
		$stmt = get_dao() -> prepare("select * from games inner join matches where games.gid = matches.gid and selected = 1 and uid = :uid1 and organizer = :uid2;");
		$stmt->bindParam(":uid1", $uid1);
		$stmt->bindParam(":uid2", $uid2);
	
		
		if ($stmt -> execute()) {
			$row = $stmt ->fetch();
			if (isset($row["gid"])){
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		
	}
	

}
?>