<?php

session_start();

require '../database/db.php';

/* ---------------------------- */

if ($_SESSION["type"] === "employer") {
    /* check db entry from COMPANIES table */
    if ($stmt = $con->prepare('DELETE FROM companies WHERE email = ?')) {
        $stmt->bind_param('s', $_SESSION['email']);
        $stmt->execute();
    } else {
        print_r($stmt);
        exit("problem with DELETE companies query. check attributes.");
    }
} else {
    /* check db entry from USERS table */
    if ($stmt = $con->prepare('DELETE FROM users WHERE email = ?')) {

        /* bind values to SQL stmt */
        $stmt->bind_param('s', $_SESSION['email']);
        $stmt->execute();
    } else {
        print_r($stmt);
        exit("problem with DELETE users query. check attributes.");
    }
}

if ($stmt->errno != 0) {
    exit('error = ' . $stmt->error);
} else {
    header("Location: ../profile/deletion-success.html");
}