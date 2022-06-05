<?php


	spl_autoload_register(function ( $class ) {
		require_once dirname(__FILE__) . '/class/' . str_replace("_", "/", $class) . '.php';
	});

	$db = new Database();
	$notes = new Notes();


	if (isset($_POST) && $notes->validateNoteImputs($_POST)) {
		$filename = $notes->uploadFile($_FILES['uploadfile'])
		
		if (!empty($filename)){

			$sql = sprintf("INSERT INTO Notes (Name, Notes_Category, Description, URL, URL_IMG, URL_YTB, IMG_FILE) 
							Values ('%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
							mysql_real_escape_string($name),
							mysql_real_escape_string($category),
							mysql_real_escape_string($_POST['Desc']),
							mysql_real_escape_string($_POST['URL']),
							mysql_real_escape_string($_POST['URL_IMG']),
							mysql_real_escape_string($_POST['URL_YTB']),
							mysql_real_escape_string($filename)

			);
			
//			$db->insertDataWithFile($name, $category, $_POST['Desc'], $_POST['URL'], $_POST['URL_IMG'], $_POST['URL_YTB'], $filename);
		} else {
			$sql = sprintf("INSERT INTO Notes (Name, Notes_Category, Description, URL, URL_IMG, URL_YTB, IMG_FILE) 
				Values ('%s', '%s', '%s', '%s', '%s', '%s')", 
				mysql_real_escape_string($name),
				mysql_real_escape_string($category),
				mysql_real_escape_string($_POST['Desc']),
				mysql_real_escape_string($_POST['URL']),
				mysql_real_escape_string($_POST['URL_IMG']),
				mysql_real_escape_string($_POST['URL_YTB'])

			);
//			$db->insertData($sql, $name, $category, $_POST['Desc'], $_POST['URL'], $_POST['URL_IMG'], $_POST['URL_YTB']);		
		}	
		$db->quary($sql)	
    }

	header('location: index.php');
?>