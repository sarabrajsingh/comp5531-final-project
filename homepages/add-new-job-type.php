<?php
    require "../database/db.php";

    $errors = [];
    $data = array();

    if(!isset($_POST["addCustomJob"])) {
        exit("error parsing arguments");
    }

    if ($stmt = $con->prepare('INSERT INTO jobTypes (
            JobType) VALUES (?)')) {
                $stmt->bind_param('s', $_POST["addCustomJob"]);
    } else {
        $error["failure"] = "problem with INSERT INTO jobs query. check attributes";
    }

    $stmt->execute();
    
    if($stmt->errno != 0) {
        $errors['sqlError'] = ('error = ' . $stmt->error);
    } 

    if (!empty($errors)) {
        $data['success'] = false;
        $data['errors'] = $errors;
    } else {
        $data['success'] = true;
        $data['message'] = 'Success!';
    }
    echo json_encode($data);
?>