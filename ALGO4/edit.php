<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit User</title>
	<link rel="stylesheet" href="styles.css">
	<style>

		body {
		    font-family: Arial, sans-serif;
		    background-color: #f0f4f8;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    min-height: 100vh;
		    margin: 0;
		    color: #333;
		}

		.container {
		    background-color: #ffffff;
		    border-radius: 8px;
		    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
		    padding: 20px 40px;
		    max-width: 600px;
		    width: 100%;
		    margin: 20px;
		}

		h1 {
		    color: #007bff;
		    text-align: center;
		    font-size: 1.8em;
		    margin-bottom: 20px;
		}

		form p {
		    margin-bottom: 15px;
		}

		label {
		    display: block;
		    font-weight: bold;
		    margin-bottom: 5px;
		    color: #555;
		}

		input[type="text"] {
		    width: 100%;
		    padding: 10px;
		    border: 1px solid #ddd;
		    border-radius: 5px;
		    font-size: 1em;
		    box-sizing: border-box;
		}

		input[type="submit"] {
		    background-color: #007bff;
		    color: #ffffff;
		    border: none;
		    padding: 12px 20px;
		    font-size: 1em;
		    border-radius: 5px;
		    cursor: pointer;
		    font-weight: bold;
		    width: 100%;
		    transition: background-color 0.3s ease;
		}

		input[type="submit"]:hover {
		    background-color: #0056b3;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Edit User</h1>
		<?php $getUserByID = getUserByID($pdo, $_GET['id']); ?>
		<form action="core/handleForms.php?id=<?php echo $_GET['id']; ?>" method="POST">
			<p>
				<label for="firstName">First Name</label> 
				<input type="text" name="first_name" value="<?php echo $getUserByID['first_name']; ?>">
			</p>
			<p>
				<label for="lastName">Last Name</label> 
				<input type="text" name="last_name" value="<?php echo $getUserByID['last_name']; ?>">
			</p>
			<p>
				<label for="email">Email</label> 
				<input type="text" name="email" value="<?php echo $getUserByID['email']; ?>">
			</p>
			<p>
				<label for="gender">Gender</label> 
				<input type="text" name="gender" value="<?php echo $getUserByID['gender']; ?>">
			</p>
			<p>
				<label for="address">Address</label> 
				<input type="text" name="address" value="<?php echo $getUserByID['address']; ?>">
			</p>
			<p>
				<label for="specialization">Specialization</label> 
				<input type="text" name="specialization" value="<?php echo $getUserByID['specialization']; ?>">
			</p>
			<p>
				<label for="yearsOfExperience">Years of Experience</label> 
				<input type="text" name="years_of_experience" value="<?php echo $getUserByID['years_of_experience']; ?>">
			</p>
			<p>
				<input type="submit" value="Save" name="editUserBtn">
			</p>
		</form>
	</div>
</body>
</html>
