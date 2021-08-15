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

	<div>
		<h2>Edit Your Profile</h2>
		<form id="edit-profile-form" action="../profile/update-profile.php" method="post" role='form'>
			<div>
				<table>
					<tr>
						<td> <label for="name">Name: </label></td>
						<td><input type='text' name='name' id='name' value='<?= $_SESSION['name']; ?>'></td>
					</tr>
					<?php if ($_SESSION['type'] === 'user') : ?>
						<tr>
							<td> <label for="dob">Date of Birth: </label></td>
							<td><input type='date' name='dob' id='dob' value='<?= $_SESSION['dob']; ?>'></td>
						</tr>
					<?php endif; ?>
					<tr>
						<td>Email: </td>
						<td><?= $_SESSION['email']; ?></td>
					</tr>
					<tr>
						<td> <label for="password">Password: </label></td>
						<td><input type='password' name='password' id='password' value='<?= $_SESSION['password']; ?>'></td>
					</tr>
					<tr>
						<td>Subscription Level: </td>
						<td>
							<?php if ($_SESSION['type'] === 'user') : ?>
								<?php if ($_SESSION['subscriptionLevel'] === 'Basic') : ?>
									<label><input type="radio" name="subscriptionLevel" value="Basic" checked> Basic - Free</label><br>
								<?php else : ?>
									<label><input type="radio" name="subscriptionLevel" value="Basic"> Basic - Free</label><br>
								<?php endif; ?>
							<?php endif; ?>
							<?php if ($_SESSION['subscriptionLevel'] === 'Gold') : ?>
								<label><input type="radio" name="subscriptionLevel" value="Gold" checked> Gold - $10/month</label><br>
							<?php else : ?>
								<label><input type="radio" name="subscriptionLevel" value="Gold"> Gold - $10/month</label><br>
							<?php endif; ?>
							<?php if ($_SESSION['subscriptionLevel'] === 'Prime') : ?>
								<label><input type="radio" name="subscriptionLevel" value="Prime" checked> Prime - $20/month</label>
							<?php else : ?>
								<label><input type="radio" name="subscriptionLevel" value="Prime"> Prime - $20/month</label>
							<?php endif; ?>
						</td>
					</tr>
				</table>
			</div>
			<div>
				<p>Your payment information follows: </p>
				<table>
					<tr>
						<td><label for='nameOnCard'>Name on Card: </td>
						<td><input type='text' name='nameOnCard' id='nameOnCard' value='<?= $_SESSION['nameOnCard']; ?>'></td>
					</tr>
					<tr>
						<td> <label for="cardNumber">Credit Card Number: </label></td>
						<td><input type='text' name='cardNumber' id='cardNumber' value='<?= $_SESSION['cardNumber']; ?>'></td>
					</tr>
					<tr>
						<td><label for='expirationDate'>Expiration Date: </label></td>
						<td><input type='text' name='expirationDate' id='expirationDate' value='<?= $_SESSION['expirationDate']; ?>'></td>
					</tr>
					<tr>
						<td><label for='cvv'>CVV :</label></td>
						<td><input type='text' name='cvv' id='cvv' value='<?= $_SESSION['cvv']; ?>'></td>
					</tr>
				</table>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<input type="submit" name="edit-profile-submit" id="edit-profile-submit" tabindex="4" class="form-control btn btn-register" value="Save">
		</form>
		<button onclick="window.location='profile.php'">Cancel</button>
	</div>
</body>

</html>