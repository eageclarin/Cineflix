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
        <link rel="stylesheet" href="../css/watchlist.css" />
        <script src="../js/movie.js"> </script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
		<!-- display contents of watchlist -->
	   	<?php
			$sqlW = "SELECT * FROM $tableWatch WHERE user='$uname' ORDER BY id ASC";
			$resW = mysqli_query($conn, $sqlW);

			if ($resW) {
				$i = 0;
				$s = 0.25;

				echo "<form action='goToMovie.php' method='post' target='_top'>";
				echo "<table>";
				echo "<input type='hidden' id='title' name='getTitle' value=\"\" />";
				echo "<input type='hidden' id='uname' name='uname' value='" .$uname. "' />";
				echo "<tr>";

				while (($rowW = mysqli_fetch_assoc($resW))) {
					$title = $rowW['title'];

					$sqlT = "SELECT * FROM $tableMovie WHERE title='$title' ORDER BY id DESC";
					$resT = mysqli_query($conn, $sqlT);
					$rowT = mysqli_fetch_assoc($resT);

					//get column data from row
					$thumbnail = $rowT['watchlist'];
					$price = $rowT['price'];
					$rate = $rowT['rate'];
					$pg = $rowT['mtrcb'];

					echo "<td>";
					echo "<div id='thumbnail' style='animation-duration:".$s."s' >";
				?>
					<input type="image" class="image" src="<?php echo $thumbnail ?>" onclick="return setTitle('<?php echo $title ?>');" />
						<div class="overlay">
							<div class="txt">
								<p class="title"> <?php echo $title ?> </p>
								P<?php echo $price ?> • <?php echo $rate ?> • <?php echo $pg ?>
							</div>
						</div>
				<?php
					echo "</div> </td>";
					$i++;
					$s += 0.25;

					//if column is 3, move to next row
					if ($i % 3 == 0) {
						echo "</tr> <tr>";
						$s = 0.25;
					}
				}

				//if column is less than 3, fill up next columns to fulfill 3 columns
				if ($i < 3) {
					for ($i; $i < 3; $i++){
						echo "<td> &nbsp; </td>";
					}
				}

					echo "</table> </form>";
			} else {
				print_r($_POST);
				echo "<font color='white'> Error: $sqlW" . mysqli_error($conn). '</font>';
			}
		?>
    </body>
</html>