<?php

function __autoload($class_name) {
	include '../classes/' .$class_name . '.php';
}

session_start();
$user = $_SESSION['user'];

if (!($user instanceof user)) {
	echo '<meta http-equiv="Refresh" content="0;url=index.php" />';
	//echo var_dump($user);
	exit;
}

//echo var_dump($_POST);
//echo var_dump($_FILES);
//exit;

$perfumeTemplate = perfume_Template::createTemplate($_POST["name"], $_POST["category"], $_POST["filename"], $_POST["description"], $_POST["discontinued"]);

if ($perfumeTemplate) {
	echo "0";
}else {
	echo "1";
}

?>
