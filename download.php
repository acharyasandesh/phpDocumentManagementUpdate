<?php
	require_once 'conn.php';
	require_once 'csrfProtection.php';

	if(ISSET($_POST['download'])){
		$store_id = trim(addslashes(mysqli_real_escape_string($conn, $_POST['store_id'])));
		
		$query = mysqli_query($conn, "SELECT * FROM `storage` WHERE `store_id` = '$store_id'") or die(mysqli_error($conn));
		$fetch  = mysqli_fetch_array($query);
		$filename = $fetch['filename'];
		$username = $fetch['username'];
		header("Content-Disposition: attachment; filename=".$filename);
		header("Content-Type: application/octet-stream;");
		readfile("files/".$username."/".$filename);
	}
?>