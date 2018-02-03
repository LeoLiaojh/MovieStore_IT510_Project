<?php
	// if(isset($_POST['username_sub'])) {
	// 	// code..
	// }
	// echo $_POST['Username'];
	header('Content-Type: application/json');
	echo json_encode(array('foo' => $_POST['Username']));
	// echo "<h2>HAHHH</h2>";
	// echo $_SESSION['Username'];
?>
