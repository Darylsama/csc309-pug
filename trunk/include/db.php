<?php

/**
 * light weight db connection obj
 */


DEFINE("DATASRC", "mysql:host=localhost;dbname=mydb");
DEFINE("USERNAME", "root");
DEFINE("PASSWORD", NULL);


/**
 * get the current php data access object with
 */
function get_dao() {

	/**
	 * Uses persistent connection: no new connection created for new PDO created
	 * Shows exception messages
	 * Set fetch key to column names instead of integers
	 */
	$conn = new PDO(

		DATASRC,
		USERNAME,
		PASSWORD,

		array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		)
	);

	return $conn;
}


?>