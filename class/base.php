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
		$this->conn = $this->dbConect();
		$result_array = array();

		$sql = "SELECT * FROM Category";
		$sql_prep = $this->conn->query($sql);
		while ($data = $sql_prep->fetch_assoc()) {
			$result_array[] = $data;
		}
		return $result_array;
	}

	public function category_Print($data) {
		echo '<ul class="nav tabs">';
		foreach ($data as $key => $value) {
			if (isset($_GET[$value["Name"]])) {
				echo '<div class=" pt-2 pr-5 pl-5 pb-2 rounded col-md-auto mr-2 border border-secondary" style="background-color:#6c757d">';
			} else {
				echo '<div class=" pt-2 pr-5 pl-5 pb-2 rounded col-md-auto mr-2 border border-secondary style="color:black">';
			}
			echo '<li class="nav-item">';
			if (isset($_GET[$value["Name"]])) {
				echo '<div class="text-center">'.$value["Icon"].'<a style="color:white" class="ml-2 text-decoration-none" href="index.php?'.$value["Name"].'">'.$value["Name"].'</a></div>';
			} else {
				echo '<div class="text-center">'.$value["Icon"].'<a style="color:black" class="ml-2 text-decoration-none" href="index.php?'.$value["Name"].'">'.$value["Name"].'</a></div>';
			}
			echo '</li>';
			echo '</div>';
		}
		echo '</ul>';
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

	public function notes_Print($data) {
		
		foreach ($data as $key => $value) {
			echo "<div class='jumbotron'>";
			echo "<div class='row'>";
			echo '<div class="col-12 col-lg-6">';
			echo '<h3 class="h3">'.$value['Name'].'</h3>';
			echo '<h6 class="h6">Kategorie: <a href="?'.$value['Notes_Category'].'">'.$value['Notes_Category'].'</a></h6><br>';
			echo "<p>".$value['Desc']."</p>";
			echo '</div>';
			echo '<div class="col-12 col-lg-6">';
			echo '<img class="img-fluid img-thumbnail" src="'.$value["URL_IMG"].'">';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
	}
}
?>