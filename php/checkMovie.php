<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$tableMovie = "Movies"; //all movies
	$moviee = $days = "";

	if(isset($_GET['moviee'])) {
		$moviee = $_GET['moviee'];
	}

	//retrieve data from database
	$imgP = gett('poster');
	$imgH = gett('header');
	$movieTitle = gett('title');
	$movieGenre = gett('genre');
	$movieYr = gett('year');
	$movieHr = gett('hours');
	$movieRate = gett('rate');
	$movieMtrcb = gett('mtrcb');
	$movieSum = gett('summary');
	$movieDirek = gett('director');
	$movieStars = gett('stars');
	$moviePrice = gett('price');

	//Search from table
	function gett($data) {
		global $conn, $tableMovie, $moviee; //get values of var outside the function
		$sqlM = "SELECT $data FROM $tableMovie WHERE title='$moviee'";
		$resM = mysqli_query($conn, $sqlM);

		if ($resM) {
			$rowM = mysqli_fetch_assoc($resM);
			$data = $rowM[$data]; //column data in row;

		} else {
			print_r($_POST);
			echo "Error: $sqlM" . mysqli_error($conn);
		}

		return $data;
	}
?>