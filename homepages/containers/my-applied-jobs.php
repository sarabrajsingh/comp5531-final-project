<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
?>
<table id="table" tyle="width:100%">
  <tr>
    <th>jobID</th>
    <th>applicationDate</th>
    <th>companyName</th>
  </tr>
<?php
    session_start();
    require "../../database/db.php";

    $errors = [];

    // get userId
    if($stmt = $con->prepare('SELECT userId FROM users WHERE email = ?')){
        $stmt->bind_param("s", $_SESSION["login-email"]);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($userId);
        $stmt->fetch();
    } else {
        $errors['sqlError'] = "error with SQL query (SELECT userId FROM users WHERE email = ?)";
    }

    $sql = "SELECT * FROM applications WHERE userId = ".$userId.";";
    $result = $con->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if($row["name"] != "Administrator") {
                echo '<tr>';
                echo '<td><a href=../../../jobs/jobs.php?jobID='.$row["jobID"].'>'.$row["jobID"].'</a></td>';
                echo '<td>'.$row["applicationDate"].'</td>';
                echo '<td>'.$row["companyName"].'</td>';
                echo '</tr>';
            }
        }
    }   
    $con->close();
?>
</table>