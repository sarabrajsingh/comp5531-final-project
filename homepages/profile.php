<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
require '../database/db.php';
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = '';
if (isset($_SESSION['employerStatus'])){
	$stmt = $con->prepare('SELECT password, email FROM companies WHERE companyId = ?');
} else {
	$stmt = $con->prepare('SELECT password, email, firstName, lastName FROM users WHERE userId = ?');
	// In this case we can use the account ID to get the account info.
	$stmt->bind_param('i', $_SESSION['id']);
	$stmt->execute();
	$stmt->bind_result($password, $email, $firstName, $lastName);
}

$stmt->fetch();
$stmt->close();
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>

	<body class="loggedin">
		<?php require 'header.php'; ?>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="#" crossorigin="anonymous">

<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>First Name:</td>
						<td><?=$firstName?></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><?=$lastName?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					
				</table>
			</div>
		</div>
	</body>
</html>