<?php
	# Define user class
	Class users {
		private $_username;
		private $_password;
		private $_email;

		# constructure, get functions, and set functions
		public function __construct($username, $pwd, $email) {
			$this -> _username = $username;
			$this -> _password = $pwd;
			$this -> _email = $email;
		}
		public function getUserName() {
			return $this -> _username;
		}
		public function getPassword() {
			return $this -> _password;
		}
		public function getEmail() {
			return $this -> _email;
		}
		public function setUserName($username) {
			$this -> _username = $username;
		}
		public function setPassword($pwd) {
			$this -> _password = $pwd;
		}
		public function setEmail($email) {
			$this -> _email -> $email;
		}

		# Methods
	}

	# Define customer class
	Class customers extends users {
		# Methods
		
	}
?>