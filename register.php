<?php include 'head.php';
		require_once 'csrfProtection.php';
		require_once 'function.php';
?>
<div class="col-md-4"></div>
<div class="col-md-4">
	<div class="panel panel-default" id="panel-margin">
		<div class="panel-heading">
			<center><h1 class="panel-title">Register</h1></center>
		</div>
		<div class="panel-body">
			<form method="POST" action="save_user.php">
					<div class="form-group">
							<label>Firstname</label>
							<input type="text" name="firstname" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Lastname</label>
								<input type="text" name="lastname" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control" required="required"/>
							</div>
							<input type="hidden" name="_token" value="<?php echo escape($_SESSION['_token']);?>"/>
					</div>
					<?php if(isset($errorMessage)){echo "<center><label class='text-danger'>" . $errorMessage . "</label></center>";}?>
					<div class="form-group">
						<button class="btn btn-block btn-primary" name="register">Register</button>
					</div>
			</form>
			<form action="main.php">
				<div class="form-group">
						<button class="btn btn-block btn-primary">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php'?>
</body>
</html>