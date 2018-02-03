<!-- HTML Header -->
<?php
	$title = "Movie Store";
	include "header.php";
?>

<div class="container" id="advertise_imgs">
	<div class="row">
		<div class="col-8">
			<div class="advertise_img">
				<?php
					# Connction
					$sqlcon = new mysqli("localhost", "root", "", "movie_store");
					if ($sqlcon->connect_error) {
					    die("Connection failed: " . $sqlcon->connect_error);
					} else {
						$sql = "SELECT AdsText, Picture FROM advertisements";
						$result = $sqlcon->query($sql);

						if ($result->num_rows > 0) {
						    // output data of each row
						    while($row = $result->fetch_assoc()) {
						        echo '<img src='. $row['Picture']. ' class="img-fluid" alt="Responsive image">'.
						        	 '<span class="advertise_word">'. $row['AdsText']. '</span>';
						    }
						} else {
						    echo "0 results";
						}
					}
				?>
			</div>
		</div>
		<div class="col-4">
			<div class="advertise_img">
				<img src="img/example.jpg" class="img-fluid" alt="Responsive image">
				<span class="advertise_word">Short Text</span>
			</div>
			<div class="advertise_img" style="padding-top:20px">
				<img src="img/example.jpg" class="img-fluid" alt="Responsive image">
				<span class="advertise_word">Short Text</span>
			</div>
		</div>
	</div>
</div>

<div class="container movie_category">
	<h2>New Movies</h2>
	<div class="row">
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
	</div>
</div>

<div class="container movie_category">
	<h2>Top-rented Movies</h2>
	<div class="row">
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
	</div>
</div>

<div class="container movie_category">
	<h2>Featured Movies</h2>
	<div class="row">
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
		<div class="col-2">
			<div class="movie_info">
				<img src="img/movie.jpg" class="img-fluid" alt="Responsive image">
				<span class="movie_name">BatMan: Gotham By Gaslight</span>
				<span class="movie_year">2018</span>
				<span class="movie_price">From: $33.5</span>
			</div>
		</div>
	</div>
</div>

<div class="container genres">
	<h2>Genres</h2>
	<div class="row">
		<div class="col-4">
			<ul>
				<li><a href="#">Action/Adventure</a></li>
				<li><a href="#">Animation</a></li>
				<li><a href="#">Anime</a></li>
				<li><a href="#">Comedy</a></li>
				<li><a href="#">Documentary</a></li>
				<li><a href="#">Drama</a></li>
			</ul>
		</div>
		<div class="col-4">
			<ul>
				<li><a href="#">Family</a></li>
				<li><a href="#">Foreign/Independent</a></li>
				<li><a href="#">Horror</a></li>
				<li><a href="#">Other</a></li>
				<li><a href="#">Romance</a></li>
			</ul>
		</div>
		<div class="col-4">
			<ul>
				<li><a href="#">Romantic Comedy</a></li>
				<li><a href="#">Sci-Fi/Fantasy</a></li>
				<li><a href="#">Sports</a></li>
				<li><a href="#">Thriller/Mystery</a></li>
				<li><a href="#">TV Movies</a></li>
			</ul>
		</div>
	</div>
</div>

<!-- HTML Footer -->
<?php include "footer.php"; ?>