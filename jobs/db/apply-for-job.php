<?php
session_start();
require '../../database/db.php';

$error = [];
$data = array();

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['jobID'])) {
	// Could not get the data that should have been sent.
	exit('arugments error');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT * FROM jobs WHERE jobID = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

	$stmt->bind_param("s", $_POST["jobID"]);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
    $stmt->bind_result(
        $jobID,
        $jobName,
        $companyName,
        $datePosted,
        $jobStatus,
        $description,
        $lowerSalaryLimit,
        $upperSalaryLimit,
        $jobCategory,
        $numVacancies
    );
    $stmt->fetch();

	if ($stmt->num_rows > 0) {
        $data["success"] = true;
        $data["response"]["jobID"] =         $jobID;
        $data["response"]["jobName"] =         $jobName;
        $data["response"]["companyName"] =         $companyName;
        $data["response"]["datePosted"] =         $datePosted;
        $data["response"]["jobStatus"] =         $jobStatus;
        $data["response"]["description"] =         $description;
        $data["response"]["lowerSalaryLimit"] =         $lowerSalaryLimit;
        $data["response"]["upperSalaryLimit"] =         $upperSalaryLimit;
        $data["response"]["jobCategory"] =         $jobCategory;
        $data["response"]["numVacancie"] =         $numVacancies;
    } else {
        $data["success"] = false;
        $error["sqlError"] = "query returned nothing";
    }
} else {
    $data["success"] = false;
    $error["sqlError"] = "query error";
}
$stmt->close();
$data["errors"] = $error;
echo json_encode($data);
?>