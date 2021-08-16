<?php
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        //header('Location: index.html');
        exit("session problem");
    }
    print_r($_GET["id"]);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <?php require "../homepages/header.php" ?>
    <div class="title">
    <label for="text"class="title">Job Title:</label>
        <input id="jobTitle" type="text" value="" class="field left" readonly>
    </div>
    <div class="companyName">
    <label for="text" class="companyName">Company Name:</label>
        <input id="companyName" type="text" value="" class="field left" readonly>
    </div>
    <div class="datePosted">
    <label for="text" class="datePosted">Date Posted:</label>
        <input id="datePosted" type="text" value="" class="field left" readonly>
    </div>
    <div class="jobCategory">
    <label for="text" class="jobCategory">Job Type:</label>
        <input id="jobCategory" type="text" value="" class="field left" readonly>
    </div>
    <div class="salaryRange">
    <label for="text" class="salaryRange">Salary Range:</label>
        <input id="salaryRange" type="text" value="" class="field left" readonly>
    </div>
    <div class="description">
    <label for="textarea" class="description">Description:</label>
        <textarea id="description" name="description" cols="40" rows="20" class="form-control" readonly></textarea>
    </div>
    <?php
        session_start();
        require "../database/db.php";

        if($stmt = $con->prepare('SELECT isPaid FROM users WHERE email = ? UNION SELECT isPaid FROM companies WHERE email = ?')) {
            $stmt->bind_param("ss", $_SESSION["login-email"], $_SESSION["login-email"]);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0) {
                $stmt->bind_result($isPaid);
                $stmt->fetch();
            }
        }
        if($isPaid) {
            if($_SESSION["type"] === "employer") {
                echo '<button type="button" id="deleteJobButton" class="btn btn-sm btn-primary">Delete Job</button>';
                echo '<span id="deleteJobButtonMessage"></span>';
            } elseif ($_SESSION["type"] === "user") {
                echo '<button type="button" id="applyButton" class="btn btn-sm btn-primary">Apply</button>';
                echo '<span id="applyButtonMessage"></span>';
            } else {
                echo '<button type="button" id="deleteJobButton" class="btn btn-sm btn-primary">Delete Job</button>';
                echo '<span id="deleteJobButtonMessage"></span>';
                echo '<button type="button" id="applyButton" class="btn btn-sm btn-primary">Apply</button>';
                echo '<span id="applyButtonMessage"></span>';
            }
        }
    ?>
</body>
</html>