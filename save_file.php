<?php
	require_once 'conn.php';
	require_once 'csrfProtection.php';
	
	if(ISSET($_POST['save'])){
		$username = trim(addslashes(mysqli_real_escape_string($conn, $_POST['username'])));
		$file_name = trim(addslashes(mysqli_real_escape_string($conn, $_FILES['file']['name'])));
		$file_type = trim(addslashes(mysqli_real_escape_string($conn, $_FILES['file']['type'])));
		$file_temp = $_FILES['file']['tmp_name'];
		$file_size = trim(addslashes(mysqli_real_escape_string($conn, $_FILES['file']['size'])));
		$location = "files/".$username."/".$file_name;
		$date = date("Y-m-d, h:i A");
		if(!file_exists("files/".$username)){
			mkdir("files/".$username);
		}
		
		if(move_uploaded_file($file_temp, $location)){
			mysqli_query($conn, "INSERT INTO `storage` VALUES(NULL, '$file_name', '$file_type', '$date', '$file_size','$username')") or die(mysqli_error($conn));
			header('location: user_profile.php');
		}
	}
?>