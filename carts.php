<!-- HTML Header -->
<?php
	$title = "Carts";
	include "header.php";
?>

<style type="text/css">
	.carts h3 {
		margin-top: 60px;
		margin-bottom: 30px;
		padding-left: 15px;
	}
	.cart_info {
		margin-top: 20px;
		margin-bottom: 10px;
		padding: 15px;
		bcart-color: #bdd3ea80;
		background-color: #f8f9fa;
	}
	.cart_info:hover {
		cursor: pointer;
	}
	.cart_info span {
		display: block;
		position: relative;
		width: 50%;
		float: left;
		padding: 20px 0;
	}
	.carts form {
		display: block;
		position: relative;
		width: 100%;
	}
	.carts .form-check {
		float: left;
		padding-top: 20px;
		padding-bottom: 20px;
	}
	.carts button {
		margin-left: 20px;
		margin-top: 20px;
		margin-bottom: 60px;
	}
</style>
<div class="container carts">
	<div class="row">
		<h3>Carts</h3>
		<?php
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
				# code
				$sql2 = "SELECT M.MovieName, C.price, C.SellType, C.CartID FROM customers AS CU, movies AS M, carts AS C WHERE M.MovieID = C.MovieID AND CU.UserID = C.UserID AND CU.UserID = ". $userid;
				$result2 = $sqlcon->query($sql2);
				if ($result->num_rows > 0) {
					while ($row2 = $result2->fetch_assoc()) {
						echo '<div class="col-12"><div class="cart_info"><span><b>Item:</b> '. $row2['MovieName']. '</span>';
						if ($row2['SellType']==1) {
							echo '<span><b>Puchase Type:</b> Sell</span>';
						} else if ($row2['SellType']==2) {
							echo '<span><b>Puchase Type:</b> Rent</span>';
						} else if ($row2['SellType']==3) {
							echo '<span><b>Puchase Type:</b> Download</span>';
						}
						echo
							'<span><b>Total:</b> $'. $row2['price']. '</span>'. 
							'<div class="form-check"><input type="checkbox" value="'. $row2['CartID']. '"class="form-check-input">' .
							'<label class="form-check-label">Check me out</label></div>' .
							'<div style="clear:both;"></div></div></div>';
					}
				} else {
					echo json_encode(array('result' => '1001', 'message' => 'Error.'));
				}
			}

			#Close
			$sqlcon -> close();
		?>

		<button class="btn btn-success" type="button" onclick="checkout_cart()">Check out</button>
		<button class="btn btn-primary" type="button" onclick="location.href='index.php'">Back to shopping</button>
	</div>
</div>

<!-- HTML Footer -->
<?php include "footer.php"; ?>