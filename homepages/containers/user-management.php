<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
?>
<script src="js/script.js"></script>
<table style="width:100%">
  <tr>
    <th>userId</th>
    <th>name</th>
    <th>email</th>
    <th>dob</th>
    <th>subscriptionLevel</th>
    <th>paymentInfos</th>
    <th>isActive</th>
    <th>type</th>
    <th>isPaid</th>
    <th>disable</th>
    <th>enable</th>
  </tr>
<?php
    session_start();
    require "../../database/db.php";
    $sql = 'SELECT * FROM users;';
    $result = $con->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if($row["name"] != "Administrator") {
                echo '<tr>';
                echo '<th>'.$row["userId"].'</th>';
                echo '<th>'.$row["name"].'</th>';
                echo '<th>'.$row["email"].'</th>';
                echo '<th>'.$row["dob"].'</th>';
                echo '<th>'.$row["subscriptionLevel"].'</th>';
                echo '<th>'.$row["paymentInfos"].'</th>';
                echo '<th>'.$row["isActive"].'</th>';
                echo '<th>'.$row["type"].'</th>';
                echo '<th>'.$row["isPaid"].'</th>';
                echo '<th><input type="checkbox"></input></th>';
                echo '<th><input type="checkbox"></input></th>';
                echo '</tr>';
            }
        }
    }   
    $con->close();
?>
</table>
<div class="col-md-7">
    <span id="enabledSelectedMessage"></span>
    <button type="button" id="enabledSelected" class="btn btn-sm btn-primary">Enabled Selected Users</button>
    <span id="disableSelectedMessage"></span>
    <button type="button" id="disabledSelected" class="btn btn-sm btn-primary">Disable Selected Users</button>
</div>