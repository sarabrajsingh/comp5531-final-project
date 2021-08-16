<?php
$redirect_path = '';
if ($_SESSION['type'] == 'employer'){
    $redirect_path = 'employer-home.php';
} else if ($_SESSION['type'] == 'user'){
    $redirect_path = 'user-home.php';
} else {
  $redirect_path = 'admin-home.php';
}
?>

<!DOCTYPE html>
<html>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href='../homepages/<?=$redirect_path?>''>Job Findr</a> 
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="../profile/profile.php"><i class="fas fa-user-circle"></i>Profile</a></li>
      <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
    </ul>
  </div>
</nav>
</html>