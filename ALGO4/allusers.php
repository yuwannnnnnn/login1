<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>All Users</title>
	<link rel="stylesheet" href="styles/styles.css">
	<style>

		body {
			font-family: Arial, sans-serif;
			background-color: #f8f9fa;
			margin: 0;
			padding: 0;
			color: #333;
		}


		nav {
			background-color: #007bff;
			padding: 10px 0;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		nav a {
			color: white;
			text-decoration: none;
			font-size: 18px;
			margin: 0 15px;
		}

		nav a:hover {
			text-decoration: underline;
		}


		h2 {
			text-align: center;
			color: #007bff;
			margin-top: 20px;
		}

		ul {
			list-style-type: none;
			padding: 0;
			margin: 20px auto;
			width: 80%;
			max-width: 600px;
			background-color: white;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
		}

		ul li {
			background-color: #ffffff;
			border-bottom: 1px solid #f1f1f1;
			padding: 15px;
			font-size: 18px;
			color: #333;
		}

		ul li:hover {
			background-color: #f1f1f1;
			cursor: pointer;
		}

		ul li:last-child {
			border-bottom: none;
		}


		@media (max-width: 600px) {
			ul {
				width: 90%;
			}
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<h2>All Users</h2>
	<ul>
		<?php $getAllUsers = getAllNUsers($pdo); ?>
		<?php foreach ($getAllUsers as $row) { ?>
			<li><?php echo $row['username']; ?></li>
		<?php } ?>
	</ul>
</body>
</html>
