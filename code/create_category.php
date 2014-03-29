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

$category = category::createCategory($_GET["name"]);

if ($category) {
	echo "0";
}else {
	echo "1";
}

?>