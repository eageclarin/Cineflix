<?php
	//variables
	$icon = "../icon.png";
	$uname = "";

	//get param from header location
	if(isset($_GET['username'])) {
		$uname = $_GET['username'];
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CINEFLIX | My Tickets </title>
        <link rel="icon" type="image/png" href="<?php echo $icon ?>" />
        
        <link rel="stylesheet" href="../css/tickets.css" />
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
	    				<a href="watchlist.php?username=<?php echo $uname ?>" class="right" style="margin-right: 150px;"> WATCHLIST </a> 
	    			</li>
	    			<li>
	    				<span class="right" style="margin-right: 280px; text-decoration: underline;"> Hi, <?php echo $uname ?> </span>
	    			</li>
	    		</ul>
	    	</div>

	    	<!-- top header -->
	    	<div id="header">
	    		<img src="../img/h/h" />
	    	</div>
	    </div>

	    <!-- bottom -->
	    <div id="bottom">
	    	<!-- bottom menu -->
	    	<div id="menu2">
		    	<ul>
		    		<li id="btn"> 
		    			<a href="ticketsOrders.php?username=<?php echo $uname ?>" target="display" class="bttn"> My Orders </a>
		    		</li>
		    		<li id="btn"> 
		    			<a href="ticketsMyCodes.php?username=<?php echo $uname ?>" target="display" class="bttn"> My Codes </a>
		    		</li>
		    	</ul>
		    </div>

	    	<br>

	    	<!-- bottom iframe: target display of menu -->
	    	<iframe src="ticketsOrders.php?username=<?php echo $uname ?>" name="display" id="display" width="100%" scrolling="no" onload="adjustIframe()"></iframe>
	    </div>

	    <!-- footer -->
	    <div id="footer">
	    	<img src="../img/logo.png" width="10%">
	    	<p> EAGE 2020 </p>
	    </div>
    </body>
</html>