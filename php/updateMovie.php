<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$mTitle = $uname = "";
	$tableRent = "Rent"; //table for rented movies 
	$tableWatch = "Watchlist"; //table for watchlist

	//Delete value from table, when button x from my tickets (cart) clicked
	if (isset($_POST['delete'])) {
		$mTitle = $_POST['getTitle'];
		$uname = $_POST['uname'];

		$sqlDel = "DELETE FROM $tableRent WHERE user='$uname' and title='$mTitle'";
		$resDel = mysqli_query($conn, $sqlDel);

		if ($resDel) {
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
			print_R($_POST);
			header("location: tickets.php?username=$uname&remove=success");
		} else {
			echo "Error: $sqlDel " . mysqli_error($conn);
		}
	}

	//Status->Paid; Generate code; Start date and end date
	if (isset($_POST['pay'])) {
		$uname = $_POST['uname'];
		$status = "paid";

		function generateCode($len){
			$char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$charLen = strlen($char);
   			$code = "";
		    for ($i = 0; $i < $len; $i++) {
		        $code .= $char[rand(0, $charLen - 1)];
		    }
		    return $code;
		}

		//set start date and end date
		$sqlSet = "SELECT * FROM $tableRent WHERE user='$uname' and status='pending'";
		$resSet = mysqli_query($conn, $sqlSet);

		if ($resSet) {
			while(($rowS = mysqli_fetch_assoc($resSet))) {
				$days = $rowS['rDays'];
				$mTitle = $rowS['title'];
				$code = generateCode(5);

				$rentStart = new DateTime('now');
				$rentEnd = new DateTime('now');
				date_add($rentEnd, date_interval_create_from_date_string("$days days"));
				$rentEnd = $rentEnd->format('Y-m-d');
				$rentStart = $rentStart->format('Y-m-d');

				$sqlUpdate = "UPDATE $tableRent SET rentStart='$rentStart', rentEnd='$rentEnd', status='$status', code='$code' WHERE user='$uname' and title='$mTitle' and status='pending'";
				$resUpdate = mysqli_query($conn, $sqlUpdate);
			}

			if ($resUpdate){
				header("location: tickets.php?username=$uname");
			} else {
				print_r($_POST);
				echo "Error $rentStart $rentEnd $sqlUpdate " . mysqli_error($conn);
			}
		} else {
			print_r($_POST);
			echo "Error $sqlSet " . mysqli_error($conn);
		}
	}

	//store in watchlist or delete from watchlist
	if(isset($_POST['watchlist'])) {
		if($_POST['watchlist'] == 'Add to Watchlist') {
			//get input data
			$uname = $_POST['uname'];
			$mTitle = $_POST['mTitle'];
			$rent = $_POST['rent'];
			$code = $_POST['code'];

			//Search match from table
			$sqlWatch = "SELECT * FROM $tableWatch WHERE user='$uname' and title='$mTitle'";
			$resWatch = mysqli_query($conn, $sqlWatch);
			$count = mysqli_num_rows($resWatch);

			//if there's match, update data; else, insert new data into table
			if ($count == 1) {
				if ($rent == '' && $code == ''){
					header("location: goTo.php?username=$uname&moviee=$mTitle&watchlist=1");
				} else if ($rent != '' && $code == ''){
					header("location: goTo.php?username=$uname&moviee=$mTitle&rent=$rent&watchlist=1");
				} else if ($rent != '' && $code != ''){
					header("location: goTo.php?username=$uname&moviee=$mTitle&rent=$rent&code=$code&watchlist=1");
				}
			} else {
				$sqlW = "INSERT INTO $tableWatch (user, title) VALUES ('$uname', '$mTitle')";
				$resW = mysqli_query($conn, $sqlW);

				if ($resW) {
					if ($rent == '' && $code == ''){
						header("location: goTo.php?username=$uname&moviee=$mTitle&watchlist=added");
					} else if ($rent != '' && $code == ''){
						header("location: goTo.php?username=$uname&moviee=$mTitle&rent=$rent&watchlist=added");
					} else if ($rent != '' && $code != ''){
						header("location: goTo.php?username=$uname&moviee=$mTitle&rent=$rent&code=$code&watchlist=added");
					}
				} else {
					echo "Error: $sqlW <br>" . mysqli_error($conn);
				}
			}
		} else if ($_POST['watchlist'] == 'Remove from Watchlist') {
			//get input data
			$uname = $_POST['uname'];
			$mTitle = $_POST['mTitle'];
			$rent = $_POST['rent'];
			$code = $_POST['code'];

			//Search match from table
			$sqlRWatch= "DELETE FROM $tableWatch WHERE user='$uname' and title='$mTitle'";
			$resRWatch = mysqli_query($conn, $sqlRWatch);

			//if deleted successfully, pass param removed from watchlist
			if ($resRWatch) {
				if ($rent == '' && $code == ''){ //if not rented and there is no code
					session_start();
					$_SESSION["title"] = $mTitle;
					header("location: goTo.php?username=$uname&moviee=$mTitle&watchlist=removed");
					die();
				} else if ($rent != '' && $code == ''){ //if rented, pass value of rent
					session_start();
					$_SESSION["title"] = $mTitle;
					header("location: goTo.php?username=$uname&moviee=$mTitle&rent=$rent&watchlist=removed");
					die();
				} else if ($rent != '' && $code != ''){ //if rented and there is code, pass values
					session_start();
					$_SESSION["title"] = $mTitle;
					header("location: goTo.php?username=$uname&moviee=$mTitle&rent=$rent&code=$code&watchlist=removed");
					die();
				}
			} else {
				echo "Error: $sqlRWatch " . mysqli_error($conn);
			}
		}
	}
?>