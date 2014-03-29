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
//echo "test";
$list = new category_collection();

$array = array();
 
echo "{ \"categories\" : [";
foreach ($list as $category) {
	//echo var_dump($perfume);
	//echo $perfume->toJSON();
	array_push($array, $category->toJSON());
	//if($list->key() !=1 ) {
	//	echo ",";
	//}

}
echo implode(",", $array);
echo "]}";
?>