<?php 

require("mysql_connect.php");
session_start();

class Process
{
	var $connection;

	function __construct()
	{
		$this->connection = new Database;
		mysql_query('SET CHARACTER SET utf8');
	}

	function login()
	{
		$errors = array();

		//validate the form, add any problems to the errors array
		if(!(isset($_POST['email']) and filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
		{
			$errors[] = "Email is empty or invalid, please try again";
		}

		if(!(isset($_POST['password']) and strlen($_POST['password']) >= 6))
		{
			$errors[] = "Password is empty or fewer than 6 characters, please try again";
		}
		
		//send any errors back to the login page
		if(count($errors) > 0)
		{
			$_SESSION['login_error_messages'] = $errors;

			header('Location: ../login.php');
		}
		
		//if no errors exist see if the email and password matches a registered user
		else
		{
			$post_email = $_POST['email'];
			$md5_password = md5($_POST['password']);

			$query = "SELECT * FROM users WHERE email = '{$post_email}' AND password = '{$md5_password}'";
			$user = $this->connection->fetch_record($query);

			//log them in if there is a user in the database
			if($user)
			{
				$_SESSION['logged_in'] = true;
				$_SESSION['user']['id'] = $user['id'];
				$_SESSION['user']['first_name'] = $user['first_name'];
				$_SESSION['user']['last_name'] = $user['last_name'];
				$_SESSION['user']['email'] = $user['email'];
				
				header('Location: ../home.php');
			}

			//do this if the login and password do not turn up a user
			else
			{
				$errors[] = "No matching user and/or email. Try again or register.";
				$_SESSION['login_error_messages'] = $errors;

				header('Location: ../login.php');
			}
		}
	}

	function register()
	{
		//validate the inputted data
		$errors = array();

		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) 
		{
			$errors[] = "Email not valid, please try again.";
		}
		if (is_numeric($_POST['first_name']) == TRUE)	
		{
			$errors[] = "Please remove the numbers from your first name.";
		}
		elseif (empty ( $_POST['first_name'])) 
		{
			$errors[] = "Please enter a first name.";
		}
		if (is_numeric($_POST['last_name']) == TRUE)	
		{
			$errors[] = "Please remove the numbers from your last name.";
		}
		elseif (empty ( $_POST['last_name'])) 
		{
			$errors[] = "Please enter a last name.";
		}
		if (strlen($_POST['password1']) < 7)	
		{
			$errors[] = "Password must have at least 6 characters";
		}
		elseif ($_POST['password1'] != $_POST['password2']) 
		{
			$errors[] = "Passwords do not match. Make sure you confirm your password.";
		}
		//if any errors were added to the error array, send it back to the login page via SESSION.
		if(!empty($errors))	
		{
			$_SESSION['reg_error_messages'] = $errors;
			header("Location: ../index.php");
		}
		//if no errors were found, see if the user already exists.
		else 
		{
			$query = "SELECT email FROM users WHERE email = '{$_POST['email']}'";
			$user = $this->connection->fetch_record($query);

			//count the results. if the count is > 0 then send an error saying they already exist.
			if($user)
			{
				$errors = "Somebody has that email address, try again";
				$_SESSION['reg_error_messages'] = $errors;
				header("Location: ../index.php");
			}
			//Insert the new record into the DB
			else
			{
				$query = "INSERT INTO users (first_name, last_name, email, password, created_at) VALUES ('".mysql_real_escape_string($_POST['first_name'])."', '".mysql_real_escape_string($_POST['last_name'])."', '".mysql_real_escape_string($_POST['email'])."', '".md5($_POST['password1'])."', NOW())";
				
				mysql_query($query);
			
				$_SESSION['reg_success_message'] = "Success! Thank you for submitting your information. You may now log in";
				header("Location: ../index.php");
			}
		}
	}
	function add_friend()
	{
		$query = "INSERT INTO friends (users_id, friend_id) VALUES ({$_SESSION['user']['id']}, {$_POST['friend_id']}), ({$_POST['friend_id']}, {$_SESSION['user']['id']})";

		mysql_query($query);

		header("Location: ../home.php");
	}
}
//down here I need to do the logic that takes the form and session input and executes the proper functions above.
if ($_POST['action'] == "login")
{
	$process = new Process();
	$process->login();
}
elseif ($_POST['action'] == "register")
{
	$process = new Process();
	$process->register();	
}
elseif ($_POST['action'] == "add_friend")
{
	$process = new Process();
	$process->add_friend();	
}
else
{
	// session_destroy();
	// header("Location: ../index.php");
}
 ?>