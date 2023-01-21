<?php
	include 'checkHome.php';

	//variables
	$uname = "";
	$icon = "../icon.png";

	//get param from header location
	if (isset($_GET['username'])) {
		$uname = $_GET['username'];
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CINEFLIX </title>
        <link rel="icon" type="image/png" href="<?php echo $icon ?>" />
        
        <link rel="stylesheet" href="../css/home.css" />
        <script src="../js/home.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
    	<!-- scroll to top when clicked -->
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
	    				<a href="signout.php" class="right"> SIGN OUT </a>
	    			</li>

	    			<li>
	    				<a href="watchlist.php?username=<?php echo $uname ?>" class="right" style="margin-right: 140px;"> WATCHLIST </a> 
	    			</li>

	    			<li>
	    				<a href="tickets.php?username=<?php echo $uname ?>" class="right" style="margin-right: 280px;"> MY TICKETS </a>
	    			</li>

	    			<li>
	    				<span class="right" style="margin-right: 420px; text-decoration: underline;"> Hi, <?php echo $uname ?> </span>
	    			</li>
	    		</ul>
	    	</div>

	    	<!-- top movie -->
    		<div id="movie">
    			<div class="image">
	    			<img src="<?php echo $image; ?>" width="100%">
	    		</div>

	    		<div class="info">
	    			<div class="left">
						<div class="title" name="getTitle" value="$movieTitle">
							<?php echo $movieTitle ?>
						</div>

						<div class="description">
							<ul>
								<li>
									<?php echo $movieGenre; ?> • <?php echo $movieYr; ?> • <?php echo $movieHr; ?>
								</li>

								<li> 
									<?php echo $movieRate; ?> • <?php echo $movieMtrcb; ?>
								</li>
							</ul>
						</div>
					</div>
					
					<div class="right">
						<span class="num"> <?php echo $rand; ?> </span> <sup> /5 </sup> 
					</div>
	    		</div>
	    	</div>
	    </div>

	    <!-- bottom -->
	    <div id="bottom">
	    	<!-- bottom menu -->
	    	<div id="menu2">
	    		<ul>
	    			<li class="drp"> 
	    				<a href="homeTop.php" target="display" class="drpbtn" style="animation-duration: 0.25s"> Top 10 </a>
	    			</li>
	    			<li class="drp">
	    				<p class="drpbtn" style="animation-duration: 0.5s"> Year </p>
	    				<div class="drp-content">
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2004" target="display"> 2004 </a>
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2011" target="display"> 2011 </a>
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2013" target="display"> 2013 </a>
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2014" target="display"> 2014 </a>
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2016" target="display"> 2016 </a>
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2017" target="display"> 2017 </a>
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2018" target="display"> 2018 </a>
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2019" target="display"> 2019 </a>
	    					<a href="homeYr.php?username=<?php echo $uname ?>&year=2020" target="display"> 2020 </a>
	    				</div>
	    			</li>
	    			<li class="drp">
	    				<p class="drpbtn" style="animation-duration: 0.75s"> Category </p>
	    				<div class="drp-content">
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Action" target="display"> Action </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Adventure" target="display"> Adventure </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Animation" target="display"> Animation </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Comedy" target="display"> Comedy </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Crime" target="display"> Crime </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Documentary" target="display"> Documentary </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Drama" target="display"> Drama </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Family" target="display"> Family </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Fantasy" target="display"> Fantasy </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Horror" target="display"> Horror </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Mystery" target="display"> Mystery </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Romance" target="display"> Romance </a>
	    					<a href="homeCat.php?username=<?php echo $uname ?>&category=Thriller" target="display"> Thriller </a>
	    				</div>
	    			</li>
	    			<li class="drp"> 
	    				<a href="homeAll.php?username=<?php echo $uname ?>&sort=id&order=ASC" target="display" class="drpbtn" style="animation-duration: 1s"> All </a>
	    				<div class="drp-content">
	    					<a href="homeAll.php?username=<?php echo $uname ?>&sort=title&order=ASC" target="display"> Title (A-Z) </a>
	    					<a href="homeAll.php?username=<?php echo $uname ?>&sort=title&order=DESC" target="display"> Title (Z-A) </a>
	    					<a href="homeAll.php?username=<?php echo $uname ?>&sort=year&order=ASC" target="display"> Year (Old-New) </a>
	    					<a href="homeAll.php?username=<?php echo $uname ?>&sort=year&order=DESC" target="display"> Year (New-Old) </a>
	    					<a href="homeAll.php?username=<?php echo $uname ?>&sort=rate&order=ASC" target="display"> Rate (5-0 ★) </a>
	    					<a href="homeAll.php?username=<?php echo $uname ?>&sort=rate&order=DESC" target="display"> Rate (0-5 ★) </a>
	    					<a href="homeAll.php?username=<?php echo $uname ?>&sort=price&order=ASC" target="display"> Price (Low-High) </a>
	    					<a href="homeAll.php?username=<?php echo $uname ?>&sort=price&order=DESC" target="display"> Price (High-Low) </a>
	    				</div>
	    			</li>
	    		</ul>
	    	</div>

	    	<br>

	    	<!-- bottom iframe: target display from menu 2 -->
	    	<iframe src="homeTop.php?username=<?php echo $uname ?>" name="display" id="display" width="100%" scrolling="no" onload="adjustIframe()"></iframe>
	    </div>

	    <!-- footer -->
	    <div id="footer">
	    	<img src="../img/logo.png" width="10%">
	    	<p> EAGE 2020 </p>
	    </div>
    </body>
</html>