<?php
session_start();
// This script loads the remaining attributes of either the users or companies tables into $_SESSION
require '../database/db.php';
if ($_SESSION['type'] === 'employer' && $stmt = $con->prepare("SELECT companyName, subscriptionLevel, paymentInfos FROM companies WHERE email = ?")) {
    $stmt->bind_param('s', $_SESSION['email']);
    $stmt->execute();
    $stmt->bind_result($_SESSION['name'], $_SESSION['subscriptionLevel'], $_SESSION['paymentInfos']);
    $stmt->fetch();
    $stmt->close();
    $paymentInfos = explode('|', $_SESSION['paymentInfos']);
    $_SESSION['nameOnCard'] = $paymentInfos[0];
    $_SESSION['cardNumber'] = $paymentInfos[1];
    $_SESSION['expirationDate'] = $paymentInfos[2];
    $_SESSION['cvv'] = $paymentInfos[3];
} else if ($stmt = $con->prepare("SELECT name, dob, subscriptionLevel, paymentInfos, isActive FROM users WHERE email = ?")) {
    $stmt->bind_param('s', $_SESSION['email']);
    $stmt->execute();
    $stmt->bind_result($_SESSION['name'], $_SESSION['dob'], $_SESSION['subscriptionLevel'], $_SESSION['paymentInfos'], $_SESSION['isActive']);
    $stmt->fetch();
    $stmt->close();
    $paymentInfos = explode('|', $_SESSION['paymentInfos']);
    $_SESSION['nameOnCard'] = $paymentInfos[0];
    $_SESSION['cardNumber'] = $paymentInfos[1];
    $_SESSION['expirationDate'] = $paymentInfos[2];
    $_SESSION['cvv'] = $paymentInfos[3];
} else {
    exit('Invalid SQL query.');
}
