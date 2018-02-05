<?php
	$movie_id = $_POST['movieID'];
	$movie_price = $_POST['price'];
	$sell_type = $_POST['sellType'];
	$username = $_COOKIE['user'];

	# Check the username from database
	$sqlcon = new mysqli("localhost", "root", "", "movie_store");
	if ($sqlcon->connect_error) {
	    die("Connection failed: " . $sqlcon->connect_error);
	} else {
		header('Content-Type: application/json');
		# code
		$sql = "SELECT UserID FROM users WHERE UserName='". $username. "'";
		$result = $sqlcon->query($sql);
		$row = $result->fetch_assoc();

		if ($result->num_rows > 0) {
			$user_id = $row['UserID'];
			$sql2 = "INSERT INTO carts (UserID, MovieID, price, SellType) VALUES (". $user_id. ", ". $movie_id. ", ". $movie_price. ", ". $sell_type. ")";
			if ($sqlcon->query($sql2) === TRUE) {
			    echo json_encode(array('result' => '0000', 'message' => 'Added successful!'));
			} else {
			    echo json_encode(array('result' => '1002', 'message' => 'Connection error!'));
			}
		} else {
			echo json_encode(array('result' => '1001', 'message' => 'Invalid username or password.'));
		}
	}

	#Close
	$sqlcon -> close();
?>