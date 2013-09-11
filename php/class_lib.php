<?php 
require("mysql_connect.php");

class Table
{
	var $connection;

	function __construct()
	{
		$this->connection = new Database;
	}
}
class Friends extends Table
{
	function __construct()
	{
		$this->connection = new Database;

		$query = "SELECT first_name, last_name, email FROM users LEFT JOIN friends ON users.id = friends.friend_id WHERE friends.users_id = '{$_SESSION['user']['id']}'";

		$results = $this->connection->fetch_all($query);

		foreach ($results as $row) {
			echo "<tr>
					<td> {$row['first_name']} {$row['last_name']} </td>
					<td> {$row['email']} </td>
				</tr>";
		}
	}
}
class Users extends Table
{
	function __construct()
	{
		$this->connection = new Database;

		$query = "SELECT users.id, users.first_name, users.last_name, users.email, friends.* FROM users LEFT JOIN friends ON users.id = friends.friend_id WHERE users.id != {$_SESSION['user']['id']}";

		$results = $this->connection->fetch_all($query);

		foreach ($results as $row) {
			echo "<tr>
					<td> {$row['first_name']} {$row['last_name']} </td>
					<td> {$row['email']} </td>";

			if($_SESSION['user']['id'] == $row['users_id'])
			{
				echo "<td> Friends </td>";
			}
			else
			{
				echo "<td>
						<form action='php/process.php' method='post'>
						<input type='hidden' name='action' value='add_friend'>
						<input type='hidden' name='friend_id' value='{$row['id']}'>
						<button class='btn btn-primary btn-mini' type='submit' class='btn'>Add Friend</button>

						</form>
					</td>";
			}
			echo "</tr>";
		}
	}
}
?>