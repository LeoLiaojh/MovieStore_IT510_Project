<!-- HTML Header -->
<?php
	$title = "Movie Store";
	include "header.php";
?>

<div class="container" id="advertise_imgs">
	<!-- Swiper -->
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php
				# Connction
				$sqlcon = new mysqli("localhost", "root", "", "movie_store");
				if ($sqlcon->connect_error) {
				    die("Connection failed: " . $sqlcon->connect_error);
				} else {
					# Get Ads from DB
					$sql = "SELECT AdsText, Picture FROM advertisements";
					$result = $sqlcon->query($sql);

					if ($result->num_rows > 0) {
					    // output data of each row
					    while($row = $result->fetch_assoc()) {
					    	echo 
					    		'<div class="swiper-slide">' .
					    			'<img src='. $row['Picture']. ' class="img-fluid" alt="Responsive image">' .
					    			'<span class="advertise_word">'. $row['AdsText']. '</span>' .
					    		'</div>';
					        // echo '<img src='. $row['Picture']. ' class="img-fluid" alt="Responsive image">'.
					        // 	 '<span class="advertise_word">'. $row['AdsText']. '</span>';
					    }
					} else {
					    echo "0 results";
					}
				}

				#Close
				$sqlcon -> close();
			?>
		</div>
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div>
</div>

<div class="container movie_category">
	<h2>New Movies</h2>
	<div class="row">
		<?php
			$sqlcon = new mysqli("localhost", "root", "", "movie_store");
			if ($sqlcon->connect_error) {
			    die("Connection failed: " . $sqlcon->connect_error);
			} else {
				# Get Ads from DB
				$sql = "SELECT MovieID, MovieName, Year, IsSell, IsRent, IsDownload, Picture FROM movies ORDER BY Year DESC";
				$result = $sqlcon->query($sql);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	$location = "'movies.php?id=". $row['MovieID']. "&Name=". $row['MovieName']. "'";
				    	echo 
				    		'<div class="col-2" onclick="location.href='. $location. '">' .
				    			'<div class="movie_info">' .
				    				'<img src='. $row['Picture']. ' class="img-fluid" alt="Responsive image">' .
				    				'<span class="movie_name">'. $row['MovieName']. '</span>' .
									'<span class="movie_year">'. $row['Year']. '</span>';
						if ($row['IsSell'] == 1) {
							# code...
							$sql2 = "SELECT Price FROM forsell WHERE MovieID=". $row['MovieID'];
							$result2 = $sqlcon->query($sql2);
							$row2 = $result2->fetch_assoc();
							echo '<span class="movie_price">Sell: '. $row2['Price']. '</span>';
						} else if ($row['IsRent'] == 1) {
							# code...
							$sql3 = "SELECT Price FROM forrent WHERE MovieID=". $row['MovieID'];
							$result3 = $sqlcon->query($sql3);
							$row3 = $result3->fetch_assoc();
							echo '<span class="movie_price">Rent: '. $row3['Price']. '</span>';
						} else if ($row['IsDownload'] == 1) {
							# code...
							$sql4 = "SELECT Price FROM fordownload WHERE MovieID=". $row['MovieID'];
							$result4 = $sqlcon->query($sql4);
							$row4 = $result4->fetch_assoc();
							echo '<span class="movie_price">Download: '. $row4['Price']. '</span>';
						} else {
							echo '<span class="movie_price">Out of Stock</span>';
						}
						echo '</div></div>';

				    }
				} else {
				    echo "0 results";
				}
			}

			#Close
			$sqlcon -> close();

		?>
	</div>
</div>

<div class="container movie_category">
	<h2>Trending</h2>
	<div class="row">
		<?php
			$sqlcon = new mysqli("localhost", "root", "", "movie_store");
			if ($sqlcon->connect_error) {
			    die("Connection failed: " . $sqlcon->connect_error);
			} else {
				# Get Ads from DB
				$sql = "SELECT MovieID, MovieName, Year, IsSell, IsRent, IsDownload, Picture FROM movies ORDER BY hotcredit DESC";
				$result = $sqlcon->query($sql);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	echo 
				    		'<div class="col-2">' .
				    			'<div class="movie_info">' .
				    				'<img src='. $row['Picture']. ' class="img-fluid" alt="Responsive image">' .
				    				'<span class="movie_name">'. $row['MovieName']. '</span>' .
									'<span class="movie_year">'. $row['Year']. '</span>';
						if ($row['IsSell'] == 1) {
							# code...
							$sql2 = "SELECT Price FROM forsell WHERE MovieID=". $row['MovieID'];
							$result2 = $sqlcon->query($sql2);
							$row2 = $result2->fetch_assoc();
							echo '<span class="movie_price">Sell: '. $row2['Price']. '</span>';
						} else if ($row['IsRent'] == 1) {
							# code...
							$sql3 = "SELECT Price FROM forrent WHERE MovieID=". $row['MovieID'];
							$result3 = $sqlcon->query($sql3);
							$row3 = $result3->fetch_assoc();
							echo '<span class="movie_price">Rent: '. $row3['Price']. '</span>';
						} else if ($row['IsDownload'] == 1) {
							# code...
							$sql4 = "SELECT Price FROM fordownload WHERE MovieID=". $row['MovieID'];
							$result4 = $sqlcon->query($sql4);
							$row4 = $result4->fetch_assoc();
							echo '<span class="movie_price">Download: '. $row4['Price']. '</span>';
						} else {
							echo '<span class="movie_price">Out of Stock</span>';
						}
						echo '</div></div>';

				    }
				} else {
				    echo "0 results";
				}
			}

			#Close
			$sqlcon -> close();

		?>
	</div>
</div>

<div class="container genres">
	<h2>Genres</h2>
	<div class="row">
		<?php
			$sqlcon = new mysqli("localhost", "root", "", "movie_store");
			if ($sqlcon->connect_error) {
			    die("Connection failed: " . $sqlcon->connect_error);
			} else {
				# Get Ads from DB
				$sql = "SELECT GenreName FROM genres ORDER BY GenreID";
				$result = $sqlcon->query($sql);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	echo 
				    		'<div class="col-4">' .
				    			'<a href="#">'. $row['GenreName']. '</a>' .
				    		'</div>';
				    }
				} else {
				    echo "0 results";
				}
			}

			#Close
			$sqlcon -> close();

		?>
	</div>
</div>

<!-- HTML Footer -->
<?php include "footer.php"; ?>