<?php
	require_once 'conn.php';
	require_once 'csrfProtection.php';

	if(ISSET($_POST['remove'])){
		$store_id = mysqli_real_escape_string($conn, $_POST['store_id']);
		$query = mysqli_query($conn, "SELECT * FROM `storage` WHERE `store_id` = '$store_id'") or die(mysqli_error($conn));
		$fetch  = mysqli_fetch_array($query);
		$filename = $fetch['filename'];
		$username = $fetch['username'];
		unlink("files/".$username."/".$filename);
		mysqli_query($conn, "DELETE FROM `storage` WHERE `store_id` = '$store_id'") or die(mysqli_error($conn));
	}
	header('location: user_profile.php');
?>