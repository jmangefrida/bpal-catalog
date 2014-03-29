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

if ($_GET['swap'] == "true"){
	$swap = true;
} else {
	$swap = false;
}
if ($_GET['discontinued'] == "true"){
	$discontinued = true;
} else {
	$discontinued = false;
}
$list = new perfume_Collection($swap, $discontinued);
if($_GET['order'] == 'category') {
	//$list->sortCategory();
} elseif ($_GET['order'] == 'name') {
	$list->sortName();
} elseif ($_GET['order'] == 'rating') {
	$list->sortRating();
} else{
	
}
$array = array();

echo "{ \"perfume\" : [";
foreach ($list as $perfume) {
	//echo var_dump($perfume);
	//echo $perfume->toJSON();
	array_push($array, $perfume->toJSON());
	//if($list->key() !=1 ) {
	//	echo ",";
	//}
	
}
echo implode(",", $array);
echo "]}";
?>