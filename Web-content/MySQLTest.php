<?php
	#MySQL Test
	$title = "MySQL Test";
	include "header.php";
?>
<!-- SQL Connection -->
<?php
	# Connection
	$sqlcon = new mysqli("localhost", "root", "", "test");
		// if ($sqlcon->connect_error) {
		    // or die("Connection failed: " . $sqlcon->connect_error);
		// } 
	if ($sqlcon->connect_error) {
	    die("Connection failed: " . $sqlcon->connect_error);
	} 

?>

<!-- Insertion -->
<form action="MySQLTest.php" method="post">
	<input type="text" name="username"> <br>
	<button type="Submit" name="username_sub">Submit</button>
</form>
<?php
	// if (isset($_POST['username_sub'])) {
	// 	# code...
	// 	// echo "txt";
	// 	$username = $_POST['username'];

	// 	$insert = "INSERT INTO users (Username) VALUES ('$username')";

	// 	if ($sqlcon->query($insert) === TRUE) {
	// 	    echo "New record created successfully";
	// 	} else {
	// 	    echo "Error: " . $insert . "<br>" . $sqlcon->error;
	// 	}

	// 	$sqlcon->close();
	// }
	
	// Selct data
	$sql = "SELECT Username, UserID FROM users ORDER BY UserID DESC";
	$result = $sqlcon->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "id: " . $row["UserID"]. " - Name: " . $row["Username"] . "<br>";
	    }
	} else {
	    echo "0 results";
	}
?>

<!-- PHP ajax -->
<input type="text" id="aname" name="aname">
<button type="button" id="asub" name="asub" onclick="ajaxTest();">Asub</button>

<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
	function ajaxTest() {
		var name = $("#aname").val();

		$.ajax({
			url: "test2.php",
			method: "post",
			dataType: "json",
			data: {
				Username: name,
				Password: "pwd"
			},
			success: function(json) {
				alert(json.foo);
			},
		});
	}
	
</script>
<?php
	#php ajax
	// echo $_POST['Username'];
	// header('Content-Type: application/json');
	// echo json_encode(array('Userback' => $_POST['Username']));
?>


<!-- footer -->
<?php
	include "footer.php";
?>