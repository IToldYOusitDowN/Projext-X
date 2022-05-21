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
		/*if ($_POST['Desc'] != "") {
			$description = $_POST['Desc'];
		} else {
			$description = "";
		}
		if ($_POST['URL'] != "") {
			$url = $_POST['URL'];
		} else {
			$url = "";
		}
		if ($_POST['URL_IMG'] != "") {
			$url_img = $_POST['URL_IMG'];
		} else {
			$url_img = "";
		}
		if ($_POST['URL_YTB'] != "") {
			$url_ytb = $_POST['URL_YTB'];
		} else {
			$url_ytb = "";
		}*/
	}

	if ($error == null) {

		$sql = "INSERT INTO Notes (Notes_Category, Name, Description, URL, URL_IMG, URL_YTB) Values (?, ?, ?, ?, ?, ?)";
		$db->insertData($sql, $name, $category, $_POST['Desc'], $_POST['URL'], $_POST['URL_IMG'], $_POST['URL_YTB']);

		header("location: index.php");

	} else {
		$_SESSION['error'] = $error;
		header('location: index.php');
	}

?>