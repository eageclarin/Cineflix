<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$mTitle = $uname = "";

	//Get value of image clicked
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$mTitle = $_POST['getTitle'];
			$uname = $_POST['uname'];
	}

	//Search match movie from table of movies
	$sqlTitle = "SELECT title FROM Movies WHERE title='$mTitle'";
	$resTitle = mysqli_query($conn, $sqlTitle);
	$count = mysqli_num_rows($resTitle);

	//Search match from rent table if rented/paid
	$sqlRented = "SELECT * FROM Rent WHERE user='$uname' and title='$mTitle'";
	$resRented = mysqli_query($conn, $sqlRented);
	$countt = mysqli_num_rows($resRented);

	//Search match from watchlist table if added/not
	$sqlListed = "SELECT * FROM Watchlist WHERE user='$uname' and title='$mTitle'";
	$resListed = mysqli_query($conn, $sqlListed);
	$counttt = mysqli_num_rows($resListed);

	//If there's a match, open goTo.php with poster image same as value and all other data from same row
	if ($count == 1 && $countt == 1){ //if movie is in movie table and in rent table
		//get column data from row
		$rowR = mysqli_fetch_assoc($resRented);
		$status = $rowR['status'];
		$code = $rowR['code'];

		if ($status == 'pending') { //if movie status is pending
			if ($counttt == 1) { //if added to watchlist
				session_start();
				$_SESSION["title"] = $mTitle;
				header("location: goTo.php?username=$uname&moviee=$mTitle&rent=rented&watchlist=added");
				die();
			} else { //if not in watchlist
				session_start();
				$_SESSION["title"] = $mTitle;
				header("location: goTo.php?username=$uname&moviee=$mTitle&rent=rented");
				die();
			}
			
		} else { //if movie status is paid
			//check if expired
			$rentToday = date('Y-m-d', time());
			$rentEnd = $rowR['rentEnd'];

			if ($rentEnd <= $rentToday) { //if expired delete from table
				$sqlDel = "DELETE FROM Rent WHERE user='$uname' and title='$mTitle' and status='paid'";
				mysqli_query($conn, $sqlDel);
			} else {
				echo mysqli_error($conn);
			}
			
			if ($counttt == 1) { //if added to watchlist
				session_start();
				$_SESSION["title"] = $mTitle;
				header("location: goTo.php?username=$uname&moviee=$mTitle&rent=paid&code=$code&watchlist=added");
				die();

			} else { //if not in watchlist
				session_start();
				$_SESSION["title"] = $mTitle;
				header("location: goTo.php?username=$uname&moviee=$mTitle&rent=paid&code=$code");
				die();
			}
		}
		
	} else if ($count == 1 && $countt != 1){ //if movies is in movie table but not rented
		if ($counttt == 1) { //if added to watchlist
			session_start();
			$_SESSION["title"] = $mTitle;
			header("location: goTo.php?username=$uname&moviee=$mTitle&watchlist=added");
			die();
		} else { //if not in watchlist
			session_start();
			$_SESSION["title"] = $mTitle;
			header("location: goTo.php?username=$uname&moviee=$mTitle");
			die();
		}
	} else { //if movie not both in movie table and rent table
		print_r($_POST);
		echo "Error: $sqlTitle " . mysqli_error($conn);
	}
?>