<?php
	session_start();
	if (isset($_SESSION['logged'])) {
		unset($_SESSION['logged']);
		header('location: index.php');
	} else {
		header('location: index.php');
	}

?>