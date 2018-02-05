<!-- HTML Header -->
<?php
	$title = $_GET['name'];
	include "header.php";
?>

<style type="text/css">
	.page_title {
		margin-top: 50px;
		margin-bottom: 60px;
	}
	.movie_list {
		position: relative;
		margin-top: 20px;
		margin-bottom: 20px;
		padding: 12px;
		border: 1px solid #fff;
		border-radius: 12px;
		-webkit-transition: .8s ease; /* Safari */
		transition: .8s ease;
	}
	.movie_list:hover {
		cursor: pointer;
		border-color: #bdd3ea80;
		background-color: #f8f9fa;
	}

	.movie_list span {
		display: block;
		position: relative;
	}
	.movie_list .movie_name_l {
		font-size: 2rem;
		margin-bottom: 15px;
	}
	.movie_list .movie_year_l {
		font-size: 1.2rem;
		color: #999;
	}
	.movie_list .movie_genre {
		font-size: 1.2rem;
		color: #666;
		margin-bottom: 25px;
	}
	.no_result span {
		display: block;
		position: relative;
		width: 100%;
		margin-top: 20px;
		margin-bottom: 50px;
		text-align: center;
		color: #ddd;
		font-size: 3rem;
	}
	.movie_list button{
		margin-top: 60px;
		margin-right: 20px;
	}
</style>

<?php
	echo 
		'<div class="container"><h2 class="page_title">'. $_GET['name']. '</h2>';

	$sqlcon = new mysqli("localhost", "root", "", "movie_store");
	if ($sqlcon->connect_error) {
	    die("Connection failed: " . $sqlcon->connect_error);
	} else {
		# Get Ads from DB
		$sql = "";
		if ($_GET['id'] == 0) {
			if (isset($_POST['search_sub'])) {
				# code...
				$content = "'%". $_POST['search_para']. "%'";
				$sql = "SELECT MovieID, MovieName, IsSell, IsRent, IsDownload, picture, Year FROM movies AS M WHERE MovieName LIKE ". $content. " OR MovieID IN ( SELECT M.MovieID FROM movies AS M, casts AS C, moviecast AS MC WHERE M.MovieID = MC.MovieID AND C.CastID = MC.CastID AND C.Cast_F_Name LIKE ". $content. " OR C.Cast_L_Name LIKE ". $content. ") ORDER BY Year";
			}
		} else {
			$sql = "SELECT M.MovieID, M.MovieName, M.IsSell, M.IsRent, M.IsDownload, M.picture, M.Year FROM movies AS M, genres AS G, moviegenre AS MG WHERE M.MovieID = MG.MovieID AND G.GenreID = MG.GenreID AND MG.GenreID =". $_GET['id']. " ORDER BY M.Year DESC";
		}
		$result = $sqlcon->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$movie_location = "'movies.php?id=". $row['MovieID']. "&Name=". $row['MovieName']. "'";
		    	echo 
		    		'<div class="row movie_list" onclick="location.href='. $movie_location. '"><div class="col-3">' .
		    		'<img src="'. $row['picture']. '" class="img-fluid" alt="Responsive image"></div><div class="col-9">' .
		    		'<span class="movie_name_l">'. $row['MovieName']. '</span>' .
		    		'<span class="movie_year_l">'. $row['Year']. '</span>';
		    	if ($row['IsSell']==1) {
		    		# code...
		    		$sql2 = "SELECT Price FROM forsell WHERE MovieID =". $row['MovieID'];
		    		$result2 = $sqlcon->query($sql2);
		    		$row2 = $result2->fetch_assoc();
		    		echo 
		    			'<button type="button" class="btn btn-success movie_sell" data-toggle="tooltip" data-placement="top" title="Price: $'. 
		    			$row2['Price']. '">' .
		    			'Sell Available</button>';
		    	}
		    	if ($row['IsRent']==1) {
		    		# code...
		    		$sql3 = "SELECT Price FROM forrent WHERE MovieID =". $row['MovieID'];
		    		$result3 = $sqlcon->query($sql3);
		    		$row3 = $result3->fetch_assoc();
		    		echo 
		    			'<button type="button" class="btn btn-success movie_sell" data-toggle="tooltip" data-placement="top" title="Price: $'. 
		    			$row3['Price']. '">' .
		    			'Rent Available</button>';
		    	}
		    	if ($row['IsDownload']==1) {
		    		# code...
		    		$sql4 = "SELECT Price FROM fordownload WHERE MovieID =". $row['MovieID'];
		    		$result4 = $sqlcon->query($sql4);
		    		$row4 = $result4->fetch_assoc();
		    		echo 
		    			'<button type="button" class="btn btn-success movie_sell" data-toggle="tooltip" data-placement="top" title="Price: $'. 
		    			$row4['Price']. '">' .
		    			'Download Available</button>';
		    	}
		    	echo '</div></div>';
		    }
		} else {
		    echo 
		    	'<div class="row no_result"><span>Ooops...No result found!</span></div>';
		}

		echo "</div>";
	}

	#Close
	$sqlcon -> close();
?>
	

<!-- HTML Footer -->
<?php include "footer.php"; ?>