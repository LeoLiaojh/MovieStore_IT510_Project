<?php
	#confirm sign up
	$username = $_POST['Username'];
	$password = $_POST['Password'];

	header('Content-Type: application/json');
	if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
		# code...
		if ($password != null) {
			# code...
			# Check the username from database
			$sqlcon = new mysqli("localhost", "root", "", "movie_store");
			if ($sqlcon->connect_error) {
			    die("Connection failed: " . $sqlcon->connect_error);
			} else {
				# Get Ads from DB
				$sql = "SELECT UserName, Password FROM users WHERE UserName='". $username. "'";
				$result = $sqlcon->query($sql);
				$row = $result->fetch_assoc();

				if ($result->num_rows > 0) {
					if ($row['Password'] != "$password") {
						# code...
						echo json_encode(array('result' => '1003', 'message' => 'Invalid username or password.'));
					} else {
						$expire = time() + 30*24*60*60;
					    setcookie("user", "$username", $expire);
					    echo json_encode(array('result' => '0000', 'message' => 'Log in successful!'));
					}
				} else {
					echo json_encode(array('result' => '1004', 'message' => 'Invalid username or password.'));
				}
			}

			#Close
			$sqlcon -> close();
		} else {
			echo json_encode(array('result' => '1002', 'message' => 'Enter you password.'));
		}
	} else {
		echo json_encode(array('result' => '1001', 'message' => 'Invalid username.'));
	}
?>