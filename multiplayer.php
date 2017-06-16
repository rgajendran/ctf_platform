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
			<a href="multiplayer.php?option=fgame"><span>FIND GAME</span></a>
			<a href="multiplayer.php?option=cgame"><span>CREATE GAME</span></a>
			<a href="multiplayer.php?option=my-upcominggame"><span>MY UPCOMING GAME</span></a>
			<a href="dashboard.php"><span>BACK</span></a>
		</div>
		<div id="content">
			<?php
			$commands = $_GET['option'];
			switch($commands){
				
				case "fgame": ?>
							<h1>Find Game</h1>
							<table>
							  <tr class="table_heading">
							    <th>Team Code</th>
							    <th>Team Name</th> 
							  </tr>

							  <tr>
							    <td><?php echo $team_list_row['TEAM'];?></td>
							    <td><?php echo $team_list_row['TEAMNAME'];?></td> 
							  </tr>
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
							    <th><input type="datetime-local" id="starttime"></th>
							  </tr>	
							  <tr class="table_heading">
							    <th class="cgame-title">Scenario</th>
							    <th>
							    	<select id="scenario">
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
										<option value='closed'>Closed</option>
										<option value='openforall'>Open For All</option>										
									</select>
							    </th>
							  </tr>						  							  						  								  						  							  						  
							</table>	
							<h1>Configure Team</h1>
							<table>
							  <tr class="table_heading">
							    <th id="setteama">Team A</th>
							    <th id="setteamb">Team B</th>
							  </tr>	
							  <tr>
							    <th>
							    	<div id="plotteama">
							    		
							    	</div>
							    </th>
							    <th>
							    	<div id="plotteamb">
							    		
							    	</div>							    	
							    </th>
							  </tr>	
							  <tr>
							    <th><input type="text" id="searcha" placeholder="Search Player (Type & Press enter)"></th>
							    <th><input type="text" id="searchb" placeholder="Search Player (Type & Press enter)"></th>
							  </tr>								  							  
							</table></br></br>			
			  <?php break;
					
				case "my-upcominggame":
					
					break;	
					
				default:
					header('location:multiplayer.php?option=fgame');
					break;					
			}
			?>
		</div>	
		<script src="pjs/mplayers.js"></script>
</body>
</html>