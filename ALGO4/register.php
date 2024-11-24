<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f7fa;
			margin: 0;
			padding: 0;
			color: #333;
		}

		h1 {
			text-align: center;
			color: #007bff;
			margin-top: 50px;
		}

		form {
			width: 100%;
			max-width: 400px;
			padding: 30px;
			background-color: white;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
			margin: 0 auto;
		}

		label {
			display: block;
			font-size: 1.2em;
			color: #555;
			margin-bottom: 8px;
			text-align: left;
		}

		input[type="text"], input[type="password"] {
			width: 100%;
			padding: 15px;
			font-size: 1em;
			border: 1px solid #ddd;
			border-radius: 4px;
			margin-bottom: 20px;
			box-sizing: border-box;
		}

		input[type="submit"] {
			width: 100%;
			padding: 15px;
			background-color: #007bff;
			color: white;
			font-size: 1.2em;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #0056b3;
		}

		.alert {
			text-align: center;
			font-size: 1.2em;
			margin-top: 20px;
		}

		.success {
			color: green;
		}

		.error {
			color: red;
		}

		p {
			font-size: 1em;
			color: #555;
			text-align: center;
		}
	</style>
</head>
<body>
	<h1>Register Now!</h1>
	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {
		$statusClass = $_SESSION['status'] == "200" ? 'success' : 'error';
		echo "<div class='alert {$statusClass}'>{$_SESSION['message']}</div>";
	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username</label>
			<input type="text" name="username" required>
		</p>
		<p>
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" required>
		</p>
		<p>
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" required>
		</p>
		<p>
			<label for="password">Password</label>
			<input type="password" name="password" required>
		</p>
		<p>
			<label for="confirm_password">Confirm Password</label>
			<input type="password" name="confirm_password" required>
		</p>
		<p>
			<input type="submit" name="insertNewUserBtn" value="Register">
		</p>
	</form>
</body>
</html>
