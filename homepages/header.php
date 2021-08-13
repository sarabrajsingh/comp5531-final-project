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

	<nav class="d-inline-flex navtop">
		<div>
			<h1><a href=<?=$redirect_path?>>Job Findr</a> </h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
			<a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
</html>