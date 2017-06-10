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
<body id="main" style="background:url('images/bgadmin.png');">
	<div id="wrapper">	
		<h1 id="head">Single Player</h1><br>
		<nav id="primary_nav_wrap">
			<?php			
				echo "<ul>";
					include 'plattemplate/connection.php';
					$result = mysqli_query($connection, "SELECT * FROM smenu");
					while($row = mysqli_fetch_assoc($result)){
						$tempname = $row['TEMP_NAME'];
						echo "<li><a href='singleplayer.php?scenario=$tempname'>$tempname</a>";	
					}
				echo "</ul>";				   
			?>
		</nav><br><br>
		<div id="content">
			<h3>Scenario Selected : <span 
			<?php	
			if(isset($_GET['scenario']) && isset($_GET['fp'])){
				$scenario = $_GET['scenario'];
				$fp = $_GET['fp'];
				
				echo 'id="s_selected">'.$scenario;
			}else{
				echo 'id="s_notselected">Not Selected';
			}	
			?>
			</span>
			</h3>
			<div id="loading">
				<p id="status">status</p>
			</div>
			<div id="loading-buttons">
				<input type="hidden" id="scenario" value="<?php if(isset($_GET['fp'])){echo $_GET['fp'];}?>" />
				<button id="play">Play</button>
				<button id="">Open VM</button>
			</div>
			<script src="js/dashboard.js"></script>
		</div>
	</div>
</body>
</html>