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

if ($_POST["discontinued"] == "on") {
	$_POST["discontinued"] = 1;
}

if ($_POST["status"] == "on") {
	$_POST["status"] = 1;
}

$perfumeInstance = perfume::createPerfume( $_POST["category"], $_POST["name"], $_POST["description"], $_POST["discontinued"], $_POST["rating"], $_POST["imps"], $_POST["bottles"], $_POST["status"], $_POST["location"], $_POST["notes"]);

if ($perfumeInstance) {
	echo "0";
}else {
	echo "1";
}

?>
