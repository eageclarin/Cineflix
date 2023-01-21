<?php
	require 'connect.php';

	//variables
	$tableUsers = "Users"; //table of users
	$uname = $password = "";

	//Get input
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$uname = $_POST['uname'];
			$password = $_POST['password'];
	}

	//Search from table if there's already match
	$sqlUn = "SELECT uname FROM $tableUsers WHERE uname='$uname'";
	$resUn = mysqli_query($conn, $sqlUn);
	$count = mysqli_num_rows($resUn);

	//If there's a match, pass param msg failed
	if($count == 1){
		header("location: ../index-signup.php?msg=failed");
	} else {
		$sqlUin = "INSERT INTO $tableUsers (uname, password) VALUES ('$uname', '$password')";
		$resUin = mysqli_query($conn, $sqlUin);
			
		if ($resUin) {
			//if no match, insert in to table then go to index.php to sign in
			header("location: ../index.php");
		} else {
			echo "Error: $sqlUin " .mysqli_error($conn);
		}
	}

	mysqli_close($conn);
?>