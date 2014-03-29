<?php
// doLogin.php - this file processes the login for the site.
//This contains the username and passowrd declaration.
//namespace classes;
function __autoload($class_name) {
	include '../classes/' .$class_name . '.php'; 
}



$pdo = database::getInstance();

$user = user::login('amb18', $_POST['password']);

if($user instanceof user) {
	session_start();
	$_SESSION['user'] = $user;
	//echo 'saved';
}


if ($user instanceof user) {
	echo '<meta http-equiv="Refresh" content="0;url=../list.php" />';
	exit;
	//go to survey page.
} elseif ($user instanceof admin) {
	//go to admin page.
	echo '<meta http-equiv="Refresh" content="0;url=admin.php" />';
} else {
	//go to login page.
	session_start();
	$_SESSION['failed'] = true; 
	echo '<meta http-equiv="Refresh" content="0;url=../index.php" />';
	
}



//testing
//echo $_POST['User'];
//echo $_POST['NetID'];
//echo $_POST['Password'];
//echo var_dump($user);
?>