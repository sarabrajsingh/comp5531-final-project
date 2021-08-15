<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
require '../database/db.php';
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body class="loggedin">
	<?php require '../header.php'; ?>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="#" crossorigin="anonymous">

	<div class="content">
		<h2>Your Profile</h2>
		<div>
			<p>Your account details are below:</p>
			<table>
				<tr>
					<td> Name:</td>
					<td><?= $_SESSION['name']; ?></td>
				</tr>
				<?php if ($_SESSION['type'] === 'user') : ?>
					<tr>
						<td> Date of birth:</td>
						<td><?= $_SESSION['dob']; ?></td>
					</tr>
				<?php endif; ?>
				<tr>
					<td>Email:</td>
					<td><?= $_SESSION['email']; ?></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><?= $_SESSION['password']; ?></td>
				</tr>
				<?php if ($_SESSION['type'] != 'admin') : ?>
					<tr>
						<td> Subscription Level:</td>
						<td><?= $_SESSION['subscriptionLevel']; ?></td>
					</tr>
			</table>
			<button onclick="window.location='edit-profile.php'">Edit profile</button>
			<button onclick="window.location='delete-profile.php'">Delete profile</button>
		<?php endif; ?>
		</div>
	</div>
</body>

</html>