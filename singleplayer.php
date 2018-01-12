<?php 
session_start();
if(!isset($_SESSION['USERNAME']) || !isset($_SESSION['TYPE'])){
	header('location:index.php');
}else{
	if(!isset($_GET['scenario'])){
		require 'class/Constants.php';
		header('location:'.Constants::SPLAYERDEFAULT);
	}
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
<body id="main" style="background:url('images/bgadmin.png');">
	<div id="wrapper">	
		<h1 id="head">Explore VM's</h1>
		<div id="nav">
			<nav id="primary_nav_wrap">
					<?php			
						echo "<ul>";
							include 'plattemplate/connection.php';
							$result = mysqli_query($connection, "SELECT * FROM smenu");
							while($row = mysqli_fetch_assoc($result)){
								$tempname = $row['TEMP_SCENARIO'];
								echo "<li><a href='singleplayer.php?scenario=$tempname'>$tempname</a>";	
							}
							echo "<li><a href='#'>Request SecGen Scenarios</a>";
								$dir = $_SERVER['DOCUMENT_ROOT']."/SecGen/scenarios";
					
								function listFolderFiles($dir){
								    $ffs = scandir($dir);
								
								    unset($ffs[array_search('.', $ffs, true)]);
								    unset($ffs[array_search('..', $ffs, true)]);
									
									echo "<ul>";
								    // prevent empty ordered elements
								    if (count($ffs) < 1)
								        return;
								    foreach($ffs as $ff){
								    	$path = strstr($dir, "scenarios");
								        echo "<li><a href='singleplayer.php?scenario=$ff&&fp=$path/$ff'>$ff</a>";
								        if(is_dir($dir.'/'.$ff)) {
								        	listFolderFiles($dir.'/'.$ff);
										}
								    }
									echo "</ul>";
								}
								listFolderFiles($dir);
							
							echo "</li>";
						echo "</ul>";				   
					?>
			</nav>		
		</div>

		<div id="main_content">
			<table>
				<tr class="c-name">
					<td class="c-head"><h3>Scenario Selected</h3></td>
					<td class="c-mid">:</td>
					<td class="c-end"><h3><span 
					<?php	
					if(isset($_GET['scenario'])){
						$scenario = $_GET['scenario'];
						echo 'id="s_selected">'.$scenario;
					}else{
						echo 'id="s_notselected">Not Selected';
					}	
					?>
					</span></h3></td>
				</tr>	
				<!--<tr class="c-name">
					<td class="c-head"><h3>Choose VM Name</h3></td>
					<td class="c-mid">:</td>
					<td class="c-end"><input type="text" id="vmname" placeholder="Enter your VM name" maxlength="30"/></td>
				</tr>	-->			
				<tr class="c-name">
					<td  colspan="3">
						<div id="loading">
							<?php echo "<pre>";?><p id="status">status</p><?php echo "</pre>";?>
						</div>
					</td>
				</tr>
			</table>
			<div id="loading-buttons">
				<input type="hidden" id="scenario" value="<?php if(isset($_GET['scenario'])){echo $_GET['scenario'];}?>" />
				<button id="back">Back</button>
				<button id="play">Create Scenario</button>
			</div>
		</div>	
		<div id="side_menu">
				<?php include 'plattemplate/availablevm.php'; ?>			
		</div>	
	</div>
	<script src="pjs/splayers.js"></script>
	<script src="pjs/dashboard.js"></script>
	<script src="noti/notify.js"></script>
	<script src="noti/notify.min.js"></script>	
</body>
</html>