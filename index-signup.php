<?php
	//variables
	$icon = "icon.png";
	$match = "php/storeIndex.php";
	$message = "<br>";

	//get param from header location
	if(isset($_GET['msg']) && $_GET['msg'] == 'failed') {
		$message = "Username taken" . "<br>";
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CINEFLIX </title>
        <link rel="icon" type="image/png" href="<?php echo $icon ?>" />
        
        <link rel="stylesheet" href="css/index.css" />
        <script src="js/index.js"> </script>
    </head>
    
    <body style="overflow: hidden;">
    	<div id="container">
    		<!-- left -->
			<div class="column left">
				<div id="mid">
		            <img src="img/logo.png" width="40%">

		            <!-- sign up then redirect to log in page; msg failed if there's existing account -->
		            <form action="<?php echo $match ?>" method="post">
		            	<ul>
		            		<li> 
		            			<p> Username </p>
		            			<input type="text" name="uname" class="input" placeholder="Enter a username" required>
		            		</li>

		            		<li>
		            			<p> Password </p>
		            			<div class="pass">	
		            				<input type="text" name="password" class="input" placeholder="Enter a password" required>
		            			</div>
		            		</li>

		            		<li>
		            			<p> Favorite Color </p>
		            			<div class="pass">	
		            				<input type="text" name="color" class="input" placeholder="Enter favorite color" required>
		            			</div>
		            		</li>

		            		<li>
		            			<span> <?php echo $message; ?> </span>
		            		</li>

		            		<li>
		            			<br> <input type="submit" value="Sign Up"> <br> <br>
		            			Already have an account? <a href="index.php"> Sign in. </a>
		            		</li>
		            	</ul>
		            </form>
		        </div>
			</div>

			<!-- right -->
			<div class="column right">
				<img src="img/index-bgg.jpg" width="100%">
			</div>
        </div>
    </body>
</html>
