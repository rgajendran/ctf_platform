<?php

class PlatformDB{
	
	##platform code 
	
	public static function getTemplateWithScenarioName($input_tempname){
		include '../plattemplate/connection.php';
		if($connection->connect_error){
			return "Technical Error [DB1001]".$connection->connect_error;
		}
		
		$stmt = $connection->prepare("SELECT TEMPLATE,TEMP_SIZE FROM smenu WHERE TEMP_NAME=?");
		$stmt->bind_param("s", $tempname);
		$tempname = Validator::filterString($input_tempname);
		$stmt->execute();
		$stmt->bind_result($col1,$col2);
		$arr = array();
		while($stmt->fetch()){
			$arr[$col1] = $col2;
		}
		return $arr;
		$stmt->close();
		$connection->close();
		
	}
	
	public static function checkVMNumberCount($username){
		include '../plattemplate/connection.php';	
		$result = mysqli_query($connection, "SELECT VMNAME FROM vm WHERE USERNAME='$username'");
		if(mysqli_num_rows($result) <= Constants::SINGLE_PLAYER_ALLOWED_VMS_TO_CREATE){
			return true;
		}else{
			return false;
		}
	}
	
	public static function insertVMDetails($username, $vmname, $vmid){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "INSERT INTO vm (USERNAME, VMNAME, VMID) VALUES ('$username', '$vmname', '$vmid')");
		if($result){
			return Constants::DB_SUCCESS;
		}else{
			return Constants::DB_FAILURE;
		}
	}
	
	public static function checkIfVMIdExistsForUser($vmid, $user){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "SELECT VMID FROM vm WHERE USERNAME='$user' AND VMID='$vmid'");
		return mysqli_num_rows($result);
	}
	
	public static function deleteVMfromDbWithVmIdandUser($vmid, $user){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "DELETE FROM vm WHERE USERNAME='$user' AND VMID='$vmid'");
		if($result){
			return Constants::DB_SUCCESS;
		}else{
			return Constants::DB_FAILURE;
		}
	}
	
	public static function checkIfScenarioExists($scenario){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "SELECT TEMP_SCENARIO FROM smenu WHERE TEMP_SCENARIO='$scenario'");
		if(mysqli_num_rows($result) == 1){
			return true;
		}else{
			return false;
		}
	}
	
	public static function insertgamedata($user, $gameid, $starttime, $endtime, $scenario, $template, $teama, $teamb, $type, $title,$desc){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "INSERT INTO game (HOST, GAME_ID, START_TIME, END_TIME, SCENARIO, TEMPLATE, TEAM_A, TEAM_B, TYPE, TITLE, DESP) VALUES (
		'$user','$gameid','$starttime','$endtime','$scenario','$template','$teama','$teamb','$type','$title','$desc')");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	public static function authorizeGameId($gameid){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "SELECT GAME_ID FROM game WHERE GAME_ID='$gameid'");
		if(mysqli_num_rows($result) == 0){
			return true;
		}else{
			return false;
		}		
	}
	
	public static function checkIfPlayerPlayedTemplate($snsarray, $template){
		include '../plattemplate/connection.php';
		
		foreach($snsarray as $key => $value){
			$result = mysqli_query($connection, "SELECT TEMPLATE FROM scenariologger WHERE USERID='$key' AND TEMPLATE='$template'");
			if(mysqli_num_rows($result) > 0){
				return false;
			}else{
				return true;
			}                
		}
	
	}
	
	public static function smenuGetTemplateByBackupNumber($scenario, $backupno){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "SELECT ".$backupno." FROM smenu WHERE TEMP_SCENARIO='$scenario'");
		while($row = mysqli_fetch_assoc($result)){
			return $row[$backupno];
		}
	}
	
	public static function create_hint_secgen_table($table){
		include '../template/connection.php';
	 	$flagSql = "CREATE TABLE `".$table."_secgenflag` (
						  `ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						  `TEAM` int(11) NOT NULL,
						  `C_ID` varchar(6) NOT NULL,
						  `STATUS` int(1) NOT NULL,
						  `VM` varchar(200) NOT NULL,
						  `IP` text NOT NULL,
						  `FLAG` text NOT NULL,
						  `FLAG_POINTS` int(100) NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
						
		$hintSql = "CREATE TABLE `".$table."_hint` (
						  `ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						  `TEAM` int(2) NOT NULL,
						  `SYSTEM_NAME` varchar(100) NOT NULL,
						  `C_ID` varchar(10) NOT NULL,
						  `CHALLENGE` int(5) NOT NULL,
						  `HINT_STATUS` int(1) NOT NULL,
						  `HINT_ID` varchar(100) NOT NULL,
						  `HINT_TYPE` varchar(100) NOT NULL,
						  `HINT_TEXT` text NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=latin1;";			
						
		$result = mysqli_query($connection, $flagSql);
		if($result){
			$r = mysqli_query($connection, $hintSql);
			if($r){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}				
	}
	
	public static function delete_hint_secgen_table($table){
		include '../template/connection.php';
		mysqli_query($connection, "DROP TABLE IF EXISTS ".$table."_secgenflag");
		mysqli_query($connection, "DROP TABLE IF EXISTS ".$table."_hint");
	}
	
	public static function insert_recreate_vm_usingbackendtable($scenario, $scenario_path, $CTF, $backupno){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "INSERT INTO backend (CTF, SCENARIONAME, SCENARIO, PROCESSING, COMPLETED, BACKUP) VALUES ('$CTF',
		'$scenario','$scenario_path','0','0','$backupno')");
		if($result){
			return true;
		}else{
			return false;
		}
	}
	
	public static function check_backend_progress($scenario, $backupno){
		include '../plattemplate/connection.php';
		$result = mysqli_query($connection, "SELECT SCENARIONAME FROM backend WHERE SCENARIONAME='$scenario' AND BACKUP='$backupno'");
		if(mysqli_num_rows($result) > 0){
			return false;
		}else{
			return true;
		}
	}
	
	public static function insert_hint_and_secgenflag_data($filename, $tablename, $team){
		include '../template/connection.php';
		if(file_exists("../marker/".$filename.".xml")){
			$xml = simplexml_load_file("../marker/".$filename.".xml");
			for($i = 1; $i<=$team; $i++){
				foreach($xml->system as $system){
					$count = count($system->challenge);
					$q = mysqli_query($connection, "SELECT C_ID FROM secgen WHERE C_NO='$count'");
					$chall = 0;
					foreach($system->challenge as $challenge){
						$chall++;
						$num = 0;		
						foreach(mysqli_fetch_assoc($q) as $cid){
							$secgenflag = mysqli_query($connection,"INSERT INTO ".$tablename."_secgenflag (TEAM, C_ID, STATUS, VM, IP, FLAG, FLAG_POINTS) VALUES('$i', '$cid', '0', '$system->system_name', 
							'$system->platform', '$challenge->flag','100')");
							if($secgenflag){
								foreach($challenge->hint as $hint){
									$num++;
									$randomKey = strtoupper(md5(bin2hex(openssl_random_pseudo_bytes(16)).time()));
									$hintText = addslashes($hint->hint_text);
									$hint_update = mysqli_query($connection, "INSERT INTO ".$tablename."_hint (TEAM, SYSTEM_NAME, C_ID, CHALLENGE, HINT_STATUS, HINT_ID, HINT_TYPE, HINT_TEXT) VALUES 
									('$i','$system->system_name','$cid','$chall','0','$hint->hint_id','$hint->hint_type','$hintText')");
									if(!$hint_update){
										return false;
									}			
								}
							}else{
								return false;
							}		
		
						}
					}
				}				
			}
			return true;
		}else{
			return false;
		}

	}

	public static function insert_scoreboard_team($gameid, $team1, $team2){
		include '../template/connection.php';
		$team = array($team1, $team2);
		for($i = 1; $i<=2; $i++){
			$result = mysqli_query($connection, "INSERT INTO team (GAMEID, TEAM, TEAMNAME) VALUES ('$gameid','$i','".$team[$i-1]."')");
			if(!$result){
				return false;
			}else{
				$res = mysqli_query($connection, "INSERT INTO scoreboard (GAMEID, TEAM, TEAMNAME, SCORE, PENALTY) VALUES ('$gameid','$i','".$team[$i-1]."','0','0')");
				if(!$res){
					return false;
				}
			}
		}
		return true;
	}
	
	public static function delete_scoreboard_team($gameid){
		include '../template/connection.php';
		$result = mysqli_query($connection, "DELETE * FROM scoreboard WHERE GAMEID='$gameid'");
		if($result){
			$team= mysqli_query($connection, "DELETE * FROM team WHERE GAMEID='$gameid'");
			if($team){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public static function insert_updater($team, $gameid, $userid){
		include '../template/connection.php';
		$update = mysqli_query($connection, "INSERT INTO updater (TEAM, GAMEID, USERID) VALUES ('$team','$gameid','$userid')");
		if($update){
			return true;
		}else{
			return false;
		}
	}
	
	public static function set_gameid_insession($userid){
		include 'plattemplate/connection.php';
		date_default_timezone_set('Europe/London');
		$timezone = 'Europe/London'; 
		$date = new DateTime('now', new DateTimeZone($timezone));
		$localtime = $date->format('Y-m-d H:i:s');		
		$getgame = mysqli_query($connection, "SELECT GAME_ID, TEAMNO FROM game_players WHERE PLAYER='$userid' AND P_STATUS='1'");
		if(mysqli_num_rows($getgame) > 0){
			while($grow = mysqli_fetch_assoc($getgame)){
				$gid = $grow['GAME_ID'];
				$team = $grow['TEAMNO'];
				$result = mysqli_query($connection, "SELECT GAME_ID, START_TIME, END_TIME FROM game WHERE GAME_ID='$gid'");
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						$starttime = $row['START_TIME'];
						$endtime = $row['END_TIME'];
						if(strtotime($endtime)>strtotime($localtime) && strtotime($starttime)<strtotime($localtime)){
							return array($row['GAME_ID'], $team);
						}		
					}
				}		
			}		
		}
	}
}

?>