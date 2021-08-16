<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
?>
<script src="js/script.js"></script>
<div class="row">
    <div class="col-md-3 border-right">
        <h4>Create a Job Offer</h4>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <div class="form-group row">
            <label for="companyName" class="col-12 col-form-label">Company Name</label>
            <select name="companyName" class="textfields" id="companyName">
                <?php
                    echo '<option>'.$_SESSION["name"].'</option>';
                ?>
            </select>
            <label for="selectedJobFromCompany" class="col-12 col-form-label">Select Job From Company</label>
            <select name="selectedJobFromCompany" class="textfields" id="selectedJobFromCompany">
                <?php
                    require '../../database/db.php';
                    if ($stmt = $con->prepare("SELECT jobName, datePosted FROM jobs WHERE companyName = ?")) {
                        $stmt->bind_param("s", $_SESSION["name"]);
                        $stmt->execute();
                        $result = $stmt->get_result();
                    }
                    while ($row = $result->fetch_assoc()){
                        if($row["jobName"] != "") {
                            echo '<option>'.$row["jobName"].'</option>';
                        }
                    }
                ?>
            </select>
            <label for="jobOfferForUser" class="col-12 col-form-label">User</label>
            <select name="jobOfferForUser" class="textfields" id="jobOfferForUser">
            <?php
                require '../../database/db.php';
                $result = mysqli_query($con, "SELECT DISTINCT name FROM users"); 
                while ($row = $result->fetch_assoc()){
                    if($row["name"] != "") {
                        echo '<option>'. $row["name"].'</option>';
                    }
                }
            ?>
            </select>
        </div>
        <div class="col-md-7">
            <span id="createJobOfferSpanMessage"></span>
            <button type="button" id="createJobOfferButton" class="btn btn-sm btn-primary">Create Job Offer</button>
        </div>
    </div>
</div>