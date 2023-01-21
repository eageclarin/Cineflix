<?php
	include 'checkMovie.php';

	//variables
	$icon = "../icon.png";
	$moviee = $uname = 	$r = $d = $watch = $c = "";
	$Rent = "Rent"; //initialize value of rent button
	$rent = "<br>";
	$value = "Add to Watchlist"; //initialize value of watchlist button
	$code ="../vid/trailer.mp4"; //initialize src of video

	//get param username and movie title from headee location
	if(isset($_GET['username']) && isset($_GET['moviee'])) {
		$moviee = $_GET['moviee'];
		$uname = $_GET['username'];
	}

	//get param from header location if rented/paid/rent succes/updated
	if(isset($_GET['rent']) && $_GET['rent'] == 'rented') { //if movie rented, update form
		$r = $_GET['rent'];
		$rent = "<br> Already in <a href='tickets.php?username=$uname'> My Tickets </a>. Update?";
		$Rent = "Update";
	} else if(isset($_GET['rent']) && $_GET['rent'] == 'paid') { //if movie paid, disable form
		$r = $_GET['rent'];
		$rent = "<br> Enjoy watching!";
		$Rent = "Rent";
		$d = "disabled";
	} else if(isset($_GET['rent']) && $_GET['rent'] == 'success') { //if rent succesm update form
		$r = $_GET['rent'];
		$rent = "<br> Added to <a href='tickets.php?username=$uname'> My Tickets </a>. Update?";
		$Rent = "Update";
	} else if(isset($_GET['rent']) && $_GET['rent'] == 'updated') { //if rent updated, updated again?
		$r = $_GET['rent'];
		$rent = "<br> Updated <a href='tickets.php?username=$uname'> My Tickets </a>.";
		$Rent = "Update Again";
	}

	//get param frm header location if in watchlist or not
	if (isset($_GET['watchlist']) && $_GET['watchlist'] == 'added') { //if in watchlist, change value
		$watch = "<br> Added to <a href='watchlist.php?username=$uname'> Watchlist </a>.";
		$value = "Remove from Watchlist";
	} else if (isset($_GET['watchlist']) && $_GET['watchlist'] == 'removed') { //if not in watchlist, bring back value
		$watch = "<br> Removed from <a href='watchlist.php?username=$uname'> Watchlist </a>.";
		$value = "Add to Watchlist";
	}

	//get param fro mheade location if movie paid and there is code
	if (isset($_GET['code']) && $_GET['code'] != '') {
		$c = $_GET['code'];
		$code = "../vid/movie.mp4";
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CINEFLIX | <?php echo $moviee ?> </title>
        <link rel="icon" type="image/png" href="<?php echo $icon ?>" />
        
        <link rel="stylesheet" href="../css/goTo.css" />
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
	    				<span class="left" style="margin-left: 175px;"> | <?php echo $moviee ?> </span>
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
    			<div class="header">
	    			<img src="<?php echo $imgH ?>" width="100%">
	    		</div>

	    		<!-- main infos of the movie -->
	    		<div class="info">
	    			<div class="left">
						<img src="<?php echo $imgP ?>" width="100%">
					</div>
					
					<div class="right">
						<div class="title">
							<?php echo $movieTitle ?>
						</div>

						<div class="description">
							<ul>
								<li>
									<?php echo $movieGenre ?> • <?php echo $movieYr ?> • <?php echo $movieHr ?>
								</li>

								<li class="rate"> 
									<?php echo $movieRate; ?> • <?php echo $movieMtrcb; ?>
								</li>

								<li>
									<!-- add to/remove from watch list -->
									<form action="updateMovie.php" method="post">
										<input type="hidden" name="mTitle" value="<?php echo $movieTitle ?>" />
				 						<input type="hidden" name="uname" value="<?php echo $uname ?>" />
										<input type="hidden" name="rent" value="<?php echo $r ?>" />
				 						<input type="hidden" name="code" value="<?php echo $c ?>" />
										<input type="submit" value="<?php echo $value ?>" name="watchlist" class="button" /> <br> <p class="watch"> <?php echo $watch ?> </p>
									</form>
								</li>
							</ul>
						</div>
					</div>
	    		</div>
	    	</div>
	    </div>

	    <!-- middle -->
	    <div id="mid">
	    	<!-- middle left part -->
	    	<div class="left">
	    		<!-- middle left (full information about the movie with trailer/movie) -->
			    <div id="menu2">
		    		<ul>
		    			<li class="btn"> 
		    				<p class="bttn"> Info </p>
		    			</li>
		    		</ul>
		    	</div>

		    	<!-- video -->
			    <video width="100%" controls>
			    	<source type="video/mp4" src="<?php echo $code ?>">
			    </video> <br> <br>

			    <!-- synopsis, director/s, stars -->
				<p class="synopsis">
				    <?php echo $movieSum ?>
				</p> <br>

				<ul>
				    <li> Director/s: <span class="b"> <?php echo $movieDirek ?></span> </li>
				    <li> Stars: <span class="b"> <?php echo $movieStars ?> </span> </li>
				</ul>
			</div>

			<!-- middle right part -->
			<div class="right">
			 	<img src="../img/tix.png" width="100%">

			 	<!-- rent form -->
			 	<div class="text">
				 	<p style="text-align: center; font-size: 20px; font-family: montserrat b;"> RENT </p> <br>

				 	<form action="storeMovie.php" method="post">
				 		<input type="hidden" name="mTitle" value="<?php echo $movieTitle ?>">
				 		<input type="hidden" name="poster" value="<?php echo $imgP ?>">
				 		<input type="hidden" name="uname" value="<?php echo $uname ?>">

				 		<!-- user info -->
			            <ul>
			            	<li> 
			            		<input type="text" name="name" class="input" placeholder="Enter name" required <?php echo $d ?> />
			            		<p> Name </p>
			            	</li>

			            	<li>
			            		<input type="text" name="contact" class="input" placeholder="Enter contact no." required <?php echo $d ?> />
			            		<p> Contact No. </p>
			            	</li>

			            	<li>
			            		<input type="text" name="address" class="input" placeholder="Enter email address" required <?php echo $d ?> />
			            		<p> Email Address </p>
			            	</li>
			            </ul>

			            <!-- number of days, price, and computed total price -->
			          	<table>
			          		<tr>
			          			<td> Days </td>
			          			<td style="text-align: right; margin-top: -50px;">
			          				<select name="days" class="select" onchange="prod(this.value)" required <?php echo $d ?>>
			          					<option value="" disabled selected> 0 </option>
			          					<option value="1"> 1 </option>
			          					<option value="2"> 2 </option>
			          					<option value="3"> 3 </option>
			          					<option value="4"> 4 </option>
			          					<option value="5"> 5 </option>
			          				</select>
			          			</td>
			          		</tr>
			          		<tr>
			          			<td> Price </td>
			          			<td style="text-align: right"> 
			          				<input type="text" id="price" name="price" value="<?php echo $moviePrice ?>.00" readonly>
			          			</td>
			          		</tr>
			          		<tr>
			          			<td> Total Price </td>
			          			<td style="text-align: right"> 
			          				<input type="text" id="total" name="total" readonly />
			          			</td>
			          		</tr>
			          	</table>

			            <br> <input type="submit" name="rent" value="<?php echo $Rent ?>" <?php echo $d ?> /> <br> 
			            <?php echo $rent ?>
			        </form>
			    </div>
			    <span> 
			 </div>
	    </div>

	    <!-- footer -->
	    <div id="footer">
	    	<img src="../img/logo.png" width="10%">
	    	<p> EAGE 2020 </p>
	    </div>
    </body>
</html>