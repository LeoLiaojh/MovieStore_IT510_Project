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
		<div class="col-12">
			<div class="order_info">
				<span>Order Number: 109012930123</span>
				<span>Date: 2018-02-02</span>
				<span>Total: $87.77</span>
				<div class="items">
					<b>Items:</b>
					<ul>
						<li>Batman</li>
						<li>Batman</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-12">
			<div class="order_info">
				<span>Order Number: 109012930123</span>
				<span>Date: 2018-02-02</span>
				<span>Total: $87.77</span>
				<div class="items">
					<b>Items:</b>
					<ul>
						<li>Batman</li>
						<li>Batman</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- HTML Footer -->
<?php include "footer.php"; ?>