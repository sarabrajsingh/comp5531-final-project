<?php
session_start();
require '../database/db.php';

// $_POST['login-email'] = 'admin@admin.com';
// $_POST['login-password'] = 'admin';

$errors = [];
$data = [];

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['login-email'], $_POST['login-password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT userId, firstName, lastName, password, userStatus FROM users WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

	$stmt->bind_param('s', $_POST['login-email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($userId, $firstName, $lastName, $password, $userStatus);
		$stmt->fetch();

		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		if (password_verify($_POST['login-password'], $password)) {
			// Verification success! User has logged-in!
			// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $firstName;
			$_SESSION['id'] = $userId;
			$_SESSION['userStatus'] = $userStatus;
			// $_SESSION['category'] = $category;
			// echo 'Welcome ' . $_SESSION['name'] . '!';
			//if($_SESSION['role'] === 'employer'){
			//	header('Location: ../homepages/employer-home.php');
			if ($_SESSION['userStatus'] === 'admin') {
				header('Location: ../homepages/admin-home.php');
			} else {
				header('Location: ../homepages/user-home.php');
			}
		}
	} else {
				if ($stmt = $con->prepare('SELECT companyName, email, Password, employerStatus FROM Employers WHERE email = ?')) {

						$stmt->bind_param('s', $_POST['login-email']);	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
						$stmt->execute();
						$stmt->store_result();							// Store the result so we can check if the account exists in the database.

						if ($stmt->num_rows > 0) {
							$stmt->bind_result($companyName, $email, $password, $employerStatus);
							$stmt->fetch();
							// Account exists, now we verify the password.
							if (password_verify($_POST['login-password'], $password)) {
								// Verification success! User has logged-in!
								session_regenerate_id(); // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.

								$_SESSION['loggedin'] = TRUE;
								$_SESSION['name'] = $companyName;
								$_SESSION['userStatus'] = $userStatus;
								header('Location: ../homepages/employer-home.php');
								}
					}
			else {
				// Incorrect password
				$errors['password'] = 'Incorrect Password';
			}
		}
		$stmt->close();
	}
}
?>