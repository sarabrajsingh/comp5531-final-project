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
					<td> <label for="name">Name: </label></td>
					<td><input type='text' name='name' id='name' value='<?= $_SESSION['name']; ?>' readonly></td>
				</tr>
				<?php if ($_SESSION['type'] === 'user') : ?>
					<tr>
						<td> <label for="dob">Date of Birth: </label></td>
						<td><input type='date' name='dob' id='dob' value='<?= $_SESSION['dob']; ?>' readonly></td>
					</tr>
				<?php endif; ?>
				<tr>
					<td> <label for="email">Email: </label></td>
					<td><input type='email' name='email' id='email' value='<?= $_SESSION['email']; ?>' readonly></td>
				</tr>
				<tr>
					<td> <label for="password">Password: </label></td>
					<td><input type='password' name='password' id='password' value='<?= $_SESSION['password']; ?>' readonly></td>
				</tr>
				<tr>
					<td>Subscription Level: </td>
					<td>
						<?php if ($_SESSION['type'] === 'user') : ?>
							<?php if ($_SESSION['subscriptionLevel'] === 'Basic') : ?>
								<label><input type="radio" name="subscriptionLevel" value="basic" checked readonly> Basic - Free</label><br>
							<?php else : ?>
								<label><input type="radio" name="subscriptionLevel" value="basic" readonly> Basic - Free</label><br>
							<?php endif; ?>
						<?php endif; ?>
						<?php if ($_SESSION['subscriptionLevel'] === 'Gold') : ?>
							<label><input type="radio" name="subscriptionLevel" value="gold" checked readonly> Gold - $10/month</label><br>
						<?php else : ?>
							<label><input type="radio" name="subscriptionLevel" value="gold" readonly> Gold - $10/month</label><br>
						<?php endif; ?>
						<?php if ($_SESSION['subscriptionLevel'] === 'Prime') : ?>
							<label><input type="radio" name="subscriptionLevel" value="prime" checked readonly> Prime - $20/month</label>
						<?php else : ?>
							<label><input type="radio" name="subscriptionLevel" value="prime" readonly> Prime - $20/month</label>
						<?php endif; ?>
					</td>
				</tr>
			</table>
			<button onclick="window.location='edit-profile.php'">Edit profile</button>
			<button onclick="window.location='delete-profile.php'">Delete profile</button>
		<?php endif; ?>
		</div>
	</div>
</body>

</html>