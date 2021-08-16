<?php
session_start();
require '../../database/db.php';

$error = [];
$data = array();

if($_SESSION["type"] === "user") {
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

    $stmt->close();

    if($stmt = $con->prepare('UPDATE users SET isPaid = ? WHERE userId = ?;')) {
        $isPaid = "1";
        $stmt->bind_param("ss", $isPaid, $userId);
        $stmt->execute();
        $data["success"] = true;
    } else{
        $data["success"] = false;
        $error["sqlError"] = "error with second UPDATE statement";
    }
} elseif ($_SESSION["type"] === "employer") {
    if($stmt = $con->prepare('SELECT companyName FROM companies WHERE email = ?')){
        $stmt->bind_param("s", $_SESSION["login-email"]);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($companyName);
        $stmt->fetch();
    } else {
        $errors['sqlError'] = "error with SQL query (SELECT userId FROM users WHERE email = ?)";
    }

    $stmt->close();

    if($stmt = $con->prepare('UPDATE companies SET isPaid = ? WHERE companyName = ?;')) {
        $isPaid = "1";
        $stmt->bind_param("ss", $isPaid, $companyName);
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