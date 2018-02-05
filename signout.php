<?php
	header('Content-Type: application/json');
	if ($_POST['Signup'] == "true") {
		# code...
		setcookie("user", "", -3600);
		echo json_encode(array('result' => '0000', 'message' => 'Sign out successful!.'));
	} else {
		echo json_encode(array('result' => '1001', 'message' => 'Sign out error!.'));
	}
?>