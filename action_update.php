<?php

	session_start();

	spl_autoload_register(function ( $class ) {
		require_once dirname(__FILE__) . '/class/' . str_replace("_", "/", $class) . '.php';
	});

	$db = new MySQL();

	$error = null;
	if (isset($_POST)) {
		if ($_POST['Name'] != "") {
			$name = $_POST['Name'];
		} else {
			$error .= "Nebyl vyplňen název<br>";
		}
		if ($_POST['category'] != "") {
			$category = $_POST['category'];
		} else {
			$error .= "Nebyla zvolena kategorie<br>";
		}
		if ($_POST['URL'] != "") {
			if (filter_var($_POST['URL'], FILTER_VALIDATE_URL) == FALSE) {
		    	$error .= "Nesprávná url adresa";
			}	
		}
		if ($_POST['URL_YTB'] != "") {
			if (filter_var($_POST['URL_YTB'], FILTER_VALIDATE_URL) == FALSE) {
		    	$error .= "Nesprávná youtube adresa";
			}	
		}
		if ($_POST['URL_IMG'] != "") {
			if (filter_var($_POST['URL_IMG'], FILTER_VALIDATE_URL) == FALSE) {
		    	$error .= "Nesprávná adresa obrázku";
			}	
		}
		
		
	}

	if ($error == null) {

		$sql = "UPDATE Notes SET Name = ?, Notes_Category = ?, Description = ?, URL = ?, URL_IMG = ?, URL_YTB = ? WHERE ID = ?";
		$db->updateData($sql, $name, $category, $_POST['Desc'], $_POST['URL'], $_POST['URL_IMG'], $_POST['URL_YTB'], $_POST['id']);

		header("location: index.php");

	} else {
		$_SESSION['error'] = $error;
		header('location: index.php');
	}

?>