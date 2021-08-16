<?php
session_start();
require '../../database/db.php';

$error = [];
$data = array();

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_SESSION["login-email"], $_POST["jobID"], $_POST["companyName"])) {
	// Could not get the data that should have been sent.
	exit('arugments error');
}

// get userId
if($stmt = $con->prepare('SELECT userId FROM users WHERE email = ?')){
    $stmt->bind_param("s", $_SESSION["login-email"]);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userId);
    $stmt->fetch();
} else {
    $errors['sqlError'] = "error with SQL query (SELECT userId FROM users WHERE email = ?)";
}

// take userId and INSERT tuple into applications table
if($stmt = $con->prepare('INSERT INTO applications (applicationDate, userId, jobID, companyName) VALUES (?, ?, ?, ?);')){
    $applicationDate = new DateTime("NOW");
    $applicationDateForDB = $applicationDate->format('Y/m/d H:i:s');
    $stmt->bind_param("ssss", $applicationDateForDB, $userId, $_POST["jobID"], $_POST["companyName"]);
    $stmt->execute();
    $data["success"] = true;
} else {
    $error["sqlError"] = "problem with SQL query";
    $data["success"] = false;
}

// decrement the vacancies value in the jobs table
if($data["success"] === true){
    if($stmt = $con->prepare('SELECT numVacancies FROM jobs WHERE jobID = ?;')) {
        $stmt->bind_param("s", $_POST["jobID"]);
        $stmt->execute();
        $stmt->bind_result($numVacancies);
        $numVacancies = intval($numVacancies);
        $stmt->fetch();
    } else {
        $data["success"] = false;
        $error["sqlError"] = "error with SELECT statement";
    }

    $stmt->close();

    if($stmt = $con->prepare('UPDATE jobs SET numVacancies = ? WHERE jobID = ?;')) {
        $newNumVacancies = $numVacancies - 1;
        $stmt->bind_param("ss", $newNumVacancies, $_POST["jobID"]);
        $stmt->execute();
        $data["success"] = true;
    } else{
        $data["success"] = false;
        $error["sqlError"] = "error with second UPDATE statement";
    }
}

$con->close();
$data["error"] = $error;
echo json_encode($data);
?>