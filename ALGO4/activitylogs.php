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
	<title>Activity Log</title>
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

		.tableClass {
			width: 90%;
			max-width: 1200px;
			margin: 40px auto;
			background-color: white;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
			overflow: hidden;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			font-size: 16px;
		}

		th, td {
			padding: 15px;
			text-align: left;
		}

		th {
			background-color: #007bff;
			color: white;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		tr:hover {
			background-color: #e1e1e1;
		}

		@media (max-width: 768px) {
			.tableClass {
				width: 100%;
			}
			table, th, td {
				font-size: 14px;
			}
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="tableClass">
		<table>
			<tr>
				<th>Activity Log ID</th>
				<th>Operation</th>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Specialization</th>
				<th>Username</th>
				<th>Date Added</th>
			</tr>
			<?php $getAllActivityLogs = getAllActivityLogs($pdo); ?>
			<?php foreach ($getAllActivityLogs as $row) { ?>
			<tr>
				<td><?php echo $row['activity_log_id']; ?></td>
				<td><?php echo $row['operation']; ?></td>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['first_name']; ?></td>
				<td><?php echo $row['last_name']; ?></td>
				<td><?php echo $row['specialization']; ?></td>
				<td><?php echo $row['username']; ?></td>
				<td><?php echo $row['date_added']; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
