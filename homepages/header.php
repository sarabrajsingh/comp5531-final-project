<?php

$redirect_path = '';
if (isset($_SESSION['employerStatus'])){
    $redirect_path = '"employer-home.php"';
} else {
    $redirect_path = '"user-home.php"';
}
?>

<!DOCTYPE html>
<html>

	<!-- <nav class="navtop">
		<div>
			<h1 style="display:inline"><a href=<?=$redirect_path?>>Job Findr</a> </h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav> -->
<!-- Working for now -->
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=<?=$redirect_path?>>Job Findr</a> 
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="../profile/profile.php"><i class="fas fa-user-circle"></i>Profile</a></li>
      <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
    </ul>
  </div>
</nav>
</html>