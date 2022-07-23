<?php
	$server = "localhost";
	$username= "id17826216_sandesh";
	$password ="Z]IjP<75TiV)YMQ*";
	$dbname = "id17826216_documentmanagement";
	$conn = mysqli_connect($server, $username, $password, $dbname);
	
	if(!$conn){
		die("Error: Failed to connect to database!" . mysqli_connect_error($conn));
	}
?>