<?php
	session_start();
	
	if(!ISSET($_SESSION['users'])){
		header('location:main.php');
	}
?>