<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../class/Validator.php';
require '../class/Constants.php';
require '../class/DBV.php';
require '../class/PlatformValidator.php';
require '../class/PlatformDB.php';
if(isset($_POST['team']) && isset($_POST['val'])){
	$tm = $_POST['team'];
	$val = Validator::PregAlphaNumericUnderScore(Validator::filterString($_POST['val']));
	if($tm == "a"){
		doTask($tm, $val);
	}else if($tm == "b"){
		doTask($tm, $val);
	}else{
		echo Constants::ERROR_EXESP_INVALID_REQUEST.Constants::ERROR_CODE_3012;
	}
}else if(isset($_POST['username']) && isset($_POST['team'])){
	$username = Validator::PregAlphaNumericUnderScore(Validator::filterString($_POST['username']));
	include '../plattemplate/connection.php';
	$sql = mysqli_query($connection, "SELECT ".DBV::login_users_userid." FROM ".DBV::TB_loginusers." WHERE ".DBV::login_users_username."='$username'");
	if(mysqli_num_rows($sql) == 1){
		if($_POST['team'] == "at"){
			while($row = mysqli_fetch_assoc($sql)){
				sessionExtract(Constants::SESSION_CREATEGAME_TEAMA, $username, $row[DBV::login_users_userid]);				
			}
		}else if($_POST['team'] == "bt"){
			while($row = mysqli_fetch_assoc($sql)){
				sessionExtract(Constants::SESSION_CREATEGAME_TEAMB, $username,$row[DBV::login_users_userid]);
			}
		}
	}
}else if(isset($_POST['un']) && isset($_POST['tms'])){
	session_start();
	$username = $_POST['un'];
	$team = $_POST['tms'];
	if($team == "a"){
		unset($_SESSION[Constants::SESSION_CREATEGAME_TEAMA][array_search($username, $_SESSION[Constants::SESSION_CREATEGAME_TEAMA])]);
		sessionOutput("success", implode("~#~", $_SESSION[Constants::SESSION_CREATEGAME_TEAMA]));
	}else if($team == "b"){
		unset($_SESSION[Constants::SESSION_CREATEGAME_TEAMB][array_search($username, $_SESSION[Constants::SESSION_CREATEGAME_TEAMB])]);
		sessionOutput("success", implode("~#~", $_SESSION[Constants::SESSION_CREATEGAME_TEAMB]));
	}
}else if(isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['starttime']) && isset($_POST['endtime']) && 
isset($_POST['scenario']) && isset($_POST['teama']) && isset($_POST['teamb']) && isset($_POST['gametype'])){
	$title = Validator::PregAlphaNumericUnderScoreSpace($_POST['title']);
	$desc = Validator::PregAlphaNumericUnderScoreSpace($_POST['desc']);
	$starttime = $_POST['starttime'];
	$endtime = $_POST['endtime'];
	$scenario = Validator::PregAlphaNumericUnderScoreSpace($_POST['scenario']);
	$teama = Validator::PregAlphaNumericUnderScoreSpace($_POST['teama']);
	$teamb = Validator::PregAlphaNumericUnderScoreSpace($_POST['teamb']);
	$gametype = $_POST['gametype'];
	if(Validator::StringLength(2, 20, $title)){
	   if(Validator::StringLength(2, 200, $desc)) {
			if(Validator::StringLength(5, 15, $teama)){
				if(Validator::StringLength(5, 15, $teamb)){
					if(Validator::validateDate($starttime)){
						if(Validator::validateDate($endtime)){
							if(PlatformDB::checkIfScenarioExists($scenario)){
								if(in_array($gametype, $allow = array(Constants::FP_GAME_TYPE_CLOSED,Constants::FP_GAME_TYPE_OPENFORALL))){
									switch($gametype){
										case Constants::FP_GAME_TYPE_CLOSED:
											session_start();
											$avsession = array(Constants::SESSION_CREATEGAME_TEAMA, Constants::SESSION_CREATEGAME_TEAMB);
											if(count($_SESSION[$avsession[0]]) >= 3 && count($_SESSION[$avsession[1]]) >= 3){
												if(count($_SESSION[$avsession[0]]) == count($_SESSION[$avsession[1]])){
													$gameid = randomTokenNstatic();
													if(PlatformDB::authorizeGameId($gameid)){
														$c = new Creditional();
														include '../plattemplate/connection.php';
														if(PlatformDB::insertgamedata($c->getUsername(), $gameid, $starttime, $endtime, $scenario, $teama, $teamb, $gametype, $title, $desc)){
															$errA = 0;
															$errB = 0;
															for($i = 0; $i<count($avsession); $i++){
																foreach($_SESSION[$avsession[$i]] as $key=>$value){
																	if($avsession[$i] == Constants::SESSION_CREATEGAME_TEAMA){
																		$sql = mysqli_query($connection, "INSERT INTO game_players (GAME_ID, TEAM, PLAYER, P_STATUS, P_VM) VALUES (
																		'$gameid','$teama','$key','NA','NA')");	
																		if($sql){
																			$errA++;
																		}
																	}else{
																		$sql = mysqli_query($connection, "INSERT INTO game_players (GAME_ID, TEAM, PLAYER, P_STATUS, P_VM) VALUES (
																		'$gameid','$teamb','$key','NA','NA')");		
																		if($sql){
																			$errB++;
																		}															
																	}
																}
															}
															if(count($_SESSION[Constants::SESSION_CREATEGAME_TEAMA]) == $errA && count($_SESSION[Constants::SESSION_CREATEGAME_TEAMB]) == $errB){
																validateOutput("success","Successfully Game Created");
															}else{
																$sql = mysqli_query($connection, "DELETE * FROM game_players WHERE GAME_ID='$gameid'");
																if($sql){
																	validateOutput("error","Game creation failed");
																}else{
																	validateOutput("error", "Technical Error");
																}
															}
														}else{
															validateOutput("error","Unable to insert data, Try again or complain with error code");
														}												
													}else{
														validateOutput("error","Technical Error, Try again");
													}
												}else{
													validateOutput("error", "Both the teams needs to have same number of players");
												}												
											}else{
												validateOutput("error", "Team needs to have 3 or more players");
											}
											break;
										
										case Constants::FP_GAME_TYPE_OPENFORALL:
											$gameid = randomTokenNstatic();
											if(PlatformDB::authorizeGameId($gameid)){
												$c = new Creditional();
												if(PlatformDB::insertgamedata($c->getUsername(), $gameid, $starttime, $endtime, $scenario, $teama, $teamb, $gametype, $title, $desc)){
													validateOutput("success","Successfully Game Created");
												}else{
													validateOutput("error","Unable to insert data, Try again or complain with error code");
												}
											}else{
												validateOutput("error","Technical Error, Try again");
											}
											break;	
									}									
								}else{
									validateOutput("error", Constants::ERROR_EXESP_INVALID_REQUEST);
								}
							}else{
								validateOutput("error", Constants::ERROR_FINDPLAYER_UNABLE_TO_FINDSCENARIO.Constants::ERROR_CODE_3014);
							}
						}else{
							validateOutput("error","Invalid Time Set");
						}
					}else{
						validateOutput("error","Invalid Time Set");
					}
				}else{
					validateOutput("error", PlatformValidator::lengthLimitError(5, 15, "Team B", Constants::ERROR_CODE_3013));	
				}
			}else{
				validateOutput("error", PlatformValidator::lengthLimitError(5, 15, "Team A", Constants::ERROR_CODE_3013));	
			}
	   }else{
	   	  validateOutput("error", PlatformValidator::lengthLimitError(2, 200, "Description", Constants::ERROR_CODE_3013));
	   }
	}else{
		validateOutput("error", PlatformValidator::lengthLimitError(2, 20, "Title", Constants::ERROR_CODE_3013));
	}
}else if(isset($_POST['gameid'])){
	include '../plattemplate/connection.php';
	$gameId = Validator::PregAlphaNumeric($_POST['gameid']);
	$c = new Creditional();
	$uid = $c->getUserId();
	$sql = mysqli_query($connection, "SELECT GAME_ID FROM game_players WHERE GAME_ID='$gameId' AND PLAYER='$uid'");
	if(mysqli_num_rows($sql) == 1){
		$sqlc = mysqli_query($connection, "UPDATE game_players SET P_STATUS='1' WHERE GAME_ID='$gameId' AND PLAYER='$uid'");
		if($sqlc){
			echo "You have joined your team";
		}else{
			echo "Technical Error";
		}
	}else{
		echo "Technical Error";
	}
}

function sessionExtract($session, $username,$userid){
		session_start();
		if(!isset($_SESSION[Constants::SESSION_CREATEGAME_TEAMA]) || !isset($_SESSION[Constants::SESSION_CREATEGAME_TEAMB])){
			$_SESSION[Constants::SESSION_CREATEGAME_TEAMA] = array();			
			$_SESSION[Constants::SESSION_CREATEGAME_TEAMB] = array();			
		}
		if(in_array($username, array_merge($_SESSION[Constants::SESSION_CREATEGAME_TEAMA],$_SESSION[Constants::SESSION_CREATEGAME_TEAMB]))){
			sessionOutput("error", implode("~#~", $_SESSION[$session]));
		}else{
			$count = count($_SESSION[$session]);
	
			if($count < Constants::MULTIPLAYER_ALLOWED_PLAYERS_NUMBER){ 
				$_SESSION[$session][$userid] = $username;			
			}
			sessionOutput("success", implode("~#~", $_SESSION[$session]));			
		}
}

function doTask($type, $username){
	include '../plattemplate/connection.php';
	$sql = mysqli_query($connection, "SELECT ".DBV::login_users_username." FROM ".DBV::TB_loginusers." WHERE ".DBV::login_users_username." LIKE '$username%'");
	$arr = array();
	if(mysqli_num_rows($sql) > 0){
		while($row = mysqli_fetch_assoc($sql)){
			$arr[] = $row[DBV::login_users_username];
		}
		echo implode("~#~", $arr);		
	}else{
		echo "No user found";
	}
}

function sessionOutput($error, $output){
	echo print_r($error . "#~#" . $output, true);
}

function randomTokenNstatic() {
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $password = array(); 
    $letterLength = strlen($letters) - 1; 
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $letterLength);
        $password[] = $letters[$n];
    }
    return implode($password); 
}

function validateOutput($error, $output){
	echo $error."#*#".$output;
}
?>