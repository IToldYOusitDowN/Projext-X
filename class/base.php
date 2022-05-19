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
			if (isset($_GET['category'])) {
				if ($_GET['category'] == $value['Name']) {
					echo '<div class=" pt-2 pr-5 pl-5 pb-2 rounded col-md-auto mr-2 border border-secondary" style="background-color:#6c757d">';
				} else {
					echo '<div class=" pt-2 pr-5 pl-5 pb-2 rounded col-md-auto mr-2 border border-secondary style="color:black">';
				}
			} else {
				echo '<div class=" pt-2 pr-5 pl-5 pb-2 rounded col-md-auto mr-2 border border-secondary style="color:black">';
			}
			echo '<li class="nav-item">';
			if (isset($_GET['category'])) {
				if ($_GET['category'] == $value['Name']) {
					echo '<div class="text-center">'.$value["Icon"].'<a style="color:white" class="ml-2 text-decoration-none" href="index.php?category='.$value["Name"].'">'.$value["Name"].'</a></div>';
				} else {	
					echo '<div class="text-center">'.$value["Icon"].'<a style="color:black" class="ml-2 text-decoration-none" href="index.php?category='.$value["Name"].'">'.$value["Name"].'</a></div>';
				}
			} else {
				echo '<div class="text-center">'.$value["Icon"].'<a style="color:black" class="ml-2 text-decoration-none" href="index.php?category='.$value["Name"].'">'.$value["Name"].'</a></div>';
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

	public function notes_Print($data) {
		$a = 0;
		foreach ($data as $key => $value) {
			echo "<div class='mt-3 mb-3' style='background-color:#efefef'>";
			echo "<div class='container'>";
			echo "<div class='row'>";
			if (($a % 2) == 0) {
				echo '<div class="col-12 col-lg-6">';
				echo '<h3 class="mt-3 h3">'.$value['Name'].'</h3>';
				echo '<h6 style="color:#8c9399" class="h6">Kategorie: <a style="color:#8c9399" href="?category='.$value['Notes_Category'].'">'.$value['Notes_Category'].'</a></h6>';
				echo '<h6 style="color:#8c9399" class="h6">URL: <a style="color:#8c9399" href="'.$value['URL'].'">'.$value['URL'].'</a></h6><br>';
				echo "<p>".$value['Desc']."</p>";
				echo '</div>';
				echo '<div class="col-12 col-lg-6">';
				
				if (!empty($value['URL_IMG'])) {
					echo '<div href="#" id="pop">';
					echo '<img id="imageresource" class="img-fluid" src="'.$value["URL_IMG"].'">';
					echo '</div>';
				} elseif (!empty($value['URL_YTB'])) {
					$url = $this->getYoutubeEmbedUrl($value['URL_YTB']);
					echo '<div class="embed-responsive embed-responsive-16by9">';
					echo '<iframe class="embed-responsive-item" src="'.$url.'" allowfullscreen></iframe>';
					echo '</div>';
				} else {
					echo '<img id="imageresource" class="img-fluid" src="https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg">';
				}
				
				echo '</div>';
			} else {
				echo '<div class="col-12 col-lg-6">';
				if (!empty($value['URL_IMG'])) {
					echo '<div href="#" id="pop">';
					echo '<img id="imageresource" class="img-fluid" src="'.$value["URL_IMG"].'">';
					echo '</div>';
				} elseif (!empty($value['URL_YTB'])) {
					$url = $this->getYoutubeEmbedUrl($value['URL_YTB']);
					echo '<div class="embed-responsive embed-responsive-16by9">';
					echo '<iframe class="embed-responsive-item" src="'.$url.'" allowfullscreen></iframe>';
					echo '</div>';
				} else {
					echo '<img id="imageresource" class="img-fluid" src="https://genesisairway.com/wp-content/uploads/2019/05/no-image.jpg">';
				}
				echo '</div>';
				echo '<div class="col-12 col-lg-6">';
				echo '<h3 class="mt-3 h3">'.$value['Name'].'</h3>';
				echo '<h6 style="color:#8c9399" class="h6">Kategorie: <a style="color:#8c9399" href="?category='.$value['Notes_Category'].'">'.$value['Notes_Category'].'</a></h6>';
				echo '<h6 style="color:#8c9399" class="h6">URL: <a style="color:#8c9399" href="'.$value['URL'].'">'.$value['URL'].'</a></h6><br>';
				echo "<p>".$value['Desc']."</p>";
				echo '</div>';	
			}
			
			echo '</div>';
			echo '</div>';
			echo '</div>';
			$a++;
		}
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

	public function selected_category_Print($notes_data, $notes_category_data) {
		
		if (isset($_GET['category'])) {
			if (!empty($notes_category_data)) {
				$this->notes_Print($notes_category_data);
			} else {
				echo '<div class="jumbotron text-center">Žádné výsledky</div>';
			}
		} else {
			$this->notes_Print($notes_data);
		}
	}

	function getYoutubeEmbedUrl($url) {
    	$shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
    	$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    	if (preg_match($longUrlRegex, $url, $matches)) {
        	$youtube_id = $matches[count($matches) - 1];
    	}

    	if (preg_match($shortUrlRegex, $url, $matches)) {
        	$youtube_id = $matches[count($matches) - 1];
    	}
    	return 'https://www.youtube.com/embed/' . $youtube_id ;
	}
}
?>