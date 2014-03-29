<?php

function __autoload($class_name) {
	include '../classes/' .$class_name . '.php';
}

session_start();
$user = $_SESSION['user'];

if ($_GET["unused"] == "true") {
	$unused = TRUE;
}else {
	$unused = FALSE;
}

if (!($user)) {
	echo '<meta http-equiv="Refresh" content="0;url=index.php" />';
	//echo var_dump($user);
	exit;
}
//echo "test";
$list = new perfume_Template_Collection($user->getId(), $unused);

$array = array();

echo "{ \"perfumes\" : [";
foreach ($list as $perfume) {
	
	array_push($array, $perfume->toJSON());
	

}
echo implode(",", $array);
echo "]}";

?>