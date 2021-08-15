<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	//header('Location: index.html');
	exit("session problem");
}
?>
<script src="js/script.js"></script>
<!-- show 5 latest jobs -->
<div class="row">
    <div class="col-md-3 border-right">
        <h4>Show Recent Jobs</h4>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <div class="form-group row">
        </div>
        <div class="col-md-7">
            <div id="showRecentJobsResults"></div>  
            <button type="button" id="showRecentJobsButton" class="btn btn-sm btn-primary">Show Recent Jobs</button>
        </div>
    </div>
</div>