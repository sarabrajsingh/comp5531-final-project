<?php
    require '../database/db.php';

    if(isset($_POST['status'])){
        $allGood = true;
        if($_POST['status'] == "Employer"){
            if(!isset($_POST["CompanyName"]))
                $allGood = false;
        }
        if($_POST['status'] == "Employee"){
            if(!isset($_POST["firstName"], $_POST["lastName"]))
                $allGood = false;
        }
        if(!isset(  $_POST["register-email"], 
                    $_POST["register-password"], 
                    $_POST["subscription"], 
                    $_POST["cardname"], 
                    $_POST["cardnumber"], 
                    $_POST["expyear"], 
                    $_POST["cvv"]))
            $allGood = false;
    }
    if(!$allGood)
        exit("problem parsing incoming form");

    $hashedPassword = password_hash($_POST["register-password"], PASSWORD_DEFAULT);
    $paymentInfo = $_POST["cardname"]."|".$_POST["cardnumber"]."|".$_POST["expyear"]."|".$_POST["cvv"];
     
    /* ---------------------------- */

    if($_POST["status"] == "Employer")
    {
        /* insert into USERS table */
        if ($stmt = $con->prepare('INSERT INTO companies (
            companyName, 
            email, 
            password,
            subscriptionLevel, 
            paymentInfos, 
            isActive,
            type,
            isPaid) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')
        ) {
            /* prepare values */
            $isActive = "1"; // isActive=1 is active, isActive=0 is disabled
            $type = "employer";
            $isPaid = "0";

            /* bind values to SQL stmt */
            $stmt->bind_param("ssssssss", 
                $_POST["CompanyName"],
                $_POST["register-email"],
                $hashedPassword,
                $_POST["subscription"],
                $paymentInfo,
                $isActive,
                $type,
                $isPaid
            );
        } else {
            print_r($stmt);
            exit("problem with INSERT INTO companies query. check attributes.");
        }
    } else {
        /* insert into USERS table */
        if ($stmt = $con->prepare('INSERT INTO users (
                name, 
                email, 
                password, 
                dob, 
                subscriptionLevel, 
                paymentInfos, 
                isActive, 
                type,
                isPaid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')
            ) {
            /* prepare values */
            $name = $_POST["firstName"].' '.$_POST["lastName"];
            $isActive = "1"; // isActive=1 is active, isActive=0 is disabled
            $type = "user";
            $isPaid = "0";

            /* bind values to SQL stmt */
            $stmt->bind_param("sssssssss", 
                $name,
                $_POST["register-email"],
                $hashedPassword,
                $_POST["dateOfBirth"],
                $_POST["subscription"],
                $paymentInfo,
                $isActive,
                $type,
                $isPaid
            );
        } else {
            print_r($stmt);
            exit("problem with INSERT INTO users query. check attributes.");
        }
    }

    $stmt->execute();
    print_r($stmt);

    if($stmt->errno != 0) {
        exit('error = ' . $stmt->error);
    } 
    else {
        $protocol = '';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            $protocol = 'https';
        } else {
            $protocol = 'http';
        }
        header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/register-user/success.html");
    }
?>