<?php

$redirect_path = '';
if (isset($_SESSION['employerStatus'])){
    $redirect_path = '"employer-home.php"';
} else {
    $redirect_path = '"user-home.php"';
}
?>

<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

	<nav class="navtop">
		<div>
			<h1><a href=<?= $redirect_path?>>Job Findr</a></h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
</html>