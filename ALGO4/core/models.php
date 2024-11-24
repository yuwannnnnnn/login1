<?php  

require_once 'dbConfig.php';

function checkIfUserExists($pdo, $username) {
	$response = array();
	$sql = "SELECT * FROM user_accounts WHERE username = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$username])) {

		$userInfoArray = $stmt->fetch();

		if ($stmt->rowCount() > 0) {
			$response = array(
				"result"=> true,
				"status" => "200",
				"userInfoArray" => $userInfoArray
			);
		}

		else {
			$response = array(
				"result"=> false,
				"status" => "400",
				"message"=> "User doesn't exist from the database"
			);
		}
	}

	return $response;

}

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {
	$response = array();
	$checkIfUserExists = checkIfUserExists($pdo, $username); 

	if (!$checkIfUserExists['result']) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) 
		VALUES (?,?,?,?)";

		$stmt = $pdo->prepare($sql);

		if ($stmt->execute([$username, $first_name, $last_name, $password])) {
			$response = array(
				"status" => "200",
				"message" => "User successfully inserted!"
			);
		}

		else {
			$response = array(
				"status" => "400",
				"message" => "An error occured with the query!"
			);
		}
	}

	else {
		$response = array(
			"status" => "400",
			"message" => "User already exists!"
		);
	}

	return $response;
}

function getAllCoachesBySearch($pdo, $searchQuery) {
    $query = "SELECT * FROM coaches WHERE 
              first_name LIKE :searchQuery OR 
              last_name LIKE :searchQuery OR 
              email LIKE :searchQuery";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getAllCoaches($pdo) {
	$sql = "SELECT * FROM coaches";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM coaches 
			ORDER BY first_name ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAllNUsers($pdo) {
	$sql = "SELECT * FROM user_accounts";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $id) {
	$sql = "SELECT * from coaches WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function insertAnActivityLog($pdo, $operation, $id, $first_name, 
		$last_name, $specialization, $username) {

	$sql = "INSERT INTO activity_logs (operation, id, first_name, 
		last_name, specialization, username) VALUES(?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $id, $first_name, 
		$last_name, $specialization, $username]);

	if ($executeQuery) {
		return true;
	}

}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs";
	$stmt = $pdo->prepare($sql);
	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

function searchForAUser($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM coaches WHERE 
			CONCAT(first_name,last_name,email,gender,
				address,specialization,years_of_experience,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}



function insertNewCoach($pdo, $first_name, $last_name, $email, $gender, $address, $specialization, $years_of_experience, $added_by) {
	$response = array();
	$sql = "INSERT INTO coaches (first_name, last_name, email, gender, address, specialization, years_of_experience, added_by) VALUES(?,?,?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$insertCoach = $stmt->execute([$first_name, $last_name, $email, $gender, $address, $specialization, $years_of_experience, $added_by]);

	if ($insertCoach) {
		$findInsertedItemSQL = "SELECT * FROM coaches ORDER BY date_added DESC LIMIT 1";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute();
		$getCoachID = $stmtfindInsertedItemSQL->fetch();

		$insertAnActivityLog = insertAnActivityLog($pdo, "INSERT", $getCoachID['id'], 
			$getCoachID['first_name'], $getCoachID['last_name'], 
			$getCoachID['specialization'], $_SESSION['username']);

		if ($insertAnActivityLog) {
			$response = array(
				"status" =>"200",
				"message"=>"Coach added successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
		
	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"Insertion of data failed!"
		);

	}

	return $response;
}


function editUser($pdo, $first_name, $last_name, $email, $gender, $address, $specialization, $years_of_experience,	 
	$last_updated, $last_updated_by, $id) {

	$response = array();
	$sql = "UPDATE coaches
			SET first_name = ?,
				last_name = ?,
				email = ?,
				gender = ?,
				address = ?,
				specialization = ?,
				years_of_experience = ?, 
				last_updated = ?, 
				last_updated_by = ? 
			WHERE id = ?
			";
	$stmt = $pdo->prepare($sql);
	$updateCoach = $stmt->execute([$first_name, $last_name, $email, $gender, $address, $specialization, $years_of_experience, 
	$last_updated, $last_updated_by, $id]);

	if ($updateCoach) {

		$findInsertedItemSQL = "SELECT * FROM coaches WHERE id = ?";
		$stmtfindInsertedItemSQL = $pdo->prepare($findInsertedItemSQL);
		$stmtfindInsertedItemSQL->execute([$id]);
		$getCoachID = $stmtfindInsertedItemSQL->fetch(); 

		$insertAnActivityLog = insertAnActivityLog($pdo, "UPDATE", $getCoachID['id'], 
			$getCoachID['first_name'], $getCoachID['last_name'], 
			$getCoachID['specialization'], $_SESSION['username']);

		if ($insertAnActivityLog) {

			$response = array(
				"status" =>"200",
				"message"=>"Updated the coach successfully!"
			);
		}

		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}

	}

	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;

}




function deleteUser($pdo, $id) {
	$response = array();
	$sql = "SELECT * FROM coaches WHERE id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$id]);
	$getCoachByID = $stmt->fetch();

	$insertAnActivityLog = insertAnActivityLog($pdo, "DELETE", $getCoachByID['id'], 
		$getCoachByID['first_name'], $getCoachByID['last_name'], 
		$getCoachByID['specialization'], $_SESSION['username']);

	if ($insertAnActivityLog) {
		$deleteSql = "DELETE FROM coaches WHERE id = ?";
		$deleteStmt = $pdo->prepare($deleteSql);
		$deleteQuery = $deleteStmt->execute([$id]);

		if ($deleteQuery) {
			$response = array(
				"status" =>"200",
				"message"=>"Deleted the coach successfully!"
			);
		}
		else {
			$response = array(
				"status" =>"400",
				"message"=>"Insertion of activity log failed!"
			);
		}
	}
	else {
		$response = array(
			"status" =>"400",
			"message"=>"An error has occured with the query!"
		);
	}

	return $response;
}




?>