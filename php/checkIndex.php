<?php
	require 'connect.php';

	//variables
	$tableUsers = "Users";
	$uname = $password = "";

	//Get input
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$uname = $_POST['uname'];
			$password = $_POST['password'];
	}

	//Search from table if there's match
	$sql = "SELECT * FROM $tableUsers WHERE uName='$uname' and password='$password'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);

	//If there's a match result, table row is 1 row
	if($count == 1){
		//go to home.php
		session_start();
		$_SESSION["uname"] = $uname;
		header("location: home.php?username=$uname");
		die();
	} else {
		header("location: ../index.php?msg=failed");
	}

	mysqli_close($conn);
?>