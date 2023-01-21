<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$tableRent = "Rent"; //table for rented and/or paid movies
	$tableWatch = "Watchlist"; //table for watchlist
	$mTitle = $uname = $name = $poster = $contact = $address = $rDays = $moviePrice = $totalPrice = "";
	$status = "pending"; //initialize rented movies to pending not paid
	$code = "000000"; //initialize code all 0

	//initialize dates to current date
	$rentStart = date('Y-m-d', time());
	$rentEnd = date('Y-m-d', time());

	//get values from rent form
	if (isset($_POST['rent'])) {
		$mTitle = $_POST['mTitle'];
		$poster = $_POST['poster'];
		$uname = $_POST['uname'];
		$name = $_POST['name'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$rDays = $_POST['days'];
		$moviePrice = $_POST['price'];
		$totalPrice = $_POST['total'];
	}

	//search match from table
	$sqlRented = "SELECT * FROM $tableRent WHERE user='$uname' and title='$mTitle' and rentStart='$rentStart' and status='pending'";
	$resRented = mysqli_query($conn, $sqlRented);
	$count = mysqli_num_rows($resRented);

	//if there's match, update data; else, insert new data into table
	if ($count == 1) {
		$sqlUpdate = "UPDATE $tableRent SET rentEnd='$rentEnd', rDays='$rDays', total='$totalPrice', name='$name', contact='$contact', address='$address' WHERE user='$uname' and title='$mTitle' and rentStart='$rentStart' and status='pending'";
		$resUpdate = mysqli_query($conn, $sqlUpdate);
	} else {
		$sqlRent = "INSERT INTO $tableRent (user, title, poster, name, contact, address, rentStart, rentEnd, rDays, price, total, status, code) VALUES ('$uname', '$mTitle', '$poster', '$name', '$contact', '$address', '$rentStart', '$rentEnd', '$rDays', '$moviePrice', '$totalPrice', '$status', '$code')";
		$resRent = mysqli_query($conn, $sqlRent);
	}

	//Search match from watchlist table if added/not
	$sqlListed = "SELECT * FROM Watchlist WHERE user='$uname' and title='$mTitle'";
	$resListed = mysqli_query($conn, $sqlListed);
	$counttt = mysqli_num_rows($resListed);

	//if data updated, pass param rent is updated; else if inserted, pass param rent is success
	if ($resUpdate) {
		if ($counttt == 1) { //if in watchlist
			session_start();
			$_SESSION["title"] = $mTitle;
			header("location: goTo.php?username=$uname&moviee=$mTitle&rent=updated&watchlist=added");
			die();
		} else { //if not in watchlist
			session_start();
			$_SESSION["title"] = $mTitle;
			header("location: goTo.php?username=$uname&moviee=$mTitle&rent=updated");
			die();
		}
	} else if ($resRent){
		if ($counttt == 1) { //if in watchlist
			session_start();
			$_SESSION["title"] = $mTitle;
			header("location: goTo.php?username=$uname&moviee=$mTitle&rent=success&watchlist=added");
			die();
		} else { //if not in watchlist
			session_start();
			$_SESSION["title"] = $mTitle;
			header("location: goTo.php?username=$uname&moviee=$mTitle&rent=success");
			die();
		}
			
	} else {
		echo "Error: $sqlRented <br>" . mysqli_error($conn);
	}


	mysqli_close($conn);
?>