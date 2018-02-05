<!-- HTML Header -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<style type="text/css">
	body {
		background-color: #0c3d7180;
	}
	.log-title {
		display: block;
		width: 100%;
		text-align: center;
		font-size: 2.4rem;
		color: #fff;
		margin-top: 120px;
		margin-bottom: 30px;
	}
	.log-box {
		display: block;
		position: relative;
		top: 30%;
		width: 500px;
		padding: 30px 15px;
		margin: auto;
		background-color: #fff;
		border-radius: 12px;
	}
	.log-box button{
		display: block;
		width: 120px;
	}
	.log-box a {
		padding-left: 5px;
	}
</style>
<div class="log-title">
	Log In
</div>
<div class="log-box">
	<div class="form-group">
	    <label for="exampleInputEmail1">Username</label>
	    <input type="email" class="form-control" id="user_name" placeholder="Enter your email">
	    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
	</div>
	<div class="form-group">
	    <label for="exampleInputPassword1">Password</label>
	    <input type="password" id="password" class="form-control" placeholder="Enter your password">
	    <a href="">forgot my password?</a>
	</div>
	<button type="submit" class="btn btn-primary" onclick="log_submit()">Submit</button>
</div>

<script type="text/javascript">
	function log_submit() {
		var user_name = $("#user_name").val();
		var password = $("#password").val();

		$.ajax({
			method: "POST",
			url: "confirm_login.php",
			dataType: "json",
			data: {
		  		"Username" : user_name,
		  		"Password" : password
			},
			success: function(e) {
				if(e.result == "0000") {
					location.href = "index.php";
				} else {
					alert(e.message);
				}
			},
			error: function() {
				alert("Connection error.");
			}
		});
	}
</script>

<!-- HTML Footer -->
<?php include "footer.php"; ?>