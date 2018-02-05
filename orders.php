<!-- HTML Header -->
<?php
	$title = "Orders";
	include "header.php";
?>

<style type="text/css">
	.orders h3 {
		margin-top: 60px;
		margin-bottom: 30px;
		padding-left: 15px;
	}
	.order_info {
		margin-top: 20px;
		margin-bottom: 10px;
		padding: 15px;
		border-color: #bdd3ea80;
		background-color: #f8f9fa;
	}
	.order_info:hover {
		cursor: pointer;
	}
	.order_info span {
		display: block;
		position: relative;
		width: 50%;
		float: left;
	}
	.items {
		width: 50%;
	}
</style>

<div class="container orders">
	<div class="row">
		<h3>Orders</h3>
		<?php
			$username = $_COOKIE['user'];

			# Check the username from database
			$sqlcon = new mysqli("localhost", "root", "", "movie_store");
			if ($sqlcon->connect_error) {
			    die("Connection failed: " . $sqlcon->connect_error);
			} else {
				# get user id
				$sql = "SELECT UserID FROM users WHERE UserName ='". $_COOKIE['user']. "'";
				$result = $sqlcon->query($sql);
				$row = $result->fetch_assoc();
				$userid = $row['UserID'];

				# get order info
				$sql2 = "SELECT OrderID, OrderDate, TotalPrice, MovieID FROM orders WHERE UserID = ". $userid. " ORDER BY OrderDate DESC";
				$result2 = $sqlcon->query($sql2);
				if ($result2->num_rows > 0) {
					while ($row2 = $result2->fetch_assoc()) {
						# get movie name
						$sql3 = "SELECT MovieName FROM movies WHERE MovieID =". $row2['MovieID'];
						$result3 = $sqlcon->query($sql3);
						$row3 = $result3->fetch_assoc();
						$movie_name = $row3['MovieName'];

						echo
							'<div class="col-12"><div class="order_info">'.
							'<span>Order Number: '. $row2['OrderID']. '</span>'.
							'<span>Date: '. $row2['OrderDate']. '</span>'.
							'<span>Total: $'. $row2['TotalPrice']. '</span><div class="items"><b>Item:</b>'.
							'<ul><li>'. $movie_name. '</li></ul></div></div></div>';

					}
				} else {
					echo json_encode(array('result' => '1001', 'message' => 'Error.'));
				}
			}

			#Close
			$sqlcon -> close();
		?>
	</div>
</div>

<!-- HTML Footer -->
<?php include "footer.php"; ?>