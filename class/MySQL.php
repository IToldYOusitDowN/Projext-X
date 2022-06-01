<?php

	/**
	 * 
	 */
	class MySQL
	{
		
		private $conf;
		private $conn;

		function __construct()
		{
			require dirname(__FILE__) . '/../config/conf.php';
	        $this->conf = $config;
	        unset($config);
	        $this->conn = $this->dbConect();
		}

		public function dbConect() {
		    //create connection
		    $conn = mysqli_connect($this->conf["server"], $this->conf["user"], $this->conf["password"], $this->conf["database"]);

		    //check connection
		    if ($conn->connect_errno) {
		        printf("Connect failed: %s\n", $conn->connect_error);
		        exit();
		    }
		    
		    //set utf8 charset
		    mysqli_set_charset($conn, "utf8");
		    return $conn;
		}

		public function category_Select() {
			$this->conn = $this->dbConect();
			$result_array = array();

			$sql = "SELECT * FROM Category";
			$sql_prep = $this->conn->query($sql);
			while ($data = $sql_prep->fetch_assoc()) {
				$result_array[] = $data;
			}
			return $result_array;
		}
		
		public function notes_Select() {
			$this->conn = $this->dbConect();
			$result_array = array();

			$sql = "SELECT * FROM Notes";

			$sql_prep = $this->conn->query($sql);
			while ($data = $sql_prep->fetch_assoc()) {
				$result_array[] = $data;
			}
			return $result_array;
		}

		public function category_in_array() {
			$this->conn = $this->dbConect();
			$result_array = array();

			$sql = "SELECT Name FROM Category";

			$sql_prep = $this->conn->query($sql);
			while ($data = $sql_prep->fetch_assoc()) {
				$result_array[] = $data;
			}
			return $result_array;
		}

		function user_data($name) {
			$this->conn = $this->dbConect();
			$result_array = array();
			$sql = "SELECT * FROM User WHERE Name = '".$name."'";
			$sql_prep = $this->conn->query($sql);
			while ($data = $sql_prep->fetch_assoc()) {
				$result_array[] = $data;
			}
			return $result_array;
		}

		public function notes_Category() {	
			if (isset($_GET['category'])) {
				$para = $_GET['category'];
				$this->conn = $this->dbConect();
				$result_array = array();
				
				$sql = "SELECT * FROM Notes WHERE Notes_Category = '".$para."'";	
				$sql_prep = $this->conn->query($sql);
				while ($data = $sql_prep->fetch_assoc()) {
					$result_array[] = $data;
				}
				return $result_array;
			}
		}

		public function delete_note($sql, $ID) {
			$this->conn = $this->dbConect();
			$result_array = array();
			$sql_prep = $this->conn->prepare($sql);
			$sql_prep->bind_param('s', $ID);
			$sql_prep->execute();
		}

		public function insertData($sql, $name, $category, $description, $url, $img, $ytb) {
			$this->conn = $this->dbConect();
			$result_array = array();
			$sql_prep = $this->conn->prepare($sql);
			$sql_prep->bind_param('ssssss', $name, $category, $description, $url, $img, $ytb);
			$sql_prep->execute();
		}

		public function insertDataWithFile($sql, $name, $category, $description, $url, $img, $ytb, $file) {
			$this->conn = $this->dbConect();
			$result_array = array();
			$sql_prep = $this->conn->prepare($sql);
			$sql_prep->bind_param('sssssss', $name, $category, $description, $url, $img, $ytb, $file);
			$sql_prep->execute();
		}

		public function updateData($sql, $name, $category, $description, $url, $img, $ytb, $id) {
			$this->conn = $this->dbConect();
			$result_array = array();
			$sql_prep = $this->conn->prepare($sql);
			$sql_prep->bind_param('ssssssi', $name, $category, $description, $url, $img, $ytb, $id);
			$sql_prep->execute();
		}

		public function select_edit($id) {
			$this->conn = $this->dbConect();
			$result_array = array();

			$sql = "SELECT * FROM Notes WHERE ID = '".$id."'";

			$sql_prep = $this->conn->query($sql);
			while ($data = $sql_prep->fetch_assoc()) {
				$result_array[] = $data;
			}
			return $result_array;
		}
	}


?>