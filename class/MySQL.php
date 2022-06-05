<?php

/**
 * Based on https://gist.github.com/Badshah1/41267e6c2ff5c5d6abde
 */

class Database{
	
	private $conf;
	private $conn;

	function __construct()
	{
		$base = new base();
		$this->conf = $base->getConfig();
		$this->conn = $this->connect();
	}
	
	public function connect(){
		$con = new mysqli($this->conf["server"], $this->conf["user"], $this->conf["password"], $this->conf["database"]);
		
		//check connection
		if ($conn->connect_errno) {
			printf("Connect failed: %s\n", $conn->connect_error);
			exit();
		}

		//set utf8 charset
		mysqli_set_charset($conn, "utf8");

		if($con){
			$this->conn=$con;
			return true;
		}else{
			return false;
		}
	}
	public function quary($sql){

		$ins=$this->conn->query($sql);
		if($ins){
			return true;
		}else{
			return false;
		}
	}







	
	public function select($table,$row="*",$where=null,$order=null){
		$query='SELECT '.$row.' FROM '.$table;
		if($where!=null){
			$query.=' WHERE '.$where;
		}
		if($order!=null){
			$query.=' ORDER BY ';
		}
		$Result=$this->conn->query($query);
		return $Result;

	}
	public function insert($table,$value,$row=null){
		$insert= " INSERT INTO ".$table;
		if($row!=null){
			$insert.=" (". $row." ) ";
		}
		for($i=0; $i<count($value); $i++){
			if(is_string($value[$i])){
				$value[$i]= '"'. $value[$i] . '"';
			}
		}

		$value=implode(',',$value);
		$insert.=' VALUES ('.$value.')';
		$ins=$this->conn->query($insert);
		if($ins){
			return true;
		}else{
			return false;
		}
	}
	public function delete($table,$where=null){
		if($where == null)
            {
                $delete = "DELETE ".$table;
            }
            else
            {
                $delete = "DELETE  FROM ".$table." WHERE ".$where;
            }
			$del=$this->conn->query($delete);
			if($del){
				return true;
			}else{
				return false;
			}
	}
	public function update($table,$rows,$where){
		 // Parse the where values
            // even values (including 0) contain the where rows
            // odd values contain the clauses for the row
            for($i = 0; $i < count($where); $i++)
            {
                if($i%2 != 0)
                {
                    if(is_string($where[$i]))
                    {
                        if(($i+1) != null)
                            $where[$i] = '"'.$where[$i].'" AND ';
                        else
                            $where[$i] = '"'.$where[$i].'"';
                    }
                }
            }
            $where = implode(" ",$where);


            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }

                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
            $update .= ' WHERE '.$where;
            $query = $this->conn->query($update);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
	    
         }
        
	
};

	/**
	 * 
	 */
	class MySQL
	{
		
		private $conf;
		private $conn;

		function __construct()
		{
			$base = new base();
	        $this->conf = $base->getConfig();
	        $this->conn = $this->connect();
		}

		public function connect() {
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
			$this->conn = $this->connect();
			$result_array = array();

			$sql = "SELECT * FROM Category";
			$sql_prep = $this->conn->query($sql);
			while ($data = $sql_prep->fetch_assoc()) {
				$result_array[] = $data;
			}
			return $result_array;
		}
		
		public function notes_Select() {
			$this->conn = $this->connect();
			$result_array = array();

			$sql = "SELECT * FROM Notes";

			$sql_prep = $this->conn->query($sql);
			while ($data = $sql_prep->fetch_assoc()) {
				$result_array[] = $data;
			}
			return $result_array;
		}

		public function category_in_array() {
			$this->conn = $this->connect();
			$result_array = array();

			$sql = "SELECT Name FROM Category";

			$sql_prep = $this->conn->query($sql);
			while ($data = $sql_prep->fetch_assoc()) {
				$result_array[] = $data;
			}
			return $result_array;
		}

		function user_data($name) {
			$this->conn = $this->connect();
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
				$this->conn = $this->connect();
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
			$this->conn = $this->connect();
			$result_array = array();
			$sql_prep = $this->conn->prepare($sql);
			$sql_prep->bind_param('s', $ID);
			$sql_prep->execute();
		}

		public function insertData($sql, $name, $category, $description, $url, $img, $ytb) {
			$this->conn = $this->connect();
			$result_array = array();
			$sql_prep = $this->conn->prepare($sql);
			$sql_prep->bind_param('ssssss', $name, $category, $description, $url, $img, $ytb);
			$sql_prep->execute();
		}

		public function insertDataWithFile($name, $category, $description, $url, $img, $ytb, $file) {
			$this->conn = $this->connect();

			$sql_prep = $this->conn->prepare($sql);
			$sql_prep->bind_param('sssssss', $name, $category, $description, $url, $img, $ytb, $file);
			$sql_prep->execute();
		}

		public function updateData($sql, $name, $category, $description, $url, $img, $ytb, $id) {
			$this->conn = $this->connect();
			$sql = "INSERT INTO Notes (Notes_Category, Name, Description, URL, URL_IMG, URL_YTB) Values (?, ?, ?, ?, ?, ?)";

			$sql_prep = $this->conn->prepare($sql);
			$sql_prep->bind_param('ssssssi', $name, $category, $description, $url, $img, $ytb, $id);
			$sql_prep->execute();
		}

		public function select_edit($id) {
			$this->conn = $this->connect();
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