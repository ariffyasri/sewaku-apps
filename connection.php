<?php
	
	session_start();
	date_default_timezone_set("Asia/Kuala_Lumpur");

	define('DB_USER', "root"); // db user
	define('DB_PASSWORD', ""); // db password (mention your db password here)
	define('DB_DATABASE', "mysql:dbname=rumah;host=localhost"); // database name

	try {
		$db = new PDO(DB_DATABASE, DB_USER, DB_PASSWORD);
		$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo 'Connection failed '. $e ->getMessage();
	}

	include_once 'class.user.php';
	$user = new USER ($db);
?>



