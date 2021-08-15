<?php

session_start();

require '../database/db.php';

$allGood = true;

if (!isset($_POST["name"], $_POST['password'], $_POST["subscriptionLevel"], $_POST["nameOnCard"], $_POST["cardNumber"], $_POST["expirationDate"], $_POST["cvv"])) {
    $allGood = false;
}
if ($_SESSION['type'] === 'user' && !isset($_POST['dob'])) {
    $allGood = false;
}
if (!$allGood) {
    exit("Problem parsing incoming form.");
}
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
$paymentInfos = $_POST["nameOnCard"] . "|" . $_POST["cardNumber"] . "|" . $_POST["expirationDate"] . "|" . $_POST["cvv"];

/* ---------------------------- */

if ($_SESSION["type"] === "employer" && ($_SESSION['name'] != $_POST['name'] || $_SESSION['password'] != $_POST['password'] || $_SESSION['subscriptionLevel'] != $_POST['subscriptionLevel'] || $_SESSION['paymentInfos'] != $paymentInfos)) {
    /* check db entry from COMPANIES table */
    if ($stmt = $con->prepare('UPDATE companies SET companyName = ?, password = ?, subscriptionLevel = ?, paymentInfos = ? WHERE email = ?')) {

        /* bind values to SQL stmt */
        $stmt->bind_param('sssss', $_POST['name'], $hashedPassword, $_POST['subscriptionLevel'], $paymentInfos, $_SESSION['email']);
        $stmt->execute();
        print_r($stmt);
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['subscriptionLevel'] = $_POST['subscriptionLevel'];
        $_SESSION['paymentInfos'] = $paymentInfos;
        $paymentInfos = explode('|', $_SESSION['paymentInfos']);
        $_SESSION['nameOnCard'] = $paymentInfos[0];
        $_SESSION['cardNumber'] = $paymentInfos[1];
        $_SESSION['expirationDate'] = $paymentInfos[2];
        $_SESSION['cvv'] = $paymentInfos[3];
    } else {
        print_r($stmt);
        exit("problem with UPDATE companies query. check attributes.");
    }
} else if ($_SESSION["type"] === "user" && ($_SESSION['name'] != $_POST['name'] || $_SESSION['password'] != $_POST['password'] || $_SESSION['dob'] != $_POST['dob'] || $_SESSION['subscriptionLevel'] != $_POST['subscriptionLevel'] || $_SESSION['paymentInfos'] != $paymentInfos)) {
    /* check db entry from USERS table */
    if ($stmt = $con->prepare('UPDATE users SET name = ?, password = ?, dob = ?, subscriptionLevel = ?, paymentInfos = ? WHERE email = ?')) {

        /* bind values to SQL stmt */
        $stmt->bind_param('ssssss', $_POST['name'], $hashedPassword, $_POST['dob'], $_POST['subscriptionLevel'], $paymentInfos, $_SESSION['email']);
        $stmt->execute();
        print_r($stmt);
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['dob'] = $_POST['dob'];
        $_SESSION['subscriptionLevel'] = $_POST['subscriptionLevel'];
        $_SESSION['paymentInfos'] = $paymentInfos;
        $paymentInfos = explode('|', $_SESSION['paymentInfos']);
        $_SESSION['nameOnCard'] = $paymentInfos[0];
        $_SESSION['cardNumber'] = $paymentInfos[1];
        $_SESSION['expirationDate'] = $paymentInfos[2];
        $_SESSION['cvv'] = $paymentInfos[3];
    } else {
        print_r($stmt);
        exit("problem with UPDATE users query. check attributes.");
    }
}

if ($stmt->errno != 0) {
    exit('error = ' . $stmt->error);
} else {
    header("Location: ../profile/update-success.html");
}
