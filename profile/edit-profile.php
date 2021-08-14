<?php
session_start();
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
	<?php require '../header.php'; ?>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="#" crossorigin="anonymous">

	<div class="content">
		<h2>Profile Page</h2>
		<div>
			<form id="profile-form" action="../profile/update-profile" method="post" role="form" style="display: none;">
				<?php if ($_SESSION['type'] === 'job-seeker') : ?>
					<div class="form-user">
						<input type="text" name="firstName" id="firstName" tabindex="1" class="form-control" placeholder="First Name" value="" required>
					</div>
					<div class="form-user">
						<input type="text" name="lastName" id="lastName" tabindex="1" class="form-control" placeholder="Last Name" value="" required>
					</div>
					<div class="form-user">
						<label for="dob">Date of Birth </label> <input type="date" name="dateOfBirth" id="dateOfBirth" tabindex="1" style="width: 150px;margin-left: 20px;" lass="form-control" value="2018-07-22" required>
					</div>
				<?php else : ?>
					<div class="form-company" style="margin-bottom: 20px;">
						<input type="text" name="CompanyName" id="CompanyName" tabindex="1" class="form-control" placeholder="Company name" value="" required>
					</div>
				<?php endif; ?>
				<div class="form-group">
					<input type="email" name="register-email" id="register-email" tabindex="1" class="form-control" placeholder="Email Address" value="" readonly>
				</div>
				<span id='register-email-already-exists'></span>
				<div class="form-group">
					<input type="password" pattern=".{5,}" required title="5 characters minimum" name="register-password" id="register-password" tabindex="2" class="form-control" placeholder="Password" required>
				</div>
				<div class="form-group">
					<input type="password" name="confirm-password" id="confirm_password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
					<span id='password-matching-message'></span>
				</div>

				<div class="paymentInfos">
					<h4>Payment</h4>
					<div>
						<label for="cardname">Name on Card</label>
						<input type="text" name="cardname" id="cardname" tabindex="1" class="form-control" placeholder="John More Doe" value="" required>
					</div>
					<div>
						<label for="cardnumber" style="margin-top: 5px;">Credit card number</label>
						<input type="text" name="cardnumber" id="cardnumber" tabindex="1" class="form-control" placeholder="1111-2222-3333-4444" value="" required>
					</div>
					<div class="expiracyBox">
						<label for="expyear">Exp Date</label>
						<input type="text" id="expyear" name="expyear" placeholder="01/22" maxlength="5" tabindex="1" required>
						<label for="cvv">CVV</label>
						<input type="text" id="cvv" name="cvv" placeholder="352" maxlength="3" tabindex="1" required>
					</div>
				</div>
				<?php if ($_SESSION['type'] === 'job-seeker') : ?>
					<div class="form-user">
						<label>Subcription choice</label>
						<br>
						<input type="radio" id="SubscriptionGold" name="subscription" value="Basic" tabindex="2" checked>
						<label for="SubscriptionChoice1">Basic - Free</label>
						<br>
						<input type="radio" id="SubscriptionGold" name="subscription" value="Prime" tabindex="2">
						<label for="SubscriptionChoice1">Gold - 10$/month</label>
						<br>
						<input type="radio" id="SubscriptionPrime" name="subscription" value="Gold" tabindex="2">
						<label for="SubscriptionChoice2">Prime - 20$/month</label>
					</div>
				<?php else : ?>
					<div class="form-company">
						<label>Subcription choice</label>
						<br>
						<input type="radio" id="SubscriptionGold" name="subscription" value="Prime" tabindex="2" checked>
						<label for="SubscriptionChoice1">Gold - 50$/month</label>
						<br>
						<input type="radio" id="SubscriptionPrime" name="subscription" value="Gold" tabindex="2">
						<label for="SubscriptionChoice2">Prime - 100$/month</label>
					</div>
				<?php endif; ?>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<input type="submit" name="edit-submit" id="edit-submit" tabindex="4" class="form-control btn btn-edit" value="Save">
						</div>
					</div>
				</div>
			</form>
		</div>
</body>

</html>