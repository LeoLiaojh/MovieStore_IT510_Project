<!-- HTML Header -->
<?php
	$title = $_GET['Name'];
	include "header.php";
?>

<style type="text/css">
	.movie_detail span{
		display: block;
		position: relative;
	}
	.movie_detail .movie_name {
		font-size: 2.4rem;
		margin-bottom: 20px;
	}
	.movie_detail .movie_year {
		font-size: 1.2rem;
	}
	.movie_detail .movie_price {
		font-size: 1.2rem;
		font-weight: bolder;
		margin-bottom: 40px;
	}
	.submit_movie {
		width: 100%;
	}
	.form-control {
		width: 40%;
	}

	.description {
		margin-top: 60px;
	}
	.description h3 {
		display: block;
		width: 100%;
		margin-bottom: 30px;
	}
	.description p {
		line-height: 35px;
	}
	.cast .w-120{
		margin-top: 20px;
		margin-left: 20px;
		cursor: pointer;
	}
	.cast-button {
		width: 120px;
		height: 120px;
		border-radius: 100%;
		background-color: #ddd;
		overflow: hidden;
	}
	.cast-button img {
		display: block;
		width: 100%;
		height: 100%;
	}
	.cast span {
		display: block;
		text-align: center;
	}
	.cast h3,
	.add-info h3 {
		display: block;
		width: 100%;
		padding-left: 15px;
		margin-top: 60px;
		margin-bottom: 30px;
	}
	.add-info .col-3 {
		margin-top: 20px;
		margin-bottom: 80px;
	}
	.add-info h4 {
		font-size: 1.2rem;
		font-weight: bold;
	}
	.add-info span {
		font-size: 1rem;
		color: #333;
	}
</style>

<div class="container movie_category">
	<div class="row">
		<div class="col-3">

<?php
# Connction
$sqlcon = new mysqli("localhost", "root", "", "movie_store");
if ($sqlcon->connect_error) {
    die("Connection failed: " . $sqlcon->connect_error);
} else {
	# Add hot credit
	$sql_hot = "UPDATE movies SET hotcredit = hotcredit + 1 WHERE MovieID=". $_GET['id'];
	$sqlcon->query($sql_hot);


	# Get Ads from DB
	$sql = "SELECT MovieID, MovieName, Year, Duration, Studio, Description, IsRent, IsSell, IsDownload, picture FROM movies WHERE MovieID =". $_GET['id'];
	$result = $sqlcon->query($sql);
	$row = $result->fetch_assoc();
	echo 
		'<img src="'. $row['picture']. '" class="img-fluid" alt="Responsive image"></div><div class="col-9 movie_detail">' .
		'<span class="movie_name">'. $row['MovieName']. '</span>' .
		'<span class="movie_year">'. $row['Year']. ' - '. $row['Duration']. ' - ';
	$sql2 = "SELECT G.GenreName FROM genres AS G, movies AS M, moviegenre AS MG WHERE G.GenreID = MG.GenreID AND M.MovieID = MG.MovieID AND MG.MovieID = ". $row['MovieID'];
	$result2 = $sqlcon->query($sql2);
	while($row2 = $result2->fetch_assoc()) {
		echo
			$row2['GenreName']. " ";
	}
	echo '</span><span class="movie_price">';
	if ($row['IsSell']==1) {
		# code...
		$sql3 = 'SELECT price FROM forsell WHERE MovieID = '. $row['MovieID'];
		$result3 = $sqlcon->query($sql3);
		$row3 = $result3->fetch_assoc();
		echo 
			'price: $'. $row3['price']. '</span><div class="row"><div class="col-3"><button class="btn btn-primary submit_movie" type="button" onclick="checkout_buy()">Buy</button></div><div class="col-9"><select id="sell_option" class="form-control">'.
			'<option value='. $row3['price']. ' selltype="1" selected="selected">I want to buy it.</option>';
	}
	if ($row['IsRent']==1) {
		# code...
		$sql4 = 'SELECT price FROM forrent WHERE MovieID = '. $row['MovieID'];
		$result4 = $sqlcon->query($sql4);
		$row4 = $result4->fetch_assoc();
		if ($row['IsSell']==1) {
			# code...
			echo '<option value='. $row4['price']. ' selltype="2">I want to rent it.</option>';
		} else {
			echo 
			'price: $'. $row4['price']. '</span><div class="row"><div class="col-3"><button class="btn btn-primary submit_movie" type="button" onclick="checkout_buy()">Buy</button></div><div class="col-9"><select id="sell_option" class="form-control">'.
			'<option value='. $row4['price']. ' selltype="2" selected="selected">I want to rent it.</option>';
		}
	}
	if ($row['IsDownload']==1) {
		# code...
		$sql5 = 'SELECT price FROM fordownload WHERE MovieID = '. $row['MovieID'];
		$result5 = $sqlcon->query($sql5);
		$row5 = $result5->fetch_assoc();
		if ($row['IsSell']==1 || $row['IsDownload']==1) {
			# code...
			echo '<option value='. $row5['price']. ' selltype="3">I want to download it.</option>';
		} else {
			echo 
			'price: $'. $row5['price']. '</span><div class="row"><div class="col-3"><button class="btn btn-primary submit_movie" type="button" onclick="checkout_buy()">Buy</button></div><div class="col-9"><select id="sell_option" class="form-control">'.
			'<option value='. $row5['price']. ' selltype="3" selected="selected">I want to download it.</option>';
		}
	}
	echo 
		'</select></div><div class="col-3" style="margin-top: 20px;"><button class="btn btn-success submit_movie" type="submit" onclick="add_cart()">Add to Cart</button></div></div></div></div><div class="row description"><div class="col-12"><h3>Description</h3>'. 
		'<p>'. $row['Description']. '</p></div></div>';

	#casts
	echo '<div class="row cast"><h3>Cast and crew</h3>';
	$sql6 = 'SELECT C.CastID, C.picture, C.Cast_F_Name, C.Cast_L_Name FROM casts AS C, movies AS M, moviecast AS MC WHERE M.MovieID = MC.MovieID AND C.CastID = MC.CastID AND MC.MovieID ='. $row['MovieID'];
	$result6 = $sqlcon->query($sql6);
	while($row6 = $result6->fetch_assoc()) {
		$cast_location = "'casts.php?id=". $row6['CastID']. "&name=". $row6['Cast_F_Name']. " ". $row6['Cast_L_Name']. "'";
		echo 
			'<div class="w-120" onclick="location.href='. $cast_location. '"><div class="cast-button">'. 
			'<img src="'. $row6['picture']. '">'.
			'</div><span>'. $row6['Cast_F_Name']. ' '. $row6['Cast_L_Name'].'</span></div>';
	}
	echo '</div>';

	#additional info
	echo 
		'<div class="row add-info"><h3 style="margin-top: 120px;">Additional info</h3><div class="col-3">'. 
		'<h4>Directors</h4><span>';
	$sql7 = 'SELECT C.Cast_F_Name, C.Cast_L_Name, C.IsDirector FROM casts AS C, movies AS M, moviecast AS MC WHERE M.MovieID = MC.MovieID AND C.CastID = MC.CastID AND MC.MovieID ='. $row['MovieID'];
	$result7 = $sqlcon->query($sql7);
	while($row7 = $result7->fetch_assoc()) {
		if ($row7['IsDirector']==1) {
			# code...
			echo $row7['Cast_F_Name']. ' '. $row7['Cast_L_Name'];
		}
	}
	echo 
		'</span></div><div class="col-3">'. 
		'<h4>Released year</h4><span>'. $row['Year']. '</span></div><div class="col-3">'. 
		'<h4>Genres</h4><span>';
	$sql8 = "SELECT G.GenreName FROM genres AS G, movies AS M, moviegenre AS MG WHERE G.GenreID = MG.GenreID AND M.MovieID = MG.MovieID AND MG.MovieID = ". $row['MovieID'];
	$result8 = $sqlcon->query($sql8);
	while($row8 = $result8->fetch_assoc()) {
		echo
			$row8['GenreName']. "<br>";
	}
	echo	
		'</span></div><div class="col-3">'. 
		'<h4>Studio</h4><span>'. $row['Studio']. '</span></div><div class="col-3">'. 
		'<h4>Writers</h4><span>';
	$sql9 = 'SELECT C.Cast_F_Name, C.Cast_L_Name, C.IsWriter FROM casts AS C, movies AS M, moviecast AS MC WHERE M.MovieID = MC.MovieID AND C.CastID = MC.CastID AND MC.MovieID ='. $row['MovieID'];
	$result9 = $sqlcon->query($sql9);
	while($row9 = $result9->fetch_assoc()) {
		if ($row9['IsWriter']==1) {
			# code...
			echo $row9['Cast_F_Name']. ' '. $row9['Cast_L_Name'];
		}
	}
	echo	
		'</span></div><div class="col-3">'. 
		'<h4>Subtitles</h4><span>';
	$sql10 = 'SELECT S.SubName FROM subtitles AS S, movies AS M, moviesubtitle AS MS WHERE M.MovieID = MS.MovieID AND S.SubID = MS.SubID AND MS.MovieID ='. $row['MovieID'];
	$result10 = $sqlcon->query($sql10);
	while($row10 = $result10->fetch_assoc()) {
		# code...
		echo $row10['SubName']. '<br>';
	}
	echo 
		'</span></div><div class="col-3">'. 
		'<h4>Duration</h4><span>'. $row['Duration']. '</span></div></div></div>';
}


#Close
$sqlcon -> close();
?>

<!-- HTML Footer -->
<?php include "footer.php"; ?>