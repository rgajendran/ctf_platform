<?php

if(isset($_POST['update']) && isset($_POST['team'])){
	include 'connection.php';
	require '../class/Validator.php';
	$c = new Creditional();
	$team = $_POST['team'];
	$sv = $_POST['update'];
	$username = $_POST['username'];
	$result = mysqli_query($connection, "UPDATE updater SET $sv='0' WHERE TEAM='$team' AND USERID='$username' AND GAME_ID='".$c->getGameId()."'");	
	if($result){
		if($sv == "HINT"){
			$chooseHint = mysqli_query($connection, "SELECT HINT_UPDATE FROM updater WHERE TEAM='$team' AND USERID='$username' AND GAME_ID='".$c->getGameId()."'");
			if($chooseHint){
				while($row = mysqli_fetch_assoc($chooseHint)){
					$hint = $row['HINT_UPDATE'];
					echo $hint;
				}
			}else{
				echo "Failed";
			}
		}else{
			echo "Success";
		}		
	}else{
		echo "Failed";
	}
}
?>