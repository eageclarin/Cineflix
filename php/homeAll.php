<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$uname = $sort = $order = $oorder = "";
	$icon = "../icon.png";
	$match = "goToMovie.php";

	//get param from header location
	if (isset($_GET['username']) && isset($_GET['sort']) && isset($_GET['order'])) {
		$uname = $_GET['username'];
		$sort = $_GET['sort'];
		$order = $_GET['order'];

		if ($sort == 'title' && $_GET['order'] == 'ASC') {
			$oorder = "Title (A-Z)";
		} else if ($sort == 'title' && $_GET['order'] == 'DESC') {
			$oorder = "Title (Z-A)";
		} else if ($sort == 'year' && $_GET['order'] == 'ASC') {
			$oorder = "Year (Old-New)";
		} else if ($sort == 'year' && $_GET['order'] == 'DESC') {
			$oorder = "Year (New-Old)";
		} else if ($sort == 'rate' && $_GET['order'] == 'ASC') {
			$oorder = "Rate (5-0 ★)";
		} else if ($sort == 'rate' && $_GET['order'] == 'DESC') {
			$oorder = "Rate (0-5 ★)";
		} else if ($sort == 'price' && $_GET['order'] == 'ASC') {
			$oorder = "Price (Low-High)";
		} else if ($sort == 'price' && $_GET['order'] == 'DESC') {
			$oorder = "Price (High-Low)";
		}
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
		<!-- display all movies; sorted and in order by param from header location -->
		<div id="dTitle"> <?php echo $oorder ?> </div>
		<?php
			//search from table
			$sqlA = "SELECT * FROM $tableMovie ORDER BY $sort $order";
			$resA = mysqli_query($conn, $sqlA);

			if ($resA) {
				$i = 0; //number of td
				$s = 0.25; //seconds for animation
			
				echo "<form action='" .$match. "' method='post' target='_top'>";
				echo "<table>";
				echo "<input type='hidden' id='title' name='getTitle' value=\"\">";
				echo "<input type='hidden' id='uname' name='uname' value='" .$uname. "'>";
				echo "<tr>";
				while (($rowA = mysqli_fetch_assoc($resA))) {
					//get column data from row
					$mTitle = $rowA['title'];
					$poster = $rowA['poster'];
					$price = $rowA['price'];

					echo "<td>";
					echo "<div class='poster' style='animation-duration:" .$s. "s'>";
				?>
					<input type="image" src="<?php echo $poster ?>" onclick="return setTitle('<?php echo $mTitle ?>');">
				<?php
					echo "<div class='desc'>";
					echo "<span>" .$mTitle. "</span> P" .$price;
					echo "</div> </div> </td>";

					$i++;
					$s += 0.25;

					//if number of column is 5, got to next row
					if ($i % 5 == 0) {
						echo "</tr> <tr>";
						$s = 0.25;
					}
				}

				echo "</table> </form>";
			} else {
				print_r($_POST);
				echo "Error: $sqlA" . mysqli_error($conn);
			}
		?>
	</body>
</html>