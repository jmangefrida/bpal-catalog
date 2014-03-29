<?php

function __autoload($class_name) {
	include '../classes/' .$class_name . '.php';
}

session_start();
$user = $_SESSION['user'];

if (!($user)) {
	echo '<meta http-equiv="Refresh" content="0;url=index.php" />';
	//echo var_dump($user);
	exit;
}

$perfume = new perfume($_GET['perfume_id'], $user->getId());

echo "{ \"perfume\" : [";
echo $perfume->toJSON();
echo "]}";
?>