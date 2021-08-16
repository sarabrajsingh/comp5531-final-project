<?php
    session_start();
    require '../../../database/db.php';

    $errors = [];
    $data = array();

    // Now we check if the data from the login form was submitted, isset() will check if the data exists.
    if ( !isset($_POST['companyName'], $_POST['selectedJobFromCompany'], $_POST['jobOfferForUser']) ) {
        // Could not get the data that should have been sent.
        $errors["formError"] = 'Please fill both the username and password fields!';
    }

    // Prepare our SQL, preparing the SQL statement will prevent SQL injection.

    if ($stmt = $con->prepare('SELECT jobID FROM jobs WHERE jobName = ? AND companyName = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

        $stmt->bind_param('ss', $_POST['selectedJobFromCompany'], $_POST['companyName']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($jobID);
            $stmt->fetch();
        }
    }

    if ($stmt = $con->prepare('SELECT userId FROM users WHERE name = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"

        $stmt->bind_param('s', $_POST['jobOfferForUser']);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId);
            $stmt->fetch();
        }
    }

    if ($stmt = $con->prepare('INSERT INTO jobOffers (jobID, userId, status) VALUES (?, ?, ?)')) {
        $status = "waitingAcceptance";
        $stmt->bind_param("sss", $jobID, $userId, $status);
    }
    
    $stmt->execute();
	$stmt->close();
	
	if (!empty($errors)) {
		$data['success'] = false;
		$data['errors'] = $errors;
	} else {
		$data['success'] = true;
		$data['message'] = 'Success!';
	}
	echo json_encode($data);
?>