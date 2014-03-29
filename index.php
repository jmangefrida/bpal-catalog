<?php
try {
	session_start();
	$user = $_SESSION['user'];
	
	if ($user) {
		echo '<meta http-equiv="Refresh" content="0;url=list.php" />';
		//echo var_dump($user);
		exit;
	}
	if ($_SESSION['failed']) {
		$failed = "Username or password incorrect.  Please try again.";
		$msg = "message";
	}else{
		$msg = "nomessage";
	}
		
	session_unset();
} catch (Exception $e) {

}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="css/login.css"/>
</head>
<body onload="dofocus()">
<script type="text/javascript" src="js/jquery-2.0.2.js"></script>
<script type="text/javascript">
function dofocus() {
	alert('test');
}
$(document).ready(function() { 
	alert('test');
	getElementById(''username").focus();
});


</script>
<div class=container>
<div class=loginBox>
<div class=spacer>
<form action = "code/dologin.php" method = "post">
<!-- 	<label>User Name:</label><input type="text" name="username"  id="username" autofocus="autofocus"/><br/> -->
	<label>Password:</label><input type="password" name="password" />
	<input type="submit" class="loginbutton" value="Login" /> 
</form>
</div>
</div>
</div>
</body>
</html>