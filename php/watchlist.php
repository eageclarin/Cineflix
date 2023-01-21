<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$icon = "../icon.png";
	$uname = "";

	//get param from header locatino
	if(isset($_GET['username'])) {
		$uname = $_GET['username'];
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CINEFLIX | Watchlist </title>
        <link rel="icon" type="image/png" href="<?php echo $icon ?>" />
        
        <link rel="stylesheet" href="../css/watchlist.css" />
        <script src="../js/movie.js"> </script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
    	<!-- button to go to top -->
    	<button onclick="toTop()" id="up" title="Go to Top"> ^ </button>

    	<!-- top -->
    	<div id="top">
    		<!-- top menu -->
    		<div id="menu">
	    		<ul>
	    			<li>
	    				<a href="home.php?username=<?php echo $uname ?>" class="left"> <img src="../img/logo.png" width="17%"> </a>
	    			</li>
	    			<li>
	    				<span class="left" style="margin-left: 175px;"> | My Tickets </span>
	    			</li>
	    			<li>
	    				<a href="signout.php" class="right"> SIGN OUT </a>
	    			</li>
	    			<li>
	    				<a href="tickets.php?username=<?php echo $uname ?>" class="right" style="margin-right: 150px;"> MY TICKETS </a> 
	    			</li>
	    			<li>
	    				<span class="right" style="margin-right: 280px; text-decoration: underline;"> Hi, <?php echo $uname ?> </span>
	    			</li>
	    		</ul>
	    	</div>

	    	<!-- top header -->
	    	<div id="header">
	    		<img src="../img/h/hh" />
	    	</div>
	    </div>

	    <!-- bottom -->
	    <div id="bottom">
	    	<!-- bottom menu -->
	    	<div id="menu2">
		    	<ul>
		    		<li class="btn"> 
		    			<p class="bttn"> WATCHLIST </p>
		    		</li>
		    	</ul>
		    </div>

		    <!-- bottom iframe: target display all movies in watchlist -->
		    <iframe src="watchlistMovies.php?username=<?php echo $uname ?>" name="display" id="display" width="100%" scrolling="no" onload="adjustIframe()"></iframe>
	    </div>

	    <!-- footer -->
	    <div id="footer">
	    	<img src="../img/logo.png" width="10%">
	    	<p> EAGE 2020 </p>
	    </div>
    </body>
</html>