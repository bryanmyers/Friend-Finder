<?php

	if(isset($_SESSION['login_error_messages']))
	{	
		echo "<div class='errors'>";

		foreach($_SESSION['login_error_messages'] as $message)
		{
			echo "<p>{$message}</p>";
		}

		unset($_SESSION['login_error_messages']);
		echo "</div>";
	}
?>