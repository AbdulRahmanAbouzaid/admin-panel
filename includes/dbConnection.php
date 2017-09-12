<?php 
	$dbserver = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "scu_db";
	$connection = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname);
	$sSQL= 'SET CHARACTER SET utf8';
	mysqli_query($connection, $sSQL);
	if(mysqli_connect_errno()) {
		die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"  
		); 
	}
?>