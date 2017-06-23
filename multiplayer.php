<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
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
		<link href="css/pcss/multiplayer.css" type="text/css" rel="stylesheet" />
	</head>
<body style="background:url('images/bgadmin.png');">
	
	<div id="wrapper">	
		<h1 id="head">Multiplayer Portal</h1>
		<div id="menu">
			<h1>Options</h1>
			<a href="multiplayer.php?option=fgame"><span class="span">FIND GAME</span></a>
			<a href="multiplayer.php?option=cgame&type=closed"><span class="span">CREATE GAME</span></a>
			<a href="multiplayer.php?option=my-upcominggame"><span class="span">MY UPCOMING GAME</span></a>
			<a href="dashboard.php"><span class="span">BACK</span></a>
		</div>
		<div id="content">
			<?php
			$commands = $_GET['option'];
			switch($commands){
				
				case "fgame": ?>
							<h1>Find Game</h1>
							<table id="mpftable">
							  <tr class="table_heading">
							    <th>Host</th>
							    <th>Title</th> 
							    <th>Scenario</th> 
							    <th>Starts_In</th> 
							    <th>View</th>
							  </tr>
						  	<?php
						  	include 'plattemplate/connection.php';
						  	$sql = mysqli_query($connection, "SELECT * FROM game");
						  	if(mysqli_num_rows($sql) > 0){
							  	$count = 0;
								while($row = mysqli_fetch_assoc($sql)){
									$count++;
									echo "<tr class='mpftr'>
									<td class='mphost'>".$row['HOST']."</td>
									<td class='mptitle'>".$row['TITLE']."</td>
									<td class='mpscenario'>".$row['SCENARIO']."</td>
									<td class='mptimer'><p id='"."timer$count"."'></p></td>
									<td class='mpview'><a href='multiplayer.php?option=viewgame&id=".$row['ID']."'>View</a></td>
									</tr>";	
								}						  		
						  	}else{
						  		echo "No Events Available";
						  	}
						  	?>
							</table>
						<?php
					break;
					
				case "cgame": ?>
							<h1>Create Game</h1>
							<table>
							  <tr class="table_heading">
							    <th class="cgame-title">Title</th>
							    <th><input type="text" id="title" placeholder="Enter game title"></th>
							  </tr>
							  <tr class="table_heading">
							    <th class="cgame-title">Description</th>
							    <th><textarea rows="5" placeholder="Game Description" id="desc"></textarea></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title">Start Time</th>
							    <th><input type="datetime-local" id="starttime"></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title">End Time</th>
							    <th><input type="datetime-local" id="endtime"></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title" id="scenario">Scenario</th>
							    <th>
							    	<select id="scena">
										<?php
										include 'plattemplate/connection.php';
										$result = mysqli_query($connection, "SELECT TEMP_NAME FROM smenu WHERE TYPE='ctf'");
										while($row = mysqli_fetch_assoc($result)){
											$tempname = $row['TEMP_NAME'];
											echo "<option value='$tempname'>$tempname</option>";
										}
										?>
									</select>
							    </th>
							  </tr>
							  <tr class="table_heading">
							    <th class="cgame-title">Team A</th>
							    <th><input type="text" id="teama" placeholder="Enter a name for Team A"></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title">Team B</th>
							    <th><input type="text" id="teamb" placeholder="Enter a name for Team B"></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title">Game Type</th>
							    <th>
							    	<select id="gtype">
										<option value='closed' >Closed</option>
										<option value='openforall'>Open For All</option>										
									</select>
							    </th>
							  </tr>						  							  						  								  						  							  						  
							</table>	
							<h1 id="out">Configure Team</h1>
							<table>
							  <tr class="table_heading">
							    <th id="setteama">Team A</th>
							    <th id="setteamb">Team B</th>
							  </tr>
							  <tr>
							    <th>
							    	<div id="viewteama">
							    		<?php
							    		require 'class/Constants.php';
							    		if(isset($_SESSION[Constants::SESSION_CREATEGAME_TEAMA]) && count($_SESSION[Constants::SESSION_CREATEGAME_TEAMA]) > 0){
								    		foreach($_SESSION[Constants::SESSION_CREATEGAME_TEAMA] as $key=>$usn){
								    			echo "<p class='vplayer'>$usn</p>";
								    		}								    			
							    		}else{
							    			echo "<p class='vplayer'>Please choose players</p>";
							    		}
							    		?>
							    	</div>
							    	<div id="viewteamaadd">
							    		<?php
							    		if(isset($_SESSION[Constants::SESSION_CREATEGAME_TEAMA])){
									    	foreach($_SESSION[Constants::SESSION_CREATEGAME_TEAMA] as $key=>$usn){
								    			echo "<p class='plusbtn' onclick='go.deleteTeamA(\"$usn\");'>-</p>";
								    		}
										}
										?>								    		
							    	</div>
							    </th>
							    <th>
							    	<div id="viewteamb">
							    		<?php
							    		if(isset($_SESSION[Constants::SESSION_CREATEGAME_TEAMB]) && count($_SESSION[Constants::SESSION_CREATEGAME_TEAMB]) > 0){
									    	foreach($_SESSION[Constants::SESSION_CREATEGAME_TEAMB] as $key=>$usn){
								    			echo "<p class='vplayer'>$usn</p>";
								    		}
										}else{
											echo "<p class='vplayer'>Please choose players</p>";
										}
										?>								    		
							    	</div>
							    	<div id="viewteambadd">
							    		<?php
							    		if(isset($_SESSION[Constants::SESSION_CREATEGAME_TEAMB])){
									    	foreach($_SESSION[Constants::SESSION_CREATEGAME_TEAMB] as $key=>$usn){
								    			echo "<p class='plusbtn' onclick='go.deleteTeamB(\"$usn\");'>-</p>";
								    		}
										}
										?>					    		
							    	</div>							    								    	
							    </th>
							  </tr>								  	
							  <tr>
							    <th>
							    	<div id="plotteama"></div>
							    	<div id="plotteamaadd"></div>
							    </th>
							    <th>
							    	<div id="plotteamb"></div>
							    	<div id="plotteambadd"></div>							    								    	
							    </th>
							  </tr>	
							  <tr>
							    <th><input type="text" id="searcha" placeholder="Search Player (Type & Press enter)"></th>
							    <th><input type="text" id="searchb" placeholder="Search Player (Type & Press enter)"></th>
							  </tr>							  							  
							</table></br></br>			
							<h1><button class="createbtn" id="createg">Create Game</button></h1>
			  <?php break;
					
				case "my-upcominggame":
					
					break;	
					
				case "viewgame":
					
					break;	
					
				default:
					header('location:multiplayer.php?option=fgame');
					break;					
			}
			?>
		</div>	
		<script src="pjs/mplayers.js"></script>
		<script src="noti/notify.js"></script>
		<script src="noti/notify.min.js"></script>
		<?php
			  	include 'plattemplate/connection.php';
			  	$sql = mysqli_query($connection, "SELECT START_TIME FROM game");
			  	$count = 0;
				if(mysqli_num_rows($sql) > 0){
					while($row = mysqli_fetch_assoc($sql)){
						$count++;			
					
					echo "<script>var countDownDate$count = new Date(\"".$row['START_TIME']."\").getTime();
							var x$count = setInterval(function() {
								var now$count = new Date().getTime();
								var distance$count = countDownDate$count - now$count;
								var days$count = Math.floor(distance$count / (1000 * 60 * 60 * 24));
								var hours$count = Math.floor((distance$count % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
								var minutes$count = Math.floor((distance$count % (1000 * 60 * 60)) / (1000 * 60));
								var seconds$count = Math.floor((distance$count % (1000 * 60)) / 1000);
								
								document.getElementById(\""."timer$count"."\").innerHTML = days$count + \"d \" + hours$count + \"h \"
								  + minutes$count + \"m \" + seconds$count + \"s \";
								if (distance$count < 0) {
								    clearInterval(x$count);
								    document.getElementById(\""."timer$count"."\").innerHTML = \"STARTED\";
								}
							}, 1000);</script>";		
					}					
				}							
		?>
</body>
</html>