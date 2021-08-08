<?php
session_start();
require '../database/db.php';

// $_POST['login-email'] = 'admin@admin.com';
// $_POST['login-password'] = 'admin';

$errors['user_found'] = false;
$data = array();

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['register-email'])) {
	// Could not get the data that should have been sent.
	exit('error receiving register-email from $_POST');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT userId FROM users WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

	$stmt->bind_param('s', $_POST['register-email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$errors['user_found'] = true;
		$data['success'] = false;
	} else {
		$data['success'] = true;
	}

	$stmt->close();
	
	$data['errors'] = $errors;

	echo json_encode($data);
}
?>