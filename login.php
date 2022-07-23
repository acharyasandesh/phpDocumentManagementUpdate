<?php require_once 'csrfProtection.php';
		require_once 'function.php';
?>
<div class="col-md-4"></div>
<div class="col-md-4">
	<div class="panel panel-default" id="panel-margin">
		<div class="panel-heading">
			<center><h1 class="panel-title">Login</h1></center>
		</div>
		<div class="panel-body">
			<form method="POST" action='login_query.php'>
				<div class="form-group">
					<label for="username">Username</label>
					<input name="username" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" name="password" type="password" required="required"/>
				</div>
				<input type="hidden" name="_token" value="<?php echo escape($_SESSION['_token']);?>"/>
				<?php if(isset($errorMessage)){echo $errorMessage;}?>
				<div class="form-group">
					<button class="btn btn-block btn-primary"  name="login">Login</button>
				</div>
			</form>
			<form action="register.php">
				<div class="form-group">
						<button class="btn btn-block btn-primary">Register</button>
				</div>
			</form>
		</div>
	</div>
</div>