<html>
<head>
	<meta charset="utf-8">
	<title>Praxe</title>
	<script src="https://kit.fontawesome.com/ff4be11dfb.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<?php

	spl_autoload_register(function ( $class ) {
		require_once dirname(__FILE__) . '/class/' . str_replace("_", "/", $class) . '.php';
	});
	$print = new printing();
	$db = new MySQL();

	if(isset($_GET['edit']) AND is_numeric($_GET['edit'])) {
		$data = $db->select_edit($_GET['edit']);
		$category = $db->category_in_array();
		if (!empty($data)) {
			echo '<form class="mt-5" method="post" action="action_update.php">';
			echo '<div class="row">
					<div class="col-12 text-center">
						<h3>Upravit</h3>
					</div>
				</div>';
			echo '<div class="row justify-content-md-center">';
			echo '<div class="col-6">';
			echo '<select class="form-control form-select-lg" aria-label="Default select example" name="category">';
			echo '<option value="" selected>Vyberte kategorii</option>';
			$print->category_Selection($category);
			echo '</select>';
			echo '</div>';
			echo '</div>';
			foreach ($data as $key => $value) {
				echo "<input type='hidden' name='id' value='".$value['ID']."'>";
				echo '<div class="row justify-content-md-center mt-3">';
				echo '<div class="col-6">';
				echo "<input class='form-control' type='text' name='Name' value='".$value['Name']."'>";
				echo '</div>';
				echo '</div>';
				echo '<div class="row justify-content-md-center mt-3">';
				echo '<div class="col-6">';
				echo "<input class='form-control' type='text' name='URL' value='".$value['URL']."'>";
				echo '</div>';
				echo '</div>';
				echo '<div class="row justify-content-md-center mt-3">';
				echo '<div class="col-6">';
				echo "<input class='form-control' type='text' name='URL_IMG' value='".$value['URL_IMG']."'>";
				echo '</div>';
				echo '</div>';
				echo '<div class="row justify-content-md-center mt-3">';
				echo '<div class="col-6">';
				echo "<input class='form-control' type='text' name='URL_YTB' value='".$value['URL_YTB']."'>";
				echo '</div>';
				echo '</div>';
				echo '<div class="row justify-content-md-center mt-3">';
				echo '<div class="col-6">';
				echo "<textarea class='form-control' type='text' name='Description'>".$value['Description']."</textarea>";
				echo '</div>';
				echo '</div>';
			}
			echo '<div class="row justify-content-md-center mb-5 mt-3">
		    		<div class="col-6">
		    			<button class="btn btn-primary mt-3" type="submit">Upravit</button>
		    		</div>
		    	</div>
			</form>';
		}
		
	}

?>
</body>
</html>