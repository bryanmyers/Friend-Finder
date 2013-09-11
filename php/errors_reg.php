<?php

	if(isset($_SESSION['reg_error_messages']))
	{	
		echo "<div class='errors'>";

		if(is_array($_SESSION['reg_error_messages']))
		{
			foreach($_SESSION['reg_error_messages'] as $message)
			{
				echo "<p>{$message}</p>";
			}
			echo "</div>";
			unset($_SESSION['reg_error_messages']);
		}
		else
		{
			echo "<p>{$_SESSION['reg_error_messages']}</p>
				   </div>";
			unset($_SESSION['reg_error_messages']);
		}
	}
	elseif (isset($_SESSION['reg_success_message']))
	{
		echo "<div id='success'>{$_SESSION['reg_success_message']}</div>";
		unset($_SESSION['reg_success_message']);
	}
?>