<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">  
  <head>
    	<title>Welcome to the Dojo Friend Finder</title>
    	<meta name="keywords" content="friend, find">
		<meta name="description" content="A Coding Dojo Exercise.">
    	<?php include("php/header.php"); ?>
  </head>
  <body>
  	<?php include("php/class_lib.php"); ?>
  		<div class="row-fluid">
				<div class="span4 offset1 my_box" id="user">
					<h3>Welcome, <?php echo $_SESSION['user']['first_name']; ?>!</h3>
					<h4><?php echo $_SESSION['user']['email']; ?></h4>
				</div>
      </div>
      <div class="row-fluid">
  				<div class="span6 my_box" id="subscribers">
  					<h3>Users</h3>
  					<table class="table table-bordered table-condensed" id="users_table">
  						<thead>
  							<tr>
  								<th>Name</th>
  								<th>Email</th>
  								<th>Action</th>
  							</tr>
  						</thead>
  						<tbody>
  							<?php $table= new Users; ?>
  						</tbody>
					  </table>
  				</div>
          <div class="span6 my_box" id="friends">
            <h3>Your Friends</h3>
            <table class="table table-bordered table-condensed" id="friends_table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>
              <?php $table= new Friends; ?>
            </tbody>
          </table>
          </div>
		</div>
  </body>
</html>