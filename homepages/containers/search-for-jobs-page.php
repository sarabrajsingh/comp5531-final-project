<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
?>
<script src="js/script.js"></script>
<!-- search by keyword -->
<div class="row">
    <div class="col-md-3 border-right">
        <h4>Search for a Job</h4>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <div class="form-group row">
            <label for="jobName" class="col-12 col-form-label">Job Title</label>
            <div class="col-12">
                <input id="jobName" name="jobName" placeholder="Enter Job Title here" class="form-control here"
                    type="text">
            </div>
        </div>
        <div class="col-md-7">
            <div id="searchResults1"></div>  
            <button type="button" id="searchButton1" class="btn btn-sm btn-primary">Search</button>
            <button type="button" id="resetButton1" class="btn btn-sm btn-primary">Reset</button>
        </div>
    </div>
</div>
<!-- search by category -->
<div class="row">
    <div class="col-md-3 border-right">
        <h4>Search for Jobs by Category</h4>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
    <label for="jobCategory">Job Type: </label>
            <select name="jobCategory" class="textfields" id="jobCategory">
                <option id="0">-- Select an Occupation --</option>
                <?php
                      require '../../database/db.php';
                      $result = mysqli_query($con, "SELECT * FROM jobTypes"); 
                      while ($row = $result->fetch_assoc()){
                         echo '<option>'. $row["JobType"].'</option>';
                    }
                ?>
            </select>
        <div class="col-md-7">
            <div id="searchResults2"></div>  
            <button type="button" id="searchButton2" class="btn btn-sm btn-primary">Search</button>
            <button type="button" id="resetButton2" class="btn btn-sm btn-primary">Reset</button>
        </div>
    </div>
</div>