<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Confirmation</title>
	<link rel="stylesheet" href="styles.css">
	<style>

		body {
		    font-family: Arial, sans-serif;
		    background-color: #f5f5f5;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    height: 100vh;
		    margin: 0;
		    color: #333;
		}


		.container {
		    border: 2px solid #d9534f;
		    background-color: #ffe6e7;
		    padding: 30px;
		    border-radius: 10px;
		    width: 90%;
		    max-width: 600px;
		    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		    text-align: left;
		}

		.container h1 {
		    color: #d9534f;
		    text-align: center;
		    font-size: 1.8em;
		}

		.container h2 {
		    font-size: 1.1em;
		    color: #555;
		    margin: 8px 0;
		}


		.deleteBtn {
		    text-align: center;
		    margin-top: 20px;
		}

		.deleteBtn form input[type="submit"] {
		    background-color: #d9534f;
		    color: white;
		    border: none;
		    padding: 10px 20px;
		    border-radius: 5px;
		    cursor: pointer;
		    font-size: 1em;
		    font-weight: bold;
		    transition: background-color 0.3s;
		}

		.deleteBtn form input[type="submit"]:hover {
		    background-color: #c9302c;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Are you sure you want to delete this user?</h1>
		<?php $getUserByID = getUserByID($pdo, $_GET['id']); ?>
		<h2>First Name: <?php echo $getUserByID['first_name']; ?></h2>
		<h2>Last Name: <?php echo $getUserByID['last_name']; ?></h2>
		<h2>Email: <?php echo $getUserByID['email']; ?></h2>
		<h2>Gender: <?php echo $getUserByID['gender']; ?></h2>
		<h2>Address: <?php echo $getUserByID['address']; ?></h2>
		<h2>Specialization: <?php echo $getUserByID['specialization']; ?></h2>
		<h2>Years of Experience: <?php echo $getUserByID['years_of_experience']; ?></h2>

		<div class="deleteBtn">
			<form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
				<input type="submit" name="deleteUserBtn" value="Delete">
			</form>			
		</div>	
	</div>
</body>
</html>
