<?php
session_start();
$DATABASE_HOST = '127.0.0.1';
$DATABASE_USER = 'cjc55311';
$DATABASE_PASS = 'suprem3';
$DATABASE_NAME = 'cjc55311';
$DATABASE_PORT = '3306';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME, $DATABASE_PORT);

if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>