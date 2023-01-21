<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$movieYr = $movieTitle = $uname = "";
	$match = "goToMovie.php";
	
	//get param form header location
	if (isset($_GET['username']) && isset($_GET['year'])) {
		$uname = $_GET['username'];
		$movieYr = $_GET['year'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" href="../css/home.css" />
        <script src="../js/movie.js"> </script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body style="overflow: hidden; background-color: #18191c; ">
		<!-- display movies according to year chosen -->
		<div id="dTitle"> <?php echo $movieYr ?> </div>
		<?php
			$sqlY = "SELECT * FROM $tableMovie WHERE year='$movieYr' ORDER BY rate ASC";
			$resY = mysqli_query($conn, $sqlY);

			if ($resY) {
				$i = 0; //number of td
				$s = 0.25; //seconds for animaiton

				echo "<form action='" .$match. "' method='post' target='_top'>";
				echo "<table>";
				echo "<input type='hidden' id='title' name='getTitle' value=\"\" />";
				echo "<input type='hidden' id='uname' name='uname' value='" .$uname. "'/>";
				echo "<tr>";

				while (($rowY = mysqli_fetch_assoc($resY))) {
					//get value from row per column
					$mTitle = $rowY['title'];
					$poster = $rowY['poster'];
					$price = $rowY['price'];

					echo "<td>";
					echo "<div class='poster' style='animation-duration:" .$s. "s'>";
				?>
					<input type="image" src="<?php echo $poster ?>" onclick="return setTitle('<?php echo $mTitle ?>');" />
				<?php
					echo "<div class='desc'>";
					echo "<span>" .$mTitle. "</span> P" .$price;
					echo "</div> </div> </td>";

					$i++;
					$s += 0.25;
					//if number of columns is 5, move to next row
					if ($i % 5 == 0) {
						echo "</tr> <tr>";
						$s = 0.25;
					}
				}

				echo "</table> </form>";
			} else {
				print_r($_POST);
				echo "Error: $sqlY" . mysqli_error($conn);
			}
		?>
	</body>
</html>