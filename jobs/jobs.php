<?php
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        //header('Location: index.html');
        exit("session problem");
    }

    print_r($_GET);
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
    <div class="title">
    <label for="text" class="title">Job Title:</label>
        <input type="text" value="" class="field left" readonly>
    </div>
    <div class="companyName">
    <label for="text" class="title">Company Name:</label>
        <input type="text" value="" class="field left" readonly>
    </div>
    <div class="companyName">
    <label for="text" class="title">Company Name:</label>
        <input type="text" value="" class="field left" readonly>
    </div>
    <div class="salaryRange">
    <label for="text" class="title">Salary Range:</label>
        <input type="text" value="" class="field left" readonly>
    </div>
    <div class="description">
    <label for="textarea" class="title">Description:</label>
        <textarea id="description" name="description" cols="40" rows="10" class="form-control"></textarea>
    </div>
    <?php
        session_start();
        require "../database/db.php";
        if($_SESSION["type"] === "Employer") {
            echo '<button type="button" id="saveButton" class="btn btn-sm btn-primary">Save</button>';
            echo '<span id="saveButtonMessage"></span>';
        } elseif ($_SESSION["type"] === "Employee")
    ?>
</body>
</html>