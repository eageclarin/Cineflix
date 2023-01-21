<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$tableRent = "Rent";
	$match = "updateMovie.php";
	$uname = $delete = "";

	//get param from header location
	if (isset($_GET['username'])) {
		$uname = $_GET['username'];
	}

	//solve for sum total
	$sqlTotal = "SELECT SUM(total) AS sumPrice FROM $tableRent WHERE status='pending'";
	$resTotal = mysqli_query($conn, $sqlTotal);
	$rowTotal = mysqli_fetch_assoc($resTotal);
	$sum = $rowTotal['sumPrice'];
?>

<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" href="../css/tickets.css" />
        <script src="../js/movie.js"> </script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body style="overflow-x: hidden; background-color: #18191c; ">
		<!-- display all orders -->
		<?php
			$sqlO = "SELECT * FROM $tableRent WHERE status='pending' and user='$uname' ORDER BY id ASC";
			$resO = mysqli_query($conn, $sqlO);

			if ($resO) {
				echo "<table>";
				echo "<tr> <td> </td>
						<td width='10%'> </td>
						<td> Movie </td>
						<td> Name </td>
						<td> Contact No. </td>
						<td> Address </td>
						<td> No. of Days </td>
						<td> Price </td>
						<td> Total </td>
					<td> </td> </tr>";

				$i = 1; //index numbers
				$s = 0.25; //seconds for animation
				while (($rowO = mysqli_fetch_assoc($resO))) {
					//get column data from row
					$mTitle = $rowO['title'];
					$poster = $rowO['poster'];
					$name = $rowO['name'];
					$contact = $rowO['contact'];
					$address = $rowO['address'];
					$days = $rowO['rDays'];
					$price = $rowO['price'];
					$total = $rowO['total'];

					echo "<tr style='font-family: montserrat m; animation-duration:".$s."s'>";
					echo "<td class='in'>" .$i. "</td>";
					echo "</form>";
				?>
					<td id="thumbnail">
						<form action="goToMovie.php" method="post" target="_top">
							<input type="hidden" name="uname" value="<?php echo $uname ?>" />
							<input type="hidden" id="title" name="getTitle" value="">
							<input type="image" src="<?php echo $poster ?>" class="image" onclick="return setTitle('<?php echo $mTitle ?>');" style="width: 100px;" />
						</form>
					</td>
				<?php
					echo "<form action='" .$match. "' method='post' target='_top'>";
					echo "<input type='hidden' name='uname' value='" .$uname. "' />";
					echo "<input type='hidden' id='title' name='getTitle' value='" .$mTitle. "''>";
					echo "<td class='in'>" .$mTitle. "</td>";
					echo "<td class='in'>" .$name. "</td>";
					echo "<td class='in'>" .$contact. "</td>";
					echo "<td class='in'>" .$address. "</td>";
					echo "<td class='in'>" .$days. " </td>";
					echo "<td class='in'> xP" .$price. ".00 </td>";
					echo "<td class='in'> P" .$total. ".00 </td>";
				?>

					<td class='in'>
						<input type="submit" name="delete" value="x" onclick="return setTitle('<?php echo $mTitle ?>');" />
					</td> </tr>

				<?php
					$i++;
					$s += 1;
				}

				echo "</table>";
				echo "<div class='payment'>";
				echo "Total: " .$sum. ".00";
				echo "<input type='submit' name='pay' value='Pay' />";
				echo "</div>";
				echo "</form>";
			} else {
				print_r($_POST);
				echo "Error: $sqlO" . mysqli_error($conn);
			}
		?>
	</body>
</html>