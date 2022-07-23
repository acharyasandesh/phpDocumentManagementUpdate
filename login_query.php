<?php
	session_start();
	require 'conn.php';
	require_once 'csrfProtection.php';
	
	if(ISSET($_POST['login'])){
		$username = trim(addslashes(mysqli_real_escape_string($conn, $_POST['username'])));
		$passwordEntered = $_POST['password'];
		$password = trim(addslashes(mysqli_real_escape_string($conn, password_hash($passwordEntered, PASSWORD_DEFAULT))));
		
		$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username'") or die(mysqli_error($conn));
		$fetch = mysqli_fetch_array($query);
		// print_r($fetch);
		$row = $query->num_rows;
		
		if($row > 0){
			$_SESSION['users'] = $fetch['username'];
			$fetchedPassword = $fetch['password'];

			$isCorrect = password_verify($passwordEntered, $fetchedPassword);
			if($isCorrect){
				header("location:user_profile.php");
			}
			else{
				$errorMessage= "<center><label class='text-danger'>Invalid username or password</label></center>";
				include 'main.php';
			}
		}else{
			$errorMessage= "<center><label class='text-danger'>Invalid username or password</label></center>";
			include 'main.php';
		}
	}
?>