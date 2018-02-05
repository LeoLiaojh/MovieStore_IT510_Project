<!-- HTML Header -->
<?php
	$title = $_GET['name'];
	include "header.php";
?>

<style type="text/css">
	.cast .w-300{
		width: 300px;
		height: 300px;
		border-radius: 100%;
		overflow: hidden;
	}
	.cast img {
		width: 100%;
		height: 100%;
	}
	.cast span {
		display: block;
		position: relative;
		padding-left: 60px;
	}
	.cast .cast_name {
		margin-top: 50px;
		font-size: 3rem;
		font-weight: bold;
	}
	.cast .cast_role {
		font-size: 1.5rem;
	}
	.films h3{
		display: block;
		width: 100%;
		margin-top: 120px;
		margin-bottom: 60px;
	}
</style>
<div class="container movie_category">
	<div class="row cast">
		<div class="w-300">

<?php
	$sqlcon = new mysqli("localhost", "root", "", "movie_store");
	if ($sqlcon->connect_error) {
	    die("Connection failed: " . $sqlcon->connect_error);
	} else {
		# Get Ads from DB
		$sql = "SELECT picture, IsDirector, IsWriter, Gender, Information FROM casts WHERE CastID =". $_GET['id'];
		$result = $sqlcon->query($sql);
		$row = $result->fetch_assoc();
		echo
			'<img src="'. $row['picture']. '" class="img-fluid" alt="Responsive image">'.
			'</div><div class="col"><span class="cast_name">'. $_GET['name']. '</span><span class="cast_role">';
		if ($row['IsDirector']==1) {
			# code...
			echo "Director";
		} elseif ($row['IsWriter']==1) {
			# code...
			echo "Writer";
		} elseif ($row['Gender']==1) {
			# code...
			echo "Actor";
		} else {
			echo "Actress";
		}
		echo 
			'</span><span class="information">'. $row['Information'].'</span></div></div>'.
			'<div class="row films"><h3>Filmography</h3>';
		$sql2 = "SELECT M.picture, M.MovieID, M.MovieName, M.Year FROM movies AS M, casts AS C, moviecast AS MC WHERE M.MovieID = MC.MovieID AND C.CastID = MC.CastID AND MC.CastID =". $_GET['id'];
		$result2 = $sqlcon->query($sql2);
		while($row2 = $result2->fetch_assoc()) {
			$movie_location = "'movies.php?id=". $row2['MovieID']. "&Name=". $row2['MovieName']. "'";
			echo
				'<div class="col-2" onclick="location.href='. $movie_location. '"><div class="movie_info">'.
				'<img src="'. $row2['picture']. '" class="img-fluid" alt="Responsive image">'.
				'<span class="movie_name">'. $row2['MovieName']. '</span>'. 
				'<span class="movie_year">'. $row2['Year']. '</span></div></div>';
		}

		echo '</div></div>';
	}

	#Close
	$sqlcon -> close();
?>

<!-- HTML Footer -->
<?php include "footer.php"; ?>