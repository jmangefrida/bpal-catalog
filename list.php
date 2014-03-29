<?php
error_reporting(-1);

function __autoload($class_name) {
	include './classes/' .$class_name . '.php';
}

session_start();
$user = $_SESSION['user'];

if (!($user)) {
	echo '<meta http-equiv="Refresh" content="0;url=index.php" />';
	//echo var_dump($user);
	exit;
}

?>

<?php 
//include './templates/header.php';

?>
<html>
<head>
<title>Amanda's Bpal List</title>
<link rel="stylesheet" type="text/css" media="all" href="css/main.css"/>
<link href="css/south-street/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Kranky' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-2.0.2.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/jquery.fileupload.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>


</head>
<body>

<div id="perfumeModal" title="PerfumeDetails">

<p class="validateTips"><div style="display:inline-block"><span id="perfumePicture">pic</span><br><span id="perfumeRating"></span></div><div style="display:inline-block; vertical-align:top"><span id="perfumeName">Name</span><br><span id=perfumeDescription>Description</span></div></p>
		<span class="shadowtitle shadowbox">Category</span>
		<span class="shadowtitle shadowbox">Bottles</span>
		<span class="shadowtitle shadowbox">Imps</span>
		
		<br>
		
		<span class="shadowbox" id="perfumeCategory">Category</span>
		<span class="shadowbox"  id="perfumeBottles">Bottles</span>
		<span class="shadowbox" id="perfumeImps">Imps</span>
		
		<p>
		<span class="shadowtitle shadowbox">Swappable</span>
		<span class="shadowtitle shadowbox">Discontinued</span>
		<br>
		<span class="shadowbox" id="perfumeStatus">Status</span>
		<span class="shadowbox" id="perfumeDiscontinued">Discontinued</span>
		<br>
		<span class="shadowtitle shadowbox">Location</span>
		<br>
		<span class="shadowbox" id="perfumeLocation">Location</span>
		<br>
		<span class="shadowtitle shadowbox">Notes</span>
		<br>
		<span class="shadowbox" id="perfumeNotes"></span>
		
</div>

<?php 

include './templates/templateNewCategory.php';
include './templates/templateUpdateCategory.php';
include './templates/templateNewPerfume.php';
include './templates/templateUpdatePerfume.php';
?>









	<div class=header>
		<h1 class=title>Amanda's BPAL Inventory</h1>
		<div class=menuButton id=menuTop>
			<button class=green id="addCategory">+Add Category</button>
			<button class=menuSelectMid id="select">Select an action</button>
		</div>
		<ul style="z-index: 2;">
			<li><a href="#" id=updateCategory>Edit...</a></li>
		</ul>
<!-- 		<div class=menuButton id=menuMid> -->
<!-- 			<button class=green id=addTemplate>+Add Template</button> -->
<!-- 			<button class=menuSelectMid id="select">Select an action</button> -->
<!-- 		</div> -->
		<ul style="z-index: 2;">
<!-- 			<li><a href="#" id=updateTemplate>Edit...</a></li> -->
<!-- 		</ul> -->
		<div class=menuButton id=menuBottom>
			<button class=green id=addPerfume>+Add Perfume</button>
			<button class=menuSelectBottom id="select">Select an action</button>
		</div>
		<ul style="z-index: 2;">
			<li><a href="#" id=updatePerfume>Edit...</a></li>
		</ul>
		
	</div>
	<input id=search />
	<select id=sort >
		<option value=category>Category</option>
		<option value =name>Name</option>
		<option value=rating>Rating</option>
		
	</select><input type="checkbox" id="swappable" name="swappable" />Swappable <input type="checkbox" id="discontinued" name="discontinued" />Discontinued  <span id=count></span>
	<div class=listTemplate style="display:none;">
		<span class="title">Name</span>
		<span class="title">Category</span>
		<span class="title">Rating</span>
		<span class="title">Bottles</span>
		<span class="title">Imps</span>
		<br>
		<span class="perfumeName">Name</span>
		<span class="perfumeCategory">Category</span>
		<span class="perfumeRating"></span>
		<span class="perfumeBottles">Bottles</span>
		<span class="perfumeImps">Imps</span>
		<span class="descShort"  id="descShort" style="font-weight: 50%;"></span>
		<span class="perfumeDescription" style="display: none"></span>
	</div>
	<div id=square></div>
	
	
</body>
</html>

