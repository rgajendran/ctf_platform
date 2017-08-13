<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(isset($_SESSION['USERID'])){
	require 'class/PlatformDB.php';
	$gameid = PlatformDB::set_gameid_insession($_SESSION['USERID']);
	$_SESSION['GAMEID'] = $gameid[0];
	$_SESSION['TEAM'] = $gameid[1]; 
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
		<link href="css/pcss/multiplayer.css" type="text/css" rel="stylesheet" />
	</head>
<body style="background:url('images/bgadmin.png');">
	
	<div id="wrapper">	
		<h1 id="head">Multiplayer Portal</h1>
		<div id="menu">
			<h1>Options</h1>
			<a href="multiplayer.php?option=request"><span class="span">INVITES</span></a>
			<a href="multiplayer.php?option=fgame"><span class="span">OPEN GAME</span></a>
			<a href="multiplayer.php?option=cgame&type=closed"><span class="span">CREATE GAME</span></a>
			<a href="multiplayer.php?option=my-upcominggame"><span class="span">MY UPCOMING GAME</span></a>
			<a href="multiplayer.php?option=team"><span class="span">CREATE TEAM</span></a>
			<a href="dashboard.php"><span class="span">BACK</span></a>
		</div>
		<div id="content">
			<?php
			$commands = $_GET['option'];
			switch($commands){
				
				case "request": ?>
							<h1>Pending Request</h1>
							<table id="mpftable">
							  <tr class="table_heading">
							    <th class='mphost'>Title</th>
							    <th class='mptitle'>Description</th> 
							    <th class='mpview'>View</th> 
							    <th class='mptimer'>Approve</th> 
							  </tr>
						  	<?php
						  	require 'class/Validator.php';
						  	include 'plattemplate/connection.php';
							$c = new Creditional();
							$uid = $c->getUserId();
						  	$sql = mysqli_query($connection, "SELECT GAME_ID FROM game_players WHERE PLAYER='$uid' AND P_STATUS='0'");
						  	if(mysqli_num_rows($sql) > 0){
								while($row = mysqli_fetch_assoc($sql)){
									$gameId = $row['GAME_ID'];
									$pensql = mysqli_query($connection, "SELECT * FROM game WHERE GAME_ID='$gameId'");
									while($prow = mysqli_fetch_assoc($pensql)){
										echo "<tr class='mpftr'>
										<td class='mphost'>".$prow['TITLE']."</td>
										<td class='mptitle'>".$prow['DESP']."</td>
										<td class='mpview'><a href='multiplayer.php?option=viewgame&from=request&id=".$row['GAME_ID']."'>View</a></td>
										<td class='mptimer'><button onclick='submit.reqAccept(\"".$row['GAME_ID']."\")'>APPROVE</button></td>
										</tr>";											
									}
								}						  		
						  	}else{
						  		echo "<tr><td colspan='4'>No Events Available</td></tr>";
						  	}
						  	?>
							</table>						
				<?php	
					break;
				
				case "fgame": ?>
							<h1>Find Game</h1>
							<table id="mpftable">
							  <tr class="table_heading">
							    <th class='mphost'>Host</th>
							    <th class='mptitle'>Title</th> 
							    <th class='mpscenario'>Scenario</th> 
							    <th class='mptimer'>Starts_In</th> 
							    <th class='mpview'>View</th>
							  </tr>
						  	<?php
						  	include 'plattemplate/connection.php';
							date_default_timezone_set('Europe/London');
							$timezone = 'Europe/London'; 
							$dates = new DateTime('now', new DateTimeZone($timezone));
							$local = strtotime($dates->format('Y-m-d H:i:s'));
						  	$sql = mysqli_query($connection, "SELECT * FROM game WHERE START_TIME > $local");
						  	if(mysqli_num_rows($sql) > 0){
							  	$count = 0;
								while($row = mysqli_fetch_assoc($sql)){
									$count++;
										$timezone = 'Europe/London'; 
										$date = new DateTime('now', new DateTimeZone($timezone));
										$localtime = $date->format('Y-m-d H:i:s');
										if(strtotime($row['START_TIME']) > strtotime($localtime)){
											echo "<tr class='mpftr'>
												<td class='mphost'>".$row['HOST']."</td>
												<td class='mptitle'>".$row['TITLE']."</td>
												<td class='mpscenario'>".$row['SCENARIO']."</td>
												<td class='mptimer'><p id='"."timer$count"."'></p></td>
												<td class='mpview'><a href='multiplayer.php?option=viewgame&from=fgame&id=".$row['GAME_ID']."'>View</a></td>
											</tr>";	
										}
								}						  		
						  	}else{
						  		echo "<tr><td colspan='5'>No Events Available</td></tr>";
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
										$result = mysqli_query($connection, "SELECT TEMP_SCENARIO FROM smenu WHERE TYPE='ctf'");
										while($row = mysqli_fetch_assoc($result)){
											$tempname = $row['TEMP_SCENARIO'];
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
										<option value='closed' <?php if($_GET['type'] == "closed"){echo "selected";}?>>Closed</option>
										<option value='openforall' <?php if($_GET['type'] == "openforall"){echo "selected";}?>>Open For All</option>										
									</select>
							    </th>
							  </tr>						  							  						  								  						  							  						  
							</table>	
							<?php if($_GET['type'] == "closed"){?>
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
							</table>
							<?php } ?>
							</br></br>			
							<h1><button class="createbtn" id="createg">Create Game</button></h1>
			  <?php break;
			  
				case "team": 
				?>
							<h1>My Teams</h1>
							<table>
									<?php
									require 'class/Validator.php';
									include 'plattemplate/connection.php';
									$c = new Creditional();
									$sql = mysqli_query($connection, "SELECT * FROM teams WHERE HOST='".$c->getUsername()."'");
									if(mysqli_num_rows($sql) == 0){
										echo "<tr><th colspan='2'>No Teams Found</th></tr>";
									}else{
										while($row = mysqli_fetch_assoc($sql)){
											echo "<tr class='table_heading'><th>".$row['TEAM']."</th>";
											echo "<th class='viewplayers'>".
												$row['P_1']."</br>".
												$row['P_2']."</br>".
												$row['P_3']."</br>".
												$row['P_4']."</br>".
												$row['P_5']."</br>".
											"</th></tr>";
										}	
									}									
									?>
							</table>
							<h1>Create Teams</h1>
							<table>
							  <tr class="table_heading">
							    <th id="setteama"><input type="text" id="oteamCreate" placeholder="Enter a name for your team"></th>
							  </tr>
							  <tr>
							    <th>
							    	<div id="viewsearchteama">
							    		<?php
							    		require 'class/Constants.php';
							    		if(isset($_SESSION[Constants::SESSION_CREATETEAM]) && count($_SESSION[Constants::SESSION_CREATETEAM]) > 0){
								    		foreach($_SESSION[Constants::SESSION_CREATETEAM] as $key=>$usn){
								    			echo "<p class='vplayer'>$usn</p>";
								    		}								    			
							    		}else{
							    			echo "<p class='vplayer'>Please choose players</p>";
							    		}
							    		?>
							    	</div>
							    	<div id="viewsearchteamaadd">
							    		<?php
							    		if(isset($_SESSION[Constants::SESSION_CREATETEAM])){
									    	foreach($_SESSION[Constants::SESSION_CREATETEAM] as $key=>$usn){
								    			echo "<p class='plusbtn' onclick='go.deleteTeamSearch(\"$usn\");'>-</p>";
								    		}
										}
										?>								    		
							    	</div>
							    </th>
							  </tr>								  	
							  <tr>
							    <th>
							    	<div id="plotsearchteama"></div>
							    	<div id="plotsearchteamaadd"></div>
							    </th>
							  </tr>	
							  <tr>
							    <th><input type="text" id="teamsearch" placeholder="Search Player (Type & Press enter)"><input type="submit" value="Create Team" id="teamsearchbtn" onclick="createteam.create();"/></th>
							  </tr>							  							  
							</table>				
					
					<?php 
					break;
					
				case "my-upcominggame": ?>
							<h1>My Upcoming Game</h1>
							<table id="mpftable">
							  <tr class="table_heading">
							    <th class='mphost'>Host</th>
							    <th class='mptitle'>Title</th> 
							    <th class='mpscenario'>Description</th> 
							    <th class='mpview'>View</th> 
							  </tr>
						  	<?php
						  	require 'class/Validator.php';
						  	include 'plattemplate/connection.php';
							$c = new Creditional();
							$uid = $c->getUserId();
						  	$sql = mysqli_query($connection, "SELECT GAME_ID FROM game_players WHERE PLAYER='$uid' AND P_STATUS='1'");
						  	if(mysqli_num_rows($sql) > 0){
								while($row = mysqli_fetch_assoc($sql)){
									$gameId = $row['GAME_ID'];
									$pensql = mysqli_query($connection, "SELECT * FROM game WHERE GAME_ID='$gameId'");
									while($prow = mysqli_fetch_assoc($pensql)){
										echo "<tr class='mpftr'>
										<td class='mphost'>".$prow['HOST']."</td>
										<td class='mptitle'>".$prow['TITLE']."</td>
										<td class='mpscenario'>".$prow['DESP']."</td>
										<td class='mpview'><button onclick='submit.redirect(\"multiplayer.php?option=viewgame&from=my-upcominggame&id=$gameId\");'>View</button></td>
										</tr>";											
									}
								}						  		
						  	}else{
						  		echo "<tr><td colspan='4'>No Events Available</td></tr>";
						  	}
						  	?>
							</table>
							<?php				
					break;	
					
				case "viewgame": 
					if(isset($_GET['id'])){
						require 'class/DBV.php';
						require 'class/Validator.php';
						$gameId = Validator::PregAlphaNumeric($_GET['id']);
						include 'plattemplate/connection.php';
						$query = mysqli_query($connection, "SELECT * FROM ".DBV::TB_game." WHERE GAME_ID='$gameId'");
						if(mysqli_num_rows($query) == 1){
						$assoc = mysqli_fetch_assoc($query);
						if(isset($_GET['from'])){
							$from = $_GET['from'];
							$url = "multiplayer.php?option=$from";	
						}else{
							$url = "multiplayer.php?option=request";	
						}	
						?>
							<h1>Game Summary</h1>
							<table>
							  <tr class="table_heading">
							    <th class="cgame-title">Title</th>
							    <th><?php echo $assoc['TITLE']; ?></th>
							  </tr>
							  <tr class="table_heading">
							    <th class="cgame-title">Description</th>
							    <th><?php echo $assoc['DESP']; ?></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title">Start Time</th>
							    <th><?php echo $assoc['START_TIME']; ?></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title">End Time</th>
							    <th><?php echo $assoc['END_TIME']; ?></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title" id="scenario">Scenario</th>
							    <th><?php echo $assoc['SCENARIO']; ?></th>
							  </tr>
							  <tr class="table_heading">
							    <th class="cgame-title">Game Type</th>
							    <th><?php echo $assoc['TYPE']; ?></th>
							  </tr>						  							  						  								  						  							  						  
							</table>	
							<h1 id="out">Players</h1>
							<table>
							  <tr class="table_heading">
							    <th id="setteama"><?php echo $assoc['TEAM_A']; ?></th>
							    <th id="setteamb"><?php echo $assoc['TEAM_B']; ?></th>
							  </tr>
							  <tr>
							    <th>
							    	<div id="viewteama">
							    		<?php
							    		$teamA = $assoc['TEAM_A'];
							    		$teamB = $assoc['TEAM_B'];
										$query1 = mysqli_query($connection, "SELECT PLAYER FROM ".DBV::TB_game_players." WHERE GAME_ID='$gameId' AND TEAM='$teamA'");
										if(mysqli_num_rows($query1) > 0){
								    		while($r = mysqli_fetch_assoc($query1)){
								    			$query11 = mysqli_query($connection, "SELECT USERNAME FROM ".DBV::TB_loginusers." WHERE USERID='".$r['PLAYER']."'");
												$query11Assoc = mysqli_fetch_assoc($query11);
								    			echo "<p class='vplayer'>".$query11Assoc['USERNAME']."</p>";
								    		}											
										}
							    		?>
							    	</div>
							    	<div id="viewteamaadd"></div>
							    </th>
							    <th>
							    	<div id="viewteamb">
							    		<?php
										$query1 = mysqli_query($connection, "SELECT PLAYER FROM ".DBV::TB_game_players." WHERE GAME_ID='$gameId' AND TEAM='$teamB'");
										if(mysqli_num_rows($query1) > 0){
								    		while($r = mysqli_fetch_assoc($query1)){
								    			$query11 = mysqli_query($connection, "SELECT USERNAME FROM ".DBV::TB_loginusers." WHERE USERID='".$r['PLAYER']."'");
												$query11Assoc = mysqli_fetch_assoc($query11);
								    			echo "<p class='vplayer'>".$query11Assoc['USERNAME']."</p>";
								    		}
										}
							    		?>								    		
							    	</div>
							    	<div id="viewteambadd"></div>							    								    	
							    </th>
							  </tr>								  						  							  
							</table></br></br>			
							<h1><button class="createbtn" onclick="submit.redirect('<?php echo $url; ?>')">Back</button></h1>
						<?php
						}else{
							header("location:multiplayer.php?option=fgame");	
						}
					}else{
						if(isset($_GET['from'])){
							$from = $_GET['from'];
							header("location:multiplayer.php?option=$from");	
						}else{
							header("location:multiplayer.php?option=request");	
						}	
					}
									
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
		if($_GET['option'] == "fgame"){
			  	include 'plattemplate/connection.php';
				date_default_timezone_set('Europe/London');
				$timezone = 'Europe/London'; 
				$dates = new DateTime('now', new DateTimeZone($timezone));
				$locals = strtotime($dates->format('Y-m-d H:i:s'));
			  	$sql = mysqli_query($connection, "SELECT START_TIME FROM game WHERE START_TIME > $locals");
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
		}						
		?>
</body>
</html>