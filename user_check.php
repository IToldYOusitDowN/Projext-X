<?php
	session_start();
	unset($_SESSION['error']);
	spl_autoload_register(function ( $class ) {
		require_once dirname(__FILE__) . '/class/' . str_replace("_", "/", $class) . '.php';
	});
	$db = new MySQL();
	$error = null;
	$name = null;
	if ($_POST['name'] != "" AND $_POST['heslo'] != "") {
		$user = $db->user_data($_POST['name']);
		if (!empty($user)) {
			foreach ($user as $key => $value) {
				if (!password_verify($_POST['heslo'], $value['Hash'])) {
					$error = "Špatné heslo!!";
				} else {
					$name = $value['Name'];	
				}
			}
		} else {
			$error = "Špatné uživatelské jméno!!";
		}

		if ($error == null) {
			$_SESSION['logged'] = $name;
			header('location: index.php');
		} else {
			$_SESSION['error'] = $error;
			header('location: index.php');
		}

	} else {
		$error = 'Vyplntě obě pole!!';
		$_SESSION['error'] = $error;
		header('location: index.php');
	}

?>