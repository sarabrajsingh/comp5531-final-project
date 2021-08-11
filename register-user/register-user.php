<?php
    require '../database/db.php';

    // $_POST['firstName'] = 'sarabraj';
    // $_POST['lastName'] = 'singh';
    // $_POST['password'] = 'admin';
    // $_POST['email'] = 'singh.sarabraj@gmail.com';
    // $role = "employer";
    // $category = "prime";

    if(!isset($_POST['firstName'], $_POST['lastName'], $_POST["register-password"], $_POST['register-email'])) {
        exit('problem parsing form');
    }

    /*
        Array
        ( 
            [firstName] => TestUserFirstName 
            [lastName] => TestUserLastName 
            [dateOfBirth] => 1980-07-22 
            [CompanyName] => testCard 
            [register-email] => testuser@gmail.com 
            [register-password] => testtesttest 
            [confirm-password] => testtesttest 
            [cardnumber] => 1111-2222-3333-4444 
            [expyear] => 01/21 
            [cvv] => 352
            [subscription] => Basic
        ) 
    */

    $hashedPassword = password_hash($_POST["register-password"], PASSWORD_DEFAULT);
    $role = 'user';
    $category = 'basic';
    $status = $_POST["status"];


    print_r($_POST);

/*
    $dateOfBirth = $_POST["dateOfBirth"];
    print("Date of birth: ".$dateOfBirth);
    $cardName = $_POST["cname"];
    print("cname: ".$cname);
    $cardNumber = $_POST["cardnumber"]; 
    print("cardNumber: ".$cardNumber);
    $cardExpiracy = $_POST["expyear"];
    print("cardExpiracy: ".$cardExpiracy);
    $cvv = $_POST["cvv"];
    print("CVV: ".$cvv);
*/
 //   $payment = $cardName."|".$cardNumber."|".$cardExpiracy."|".$cvv;

    print("Payment: "+$payment);
    print("Status: "+$status); 

$stmt = $con->prepare('INSERT INTO users (
    firstName, 
    lastName, 
    email, 
    password, 
    dob,
    userStatus,
    PaymentInfos) VALUES (?, ?, ?, ?, ?, ?, ?)');
    print("\nTEST2\n");
$stmt->bind_param("sssssss", 
    $_POST["firstName"],
    $_POST["lastName"],
    $_POST["register-email"],
    $hashedPassword,
    $_POST["dateOfBirth"],
    $_POST["subscription"],
    $_POST["dateOfBirth"],
);

$stmt->execute();
    if($stmt->affected_rows === 0) {
        exit('No rows updated');
    } else {
        header('Location: success.html'); 
    }
?>