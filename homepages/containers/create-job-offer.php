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
    </div>
</div>