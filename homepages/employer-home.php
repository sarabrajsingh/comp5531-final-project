<?php
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
		<title>Home Page</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body class="loggedin">
		<nav class="navtop">x
			<div>
				<h1><a href="employer-home.php">Job Findr</a></h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="#" crossorigin="anonymous">

<div class="container-fluid">
	<div class="row">
		<div class="col-md-3 ">
		     <div class="list-group ">
              <a href="#" class="list-group-item list-group-item-action active">Post a New Job</a>
              <a href="#" class="list-group-item list-group-item-action">User Management</a>              
			  <a href="#" class="list-group-item list-group-item-action">Contact Us</a>   
            </div> 
		</div>
		<div class="col-md-9">
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-3 border-right">
		                    <h4>Add New Post</h4>
		                </div>
		                <div class="col-md-7">
		                    <button type="button" class="btn btn-sm btn-primary">Add New</button>
		                </div>
		                
		            </div>
		            <hr>
		            <div class="row">
		                <div class="col-md-8">
        		            <form>
                              <div class="form-group row">
                                <label for="text" class="col-12 col-form-label">Enter Title here</label> 
                                <div class="col-12">
                                  <input id="text" name="text" placeholder="Enter Title here" class="form-control here" required="required" type="text">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="textarea" class="col-12 col-form-label">Description</label> 
                                <div class="col-12">
                                  <textarea id="textarea" name="textarea" cols="40" rows="5" class="form-control"></textarea>
                                </div>
                              </div> 
                            </form>
        		        </div>
        		        <div class="col-md-4 ">
        		            <div class="card mb-3" style="max-width: 18rem;">
                                  <div class="card-header bg-light ">Publish</div>
                                  <div class="card-body">
                                   
                                  </div>
                                  <div class="card-footer bg-light">
                                      <button type="button" class="btn btn-outline-secondary btn-sm">Preview</button>
                                      <button type="button" class="btn btn-info btn-sm">Save Draft</button>
                                      <button type="button" class="btn btn-primary btn-sm">Publish</button>
                                  </div>
                                </div>
                            <div class="card mb-3" style="max-width: 18rem;">
                                  <div class="card-header bg-light ">Tags</div>
                                  <div class="card-body">
                                    <form>
                                      <div class="form-group row">
                                        <div class="col-9">
                                          <input id="tags" name="tags" placeholder="seperate with commas" required="required" class="form-control here" type="text">
                                        </div>
                                        <div class=" col-2">
                                          <button name="submit" type="submit" class="btn btn-light">Add</button>
                                        </div>
                                        <div class="col-12">
                                            <small>Separate Tags with commas</small>
                                        </div>
                                      </div> 
                                    </form>
                                    

                                  </div>
                                  <div class="card-footer bg-light">
                                      <a href="#">Choose from the most used tags</a>
                                  </div>
                                </div>
                            <div class="card mb-3" style="max-width: 18rem;">
                                  <div class="card-header bg-light ">Categories</div>
                                  <div class="card-body">
                                    <form>
                                      <div class="form-group row">
                                        <div class="col-9">
                                          <input id="tags" name="tags" placeholder=" " required="required" class="form-control here" type="text">
                                        </div>
                                        <div class=" col-2">
                                          <button name="submit" type="submit" class="btn btn-light">Add</button>
                                        </div>
                                        
                                      </div> 
                                    </form>
                                    <form>
                                      <div class="form-group row">
                                        <label for="select" class="col-12 col-form-label">Select Category</label> 
                                        <div class="col-8">
                                          <select id="select" name="select" class="custom-select" required="required">
                                            <option value="rabbit">Rabbit</option>
                                            <option value="duck">Duck</option>
                                            <option value="fish">Fish</option>
                                          </select>
                                        </div>
                                      </div> 
                                    </form>
                                  </div>
                                  <div class="card-footer bg-light">
                                      <button type="button" class="btn btn-primary btn-sm">Add New Category</button>
                                  </div>
                                </div>
                            <div class="card mb-3" style="max-width: 18rem;">
                                  <div class="card-header bg-light ">Featured Image</div>
                                  <div class="card-body">
                                    

                                  </div>
                                  <div class="card-footer bg-light">
                                      <a href="#">Set Featured Image</a>
                                  </div>
                                </div>    
        		        </div>
        		        
        		    </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
	</body>
</html>