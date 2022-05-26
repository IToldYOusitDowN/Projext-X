<?php

	session_start();

	spl_autoload_register(function ( $class ) {
		require_once dirname(__FILE__) . '/class/' . str_replace("_", "/", $class) . '.php';
	});

	$db = new MySQL();
	$error = null;
	if (isset($_GET['delete'])) {
		if (!empty($_GET["delete"]) AND is_numeric($_GET['delete'])) {
			$sql = "DELETE FROM Notes WHERE ID = ?";
			$db->delete_note($sql, $_GET['delete']);
			$_SESSION['successful'] = "Záznam úspěšně smazán";
			header('location: index.php');
		} else {
			$error = "něco se pokazilo :(";
			$_SESSION['error'] = $error;
			header('location: index.php');	
		}
	} else {
	 	$error = "něco se pokazilo :(";
	 	$_SESSION['error'] = $error;
	 	header('location: index.php');
	}

?>