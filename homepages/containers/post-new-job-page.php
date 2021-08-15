<?php require '../header.php'; ?>

<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
?>
<div class="row">
    <div class="col-md-3 border-right">
        <h4>Post a New Job</h4>
    </div>x
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <form id="saveJobForm" action="post-job.php" method="post" role="form" style="display: block;">
            <div class="form-group row">
                <label for="jobName" class="col-12 col-form-label">Job Title</label>
                <div class="col-12">
                    <input id="jobName" name="jobName" placeholder="Enter Job Title here" class="form-control here"
                        type="text">
                </div>
            </div>
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
            <input id="addCustomJob" name="addCustomJob" placeholder="Optional - Enter Job Title to Add"
                class="form-control here" type="text">
            <button type="button" id="addNewJobType">New Job Type</button>
            <span id="addNewJobTypeSpanMessage"></span>
            <div class="form-group row">
                <label for="companyName" class="col-12 col-form-label">Company Name</label>
                <select name="companyName" class="textfields" id="companyName">
                    <?php
                      require '../../database/db.php';
                      if ($stmt = $con->prepare("SELECT companyName FROM companies WHERE email = ?")) {
                        $stmt->bind_param("s", $_SESSION["login-email"]);
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($companyName);
                        $stmt->fetch();
                      }
                      echo '<option>'.$companyName.'</option>';
                ?>
                </select>
            </div>
            <div class="form-group row">
                <label for="text" class="col-12 col-form-label">Salary</label>
                <div class="col-12">
                    <input id="lowerSalaryAmount" name="lowerSalaryAmount" placeholder="Lower Salary Amount"
                        class="form-control here" type="number">
                    <input id="upperSalaryAmount" name="upperSalaryAmount" placeholder="Upper Salary Amount"
                        class="form-control here" type="number">
                </div>
            </div>
            <div class="form-group row">
                <label for="textarea" class="col-12 col-form-label">Description</label>
                <div class="col-12">
                    <textarea id="description" name="description" cols="40" rows="10" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-7">
                <span id="saveButtonMessage"></span>
                <button type="button" id="saveButton" class="btn btn-sm btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>