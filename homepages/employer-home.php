<?php
require 'load-attributes.php';
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Employer Home Page</title>
		<link href="../css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
	</head>
<body class="loggedin">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
    integrity="#" crossorigin="anonymous">
  <?php require "header.php" ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 ">
        <div class="list-group">
          <a href="#" id="postNewJobTab" class="list-group-item list-group-item-action">Post a New Job</a>
          <a href="#" id="searchJobTab" class="list-group-item list-group-item-action">Search Jobs</a>
          <a href="#" id="recentJobsTab" class="list-group-item list-group-item-action">Recent Jobs</a>
          <a href="#" id="createJobOfferTab" class="list-group-item list-group-item-action">Create a Job Offer</a>
          <a href="#" id="userManagementTab" class="list-group-item list-group-item-action">User Management</a>
          <a href="#" id="contactUsTab" class="list-group-item list-group-item-action">Contact Us</a>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>