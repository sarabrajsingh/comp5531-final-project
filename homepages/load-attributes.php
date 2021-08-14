<?php
// This script loads the remaining attributes of the users table into $_SESSION

if ($stmt = $con->prepare("SELECT name, dob, subscriptionLevel, paymentInfos, isActive FROM users WHERE email = ?")){
    $stmt->bind_param('ssssb', $_SESSION['email']);
	$stmt->execute();
    $stmt->bind_result($_SESSION['name'], $_SESSION['dob'], $_SESSION['subscriptionLevel'], $_SESSION['paymentInfos'], $_SESSION['isActive']);
    $stmt->fetch();
    $stmt->close();
} else {
    exit('Invalid SQL query.');
}