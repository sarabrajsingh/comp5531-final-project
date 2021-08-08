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

    $hashedPassword = password_hash($_POST["register-password"], PASSWORD_DEFAULT);
    $role = 'user';
    $category = 'basic';

    $stmt = $con->prepare('INSERT INTO users (
        firstName, 
        lastName, 
        password, 
        email, 
        role, 
        category) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->bind_param("ssssss", 
        $_POST["firstName"],
        $_POST["lastName"],
        $hashedPassword,
        $_POST["register-email"],
        $role,
        $category
    );
    $stmt->execute();

    if($stmt->affected_rows === 0) {
        exit('No rows updated');
    } else {
        header('Location: success.html'); 
    }
?>