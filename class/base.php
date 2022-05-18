<?php 

/**
 * 
 */
class base
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
		$web = new base();
		$conn = $web->dbConect();
		$result_array = array();

		$sql = "SELECT * FROM Category";

		$sql_prep = $conn->query($sql);
		while ($data = $sql_prep->fetch_assoc()) {
			$result_array[] = $data;
		}
		return $result_array;
	}

	public function category_Print($data) {
		echo '<ul class="nav tabs">';
		foreach ($data as $key => $value) {
			if (isset($_GET[$value["Name"]])) {
				echo '<div class="col-2 mr-2 border border-dark" style="background-color:'.$value["Color"].'">';
			} else {
				echo '<div class="col-2 mr-2" style="background-color:'.$value["Color"].'">';
			}
			echo '<li class="nav-item">';
			echo '<div class="text-center">'.$value["Icon"].'<a class="nav-link" href="index.php?'.$value["Name"].'">'.$value["Name"].'</a></div>';
			echo '</li>';
			echo '</div>';
		}
		echo '</ul>';
	}

}



?>