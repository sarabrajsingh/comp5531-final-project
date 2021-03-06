<?php   

    require "../database/db.php";
    
    $errors = [];
    $data = array();

    if(!isset($_POST["jobName"], $_POST["jobCategory"], $_POST["companyName"], $_POST["lowerSalaryAmount"], $_POST["description"], $_POST["numVacancies"])) {
        $errors["failure"] = "problem parsing attributes";
    }

    if ($stmt = $con->prepare('INSERT INTO jobs (
        jobName,
        companyName,    
        datePosted,
        jobStatus,
        description,
        lowerSalaryLimit,
        upperSalaryLimit,
        jobCategory,
        numVacancies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)')) {

        $datePosted = new DateTime("NOW");
        $datePostedForDB = $datePosted->format('Y/m/d H:i:s');
        $upperSalaryLimit = null;
        $jobStatus = "vacant";
        if($_POST['upperSalaryAmount']) {
            $upperSalaryAmount = $_POST['upperSalaryAmount'];
        }
        $stmt->bind_param("sssssssss",
            $_POST["jobName"],
            $_POST["companyName"],
            $datePostedForDB,
            $jobStatus,
            $_POST["description"],
            $_POST["lowerSalaryAmount"],
            $upperSalaryAmount,
            $_POST["jobCategory"],
            $_POST["numVacancies"]
        );
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
        $data['POST'] = $_POST;
    } else {
        $data['success'] = true;
        $data['message'] = 'Success!';
    }
    echo json_encode($data);
?>