<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
require 'load-attributes.php';
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Admin Console</title>
  <link href="../css/style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/script.js"></script>
</head>

<body class="loggedin">
  <?php require '../header.php'; ?>
  </nav>

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
    integrity="#" crossorigin="anonymous">

  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 ">
        <div class="list-group ">
          <a href="#" class="list-group-item list-group-item-action active">Post a New Job</a>
          <a href="#" class="list-group-item list-group-item-action">Search Jobs</a>
          <a href="#" class="list-group-item list-group-item-action">Recent Jobs</a>
          <a href="#" class="list-group-item list-group-item-action">User Management</a>
          <a href="#" class="list-group-item list-group-item-action">Contact Us</a>
        </div>
      </div>
      <div class="col-md-9">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-3 border-right">
                <h4>Post a New Job</h4>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-8">
                <form id="saveJobForm" action="post-job.php" method="post" role="form" style="display: block;">
                  <div class="form-group row">
                    <label for="text" class="col-12 col-form-label">Job Title</label>
                    <div class="col-12">
                      <input id="text" name="text" placeholder="Enter Title here" class="form-control here"
                        required="required" type="text">
                    </div>
                  </div>
                  <label for="selectJobType">Job Type: </label>
                  <select name="selectJobType" class="textfields" id="choosenJobType">
                    <option id="0">-- Select an Occupation -- </option>
                    <?php
                          require '../database/db.php';
                          $result = mysqli_query($con, "SELECT * FROM jobTypes"); 
                          while ($row = $result->fetch_assoc()){
                             echo '<option>'. $row["JobType"].'</option>';
						  }
					?>
                  </select>
                  <div class="form-group row">
                    <label for="text" class="col-12 col-form-label">Company Name</label>
                    <div class="col-12">
                      <input id="text" name="text" placeholder="Company Name" class="form-control here"
                        required="required" type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="text" class="col-12 col-form-label">Salary</label>
                    <div class="col-12">
                      <input id="text" name="text" placeholder="Lower Salary Amount" class="form-control here"
                        required="required" type="text">
                      <input id="text" name="text" placeholder="Upper Salary Amount" class="form-control here"
                        type="text">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="textarea" class="col-12 col-form-label">Description</label>
                    <div class="col-12">
                      <textarea id="textarea" name="textarea" cols="40" rows="10" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <button type="button" id="saveButton" class="btn btn-sm btn-primary">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>