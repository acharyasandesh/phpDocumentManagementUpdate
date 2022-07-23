<?php 
	require_once 'validator.php';
	require_once 'conn.php';
	require_once 'head.php';
	require_once 'csrfProtection.php';
	require_once 'function.php';
?>

<div class="col-md-8">
	<h1 style="margin-top:100px;">File List</h1>
	<div class="panel panel-default">
		<div class="panel-body alert-success" >
			
			<table id="table" class="table table-bordered">
				<thead>
					<tr>
						<th>Filename</th>
						<th>File Type</th>
						<th>Date Uploaded</th>
						<th>Size</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$_SESSION[users]'") or die(mysqli_error($conn));
						$fetch = mysqli_fetch_array($query);
						$username = $fetch['username'];
						$query1 = mysqli_query($conn, "SELECT * FROM `storage` WHERE `username` = '$username'") or die(mysqli_error($conn));
						$row = $query1->num_rows;

						if($row == 0){
							?>
							<tr> <td>No files found in the record...</td>
					<?php }
						else {
					?>
						<?php
							while($fetch1 = mysqli_fetch_array($query1)){
						?>
							<tr class="del_file<?php echo escape($fetch1['store_id']);?>">
								<td><?php echo escape(substr($fetch1['filename'], 0 ,30)."...");?></td>
								<td><?php echo escape($fetch1['file_type']);?></td>
								<td><?php echo escape($fetch1['date_uploaded']);?></td>
								<td><?php $size = $fetch1['file_size']; 
									if($size < 1048576){
										echo escape(floor($size/1014) . " KB");
									}
									else{
										echo escape(round($size/1048576, 2) . " MB");
										};?></td>
								<td>
									<form method="POST" action="download.php">
										<input type="hidden" name="_token" value="<?php echo escape($_SESSION['_token']);?>"/>
										<input type="hidden" name="store_id" value="<?php echo escape($fetch1['store_id']);?>"/>
										<button name="download" class="btn btn-success"> Download</button>
									</form> |
									<form method="POST" action="remove_file.php">
										<input type="hidden" name="_token" value="<?php echo escape($_SESSION['_token']);?>"/>
										<input type="hidden" name="store_id" value="<?php echo escape($fetch1['store_id']);?>"/>
										<button name="remove" class="btn btn-danger">Remove</button>
									</form>
								</td>
							</tr>
							<?php
								}
							?>
					<?php 
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-md-4">
	<div class="panel panel-primary" style="margin-top:20%;">
		<div class="panel-heading">
			<h1 class="panel-title">User Information</h1>
		</div>
		<div class="panel-body">
			<h4>Username: <label class="pull-right"><?php echo escape($fetch['username']);?></label></h4>
			<hr style="border-top:1px dotted #ccc;"/>
			<h4>Full Name: <label class="pull-right"><?php echo escape($fetch['firstname']." ".$fetch['lastname']);?></label></h4>
			<hr style="border-top:1px dotted #ccc;"/>
			<h3>Upload New File</h3>
			<form method="POST" enctype="multipart/form-data" action="save_file.php">
				<input type="file" name="file" size="4" style="background-color:#fff;" required="required" />
				<br />
				<input type="hidden" name="username" value="<?php echo escape($fetch['username']);?>"/>
				<input type="hidden" name="_token" value="<?php echo escape($_SESSION['_token']);?>"/>
				<button class="btn btn-success btn-sm" name="save"> Add File</button>
			</form>
			<br style="clear:both;"/>
			<a href="#" onclick="logoutFunction()" class="btn btn-danger">Logout</a>
		</div>
	</div>
	
</div>
<script>
	function logoutFunction() {
		var r = confirm("Are you sure you want to logout?");
		if (r == true) {
			window.location = "logout.php";
		}
	}
</script>	
<?php include "footer.php"?>