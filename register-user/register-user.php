<?php
    require '../database/db.php';

    if(!isset($_POST['firstName'], $_POST['lastName'], $_POST["register-password"], $_POST['register-email'])) {
        exit('problem parsing form');
    }

    //print_r($_POST);
    print_r($_POST);

    $hashedPassword = password_hash($_POST["register-password"], PASSWORD_DEFAULT);
    $role = 'user';
    $category = 'basic';
    $status = $_POST["status"];

    $payment = $_POST["cardname"]."|".$_POST["cardnumber"]."|".$_POST["expyear"]."|".$_POST["cvv"];
     
    /* ---------------------------- */

    if($status == "Employer")
    {
        /* check values */
        print("companyName: ".$_POST["CompanyName"]);
        print("email: ".$_POST["register-email"]);
        print("password: ".$hashedPassword);
        print("subscription: ".$_POST["subscription"]);
        print("payment: ".$payment);
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
            $payment,
        );
    }else{
        /* check values */
        print("first name: ".$_POST["firstName"]);
        print("last name: ".$_POST["lastName"]);
        print("email: ".$_POST["register-email"]);
        print("password: ".$hashedPassword);
        print("date of birth: ".$_POST["dateOfBirth"]);
        print("subscription: ".$_POST["subscription"]);
        print("payment: ".$payment);
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
            $payment,
        );
    }

$stmt->execute();
    if($stmt->affected_rows === 0) {
        exit('No rows updated');
    } else {
        header('Location: success.html'); 
    }
?>