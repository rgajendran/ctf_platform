<?php 
session_start();
if(!isset($_SESSION['USERNAME']) || !isset($_SESSION['TYPE'])){
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Iceland|Orbitron" rel="stylesheet"> 
		<link href="css/main.css" rel="stylesheet" type="text/css" />
	</head>
<body style="background:url('images/bgadmin.png');">
	<div id="wrapper">	
			<h1 id="head">Hacking Challenges</h1><br>
			<button class="dropbtn">Beginners</button>
			<button class="left-right-padding" id="singleplayer">Single Player</button>
			<button class="left-right-padding" id="multiplayer">Multiplayer</button>
			<button class="left-right-padding" id="options">Options</button>			
	</div>
</body>		
<script src="pjs/dashboard.js"></script>
</html>