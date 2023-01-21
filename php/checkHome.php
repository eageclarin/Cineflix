<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$top = "Top5"; //top 5 movies for home top part

	//retrieve data from database
	$rand = rand(1,5);
	
	$image = gett('imgTop');
	$movieTitle = gett('title');
	$movieGenre = gett('genre');
	$movieYr = gett('year');
	$movieHr = gett('hrs');
	$movieRate = gett('rate');
	$movieMtrcb = gett('mtrcb');

	//Search from table
	function gett($data) {
		global $rand, $conn, $top; //get values of var outside the function
		$sql = "SELECT $data FROM $top WHERE imgTop = '../img/top/$rand' LIMIT 1";
		$res = mysqli_query($conn, $sql);

		if ($res) {
			$row = mysqli_fetch_assoc($res);
			$data = $row[$data]; //column data row;

		} else {
			echo "Error: $res" . mysqli_error($conn);
		}

		return $data;
	}
	
	//read file and transfer data
	$file = fopen('../txt/top5.txt','r');

	while (!feof($file)) {
		$get = fgets($file);
		$comma = explode(",",$get); //data separated by comma
			
		list($img,$movie,$gen,$yr,$hr,$rating,$pg) = $comma;
			
		//insert into table if there's no matching record
		$qry = "INSERT INTO $top (imgTop, title, genre, year, hrs, rate, mtrcb)
				SELECT * FROM (SELECT '$img', '$movie', '$gen', '$yr', '$hr', '$rating', '$pg') AS tmp
				WHERE NOT EXISTS (SELECT * FROM $top WHERE
					imgTop IN ('../img/top/1', '../img/top/2', '../img/top/3', '../img/top/4', '../img/top/5') and
					title IN ('Knives Out', 'Kimi no Nawa', 'Peninsula', 'Bad Genius', 'Enola Holmes') and
					genre IN ('Mystery/Comedy', 'Animation/Romance', 'Action/Horror', 'Drama/Romance', 'Crime/Adventure') and
					year IN ('2019', '2016', '2020', '2017', '2020') and
					hrs IN ('2h 10m', '1h 52m', '1h 44m', '2h 10m', '2h 1m') and
					rate IN ('★ ★ ★ ★ ☆', '★ ★ ★ ★ ☆', '★ ★ ★ ☆ ☆', '★ ★ ★ ☆ ☆', '★ ★ ★ ★ ☆') and
					mtrcb IN ('PG-13', 'PG', 'PG-13', 'PG', 'PG-13')
				) LIMIT 1";
		mysqli_query($conn, $qry);
	}

	fclose($file); //close file when done

	mysqli_close($conn);
?>