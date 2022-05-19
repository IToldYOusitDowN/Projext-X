<?php 	
	//Načte potřebné classy
	spl_autoload_register(function ( $class ) {
		require_once dirname(__FILE__) . '/class/' . str_replace("_", "/", $class) . '.php';
	});
	//vytvoří instanci pro class base
	$web = new base();
?>

<!DOCTYPE html>
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
	<div class="container">
		<header>
			<div class="text-center mt-5">
				<h1 class="h1">Materials</h1>
			</div>
			<div class="jumbotron text-center">
				<div class="row justify-content-md-center">
					<?php
						//vybere z databáze všechny data o tabulce category a uloží do array
						$category_array = $web->category_Select();
						//vypise data z array a priradi správné hodnoty(base.php)
						$web->category_Print($category_array);
					?>
				<div>
			</div>
		</header>
		<article>
			<?php 
				$notes_array = $web->notes_Select();
				$web->notes_Print($notes_array);

			?>
		</article>
	</div>
</body>
</html>