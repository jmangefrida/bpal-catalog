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

$result = category::updateCategory($_GET["id"], $_GET["name"]);

//category::confirm($id)::updatePerfume($user->getId(), $_POST["template"], $_POST["rating"], $_POST["imps"], $_POST["bottles"], $_POST["status"], $_POST["location"], $_POST["notes"]);

if ($result) {
	echo "0";
}else {
	echo "1";
}

?>