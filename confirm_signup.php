<?php
	#confirm sign up
	$username = $_POST['Username'];
	$c_username = $_POST['C_Username'];
	$password = $_POST['Password'];
	$c_password = $_POST['C_Password'];

	header('Content-Type: application/json');
	if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
		# code...
		if ($username == $c_username) {
			# code...
			if ($password != null) {
				# code...
				if ($password == $c_password) {
					# code...
					# Check the username from database
					$sqlcon = new mysqli("localhost", "root", "", "movie_store");
					if ($sqlcon->connect_error) {
					    die("Connection failed: " . $sqlcon->connect_error);
					} else {
						# Get Ads from DB
						$sql = "SELECT * FROM users WHERE UserName='". $username. "'";
						$result = $sqlcon->query($sql);

						if ($result->num_rows > 0) {
						    echo json_encode(array('result' => '1005', 'message' => 'Username already exsists.'));
						} else {
						    $sql2 = "INSERT INTO users (UserName, Password) VALUES ('$username', '$password')";
						    if ($sqlcon->query($sql2) === TRUE) {
						    	$sql3 ="SELECT UserID FROM users WHERE UserName='". $username. "'";
						    	$result3 = $sqlcon->query($sql3);
						    	$row3 = $result3->fetch_assoc();
						    	$user_id = $row3['UserID'];

						    	$sql4 = "INSERT INTO customers (UserID) VALUES (". $user_id. ")";
						    	if ($sqlcon->query($sql4) === TRUE) {
						    		$expire = time() + 30*24*60*60;
									setcookie("user", "$username", $expire);
								    echo json_encode(array('result' => '0000', 'message' => 'Registered successful!'));
						    	} else {
						    		echo json_encode(array('result' => '1007', 'message' => 'Connection error!'));
						    	}
							} else {
							    echo json_encode(array('result' => '1006', 'message' => 'Connection error!'));
							}
						}
					}

					#Close
					$sqlcon -> close();
					# 
				} else {
					echo json_encode(array('result' => '1004', 'message' => 'You have enterd different password.'));
				}
			} else {
				echo json_encode(array('result' => '1003', 'message' => 'Enter you password.'));
			}
		} else
		echo json_encode(array('result' => '1002', 'message' => 'You have enterd different username.'));
	} else {
		echo json_encode(array('result' => '1001', 'message' => 'Invalid username.'));
	}
?>