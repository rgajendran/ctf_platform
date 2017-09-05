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
		if(strlen($val) > 2){
			doTask($tm, $val);
		}else{
			echo "Type more than 3 characters";
		}
	}else if($tm == "b"){
		if(strlen($val) > 2){
			doTask($tm, $val);
		}else{
			echo "Type more than 3 characters";
		}
	}else{
		echo Constants::ERROR_EXESP_INVALID_REQUEST.Constants::ERROR_CODE_3012;
	}
}else if(isset($_POST['search']) && isset($_POST['team'])){
	$search =  Validator::PregAlphaNumericUnderScore(Validator::filterString($_POST['search']));
	if(strlen($search) > 2){
		doTask("d", $search);	
	}else{
		echo "Type more than 3 characters";
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
		}else if($_POST['team'] == "st"){
			while($row = mysqli_fetch_assoc($sql)){
				sessionExtract(Constants::SESSION_CREATETEAM, $username,$row[DBV::login_users_userid]);
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
	}else if($team == "s"){
		unset($_SESSION[Constants::SESSION_CREATETEAM][array_search($username, $_SESSION[Constants::SESSION_CREATETEAM])]);
		sessionOutput("success", implode("~#~", $_SESSION[Constants::SESSION_CREATETEAM]));
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
}else if(isset($_POST['denyGameid'])){
	include '../plattemplate/connection.php';
	$gameId = Validator::PregAlphaNumeric($_POST['denyGameid']);
	$c = new Creditional();
	$uid = $c->getUserId();
	$sql = mysqli_query($connection, "SELECT GAME_ID FROM game_players WHERE GAME_ID='$gameId' AND PLAYER='$uid'");
	if(mysqli_num_rows($sql) == 1){
		$sqlc = mysqli_query($connection, "DELETE FROM game_players WHERE GAME_ID='$gameId' AND PLAYER='$uid'");
		if($sqlc){
			echo "Request Declined";
		}else{
			echo "Technical Error";
		}
	}else{
		echo "Technical Error";
	}
}else if(isset($_POST['teamname'])){
	session_start();
	if(!isset($_SESSION[Constants::SESSION_CREATETEAM])){
		$_SESSION[Constants::SESSION_CREATETEAM] = array();
	}
	
	if(count($_SESSION[Constants::SESSION_CREATETEAM]) < 5 || count($_SESSION[Constants::SESSION_CREATETEAM]) > 5){
		validateOutput("error", "Select 5 players to create team");
	}else{
		$teamname = Validator::PregAlphaNumericUnderScoreSpace(Validator::filterString($_POST['teamname']));
		if(strlen($teamname) >= 4 && strlen($teamname) <= 15){
			include '../plattemplate/connection.php';
			$c = new Creditional();
			$un = $c->getUserId();
			$s = 0;
			$sqlcheck = mysqli_query($connection, "SELECT * FROM teams WHERE HOST='$un'");
			
			if(mysqli_num_rows($sqlcheck) < 2){
				foreach($_SESSION[Constants::SESSION_CREATETEAM] as $key=>$value){
					$s++;
					${"p$s"} = $key;
				}
				$sql = mysqli_query($connection, "INSERT INTO teams (HOST, TEAM, P_1, P_2, P_3, P_4, P_5) VALUES ('$un', '$teamname', '$p1','$p2','$p3','$p4','$p5')");
				if($sql){
					validateOutput("good", "Created Team : ");
					unset($_SESSION[Constants::SESSION_CREATETEAM]);
				}else{
					validateOutput("error", "Train again later");
				}
			}else{
				validateOutput("error", "User can create only 2 teams");	
			}
						
		}else{
			validateOutput("error", "Team name should be between 4 to 15 characters");
		}
	}
}else if(isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['starttime']) && isset($_POST['endtime']) && isset($_POST['scenario']) && isset($_POST['teama']) && isset($_POST['teamb']) && isset($_POST['gametype'])){
	$title = Validator::PregAlphaNumericUnderScoreSpace($_POST['title']);
	$desc = Validator::PregAlphaNumericUnderScoreSpace($_POST['desc']);
	$starttime = $_POST['starttime'];
	$endtime = $_POST['endtime'];
	$scenario = Validator::PregAlphaNumericUnderScoreSpace($_POST['scenario']);
	$teama = Validator::PregAlphaNumericUnderScoreSpace($_POST['teama']);
	$teamb = Validator::PregAlphaNumericUnderScoreSpace($_POST['teamb']);
	$gametype = $_POST['gametype'];
	$gameid = randomTokenNstatic();
	if(Validator::StringLength(2, 20, $title)){
	   if(Validator::StringLength(2, 200, $desc)) {
			if(Validator::StringLength(5, 15, $teama)){
				if(Validator::StringLength(5, 15, $teamb)){
					if(Validator::validateDate($starttime)){
						if(Validator::validateDate($endtime)){
							if(PlatformDB::checkIfScenarioExists($scenario)){
								if(in_array($gametype, $allow = array(Constants::FP_GAME_TYPE_CLOSED,Constants::FP_GAME_TYPE_OPENFORALL, Constants::FP_GAME_TYPE_TEAMGAME))){
									switch($gametype){
										case Constants::FP_GAME_TYPE_CLOSED:
											session_start();
											$avsession = array(Constants::SESSION_CREATEGAME_TEAMA, Constants::SESSION_CREATEGAME_TEAMB);
											if(!isset($_SESSION[$avsession[0]]) && !isset($_SESSION[$avsession[1]])){
												$_SESSION[$avsession[0]] = array();
												$_SESSION[$avsession[1]] = array();
											}
											if(count($_SESSION[$avsession[0]]) >= 3 && count($_SESSION[$avsession[1]]) >= 3){
												if(count($_SESSION[$avsession[0]]) == count($_SESSION[$avsession[1]])){
													//STEP AA check scenario has been used by user
													$back1 = PlatformDB::checkIfPlayerPlayedTemplate($_SESSION[$avsession[0]]+$_SESSION[$avsession[1]], PlatformDB::smenuGetTemplateByBackupNumber($scenario, DBV::smenu_template1));
													$back1temp = PlatformDB::smenuGetTemplateByBackupNumber($scenario, DBV::smenu_template1);

													$back2 = PlatformDB::checkIfPlayerPlayedTemplate($_SESSION[$avsession[0]]+$_SESSION[$avsession[1]], PlatformDB::smenuGetTemplateByBackupNumber($scenario, DBV::smenu_template2));
													$back2temp = PlatformDB::smenuGetTemplateByBackupNumber($scenario, DBV::smenu_template2);		
													
													$back3 = PlatformDB::checkIfPlayerPlayedTemplate($_SESSION[$avsession[0]]+$_SESSION[$avsession[1]], PlatformDB::smenuGetTemplateByBackupNumber($scenario, DBV::smenu_template3));
													$back3temp = PlatformDB::smenuGetTemplateByBackupNumber($scenario, DBV::smenu_template3);	
													$checkbackup = array(1 => $back1, 2 => $back2, 3 => $back3);
													$arraysearch = array_search(true, $checkbackup);
													if(!empty($arraysearch)){
														switch($arraysearch){
															case 1:
																$temp = $back1temp;
																break;
															case 2:
																$temp = $back2temp;
																break;
															case 3:
																$temp = $back3temp;
																break;		
														}
														if(PlatformDB::authorizeGameId($gameid)){
															$c = new Creditional();
															include '../plattemplate/connection.php';
															$vmno = PlatformDB::getVMNO_withScenario($scenario);
															if(PlatformDB::insertgamedata($c->getUserId(), $gameid, $starttime, $endtime, $scenario, $temp, $vmno, $teama, $teamb, $gametype, $title, $desc)){																
																if(PlatformDB::create_hint_secgen_table($gameid)){ //create hint and secgenflag table
																		if(PlatformDB::insert_hint_and_secgenflag_data("marker", $gameid, 2)){	//import hint and flags
																			if(PlatformDB::insert_scoreboard_team($gameid, $teama, $teamb)){
																				//STEP AS MODIFY START
																				$errA = 0;
																				$errB = 0;
																				for($i = 0; $i<count($avsession); $i++){
																					foreach($_SESSION[$avsession[$i]] as $key=>$value){
																						if($value == $c->getUsername()){
																							$pstat = 1;
																						}else{
																							$pstat = 0;
																						}
																						if($avsession[$i] == Constants::SESSION_CREATEGAME_TEAMA){
																							$sql = mysqli_query($connection, "INSERT INTO game_players (GAME_ID, TEAMNO, TEAM, PLAYER, P_STATUS, P_VM) VALUES (
																							'$gameid','1','$teama','$key','$pstat','NA')");	
																							if($sql){
																								$res = mysqli_query($connection, "INSERT INTO scenariologger (GAME_ID, SCENARIO, TEMPLATE, USERID) VALUES ('$gameid','$scenario','$temp','$key')");
																								if($res){
																									if(PlatformDB::insert_updater(1, $gameid, $key)){
																										$errA++;																											
																									}																						
																								}
																							}
																						}else{
																							$sql = mysqli_query($connection, "INSERT INTO game_players (GAME_ID, TEAMNO, TEAM, PLAYER, P_STATUS, P_VM) VALUES (
																							'$gameid','2','$teamb','$key','$pstat','NA')");		
																							if($sql){
																								$res = mysqli_query($connection, "INSERT INTO scenariologger (GAME_ID, SCENARIO, TEMPLATE, USERID) VALUES ('$gameid','$scenario','$temp','$key')");
																								if($res){
																									if(PlatformDB::insert_updater(2, $gameid, $key)){																									
																										$errB++;
																									}
																								}
																							}															
																						}
																					}
																				}
																				if(count($_SESSION[Constants::SESSION_CREATEGAME_TEAMA]) == $errA && count($_SESSION[Constants::SESSION_CREATEGAME_TEAMB]) == $errB){
																					validateOutput("success","Successfully Game Created");
																					unset($_SESSION[$avsession[0]]);
																					unset($_SESSION[$avsession[1]]);
																				}else{
																					$sresu = mysqli_query($connection, "SELECT * FROM game_players WHERE GAME_ID='$gameid'");
																					if(mysqli_num_rows($sresu) > 0){
																						$sql = mysqli_query($connection, "DELETE * FROM game_players WHERE GAME_ID='$gameid'");
																						if($sql){
																							$dsql = mysqli_query($connection, "DELETE * FROM scenariologger WHERE GAME_ID='$gameid'");
																							if($dsql){
																								validateOutput("error","Game creation failed");
																							}else{
																								validateOutput("error", "Technical Error, Report with error code : ".Constants::ERROR_CODE_3016);
																							}
																						}else{
																							validateOutput("error", "Technical Error - 102");
																						}																						
																					}else{
																						validateOutput("error", "Technical Error - 101");
																					}
																				}
																				//STEP AS MODIFY END																					
																			}else{
																				PlatformDB::delete_scoreboard_team($gameid);
																				validateOutput("error","Technical Error, Try again or complain with the error code".Constants::ERROR_CODE_3019);
																			}												
																			
																		}else{
																			PlatformDB::delete_hint_secgen_table($gameid);
																			validateOutput("error","Technical Error, Try again or complain with the error code".Constants::ERROR_CODE_3018);
																		}																
																}else{
																	PlatformDB::delete_hint_secgen_table($gameid);
																	validateOutput("error","Technical Error, Try again or complain with the error code".Constants::ERROR_CODE_3015);
																}
															}else{
																validateOutput("error","Unable to insert data, Try again or complain with the error code");
															}												
														}else{
															validateOutput("error","Technical Error, Try again");
														}														
													}else{
														//insert into backend table
														if(!empty(array_search(false, $checkbackup))){
															foreach(array_keys($checkbackup, false) as $keys){
																$getVals = "BACKUP".$keys;
																if(PlatformDB::check_backend_progress($scenario, $getVals)){
																	if(PlatformDB::insert_recreate_vm_usingbackendtable($scenario, "scenarios/ctf/".$scenario.".xml", "T", $getVals)){
																		$out = "T";
																	}else{
																		$out = "F";
																	}																	
																}else{
																	$out = "FT";
																}
															}
															if($out == "T"){
																validateOutput("success", "Your scenario is being generated, try again later or choose different scenario");	
															}else if($out == "F"){
																validateOutput("error", "Your scenario generation failed, try again later or choose different scenario");
															}else if($out == "FT"){
																validateOutput("warn", "Your new scenario generation is in queue, Please wait");
															}
														}else{
															validateOutput("error", "Technical Error, try again later or complain with error code :".Constants::ERROR_CODE_3017);
														}
													}																							
													//END AA
												}else{
													validateOutput("error", "Both the teams needs to have same number of players");
												}												
											}else{
												validateOutput("error", "Team needs to have 3 or more players");
											}
											break;
										
										case Constants::FP_GAME_TYPE_OPENFORALL:
											if(PlatformDB::authorizeGameId($gameid)){
												$vmno = PlatformDB::getVMNO_withScenario($scenario);
												$backs = array(DBV::smenu_template1,DBV::smenu_template2,DBV::smenu_template3);
												$o = rand(1, 3) - 1;
												$temp = PlatformDB::smenuGetTemplateByBackupNumber($scenario, $backs[$o]);
												$c = new Creditional();
												if(PlatformDB::insertgamedata($c->getUserId(), $gameid, $starttime, $endtime, $scenario, $temp, $vmno, $teama, $teamb, $gametype, $title, $desc)){
													validateOutput("success","Successfully Game Created");
												}else{
													validateOutput("error","Unable to insert data, Try again");
												}
											}else{
												validateOutput("error","Technical Error, Try again");
											}
											break;	
											
										case Constants::FP_GAME_TYPE_TEAMGAME:
											if(PlatformDB::authorizeGameId($gameid)){
												$vmno = PlatformDB::getVMNO_withScenario($scenario);
												$backs = array(DBV::smenu_template1,DBV::smenu_template2,DBV::smenu_template3);
												$o = rand(1, 3) - 1;
												$temp = PlatformDB::smenuGetTemplateByBackupNumber($scenario, $backs[$o]);
												$c = new Creditional();
												if(PlatformDB::insertgamedata($c->getUserId(), $gameid, $starttime, $endtime, $scenario, $temp, $vmno, $teama, $teamb, $gametype, $title, $desc)){
													validateOutput("success","Successfully Game Created");
												}else{
													validateOutput("error","Unable to insert data, Try again");
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
}else if(isset($_POST['delteam'])){
	include 'connection.php';
	$teamid = Validator::PregOnlyNumeric($_POST['delteam']);
	$c = new Creditional();
	$result = mysqli_query($connection, "DELETE FROM teams WHERE HOST='".$c->getUserId()."' AND ID='$teamid'");
	if($result){
		validateOutput("success", "Deleted Team Successfully");
	}else{
		validateOutput("error", "Unable to delete team");		
	}
}

function sessionExtract($session, $username,$userid){
		session_start();
		if(!isset($_SESSION[Constants::SESSION_CREATEGAME_TEAMA]) || !isset($_SESSION[Constants::SESSION_CREATEGAME_TEAMB]) || !isset($_SESSION[Constants::SESSION_CREATETEAM])){
			$_SESSION[Constants::SESSION_CREATEGAME_TEAMA] = array();			
			$_SESSION[Constants::SESSION_CREATEGAME_TEAMB] = array();	
			$_SESSION[Constants::SESSION_CREATETEAM] = array();			
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