<?php
session_start();
require '../database/db.php';

// $_POST['login-email'] = 'admin@admin.com';
// $_POST['login-password'] = 'admin';

$errors = [];
$data = array();

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['login-email'], $_POST['login-password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT password FROM users WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

	$stmt->bind_param('s', $_POST['login-email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($password);
		$stmt->fetch();

		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		if (password_verify($_POST['login-password'], $password)) {
			$data['success'] = true;
		} else {
			// Incorrect password
			$errors['password'] = 'Incorrect Password';
		}
	} else {
		// Incorrect username
		$errors['username'] = 'Incorrect Username';
	}
	$stmt->close();
	
	if (!empty($errors)) {
		$data['success'] = false;
		$data['errors'] = $errors;
	} else {
		$data['success'] = true;
		$data['message'] = 'Success!';
	}
	echo json_encode($data);
}
?>