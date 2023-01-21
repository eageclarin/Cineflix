<?php
	session_start();
	$_SESSION = array(); //unset all of the session variables
	session_destroy(); //destroy session
	header("location: ../index.php"); //redirect to log-in page
	exit;
?>