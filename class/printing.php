<?php

	spl_autoload_register(function ( $class ) {
		require_once dirname(__FILE__) . '/class/' . str_replace("_", "/", $class) . '.php';
	});

	class printing extends base{

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

		public function notes_Print($data) {
			$a = 0;
			foreach ($data as $key => $value) {
				echo "<div class='mt-3 mb-3' style='background-color:#efefef'>";
				echo "<div class='container'>";
				echo "<div class='row'>";
				if (($a % 2) == 0) {
					echo '<div class="col-12 col-lg-6" style="word-wrap: break-word;">';
					echo '<h3 class="mt-3 h3">'.$value['Name'].'</h3>';
					echo '<h6 style="color:#8c9399" class="h6">Kategorie: <a style="color:#8c9399" href="?category='.$value['Notes_Category'].'">'.$value['Notes_Category'].'</a></h6>';
					echo '<h6 style="color:#8c9399" class="h6">URL: <a style="color:#8c9399" href="'.$value['URL'].'">'.$value['URL'].'</a></h6><br>';
					echo "<p>".$value['Description']."</p>";
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
					echo '<div class="col-12 col-lg-6" style="word-wrap: break-word;>';
					echo '<h3 class="mt-3 h3">'.$value['Name'].'</h3>';
					echo '<h6 style="color:#8c9399" class="h6">Kategorie: <a style="color:#8c9399" href="?category='.$value['Notes_Category'].'">'.$value['Notes_Category'].'</a></h6>';
					echo '<h6 style="color:#8c9399" class="h6">URL: <a style="color:#8c9399" href="'.$value['URL'].'">'.$value['URL'].'</a></h6><br>';
					echo "<p>".$value['Description']."</p>";
					echo '</div>';	
				}
				
				echo '</div>';
				echo '</div>';
				echo '</div>';
				$a++;
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

		function isLogin() {
			if (isset($_SESSION['logged'])) {
				$user = $_SESSION['logged'];
				echo '<div class="dropdown">
	  				<button class="btn mt-2 btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$user.'</button>
	  				<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
	    				<button class="dropdown-item" data-toggle="modal" data-target="#insert-modal" type="button">Přidat Nový</button>
	  					<button class="dropdown-item" id="logoutButton" type="button">Odhlásit</button>
	  				</div>
				</div>';
			} else {
				echo '<button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target=".bd-example-modal-lg">Přihlásit</button>';
			}
		}

		function errorAlert() {
			if (isset($_SESSION['error'])) {
				$error = $_SESSION['error'];
				echo '<div class="mt-3 alert alert-danger text-center" role="alert"><span class="h5">'.$error.'</span></div>';
				unset($_SESSION['error']);	
			}
		}

		public function category_Selection($data) {
			foreach ($data as $key => $value) {
				echo '<option value="'.$value['Name'].'">'.$value['Name'].'</option>';
			}
		}

	}

?>