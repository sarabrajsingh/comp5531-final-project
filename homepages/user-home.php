<?php
session_start();
// If the user is not logged in redirect to the login page...

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit("Not logged in.");
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
	<body class="loggedin">
			<?php require 'header.php'; ?>
			<!-- <h1><a href="user-home.php">Job Findr</a></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a> -->

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="#" crossorigin="anonymous">

<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 ">
		     <div class="list-group ">
              <a href="#" class="list-group-item list-group-item-action">User Management</a>              
			  <a href="#" class="list-group-item list-group-item-action">Contact Us</a>   
            </div> 
		</div>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
					<div class="content">
						<h2>Home Page</h2>
						<p>Welcome back, <?=$_SESSION['name']?>!</p>
					</div>
		        </div>
		    </div>
		</div>
	</div>
</div>
	</body>
</html>