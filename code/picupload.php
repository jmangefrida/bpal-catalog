<?php
// if ($_FILES["file"]["error"] > 0)
//   {
//   echo "Error: " . $_FILES["file"]["error"] . "<br>";
//   }
// else
//   {
//   echo "Upload: " . $_FILES["file"]["name"] . "<br>";
//   echo "Type: " . $_FILES["file"]["type"] . "<br>";
//   echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//   echo "Stored in: " . $_FILES["file"]["tmp_name"];
//   }
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

$pdo = database::getInstance();
$query = "SHOW TABLE STATUS LIKE 'perfume'";
$stmt = $pdo->prepare($query);
$stmt->execute(array());
$row = $stmt->fetch();
if (!$row) {
	//throw new Exception();
	return false;
}
$id = $row['Auto_increment'];

move_uploaded_file($_FILES["file"]["tmp_name"],  "../images/labels/" . $id . ".jpg");

echo "{\"location\":\"" . $id . "\"}";

?>