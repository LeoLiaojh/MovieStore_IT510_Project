<?php
	// Session
	session_start();

	// Cookies
	$expire = time() + 30*24*60*60;
	// set cookies  (name, value, expiretime)
	setcookie("Damn", "WTFssss", $expire);
	// destroy a cookie
	// setcookie("Damn", "", time() - 3600);
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Test</title>
</head> -->
<?php
	$title = "Test Page";
	include "header.php";
?>
<body>
	<?php
		//use cookie
		echo $_COOKIE['Damn'], "<br/>";
		print_r($_COOKIE['Damn']);
		// for ($i=0; $i < 10; $i++) { 
		// 	# code...
		// 	echo "<h1>" .
		// 			"Hello World!" .
		// 		 "</h1>";
		// }
		// $data = array("aa","bb");
		// print_r($data);
		echo $true = true;
		echo $false = false;
		echo var_dump($true);
		$pwd = "Make me sad.";
		echo strlen($pwd);
		if(1) {
			echo "test1" . "<br/>";
			// exit();
			echo "second line";
		}

		// foreach loop
		$names = array('John', 'Smith', 'Jack');
		foreach ($names as $value) {
			# code...
			echo $value . "<br/>";
		}

		// functions
		function printSomething () {
			echo "yo</br>";
		};
		printSomething();

		# object
		/**
		* 
		*/
		class Student
		{	
			private $_name;
			public function __construct($name) {
				$this -> _name = $name;
			}
			
			public function getName() {
				return $this -> _name;
			}
			public function printName($argument)
			{
				echo $argument;
				# code...
			}

		}

		$stu1 = new Student("Jack");
		echo $stu1 -> getName();

		// include and require command
		// The require() function is identical to include(), except that it handles errors differently. If an error occurs, the include() function generates a warning, but the script will continue execution. The require() generates a fatal error, and the script will stop.
		include "test2.php";
		// require("test2.php");

		// Session goes to the top of a main page

	?>
	<form action="" method="post">
		<input type="text" name="Username">
		<button type="Submit" name="sub">Submit</button>
	</form>

	<a href="test.php?logout">Log Out</a>
	<?php
		if(isset($_POST['sub'])) {
			$username = $_POST['Username'];

			// session register
			$session = $_SESSION['Username'] = $username;

			echo $_SESSION['Username'];
		}

		if(isset($_GET['logout'])) {
			// session destory
			session_destroy();
		}
		

		// Mail function
		// mail("leo.liaojh325@gmail.com", "Test message from myself", "This is a test message.", "From: Biggod@Nowhere.org");


	?>
	<!-- <input type="text" id="username_input" name="Username"> -->
	<!-- <button type="button" id="username_sub" onclick="aclick();">Submit</button> -->

	<!-- PHP Filter -->
	<form action="" method="post">
		<input type="text" name="url">
		<button type="Submit" name="urlsub">Submit</button>
	</form>
	<?php
		// Filter book: http://php.net/manual/en/book.filter.php
		if (isset($_POST["urlsub"])) {
			$url = $_POST["url"];
			if (filter_var($url, FILTER_VALIDATE_URL)) {
				# code...
				echo "URL is right";
			} else {
				echo "URL is wrong";
			}
		}
	?>

	<!-- PHP File -->
	<?php
		$file = fopen("testfile.txt", 'r');

		$text = "THHHHHHH000000";

		// fwrite($file, $text);
		echo fread($file, filesize("testfile.txt"));

		fclose($file);
	?>

	<!-- PHP error -->
	<?php
		// if(!file_exists("welcome.txt")) {
		//   die("File not found");
		// } else {
		//   $file=fopen("welcome.txt","r");
		// }
	?>

	<!-- Image Upload -->
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="uploadfile">
		<button type="Submit" name="filesub">submit</button>
	</form>
	<?php
		if (isset($_POST["filesub"])) {
			# code...
			$image = $_FILES['uploadfile']['name'];
			$image_tmp = $_FILES['uploadfile']['tmp_name'];

			move_uploaded_file($image_tmp, "img/$image");

			// echo "<img src='img/$image'>";
		}
	?>

	<!-- Other command -->

	<?php
		// date
		echo date("D/M/d/Y");

		// random number
		echo "<br/>" . mt_rand(0,10);

		$arr = array(20,30,40);
		echo array_sum($arr) . "<br/>";

		$n = 1.001;
		echo round($n);

		echo "<br/>" . md5("AK47");

	?>

	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript">
		function aclick() {
			var username = $("#username_input").val();
			$.ajax({
			  method: "POST",
			  url: "test2.php",
			  dataType: "script",
			  data: {Username : username},
			});
		}
	</script>
</body>
</html>