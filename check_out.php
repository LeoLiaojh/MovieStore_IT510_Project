<?php
	# set up time zone
	date_default_timezone_set("America/Los_Angeles");
	
	$type = $_POST['checkType'];
	# check out from cart
	if ($type == 'cart') {
		# code...
		# Check the username from database
		$sqlcon = new mysqli("localhost", "root", "", "movie_store");
		if ($sqlcon->connect_error) {
		    die("Connection failed: " . $sqlcon->connect_error);
		} else {
			header('Content-Type: application/json');
			# code
			$sql = "SELECT UserID, MovieID, SellType, price FROM carts WHERE CartID=". $_POST['cartID'];
			$result = $sqlcon->query($sql);

			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$user_id = $row['UserID'];
				$movie_id = $row['MovieID'];
				$sell_type = $row['SellType'];
				$price = $row['price'];
				$time = date("Y-m-d h:i:sa");

				if ($sell_type == "1") {
					$sql_check = "SELECT Qty_On_Hand FROM forsell WHERE MovieID = ". $movie_id;
					$result = $sqlcon->query($sql_check);
					if ($result->num_rows > 0) {
						$row_check1 = $result->fetch_assoc();
						$qty1 = $row_check1['Qty_On_Hand'];
						if ($qty1 > 0) {
						 	# code...
							$sql2 = "UPDATE forsell SET Qty_On_Hand = Qty_On_Hand -1 WHERE MovieID = ". $movie_id;
							if (($sqlcon->query($sql2) === TRUE)) {
								$sql3 = "DELETE FROM carts WHERE CartID=". $_POST['cartID'];
								if ($sqlcon->query($sql3) === TRUE) {
									$sql4 = "INSERT INTO orders (UserID, OrderDate, TotalPrice, MovieID) VALUES (". $user_id. ", '". $time. "', ". $price. ",". $movie_id. ")";
									if ($sqlcon->query($sql4) === TRUE) {

									    echo json_encode(array('result' => '0000', 'message' => 'Checked out successful!'));
									} else {
									    echo json_encode(array('result' => '1011', 'message' => 'Connection error!'));
									}	
								} else {
								    echo json_encode(array('result' => '1010', 'message' => 'Connection error!'));
								}
							} else {
								echo json_encode(array('result' => '1013', 'message' => 'Out of Stock!'));
							}
						} else {
							echo json_encode(array('result' => '1009', 'message' => 'Out of Stock!'));
						}
					} else {
						echo json_encode(array('result' => '1008', 'message' => 'Connection error!'));
					}
				} else if ($sell_type == "2") {
					$sql_check2 = "SELECT Qty_On_Hand FROM forrent WHERE MovieID = ". $movie_id;
					$result2 = $sqlcon->query($sql_check2);
					if ($result2->num_rows > 0) {
						$row_check2 = $result2->fetch_assoc();
						$qty2 = $row_check2['Qty_On_Hand'];
						if ($qty2 > 0) {
						 	# code...
							$sql2 = "UPDATE forrent SET Qty_On_Hand = Qty_On_Hand -1 WHERE MovieID = ". $movie_id;
							if (($sqlcon->query($sql2) === TRUE)) {
								$sql3 = "DELETE FROM carts WHERE CartID=". $_POST['cartID'];
								if ($sqlcon->query($sql3) === TRUE) {
									$sql4 = "INSERT INTO orders (UserID, OrderDate, TotalPrice, MovieID) VALUES (". $user_id. ", '". $time. "', ". $price. ",". $movie_id. ")";
									if ($sqlcon->query($sql4) === TRUE) {

									    echo json_encode(array('result' => '0000', 'message' => 'Checked out successful!'));
									} else {
									    echo json_encode(array('result' => '1007', 'message' => 'Connection error!'));
									}	
								} else {
								    echo json_encode(array('result' => '1006', 'message' => 'Connection error!'));
								}
							} else {
								echo json_encode(array('result' => '1012', 'message' => 'Out of Stock!'));
							}
						} else {
							echo json_encode(array('result' => '1005', 'message' => 'Out of Stock!'));
						}
					} else {
						echo json_encode(array('result' => '1004', 'message' => 'Connection error!'));
					}
				} else if ($sell_type == "3") {
					$sql3 = "DELETE FROM carts WHERE CartID=". $_POST['cartID'];
					if ($sqlcon->query($sql3) === TRUE) {
						$sql4 = "INSERT INTO orders (UserID, OrderDate, TotalPrice, MovieID) VALUES (". $user_id. ", '". $time. "', ". $price. ",". $movie_id. ")";
						if ($sqlcon->query($sql4) === TRUE) {

						    echo json_encode(array('result' => '0000', 'message' => 'Checked out successful!'));
						} else {
						    echo json_encode(array('result' => '1003', 'message' => 'Connection error!'));
						}	
					} else {
					    echo json_encode(array('result' => '1002', 'message' => 'Connection error!'));
					}
				}
			} else {
				echo json_encode(array('result' => '1001', 'message' => 'Error.'));
			}
		}

		#Close
		$sqlcon -> close();
	} else if ($type == 'buy') {
		# check out from movie info page
		header('Content-Type: application/json');
		$username = "";
		$movie_id = $_POST['movieID'];
		$price = $_POST['price'];
		$sell_type = $_POST['sellType'];

		# look for username
		if (isset($_COOKIE['user'])) {
			# code...
			$username = $_COOKIE['user'];
		} else {
			echo json_encode(array('result' => '1200', 'message' => 'Please log in first.'));
		}

		# database connection
		$sqlcon = new mysqli("localhost", "root", "", "movie_store");
		if ($sqlcon->connect_error) {
		    die("Connection failed: " . $sqlcon->connect_error);
		} else {
			# get user id
			$sql = "SELECT UserID FROM users WHERE UserName='". $username. "'";
			$result = $sqlcon->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$user_id = $row['UserID'];
				$time = date("Y-m-d h:i:sa");

				if ($sell_type == "1") {
					$sql_check = "SELECT Qty_On_Hand FROM forsell WHERE MovieID = ". $movie_id;
					$result = $sqlcon->query($sql_check);
					if ($result->num_rows > 0) {
						$row_check1 = $result->fetch_assoc();
						$qty1 = $row_check1['Qty_On_Hand'];
						if ($qty1 > 0) {
						 	# code...
							$sql2 = "UPDATE forsell SET Qty_On_Hand = Qty_On_Hand -1 WHERE MovieID = ". $movie_id;
							if (($sqlcon->query($sql2) === TRUE)) {
								$sql4 = "INSERT INTO orders (UserID, OrderDate, TotalPrice, MovieID) VALUES (". $user_id. ", '". $time. "', ". $price. ",". $movie_id. ")";
								if ($sqlcon->query($sql4) === TRUE) {

								    echo json_encode(array('result' => '0000', 'message' => 'Checked out successful!'));
								} else {
								    echo json_encode(array('result' => '1010', 'message' => 'Connection error!'));
								}
							} else {
								echo json_encode(array('result' => '1009', 'message' => 'Out of Stock!'));
							}
						} else {
							echo json_encode(array('result' => '1008', 'message' => 'Out of Stock!'));
						}
					} else {
						echo json_encode(array('result' => '1007', 'message' => 'Connection error!'));
					}
				} else if ($sell_type == "2") {
					$sql_check2 = "SELECT Qty_On_Hand FROM forrent WHERE MovieID = ". $movie_id;
					$result2 = $sqlcon->query($sql_check2);
					if ($result2->num_rows > 0) {
						$row_check2 = $result2->fetch_assoc();
						$qty2 = $row_check2['Qty_On_Hand'];
						if ($qty2 > 0) {
						 	# code...
							$sql2 = "UPDATE forrent SET Qty_On_Hand = Qty_On_Hand -1 WHERE MovieID = ". $movie_id;
							if (($sqlcon->query($sql2) === TRUE)) {
								$sql4 = "INSERT INTO orders (UserID, OrderDate, TotalPrice, MovieID) VALUES (". $user_id. ", '". $time. "', ". $price. ",". $movie_id. ")";
								if ($sqlcon->query($sql4) === TRUE) {
								    echo json_encode(array('result' => '0000', 'message' => 'Checked out successful!'));
								} else {
								    echo json_encode(array('result' => '1006', 'message' => 'Connection error!'));
								}	
							} else {
								echo json_encode(array('result' => '1005', 'message' => 'Out of Stock!'));
							}
						} else {
							echo json_encode(array('result' => '1004', 'message' => 'Out of Stock!'));
						}
					} else {
						echo json_encode(array('result' => '1003', 'message' => 'Connection error!'));
					}
				} else if ($sell_type == "3") {
					$sql4 = "INSERT INTO orders (UserID, OrderDate, TotalPrice, MovieID) VALUES (". $user_id. ", '". $time. "', ". $price. ",". $movie_id. ")";
					if ($sqlcon->query($sql4) === TRUE) {

					    echo json_encode(array('result' => '0000', 'message' => 'Checked out successful!'));
					} else {
					    echo json_encode(array('result' => '1002', 'message' => 'Connection error!'));
					}
				}
			} else {
				echo json_encode(array('result' => '1001', 'message' => 'Error.'));
			}
		}

		#Close
		$sqlcon -> close();
	}
?>