<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
?>
<script src="js/script.js"></script>
<table id="table" tyle="width:100%">
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
                echo '<td>'.$row["userId"].'</td>';
                echo '<td>'.$row["name"].'</td>';
                echo '<td>'.$row["email"].'</td>';
                echo '<td>'.$row["dob"].'</td>';
                echo '<td>'.$row["subscriptionLevel"].'</td>';
                echo '<td>'.$row["paymentInfos"].'</td>';
                echo '<td>'.$row["isActive"].'</td>';
                echo '<td>'.$row["type"].'</td>';
                echo '<td>'.$row["isPaid"].'</td>';
                echo '<td class="category_enabled"><input name="disabledCheck" type="checkbox"></input></td>';
                echo '<td class="category_enabled"><input name="enabledCheck" type="checkbox"></input></td>';
                echo '</tr>';
            }
        }
    }   
    $con->close();
?>
</table>
<div class="col-md-7">
<span id="disableSelectedMessage"></span>
    <button type="button" id="disabledSelected" class="btn btn-sm btn-primary">Disable Selected Users</button>
    <span id="enabledSelectedMessage"></span>
    <button type="button" id="enabledSelected" class="btn btn-sm btn-primary">Enabled Selected Users</button>
</div>