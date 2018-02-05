<!-- HTML Header -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sign Up</title>
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
		margin-top: 60px;
		margin-bottom: 30px;
	}
	.log-box {
		display: block;
		position: relative;
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
	Sign Up
</div>
<div class="log-box">
	<div class="form-group">
	    <label for="exampleInputEmail1">Username</label>
	    <input type="email" id="user_name" class="form-control" placeholder="Enter your email">
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1">Confirm Username</label>
	    <input type="email" id="c_user_name" class="form-control" placeholder="Enter your email">
	</div>
	<div class="form-group">
	    <label for="exampleInputPassword1">Password</label>
	    <input type="password" id="password" class="form-control" placeholder="Enter your password">
	</div>
	<div class="form-group">
	    <label for="exampleInputPassword1">Confirm Password</label>
		<input type="password" id="c_password" class="form-control" placeholder="Enter your password">
	</div>
	<button type="submit" name="signup_sub" class="btn btn-primary" onclick="su_submit()">Submit</button>
</div>

<script type="text/javascript">
	function su_submit() {
		var user_name = $("#user_name").val();
		var c_user_name = $("#c_user_name").val();
		var password = $("#password").val();
		var c_password = $("#c_password").val();

		$.ajax({
			method: "POST",
			url: "confirm_signup.php",
			dataType: "json",
			data: {
		  		"Username" : user_name,
		  		"C_Username" : c_user_name,
		  		"Password" : password,
		  		"C_Password" : c_password
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