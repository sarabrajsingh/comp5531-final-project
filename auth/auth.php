<?php

session_start();

require '../database/db.php';

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['login-email'], $_POST['login-password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT password, type FROM users WHERE email = ? UNION select password, type FROM companies WHERE email = ?')) {
	// Bind parameters (s = string, ic = int, b = blob, etc), in our case the username is a string so we use "s"

	$stmt->bind_param('ss', $_POST['login-email'], $_POST['login-email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($password, $type);
		$stmt->fetch();

		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		if (password_verify($_POST['login-password'], $password)) {
			// Verification success! User has logged-in!
			// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['email'] = $_POST['login-email'];
			$_SESSION['password'] = $_POST['login-password'];
			$_SESSION['type'] = $type;
			$_SESSION['login-email'] = $_POST['login-email'];

			echo json_encode($type);

			if($_SESSION['type'] === 'admin'){
				header('Location: ../homepages/admin-home.php');
			} else if ($_SESSION['type'] === 'employer') {
				header('Location: ../homepages/employer-home.php');
			} else {
				header('Location: ../homepages/user-home.php');
			}
		}
	}
	echo json_encode($stmt);
	$stmt->close();
}
?>