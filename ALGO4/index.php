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
	<title>Document</title>
	<link rel="stylesheet" href="styles/styles.css">
	<style>
		
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f9;
			color: #333;
			margin: 0;
			padding: 0;
		}

	
		nav {
			display: flex;
			justify-content: center;
			align-items: center;
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


		.searchForm {
			text-align: center;
			margin: 20px auto;
		}

		.searchForm input[type="text"] {
			width: 300px;
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		.searchForm input[type="submit"] {
			padding: 10px 20px;
			font-size: 16px;
			background-color: #007bff;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.searchForm input[type="submit"]:hover {
			background-color: #0056b3;
		}

		.searchForm h3 a {
			text-decoration: none;
			color: #007bff;
		}

		.searchForm h3 a:hover {
			text-decoration: underline;
		}

	
		.tableClass {
			margin: 20px auto;
			width: 95%;
			overflow-x: auto;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			background-color: white;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			margin: 20px 0;
		}

		th, td {
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #007bff;
			color: white;
			text-transform: uppercase;
		}

		tr:hover {
			background-color: #f1f1f1;
		}

	
		td a {
			text-decoration: none;
			padding: 7px 12px;
			border-radius: 5px;
			color: white;
			font-size: 14px;
			display: inline-block; 
			margin-right: 5px; 
		}

		td a:hover {
			opacity: 0.8;
		}

		td a[href*="edit.php"] {
			background-color: #28a745;
		}

		td a[href*="delete.php"] {
			background-color: #dc3545;
		}
	</style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="searchForm">
		<form action="index.php" method="GET">
			<p>
				<input type="text" name="searchQuery" placeholder="Search here">
				<input type="submit" name="searchBtn" value="Search">
				<h3><a href="index.php">Search Again</a></h3>	
			</p>
		</form>
	</div>

	<?php  
	if (isset($_SESSION['message']) && isset($_SESSION['status'])) {

		if ($_SESSION['status'] == "200") {
			echo "<h1 style='color: green;'>{$_SESSION['message']}</h1>";
		} else {
			echo "<h1 style='color: red;'>{$_SESSION['message']}</h1>";	
		}

	}
	unset($_SESSION['message']);
	unset($_SESSION['status']);
	?>

	<div class="tableClass">
		<table>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Gender</th>
				<th>Address</th>
				<th>Specialization</th>
				<th>Years of Experience</th>
				<th>Date Added</th>
				<th>Added By</th>
				<th>Last Updated</th>
				<th>Last Updated By</th>
				<th>Action</th>
			</tr>
			<?php if (!isset($_GET['searchBtn'])) { ?>
				<?php $getAllCoaches = getAllCoaches($pdo); ?>
				<?php foreach ($getAllCoaches as $row) { ?>
				<tr>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['gender']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['specialization']; ?></td>
					<td><?php echo $row['years_of_experience']; ?></td>
					<td><?php echo $row['date_added']; ?></td>
					<td><?php echo $row['added_by']; ?></td>
					<td><?php echo $row['last_updated']; ?></td>
					<td><?php echo $row['last_updated_by']; ?></td>
					<td>
						<a href="edit.php?id=<?php echo $row['id']; ?>">Update</a>
						<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
					</td>
				</tr>
				<?php } ?>
			<?php } else { ?>
				<?php 
				$getAllCoachesBySearch = getAllCoachesBySearch($pdo, $_GET['searchQuery']); 
				
				foreach ($getAllCoachesBySearch as $row) {
					insertAnActivityLog(
						$pdo,
						'SEARCH',
						$row['id'], 
						$row['first_name'],
						$row['last_name'],
						$row['specialization'],
						$_SESSION['username']
					);
				}
				?>
				
				<?php foreach ($getAllCoachesBySearch as $row) { ?>
				<tr>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['gender']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['specialization']; ?></td>
					<td><?php echo $row['years_of_experience']; ?></td>
					<td><?php echo $row['date_added']; ?></td>
					<td><?php echo $row['added_by']; ?></td>
					<td><?php echo $row['last_updated']; ?></td>
					<td><?php echo $row['last_updated_by']; ?></td>
					<td>
						<a href="edit.php?id=<?php echo $row['id']; ?>">Update</a>
						<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
					</td>
				</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
	
</body>
</html>
