<?php

/**
 * Encapsulate all model operations
 * TODO: break down into distinct models
 * TODO: add error handline
 */

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
    public function create_user($uid, $username, $password, $permission, $firstname, $lastname, $status) {
        return new User($uid, $username, $password, $permission, $firstname, $lastname, $status);
    }
    
    /**
     * save an existing user object into db
     */
    public function persist_user($user) {

        // insert user into database
        $stmt = get_dao() -> prepare("insert into users (username, password, type, lastname, firstname, status) values (:username, :password, :type, :lastname, :firstname, :status);");
        $stmt -> bindParam(':username', $user -> username);
        $stmt -> bindParam(':password', $user -> password);
        $stmt -> bindParam(':type', $user -> permission);
        $stmt -> bindParam(':lastname', $user -> lastname);
        $stmt -> bindParam(':firstname', $user -> firstname);
        $stmt -> bindParam(':status', $user->status);
        $stmt -> execute();

        // set the uid for the current user
        // TODO: minimize this
        $stmt = get_dao() -> prepare("select uid from users where username = :username;");
        $stmt -> bindParam(':username', $user->username);

        if ($stmt->execute()) {
            $row = $stmt -> fetch();
            $user ->uid = $row["uid"];
        }
    }
    
    /**
     * remove an user from the system base on his/her user id
     *  mark the user as deleted
     *  remove friendship between this user and other users in the system
     *  also mark all games organized by this user as cancelled
     *  and for each of these games unjoin any player who will be participating or has expressed interest this game 
     */
   	public function delete_user($uid){
   		
   		$stmt = get_dao()->prepare("update users set status = 1 where uid =:uid; delete from friendship where uid1 = :uid or uid2 = :uid; update games set status = 1 where organizer = :uid;"); 
		$stmt -> bindParam(":uid", $uid);
		$stmt->execute();
		
		$stmt2 = get_dao()->prepare("select gid from games where organizer = :uid;");
		$stmt2 -> bindParam(":uid", $uid);
		
		if ($stmt2->execute()){
			$row = $stmt2->fetch();
			while (isset($row["gid"])){
				$stmt3 = get_dao()->prepare("delete from matches where gid =:gid;");
				$stmt3->bindParam(":gid", $row["gid"]);
				
				$stmt3->execute();
				$row =  $stmt2->fetch();
			}

		}
		else{
			return FALSE;
		}
   	}
   	
    /**
     * return whether the given username already exist in the database
     */
    public function username_exist($username){

        $stmt = get_dao() -> prepare("select * from users where username = :username;");
        $stmt -> bindParam(":username", $username);

        if ($stmt->execute()) {
            $row = $stmt->fetch();
            return isset($row["uid"]);
        }
    }
    
    /**
     * get a user entity by its user id
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

            $user = $this -> create_user($uid, $username, $password, $permission, $firstname, $lastname,0);

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

                $user = $this -> create_user($user_row["uid"], $user_row["username"], $user_row["password"], $user_row["type"], $user_row["firstname"], $user_row["lastname"],0);

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

                $users[$uid] = $this -> create_user($uid, $username, $password, $permission, $firstname, $lastname,0);
            }

            return $users;

        }

        return false;
    }
    
    /**
     * return a list of users who hasn't been deleted from the system
     */
	public function get_all_valid_users() {

        $stmt = get_dao() -> prepare("select * from users where status = 0;");

        if ($stmt -> execute()) {

            $users = array();

            while (($row = $stmt -> fetch()) != null) {

                $uid = $row["uid"];
                $username = $row["username"];
                $password = $row["password"];
                $permission = $row["type"];
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];

                $users[$uid] = $this -> create_user($uid, $username, $password, $permission, $firstname, $lastname,0);
            }

            return $users;

        }

        return false;
    }
    
    /**
     * should be really called "are_friends"
     * determine whether 2 users represented by 2 uid are friends
     * @param unknown_type $uid1
     * @param unknown_type $uid2
     */
    public function is_friend($uid1, $uid2){
         
        $stmt = get_dao() -> prepare("select * from friendship where (uid1 = :uid1 and uid2 = :uid2) or (uid1 = :uid2 and uid2 = :uid1);");
        $stmt -> bindParam(":uid1", $uid1);
        $stmt -> bindParam(":uid2", $uid2);

        if ($stmt -> execute()) {
            $resultset = $stmt -> fetch();
            return isset($resultset["uid1"]) ? true : false;
        }

    }

    /**
     * be-friend a user with all other user as well as the game organizer who will be participating in a pick-up game
     * no duplicate friendship are inserted if some pair of players are already inseted
     * @param int $uid the user to be selected
     * @param int $gid the game the user will be participating
     */
    public function create_friendships($uid, $gid) {
         
        // new friendships to be added
        $new_friendships = array();
         
        // get all participating players in the same game
        $stmt_get_players = get_dao() -> prepare("select uid from matches where gid = :gid and selected = 1;");
        $stmt_get_players -> bindParam(":gid", $gid);
        if ($stmt_get_players -> execute()) {
            while (($row = $stmt_get_players -> fetch()) != null) {
                // keeping the friendship diagnol
                $new_friendships[] = array($row["uid"], $uid);
                $new_friendships[] = array($uid, $row["uid"]);
            }
        }

        // var_dump($new_friendships);

        // get the organizer for the current game
        $stmt_get_organizer = get_dao() -> prepare("select organizer from games where gid = :gid");
        $stmt_get_organizer -> bindParam(":gid", $gid);
        if ($stmt_get_organizer -> execute()) {
            if (($row = $stmt_get_organizer -> fetch()) != null) {
                // keeping the friendship diagnol
                $new_friendships[] = array($row["organizer"], $uid);
                $new_friendships[] = array($uid, $row["organizer"]);
            }
        }

        // var_dump($new_friendships);

        // NUMBER OF new friendships to create
        $no_friendships = count($new_friendships);

        // dynamic build query.
        // using ignore keyword to skip insertion if there're exisitng friendships that's equivalent newer friendhsips
        $sql = "insert ignore into friendship (uid1, uid2) values ";
        for ($i = 0; $i < $no_friendships; $i++) {

            // must fetch friendship uids outside of php quotes
            // php will ignore the second index and treat it as "[0]" or "[1]"
            $uid1 = $new_friendships[$i][0];
            $uid2 = $new_friendships[$i][1];

            // append the values to the query
            $sql .= "($uid1, $uid2)";

            // append value separator if it's not the last element
            $sql .= ($i != $no_friendships - 1) ? ", " : ";";
        }

        // var_dump($sql);

        // finall execute the statement
        get_dao() -> prepare($sql) -> execute();
    }
    
    /**
     * returning a list of friends of a user existing within the system
     * @param unknown_type $uid
     */
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
    
    /**
     * update general profile information such as username, firstname, and last name
     * return the user on completion
     */
    public function update_profile($uid, $username, $firstname, $lastname){
        
    	$stmt = get_dao()->prepare("update users set username = :username, firstname = :firstname, lastname = :lastname where uid = :uid ;");
    	$stmt->bindParam(":uid", $uid);
    	$stmt->bindParam(":username", $username);
    	$stmt->bindParam(":firstname", $firstname);
    	$stmt->bindParam(":lastname", $lastname);
    	
    	if ($stmt->execute()){
    	    $stmt = get_dao()->prepare("select * from users where uid = :uid ;");
            $stmt->bindParam(":uid", $uid);

            $stmt->execute();
            
            $row = $stmt -> fetch();
            
            $username = $row["username"];
            $password = $row["password"];
            $permission = $row["type"];
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            
            $user = $this -> create_user($uid, $username, $password, $permission, $firstname, $lastname,0);
            
            return $user;
    	}
    	else{
    		return FALSE;
    	}	
    }
    
    /**
     * change the password for a given user based on the uid for the user
     * return true on success
     */
	public function update_password($uid, $password){
		$stmt = get_dao()->prepare("update users set password = :password where uid = :uid;");
		$stmt->bindParam(":uid", $uid);
		$stmt->bindParam(":password", $password);
		if ($stmt->execute()){
			return TRUE;
		}
		else{
			return False;
		}
	}
}

/**
 * encapsulate all sports related model operations
 */
class SportModel {

    /**
     * create a new sport
     */
    public function create_sport($sid, $name, $description, $status) {
        return new Sport($sid, $name, $description, $status);
    }
    
    /**
     * store a sport entity into the database
     */
    public function persist_sport($sport) {

        $stmt = get_dao() -> prepare("insert into sports (name, description, status) values (:name, :description, :status)");
        $stmt -> bindParam(':name', $sport -> name);
        $stmt -> bindParam(':description', $sport -> description);
        $stmt -> bindParam(":status", $sport->status);
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
     * also persist this relationship
     */
    public function add_sports($user, $sport) {

        $stmt = get_dao() -> prepare("insert into user_sports (uid, sid) values (:uid, :sid);");
        $stmt -> bindParam(':uid', $user -> uid);
        $stmt -> bindParam(':sid', $sport -> sid);
        $stmt -> execute();
    }
    
    /**
     * update the associate information for a sport
     */
    public function update_sport($sid, $name, $description){
    	$stmt = get_dao() -> prepare("update sports set name = :name, description = :description where sid = :sid;");
    	$stmt -> bindParam(":name", $name);
    	$stmt -> bindParam(":description", $description);
    	$stmt -> bindParam(":sid", $sid);
    	$stmt -> execute();
    }
    
    /**
     * remove a sport from teh system base on the sport's id
     */
    public function delete_sport($sid){
    	
    	$stmt = get_dao() -> prepare("update sports set status = 1 where sid =:sid;");
    	$stmt->bindParam(":sid", $sid);
    	
		$stmt->execute();
    }
    
    /**
     * unassociate a sport from an user.
     * Doesn't affect the games that is already created under the user with that sport 
     */
    public function delete_user_sport($uid, $sid){
    	
    	$stmt = get_dao()-> prepare("delete from user_sports where uid=:uid and sid =:sid;");
    	$stmt->bindParam(":uid", $uid);
    	$stmt->bindParam(":sid", $sid);
    	
    	$stmt->execute();
    }
    
    /**
     * return a sport entity by its sid
     */
    public function get_sport($sid) {

        $stmt = get_dao() -> prepare("select * from sports where sid = :sid");
        $stmt -> bindParam(':sid', $sid);

        if ($stmt -> execute()) {

            $row = $stmt -> fetch();
            $name = $row["name"];
            $description = $row["description"];
            $status = $row["status"];

            $sport = $this -> create_sport($sid, $name, $description, $status);

            return $sport;
        }
    }

    /**
     * return all sports associate with a particular user
     * return empty array if no sports associate with that user
     * return false if query doesn't success // need more work
     */
    public function get_sports($user) {

        $user_sports = array();
        $stmt = get_dao() -> prepare("select sports.sid as sid, sports.name as name, sports.description as description, sports.status as status from user_sports inner join sports on user_sports.sid = sports.sid where uid = :uid;");
        $stmt -> bindParam(':uid', $user -> uid);

        if ($stmt -> execute()) {
            while (($row = $stmt -> fetch()) != null) {
                $sport = $this -> create_sport($row["sid"], $row["name"], $row["description"], $row["status"]);
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
        $stmt = get_dao() -> prepare("select * from sports;");

        if ($stmt -> execute()) {

            while (($row = $stmt -> fetch()) != null) {
                $sport = $this -> create_sport($row["sid"], $row["name"], $row["description"], $row["status"]);
                $user_sports[$row["sid"]] = $sport;
            }
            return $user_sports;
        }

        return false;
    }
    
    /**
     * return a list of all sports within the system that hasn't been deleted
     */
    public function get_all_valid_sports() {

        $user_sports = array();
        $stmt = get_dao() -> prepare("select * from sports where status = 0;");

        if ($stmt -> execute()) {

            while (($row = $stmt -> fetch()) != null) {
                $sport = $this -> create_sport($row["sid"], $row["name"], $row["description"], $row["status"]);
                $user_sports[$row["sid"]] = $sport;
            }
            return $user_sports;
        }

        return false;
    }
	
}

/**
 * encapsulate all game related model operations
 */
class GameModel {

    /**
     * create a new game entity by its constructor
     * @param int $gid the game id
     * @param string $name the name of the game
     * @param int $organizer the user id of the organizer
     * @param string $creation the creation date
     * @param int $sport the sport id of the the sport
     * @param string $desc the description of the game
     * @return Game the game entity that encapsulate the game
     */
    public function create_game($gid, $name, $organizer, $start_time, $duration, $creation, $sport, $desc, $status) {
        return new Game($gid, $name, $organizer, $start_time, $duration, $creation, $sport, $desc, $status);
    }

    /**
     * store a game entity into the db
     * also set the id for the given game
     */
    public function persist_game($game) {

        $stmt = get_dao() -> prepare("insert into games (name, organizer, start_time, duration, creation, sport, `desc`, status) values (:name, :organizer, :start_time, :duration, :creation, :sport, :desc, :status)");
        $stmt -> bindParam(':name', $game -> name);
        $stmt -> bindParam(':organizer', $game -> organizer);
        $stmt -> bindParam(':start_time', $game -> start_time);
        $stmt -> bindParam(':duration', $game -> duration);
        $stmt -> bindParam(':creation', $game -> creation);
        $stmt -> bindParam(':sport', $game -> sport);
        $stmt -> bindParam(':desc', $game -> desc);
        $stmt -> bindParam(":status", $game->status);
        $stmt -> execute();

        // set the gid for the current sport
        $stmt = get_dao() -> prepare("select gid from games order by gid desc");
        if ($stmt->execute()) {
            $row = $stmt -> fetch();
            $game ->gid = $row["gid"];
        }
    }
    
    /**
     * mark a game as deleted
     * also remove the participation of every player in that game
     */
    public function delete_game($gid){
    	$stmt = get_dao() -> prepare("update games set status = 1 where gid =:gid;");
    	$stmt->bindParam(":gid", $gid);
    	$stmt->execute();
    	
    	$stmt2 = get_dao() -> prepare("delete from matches where gid =:gid;");
    	$stmt2->bindParam(":gid", $gid);
    	$stmt->execute();
    }

    /**
     * returning a game object based on the give game id
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
            $start_time = strtotime($row["start_time"]);
            $duration = $row["duration"];
            $creation = strtotime($row["creation"]);
            $sport = $sport_model -> get_sport($row["sport"]);
            $desc = $row["desc"];

            $game = $this -> create_game($gid, $name, $organizer, $start_time, $duration, $creation, $sport, $desc, 0);

            return $game;
        }

        return false;
    }

    /**
     * return all games created by a particular user
     * return empty array if no games associate with that user
     * return false if query doesn't success
     */
    public function get_games($user) {

        // first get all sports associate with the current user
        $sport_model = new SportModel();
        $user_sports = $sport_model -> get_sports($user);

        // then create the corresponding game objects for the current user
        // note that the supposedly foreign key attribute is set to the entities themselves
        $user_games = array();
        $stmt = get_dao() -> prepare("select * from games where organizer = :organizer and status = 0;");
        $stmt -> bindParam(':organizer', $user -> uid);

        if ($stmt -> execute()) {
            while (($row = $stmt -> fetch()) != null) {

                $gid = $row["gid"];
                $name = $row["name"];
                $organizer = get_loggedin_user();
                $start_time = strtotime($row["start_time"]);
                $duration = $row["duration"];
                $creation = $row["creation"];
                $sport = $user_sports[$row["sport"]];
                $desc = $row["desc"];

                $game = $this -> create_game($gid, $name, $organizer, $start_time, $duration, $creation, $sport, $desc, 0);
                $user_games[$gid] = $game;
            }
            return $user_games;
        }

        return false;
    }

    /**
     * return an array of games containing information to be showed on the view game page
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
                $start_time = strtotime($row["start_time"]);
                $duration = $row["duration"];
                $creation = $row["creation"];
                $sport = $sports[$row["sport"]];
                $desc = $row["desc"];

                $game = $this -> create_game($gid, $name, $organizer, $start_time, $duration, $creation, $sport, $desc,0);
                $user_games[$gid] = $game;
            }
            return $user_games;
        } else {
            return false;
        }
    }

    /**
     * return all games in the system that hasn't been deleted yet
     */
    public function get_all_valid_games() {

        //  get all sports within the system
        $sport_model = new SportModel();
        $sports = $sport_model -> get_all_sports();

        // get all corresponding users within the system
        $user_model = new UserModel();
        $users = $user_model -> get_all_users();

        // then create the corresponding game objects
        $user_games = array();
        $stmt = get_dao() -> prepare("select * from games where status = 0;");
        if ($stmt -> execute()) {
            while (($row = $stmt -> fetch()) != null) {

                $gid = $row["gid"];
                $name = $row["name"];
                $organizer = $users[$row["organizer"]];
                $start_time = strtotime($row["start_time"]);
                $duration = $row["duration"];
                $creation = $row["creation"];
                $sport = $sports[$row["sport"]];
                $desc = $row["desc"];

                $game = $this -> create_game($gid, $name, $organizer, $start_time, $duration, $creation, $sport, $desc,0);
                $user_games[$gid] = $game;
            }
            return $user_games;
        } else {
            return false;
        }
    }
    
    /**
     * return a list of games that the particular user is interesetd in
     * doesn't return games which the user doesn't have any sports in
     * doesn't return games that is already expired 
     */
    public function get_joinable_games($user) {
        
        //  get all sports within the system
        $sport_model = new SportModel();
        $sports = $sport_model -> get_all_sports();
    
        // get all corresponding users within the system
        $user_model = new UserModel();
        $users = $user_model -> get_all_users();
    
        // then create the corresponding game objects
        $user_games = array();
        $stmt = get_dao() -> prepare("select * from games where start_time > NOW() and sport in (select sid from user_sports where uid = :uid) and status = 0;");
        $stmt->bindParam(":uid", $user->uid);
        
        if ($stmt -> execute()) {
            while (($row = $stmt -> fetch()) != null) {
    
                $gid = $row["gid"];
                $name = $row["name"];
                $organizer = $users[$row["organizer"]];
                $start_time = strtotime($row["start_time"]);
                $duration = $row["duration"];
                $creation = $row["creation"];
                $sport = $sports[$row["sport"]];
                $desc = $row["desc"];
    
                $game = $this -> create_game($gid, $name, $organizer, $start_time, $duration, $creation, $sport, $desc,0);
                $user_games[$gid] = $game;
            }
            return $user_games;
        } else {
            return false;
        }
    }
    
    /**
     * let a player express interest in a game
     * in terms of table updating:
     * an entry in the matches table means that the player had expressed interest in one of the game
     * selected = false means that the player had expressed interest in the game
     * selected = true means that the player will be participating the game
     */
    public function express_interest($user, $gid) {
         
        $stmt = get_dao() -> prepare("insert into matches (uid, gid, selected) values (:uid, :gid, false);");
        $stmt->bindParam(':uid', $user->uid);
        $stmt->bindParam(':gid', $gid);
        $stmt -> execute();
    }
	
    /**
     * revoke interest by an user to a particular game 
     */
	public function cancel_interest($user, $gid) {
		$stmt = get_dao() -> prepare("delete from matches where gid = :gid and uid = :uid;");
		$stmt-> bindParam(':gid', $gid);
		$stmt-> bindParam(':uid', $user->uid);
		$stmt -> execute();	
	}
	
	/**
	 * withdraw a player participating in a pickup game 
	 * @param unknown_type $user
	 * @param unknown_type $gid
	 */
	public function cancel_join($user, $gid) {
		$stmt = get_dao() -> prepare("delete from matches where gid = :gid and uid = :uid;");
		$stmt-> bindParam(':gid', $gid);
		$stmt-> bindParam(':uid', $user->uid);
		$stmt -> execute();	
	}

    /**
     * let a player with $uid join a game with $gid
     */
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

    /**
     * return a listing of users whose interested in a particular game identified by gid
     */
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
                 
                $user = $user_model->create_user($uid, $username, $password, $permission, $firstname, $lastname,0);
                $users[$uid] = $user;
            }
             
            return $users;
        }
        return false;
    }

    /**
     * returning a list of players who will be participating a game identified by gid
     */
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

                $user = $user_model->create_user($uid, $username, $password, $permission, $firstname, $lastname,0);
                $users[$uid] = $user;
            }

            return $users;
        }
        return false;
    }

    /**
     * Return the an array of games that this user
     * interested but not selected
     */
    public function get_interested_games($uid){
        $game_list = array();
        $stmt = get_dao() -> prepare("select * from games inner join matches where games.gid = matches.gid and selected = 0 and uid = :uid and status = 0;");
        $stmt -> bindParam(":uid", $uid);
        if ($stmt->execute()) {
            while (($row = $stmt->fetch()) != NULL) {
                $game_list[$row["gid"]] = $row["name"];
            }
            return $game_list;
        }
    }

    /**
     * Return an array of games that this user (identified by uid) had joined
     */
    public function get_joined_games($uid){

        $game_list = array();
        $stmt = get_dao() -> prepare("select * from games inner join matches where games.gid = matches.gid and selected = 1 and uid = :uid and status =0;");
        $stmt -> bindParam(":uid", $uid);
        if ($stmt -> execute()) {
            while (($row = $stmt->fetch()) != NULL) {
                $game_list[$row["gid"]] = $row["name"];
            }
            return $game_list;
        }
    }
}

/**
 * encapsulate all ratings related model operations
 */
class RatingModel {

    /**
     * creating a rating entity 
     */
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
  		$stmt -> bindParam(':type', $rating->type);
        $stmt -> bindParam(':time', $time);
        $stmt -> execute();

	    // set the id for the current rating
        $stmt2 = get_dao() -> prepare("select rid from ratings where rater = :rater and ratee = :ratee and time = :time;");
        $stmt2 -> bindParam(':rater', $rating -> rater);
        $stmt2 -> bindParam(':ratee', $rating -> ratee);
        $stmt2 -> bindParam(':time', $time);
        
        if ($stmt2->execute()) {
            $row = $stmt2 -> fetch();
            $rating ->rid = $row["rid"];
            return $rating;
        }
        return false;
    }

    /**
     * Return the average rating of this user as a player
     */
    public function get_user_avg_rating($uid) {

        $stmt = get_dao() -> prepare("select avg(value) as avgvalue from ratings where ratee = :uid and type = 1;");
        $stmt -> bindParam(":uid", $uid);
        if ($stmt->execute()){
            $row = $stmt -> fetch();
            return $row["avgvalue"];
        }
    }

    /**
     * Return the average rating of this user as a game organizer
     */
    public function get_organizer_avg_rating($uid) {
        $stmt = get_dao() -> prepare("select avg(value) as avgvalue from ratings where ratee = :uid and type = 0;");
        $stmt -> bindParam(":uid", $uid);
        if ($stmt -> execute()) {
            $row = $stmt -> fetch();
            return $row["avgvalue"];
        }
    }

    /**
     * returning whether the rater had rated ratee as a player before 
     * TODO: change this function so that it actually return the value of the rating of the user
     */
    public function rate_player_before($rater, $ratee) {

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

    /**
     * returning whether the rater had rated ratee as a game organizer before
     */
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
    
    /**
     * a user can rate another user2 as an organizer only
     * when this user1 joined the game organized by user2 before
     */
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
    
    /**
     * returns a 2d list ratings contain all ratings given to the user identified by uid
     * ratings[1] will be all the player ratings and ratings[0] will be all the organizer ratings
     */
    public function get_all_ratings($uid) {

        // get a list of all users
        $user_model = new UserModel();
        $user_list = $user_model->get_all_users();
        $user_dict = array();
        foreach ($user_list as $user) {
            $user_dict[$user->uid] = $user;
        }
        
        
        $stmt = get_dao() -> prepare("select * from ratings where ratee = :uid");
        $stmt->bindParam(":uid", $uid);
        
        if ($stmt -> execute()) {
            
            // ratings[1] will be all the player ratings
            // ratings[0] will be all the organizer ratings
            $ratings = array(array(), array());
            
            while (($row = $stmt -> fetch()) != null) {
                
                $rid = $row["rid"];
                $rater = $user_dict[$row["rater"]];
                $ratee = $user_dict[$row["ratee"]];
                $value = $row["value"];
                $comment = $row["comment"];
                $type = $row["type"];
                $rating = $this->create_rating($rid, $rater, $ratee, $value, $comment, $type);
                
                $ratings[$type][] = $rating;
            }
            
            return $ratings;
        } else {
            return false;
        }
    }
}

/**
 * encapsulate all message related model operations
 */
class MessageModel{
	
	public function create_message($mid, $to, $from, $subject, $content, $create_time){
		return new Message($mid, $to, $from, $subject, $content, $create_time);
	}
	
	public function persist_message($message){
		
		$create_time = date("Y-m-d h:i:s");
		$stmt = get_dao() -> prepare("insert into messages (to, from, subject, body, time) values (:to, :from, :subject, :body, :time);");
		$stmt->bindParam(":to", $message->to);
		$stmt->bindParam(":from", $message->from);
		$stmt->bindParam(":subject", $message->subject);
		$stmt->bindParam(":body", $message->body);
		$stmt->bindParam(":time", $message->create_time);
		$stmt->execute();
		
		 // set the id for the current message
		$stmt2 = get_dao() -> prepare("select mid from messages where to =:to and from = :from and time = :time;");
		$stmt2->bindParam(":to", $message->to);
		$stmt2->bindParam(":from", $message->from);
		$stmt2->bindParam(":time", $create_time);
		if ($stmt2->execute()) {
            $row = $stmt2 -> fetch();
            $message ->mid = $row["mid"];
            return $message;
        }
        return false;
	}
        
	public function get_received_messages($uid){
		
		$stmt = get_dao()->prepare("select * from messages where to = :uid;");
		$stmt->bindParam(":uid", $uid);
		
		if ($stmt->execute()){
			$messages = array();
			
			$row = $stmt->fetch();
			while (isset($row["mid"] )){
				$mid = $row["mid"];
				$to = $row["to"];
				$from =  $row["from"];
				$subject = $row["subject"];
				$body = $row["body"];
				$time = $row["time"];
				$message = new Message($mid, $to, $from, $subject, $body, $time);
				
				$message[$mid] = $message;	
				
				$row = $stmt->fetch();
			}
			
			return $messages;
		}
		else{
			return FALSE;
		}
	}
	
	public function get_send_message($uid){
		$stmt = get_dao()->prepare("select * from messages where from = :uid;");
		$stmt->bindParam(":uid", $uid);
		
		if ($stmt->execute()){
			$messages = array();
			$row = $stmt->fetch();
			while (isset($row["mid"] )){
				$mid = $row["mid"];
				$to = $row["to"];
				$from =  $row["from"];
				$subject = $row["subject"];
				$body = $row["body"];
				$time = $row["time"];
				$message = new Message($mid, $to, $from, $subject, $body, $time);
				
				$message[$mid] = $message;	
				
				$row = $stmt->fetch();
			}
			
			return $messages;
		}
		else{
			return FALSE;
		}
		
	}
	
	public function get_message($mid){
		
		$stmt = get_dao()->prepare("select * from messages where mid =:mid;");
		$stmt-> bindParam(":mid", $mid);
		
		if ($stmt->execute()){
			$row = $stmt->fetch();
			
			return new Message($row["mid"], $row["to"], $row["from"],$row["subject"], $row["body"], $row["time"]);
		}
		else{
			return FALSE;
		}
		
	}
	
}
?>