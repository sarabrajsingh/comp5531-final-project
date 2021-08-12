<?php
    require '../database/db.php';
/*
    $_POST["status"] = "Employer";
    $_POST["CompanyName"] = "Raj's Dig Bick Company";
    $_POST["register-email"] = "dig@bick.com";
    $_POST["register-password"] = "wagwanG";
    $_POST["subscription"] = "Prime";
    $_POST["cardname"] = "Sarabraj Singh";
    $_POST["cardnumber"] = "1111-2222-3333-4444";
    $_POST["expyear"] = "69/69";
    $_POST["cvv"] = "666";
*/
    if(isset($_POST['status'])){
        $allGood = true;
        if($_POST['status'] == "Employer"){
            if(!isset($_POST["CompanyName"]))
                $allGood = false;
        }
        if($_POST['status'] == "Job-Seeker"){
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
    $role = 'user';
    $category = 'basic';
    $status = $_POST["status"];

    $paymentInfo = $_POST["cardname"]."|".$_POST["cardnumber"]."|".$_POST["expyear"]."|".$_POST["cvv"];
     
    /* ---------------------------- */

    if($status == "Employer")
    {
        print_r($_POST);
        /* check values */
        // print("companyName: ".$_POST["CompanyName"]);
        // print("email: ".$_POST["register-email"]);
        // print("password: ".$hashedPassword);
        // print("subscription: ".$_POST["subscription"]);
        // print("payment: ".$paymentInfo);
        /* send values */
        $stmt = $con->prepare('INSERT INTO companies (
            companyName, 
            email, 
            password, 
            employerStatus,
            paymentInfos) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param("sssss", 
            $_POST["CompanyName"],
            $_POST["register-email"],
            $hashedPassword,
            $_POST["subscription"],
            $paymentInfo,
        );
    }
    if ($status == "Job-Seeker") {
        print_r($_POST);
        /* check values */
        // print("first name: ".$_POST["firstName"]);
        // print("last name: ".$_POST["lastName"]);
        // print("email: ".$_POST["register-email"]);
        // print("password: ".$hashedPassword);
        // print("date of birth: ".$_POST["dateOfBirth"]);
        // print("subscription: ".$_POST["subscription"]);
        // print("payment: ".$payment);
        /* send values */

        $stmt = $con->prepare('INSERT INTO users (
            firstName, 
            lastName, 
            email, 
            password, 
            dob,
            userStatus,
            PaymentInfos) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param("sssssss", 
            $_POST["firstName"],
            $_POST["lastName"],
            $_POST["register-email"],
            $hashedPassword,
            $_POST["dateOfBirth"],
            $_POST["subscription"],
            $paymentInfo,
        );
        $stmt->execute();
        print_r($stmt);
    }

    if($stmt->errno != 0) {
        exit('error = ' . $stmt->error);
    } else {
        // header('Location: success.html'); 
        echo 'Success';
    }
?>