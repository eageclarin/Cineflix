<?php
	require 'connect.php';
	include 'movies.php';

	//variables
	$tableRent = "Rent";
	$match = "goToMovie.php";
	$uname = $delete = "";

	//get param from header location
	if (isset($_GET['username'])) {
		$uname = $_GET['username'];
	}
?>

<!DOCTYPE html>
<html>
	<head>
        <link rel="stylesheet" href="../css/tickets.css" />
        <script src="../js/movie.js"> </script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body style="overflow-x: hidden; background-color: #18191c; ">
		<!-- display list of paid movies -->
		<?php
			$sqlC = "SELECT * FROM $tableRent WHERE status='paid' and user='$uname' ORDER BY id ASC";
			$resC = mysqli_query($conn, $sqlC);

			if ($resC) {
				echo "<form action='" .$match. "' method='post' target='_top'>";
				echo "<table>";
				echo "<input type='hidden' name='uname' value='" .$uname. "' />";
				echo "<input type='hidden' id='title' name='getTitle' value=\"\">";
				echo "<tr> <td> </td>
						<td width='10%'> </td>
						<td> Movie </td>
						<td> Name </td>
						<td> Contact No. </td>
						<td> Address </td>
						<td> Start Date <br> End Date </td>
						<td> Code </td>
						</tr>";

				$i = 1; //index number
				$s = 0.25; //seconds for animation
				while (($rowC = mysqli_fetch_assoc($resC))) {
					//get column data from row
					$mTitle = $rowC['title'];
					$code = $rowC['code'];
					$poster = $rowC['poster'];
					$name = $rowC['name'];
					$contact = $rowC['contact'];
					$address = $rowC['address'];
					$start = $rowC['rentStart'];
					$end = $rowC['rentEnd'];

					//Search match from rent table if rented/paid
					$sqlRented = "SELECT * FROM Rent WHERE user='$uname' and title='$mTitle'";
					$resRented = mysqli_query($conn, $sqlRented);
					$countt = mysqli_num_rows($resRented);
					$rowR = mysqli_fetch_assoc($resRented);
					
					//check if expired
					$rentToday = date('Y-m-d', time());
					$rentEnd = $rowR['rentEnd'];

					if ($rentEnd <= $rentToday) { //if expired delete from table
						$sqlDel = "DELETE FROM $tableRent WHERE user='$uname' and title='$mTitle'";
						mysqli_query($conn, $sqlDel);

					} else {
						echo mysqli_error($conn);
					}

					echo "<tr style='font-family: montserrat m; animation-duration:".$s."s'>";
					echo "<td class='in'>" .$i. "</td>";
				?>

					<td id="thumbnail">
						<input type="image" class="image" src="<?php echo $poster ?>" onclick="return setTitle('<?php echo $mTitle ?>')" style="width: 100px;" />
					</td>

				<?php
					echo "<td class='in'>" .$mTitle. "</td>";
					echo "<td class='in'>" .$name. "</td>";
					echo "<td class='in'>" .$contact. "</td>";
					echo "<td class='in'>" .$address. "</td>";
					echo "<td class='in'>" .$start. "<br>" .$end. "</td>";
					echo "<td class='in'>" .$code. "</td>";
				?>

				<?php
					$i++;
					$s += 1;
				}

				echo "</table></form>";
			} else {
				print_r($_POST);
				echo "Error: $sqlC" . mysqli_error($conn);
			}
		?>
	</body>
</html>