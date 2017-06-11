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
		<h1 id="head">Single Player</h1>
		<div id="nav">
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
				<tr class="c-name">
					<td class="c-head"><h3>Choose VM Name</h3></td>
					<td class="c-mid">:</td>
					<td class="c-end"><input type="text" id="vmname" placeholder="Enter your VM name" maxlength="40"/></td>
				</tr>				
				<tr class="c-name">
					<td  colspan="3">
						<div id="loading">
							<?php echo "<pre>"; ?><p id="status">status</p><?php echo "</pre>"; ?>
						</div>
					</td>
				</tr>
			</table>
			<div id="loading-buttons">
				<input type="hidden" id="scenario" value="<?php if(isset($_GET['scenario'])){echo $_GET['scenario'];}?>" />
				<button >Back</button>
				<button id="play">Create Scenario</button>
			</div>
			<script src="js/dashboard.js"></script>
		</div>	
		<div id="side_menu">
			<h4 align="center">Available VM's</h4>
				<table>
					<?php
					include 'plattemplate/connection.php';
					$result_vm = mysqli_query($connection, "SELECT VMNAME FROM vm WHERE USERNAME=$credit->getUsername()");
					if(mysqli_num_rows($result_vm) == 0){
							echo '<tr class="tg">
							    	<td>No VMs available</td>
							  	</tr>';
					}else{
						while($vmrow = mysqli_fetch_assoc($result_vm)){
							echo '<tr class="tg">
								    <td class="t-name">'.$vmrow['VMNAME'].'</td>
								    <td class="t-icon">d</td>
								    <td class="t-icon">d</td>
								    <td class="t-icon">d</td>
								    <td class="t-icon">d</td>
								  </tr>';
						}	
					}
					?>			  				  				  
				</table>
		</div>	
	</div>
</body>
</html>