<?php
	//variables
	$match = "php/checkIndex.php";
	$message = "<br>";

	//get param from header location
	if(isset($_GET['msg']) && $_GET['msg'] == 'failed') {
		$message = "Invalid Username / Password" . "<br>";
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> CINEFLIX </title>
        <link rel="icon" type="image/png" href="icon.png" />
        
        <link rel="stylesheet" href="css/index.css" />
        <script src="js/index.js"> </script>
    </head>
    
    <body style="overflow: hidden;">
    	<div id="container">
    		<!-- left -->
			<div class="column left">
				<div id="mid">
		            <img src="img/logo.png" width="40%">

		            <!-- log in; sign up if no account -->
		            <form action="<?php echo $match ?>" method="post">
		            	<ul>
		            		<li> 
		            			<p> Username </p>
		            			<input type="text" name="uname" class="input" placeholder="Enter username">
		            		</li>

		            		<li>
		            			<p> Password </p>
		            			<div class="pass">	
		            				<input type="password" name="password" class="input" placeholder="Enter the password">
		            				<div class="eye slash" onclick="togglePW()"> </div>
		            			</div>
		            		</li>

		            		<li>
		            			<span> <?php echo $message; ?> </span>
		            		</li>

		            		<li>
		            			<br> <input type="submit" value="Sign In"> <br> <br>
		            			No account? <a href="index-signup.php"> Sign up. </a>
		            		</li>

		            		<li>
		            			<p class="small"> Credits to the photo owners. </p>
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
