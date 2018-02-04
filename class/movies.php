<?php
	# Define movie class
	Class orders {
		private $_moviename;
		private $_year;
		private $_duration;
		private $_studio;
		private $_description;
		private $_selltype;
		private $_picture;

		# constructure, get functions, and set functions
		public function __construct($moviename, $year, $duration, $studio, $description, $selltype, $picture) {
			$this -> _moviename = $moviename;
			$this -> _year = $year;
			$this -> _duration = $duration;
			$this -> _studio = $studio;
			$this -> _description -> $description;
			$this -> _selltype -> $selltype;
			$this -> _picture -> $picture;
		}
		public function getMovieName() {
			return $this -> _moviename;
		}
		public function getYear() {
			return $this -> _year;
		}
		public function getDuration() {
			return $this -> _duration;
		}
		public function getStudio() {
			return $this -> _studio;
		}
		public function getDescription() {
			return $this -> _description;
		}
		public function getSellType() {
			return $this -> _selltype;
		}
		public function getPicture() {
			return $this -> _picture;
		}
		public function setMovieName($moviename) {
			$this -> _moviename = $moviename;
		}
		public function setYear($year) {
			$this -> _year = $year;
		}
		public function setDuration($duration) {
			$this -> _duration = $duration;
		}
		public function setStudio($studio) {
			$this -> _studio = $studio;
		}
		public function setDescription($description) {
			$this -> _description = $description;
		}
		public function setSellType($selltype) {
			$this -> _selltype = $selltype;
		}
		public function setPicture($picture) {
			$this -> _picture = $picture;
		}

		# Methods
		public function selectMovies($sql) {
			# Connction
			$sqlcon = new mysqli("localhost", "root", "", "movie_store");
			if ($sqlcon->connect_error) {
			    die("Connection failed: " . $sqlcon->connect_error);
			} else {
				# Get Ads from DB
				$result = $sqlcon->query($sql);

				if ($result->num_rows > 0) {
				    // output data of each row
				    
				} else {
				    echo "0 results";
				}
			}

			#Close
			$sqlcon -> close();
		}
	}
?>