<?php
session_start();
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

<body class='loggedin'>

	<?php require '../header.php'; ?>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="#" crossorigin="anonymous">

	<div class="content">
		<h2>Edit Your Profile</h2>
		<fieldset>
			<table>
				<tr>
					<td> <label for="name">Name :</label>:</td>
					<td><input type='text' name='name' id='name' value=<?= $_SESSION['name']; ?>></td>
				</tr>
				<?php if ($_SESSION['type'] === 'user') : ?>
					<tr>
						<td> <label for="dob">Name :</label>:</td>
						<td><input type='date' name='dob' id='dob' value=<?= $_SESSION['dob']; ?>></td>
					</tr>
				<?php endif; ?>
				<tr>
					<td> <label for="dob">Email :</label>:</td>
					<td><input type='email' name='email' id='email' value=<?= $_SESSION['email']; ?> readonly></td>
				</tr>
				<tr>
					<td> <label for="password">Password: :</label>:</td>
					<td><input type='password' name='password' id='password' value=<?= $_SESSION['password']; ?>></td>
				</tr>
				<tr>
					<td> <label for="subscriptionLevel">Subscription Level :</label>:</td>
					<td><select name='dob' id='dob'>
							<?php if ($_SESSION['type'] === 'user') : ?>
								<option value='basic'>Basic - Free</option>
							<?php endif; ?>
							<option value='gold'>Gold - $10/month</option>
							<option value='prime'>Prime - $20/month</option>
						</select> </td>
				</tr>
			</table>
		</fieldset>
	</div>

</body>

</html>