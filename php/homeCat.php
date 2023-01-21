<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$movieGen = $uname = "";
	$icon = "../icon.png";
	$match = "goToMovie.php";

	//get param from head location
	if (isset($_GET['username']) && isset($_GET['category'])) {
		$uname = $_GET['username'];
		$movieGen = $_GET['category'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" href="../css/home.css" />
        <script src="../js/movie.js"> </script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body style="background-color: #18191c; ">
		<!-- display 10 movies max according to chosen category -->
		<div id="dTitle"> <?php echo $movieGen ?> </div>
		<?php
			$sqlC = "SELECT * FROM $tableMovie WHERE genre LIKE '%$movieGen%' ORDER BY rate ASC LIMIT 10";
			$resC = mysqli_query($conn, $sqlC);

			if ($resC) {
				$i = 0; //number of td
				$s = 0.25; //seconds for animation

				echo "<form action='" .$match. "' method='post' target='_top'>";
				echo "<table>";
				echo "<input type='hidden' id='title' name='getTitle' value=\"\">";
				echo "<input type='hidden' id='uname' name='uname' value='" .$uname. "'>";
				echo "<tr>";
				while (($rowC = mysqli_fetch_assoc($resC))) {
					//get value from row per column
					$mTitle = $rowC['title'];
					$poster = $rowC['poster'];
					$price = $rowC['price'];

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
				echo "Error: $sqlC" . mysqli_error($conn);
			}
		?>
	</body>
</html>