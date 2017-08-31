<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Iceland|Orbitron" rel="stylesheet"> 
		<link href="css/admin.css" type="text/css" rel="stylesheet" />
	</head>
<body style="background:url('images/bgadmin.png');">
	
	<div id="wrapper">	
		<h1 id="head">Options</h1>
		<div id="menu">
			<h1>Menu</h1>
			<a href="admin.php?option=team"><span>TEAM</span></a>
			<a href="admin.php?option=token"><span>CREATE TOKENS</span></a>
			<a href="admin.php?option=team-members"><span>TEAM MEMBERS</span></a>
			<a href="template/logout.php"><span>LOGOUT</span></a>
			<a href="dashboard.php"><span>BACK</span></a>
		</div>
		<div id="content">
			<?php
			require 'class/Validator.php';
			if(isset($_GET['option'])){
				$command = $_GET['option'];
				switch($command){
					case "announce":
							?>
							<h1>Announce</h1>
							<form method="post" action="admin.php?option=announce">
								<textarea rows="10" placeholder="Enter your message for announcement" name="team_announce"></textarea>
								<input id="ann_submit" type="submit" value="Send" name="a_send" <?php if(!Validator::AdminEditPermission()){echo "disabled "; echo Validator::DisabledCSS();}?>/>
							</form>
							<?php
						break;
						

						
				case "options":
						
					break; 	

					default:
						header('location:admin.php?option=team');
						break;	
				}			
			}
			
			?>
			<?php
				function randomToken() {
				    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
				    $password = array(); 
				    $letterLength = strlen($letters) - 1; 
				    for ($i = 0; $i < 8; $i++) {
				        $n = rand(0, $letterLength);
				        $password[] = $letters[$n];
				    }
				    return implode($password); 
				}
			
			?>
		</div>
	</div>

</body>
</html>