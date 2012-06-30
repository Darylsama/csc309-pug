<?php

/**
 * light weight db connection obj
 */

DEFINE("DEVELOPMENT", 1);

if (DEVELOPMENT) {

    DEFINE("DATASRC", "mysql:host=localhost;dbname=mydb");
    DEFINE("USERNAME", "root");
    DEFINE("PASSWORD", NULL);
} else {

    DEFINE("DATASRC", "mysql:host=mysql3.000webhost.com;dbname=a3074846_pug");
    DEFINE("USERNAME", "a3074846_root");
    DEFINE("PASSWORD", "xyz654321");
}



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