<?php
	//variables
	$uname = "";
	$match = "goToMovie.php";

	//get param from header location
	if (isset($_GET['username'])) {
		$uname = $_GET['username'];
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
		<!-- top 10 movies -->
		<table>
			<form action="<?php echo $match ?>" method="post" target="_top">
				<input type="hidden" id="title" name="getTitle" value="">
				<input type="hidden" id="uname" name="uname" value="<?php echo $uname ?>">
				<tr>
					<td>
						<div class="poster" style="animation-duration: 0.5s">
							<input type="image" src="../img/posters/knives-out" onclick="return setTitle('Knives Out');">
							<div class="desc">
								<span> Knives Out </span> P80
							</div>
						</div>
					</td>
					<td>
						<div class="poster" style="animation-duration: 0.75s">
							<input type="image" src="../img/posters/your-name" onclick="return setTitle('Kimi no Nawa');">
							<div class="desc">
								<span> Kimi no Nawa </span> P50
							</div>
						</div>
					</td>
					<td>
						<div class="poster" style="animation-duration: 1s">
							<input type="image" src="../img/posters/bad-genius" onclick="return setTitle('Bad Genius');">
							<div class="desc">
								<span> Bad Genius </span> P90
							</div>
						</div>
					</td>
					<td>
						<div class="poster" style="animation-duration: 1.25s">
							<input type="image" src="../img/posters/enola-holmes" onclick="return setTitle('Enola Holmes');">
							<div class="desc">
								<span> Enola Holmes </span> P55
							</div>
						</div>
					</td>
					<td>
						<div class="poster" style="animation-duration: 1.5s">
							<input type="image" src="../img/posters/parasite" onclick="return setTitle('Parasite');">
							<div class="desc">
								<span> Parasite </span> P75
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="poster" style="animation-duration: 0.5s">
							<input type="image" src="../img/posters/peninsula" onclick="return setTitle('Peninsula');">
							<div class="desc">
								<span> Peninsula </span> P40
							</div>
						</div>
					</td>
					<td>
						<div class="poster" style="animation-duration: 0.75s">
							<input type="image" src="../img/posters/happy-old-year" onclick="return setTitle('Happy Old Year');">
							<div class="desc">
								<span> Happy Old Year </span> P80
							</div>
						</div>
					</td>
					<td>
						<div class="poster" style="animation-duration: 1s">
							<input type="image" src="../img/posters/spiderverse" onclick="return setTitle('Spiderverse');">
							<div class="desc">
								<span> Spiderverse </span> P50
							</div>
						</div>
					</td>
					<td>
						<div class="poster" style="animation-duration: 1.25s">
							<input type="image" src="../img/posters/glass" onclick="return setTitle('Glass');">
							<div class="desc">
								<span> Glass </span> P70
							</div>
						</div>
					</td>
					<td>
						<div class="poster" style="animation-duration: 1.5s">
							<input type="image" src="../img/posters/maleficent-1" onclick="return setTitle('Maleficent');">
							<div class="desc">
								<span> Maleficent </span> P60
							</div>
						</div>
					</td>
				</tr>
			</form>
		</table>

	</body>
</html>