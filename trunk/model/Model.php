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

        $stmt = get_dao() -> prepare("insert into users (username, password, type, lastname, firstname) values (:username, :password, :type, :lastname, :firstname)");

        $stmt -> bindParam(':username', $user -> username);
        $stmt -> bindParam(':password', $user -> password);
        $stmt -> bindParam(':type', $user -> permission);
        $stmt -> bindParam(':lastname', $user -> lastname);
        $stmt -> bindParam(':firstname', $user -> firstname);

        $stmt -> execute();
        // error handling code goes here
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
            
            while (($row = $stmt->fetch()) != null) {
                
                $uid = $row["uid"];
                $username = $row["username"];
                $password = $row["password"];
                $permission = $row["type"];
                $firstname = $row["firstname"];
                $lastname = $row["lastname"];
                
                $users[$uid] = $this->create_user($uid, $username, $password, $permission, $firstname, $lastname);
            }
            
            return $users;
            
        }
        
        return false;
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
     */
    public function persist_game($game) {

        $stmt = get_dao() -> prepare("insert into games (name, organizer, creation, sport, `desc`) values (:name, :organizer, :creation, :sport, :desc)");

        $stmt -> bindParam(':name', $game -> name);
        $stmt -> bindParam(':organizer', $game -> organizer);
        $stmt -> bindParam(':creation', $game -> creation);
        $stmt -> bindParam(':sport', $game -> sport);
        $stmt -> bindParam(':desc', $game -> desc);

        $stmt -> execute();
    }

    /**
     * return all games created by a particular user
     * return empty array if no games associate with that user
     * return false if query doesn't success // need more work
     */
    public function get_games($user) {

        // first get all sports associate with the current user
        $sport_model = new SportModel();
        $user_sports = $sport_model -> get_sports(get_loggedin_user());

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
        $users = $user_model->get_all_users();
        
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
                
                $game = $this->create_game($gid, $name, $organizer, $creation, $sport, $desc);
                $user_games[] = $game;
            }
            return $user_games;
        } else {
            return false;
        }
    }
}


?>