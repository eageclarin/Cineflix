<?php
	require 'connect.php';

	//variables
	$tableMovie = "Movies";	//table for all movies
	$tableWatch = "Watchlist";	//table for all movies
	$m_id = $m_poster = $m_head = $m_watch = $m_title = $m_genre = $m_yr = $m_hrs = $m_rate = $m_mtrcb = $m_direk = $m_stars = $m_sum = $m_price = '';

	//retrieve movie data from txt file
	$file_mov = fopen('../txt/movies.txt','r');

	while (!feof($file_mov)) {
		$get_mov = fgets($file_mov);
		$comma_mov = explode('|',$get_mov);
			
		list($m_id,$m_poster,$m_head,$m_watch,$m_title,$m_genre,$m_yr,$m_hrs,$m_rate,$m_mtrcb,$m_direk,$m_stars,$m_sum,$m_price) = $comma_mov;
			
		//insert into table if there's no matching record
		$query_mov = "INSERT INTO $tableMovie (id, poster, header, watchlist, title, genre, year, hours, rate, mtrcb, director, stars, summary, price)
			VALUES ('$m_id', '$m_poster', '$m_head', '$m_watch', '$m_title', '$m_genre', '$m_yr', '$m_hrs', '$m_rate', '$m_mtrcb', '$m_direk', '$m_stars', '$m_sum', '$m_price')";
		mysqli_query($conn, $query_mov);
	}
	
	fclose($file_mov);
?>