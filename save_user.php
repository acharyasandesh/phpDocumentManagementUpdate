<?php
	require_once 'conn.php';
	require_once 'csrfProtection.php';
	
	if(ISSET($_POST['register'])){
		$username = trim(addslashes(mysqli_real_escape_string($conn, $_POST['username'])));
		if(!preg_match('/^[a-z0-9]{4,20}$/', $username))
		{
			$errorMessage = "Please Enter Valid Username! No captial letters, at least 4 characters...";
			include 'register.php';
		}
		else{
			$firstname = trim(addslashes(mysqli_real_escape_string($conn, $_POST['firstname'])));
			$lastname = trim(addslashes(mysqli_real_escape_string($conn, $_POST['lastname'])));
			$passwordCheck = $_POST['password'];
			$password = trim(addslashes(mysqli_real_escape_string($conn, password_hash($passwordCheck, PASSWORD_DEFAULT))));
			$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username'") or die(mysqli_error($conn));
			$fetch = mysqli_fetch_array($query);
			$row = $query->num_rows;

			
			if (strlen($passwordCheck) <= 8) {
				$errorMessage = "Your Password Must Contain At Least 8 Characters!";
			}
			elseif(!preg_match("#[0-9]+#",$passwordCheck)) {
				$errorMessage = "Your Password Must Contain At Least 1 Number!";
			}
			elseif(!preg_match("#[A-Z]+#",$passwordCheck)) {
				$errorMessage = "Your Password Must Contain At Least 1 Capital Letter!";
			}
			elseif(!preg_match("#[a-z]+#",$passwordCheck)) {
				$errorMessage = "Your Password Must Contain At Least 1 Lowercase Letter!";
			}
			else{
				if($row == 0){
					mysqli_query($conn, "INSERT INTO `users` VALUES(NULL, '$username', '$firstname', '$lastname', '$password')") or die(mysqli_error($conn));
					header('location:main.php');
				}else{
					$errorMessage = "Username already taken, Try another one!";
				}
			}
			if(isset($errorMessage)){
				include 'register.php';
			};
		}
	}
?>