<!DOCTYPE html>
<?php session_start();  ?>
<html lang="en">  
  	<head>
    	<title>Login to Dojo Friend Finder</title>
    	<meta name="keywords" content="friend, find">
		<meta name="description" content="A Coding Dojo Exercise.">
    	<?php include("php/header.php"); ?>
  	</head>
  	<body>
  		<div class="row-fluid">
  			<div class="span12" id="container">
  				<div class="row-fluid">
  					<div class="span5 offset1 my_box" id="login">
  						<?php include('php/errors_login.php'); ?>
						<!-- Login form starts here -->
						<legend>Login</legend>
						<form class="form-horizontal" action="php/process.php" method="post">
							<input type="hidden" name="action" value="login">
							<div class="control-group">
								<label class="control-label" for="username">Email Address:</label>
								<div class="controls">
									<input class="input-medium" type="text" name="email" placeholder="Email Address"></br>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">Password:</label>
								<div class="controls">
									<input class="input-medium" type="password" name="password" placeholder="Password"></br>
								</div>
							</div>
							<div class="control-group">	
								<div class="controls">
									<input class="btn btn-danger" type="submit" value="Login">
								</div>
							</div>
						</form>
  					</div>
  					<div class="span5 my_box" id="register">
  						<!-- 	registration form starts here -->
  						<?php include('php/errors_reg.php'); ?>
						<legend>Register</legend>
						<form class="form-horizontal" action="php/process.php" method="post">
							<input type="hidden" name="action" value="register">
							<div class="control-group">
								<label class="control-label" for="email">Email:</label>
								<div class="controls">
									<input class="input-medium" id="email" type="text" name="email" placeholder="email address"></br>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="first_name">First Name:</label>
								<div class="controls">
									<input class="input-medium" id="first_name" type="text" name="first_name" placeholder="First Name"></br>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="last_name">Last Name:</label>
								<div class="controls">
									<input class="input-medium" id="last_name" type="text" name="last_name" placeholder="Last Name"></br>
								</div>
							</div>
							<div class="control-group">	
								<label class="control-label" for="password1">Password:</label>
								<div class="controls">
									<input class="input-medium" id="password1" type="password" name="password1" placeholder="Password"></br>
								</div>
							</div>
							<div class="control-group">	
								<label class="control-label" for="password2">Confirm Password:</label>
								<div class="controls">
									<input class="input-medium" id="password2" type="password" name="password2" placeholder="Confirm Password"></br>
								</div>
							</div>
							<div class="control-group">	
								<div class="controls">
									<input class="btn btn-danger" type="submit" value="Register">
								</div>
							</div>
						</form>
  					</div>
  				</div>
  			</div>
		</div>
  	</body>
</html>