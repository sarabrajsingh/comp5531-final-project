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
}else{
	print("email: ".$_POST['login-email']." ____ password: ".$_POST['login-password']);
}

if($_POST['login-email'] === 'admin@admin.com') {
	if(password_verify($_POST['login-password'], '$2y$10$GCRBD7g/mPz1J9DUsxQ8O..hE9XSOOaCf7LUfYAXKs3AxD.o282BK'))
	{
		$_SESSION['name'] = 'Admin';
		header('Location: ../homepages/admin-home.php');
	}
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT userId, firstName, lastName, password, subscriptionLevel FROM users WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

	$stmt->bind_param('s', $_POST['login-email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($userId, $firstName, $lastName, $password, $subscriptionLevel);
		$stmt->fetch();

		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		if (password_verify($_POST['login-password'], $password)) {
			// Verification success! User has logged-in!
			// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $firstName . $lastName;
			$_SESSION['id'] = $userId;
			$_SESSION['subscriptionLevel'] = $subscriptionLevel;
			$_SESSION['type'] = $type;
			// $_SESSION['category'] = $category;
			// echo 'Welcome ' . $_SESSION['name'] . '!';
			if($_SESSION['type'] === 'employer'){
				header('Location: ../homepages/employer-home.php');
			} else {
				header('Location: ../homepages/user-home.php');
			}
		} else {
			// Incorrect password
			$errors['password'] = 'Incorrect Password';
		}
	} else {
		// Incorrect username
		$errors['username'] = 'Incorrect Username';
	}
	$stmt->close();
}
?>