<?php 
session_start();
if(!isset($_SESSION['USERNAME']) || !isset($_SESSION['TYPE'])){
	header('location:index.php');
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
					<td class="c-end"><input type="text" id="vmname" placeholder="Enter your VM name" maxlength="30"/></td>
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
			<script src="pjs/dashboard.js"></script>
		</div>	
		<div id="side_menu">
			<h4 align="center">Available VM's</h4>
				<table>
					<?php
					require 'class/PlatformValidator.php';
					require 'class/Validator.php';
					require 'class/Constants.php';
					$c = new Creditional();
					$resultvm = mysqli_query($connection, "SELECT VMNAME,VMID FROM vm WHERE USERNAME='".$c->getUsername()."'");
					$pv = new PlatformValidator();
					if($resultvm){
						if(mysqli_num_rows($resultvm) == 0){
								echo '<tr class="tg">
								    	<td>No VM\'s available</td>
								  	</tr>';
						}else{
							while($vmrow = mysqli_fetch_assoc($resultvm)){
								$vmname = $pv->RemoveVMNameextraInfo($vmrow['VMNAME']);
								$vmid = $vmrow['VMID'];
								echo "<tr class=\"tg\">
									    <td class=\"t-name\">$vmname</td>
									    <td class=\"t-icon\"><img src=\"images/icon/run.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_RUN."\",\"$vmid\");'/></td>
									    <td class=\"t-icon\"><img src=\"images/icon/start.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_START."\",\"$vmid\");'/></td>
									    <td class=\"t-icon\"><img src=\"images/icon/stop.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_STOP."\",\"$vmid\");'/></td>
									    <td class=\"t-icon\"><img src=\"images/icon/delete.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_DELETE."\",\"$vmid\");'/></td>
									  </tr>";
							}	
						}						
					}else{
						echo mysqli_error($connection);
					}

					?>			  				  				  
				</table>
		</div>	
	</div>
	<script src="pjs/splayers.js"></script>
</body>
</html>