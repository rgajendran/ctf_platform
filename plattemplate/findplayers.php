<?php
require '../class/Validator.php';
require '../class/Constants.php';
require '../class/DBV.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
	$sql = mysqli_query($connection, "SELECT ".DBV::login_users_username." FROM ".DBV::TB_loginusers." WHERE ".DBV::login_users_username."='$username'");
	if(mysqli_num_rows($sql) == 1){
		if($_POST['team'] == "at"){
			sessionExtract(Constants::SESSION_CREATEGAME_TEAMA, $username);
		}else if($_POST['team'] == "bt"){
			sessionExtract(Constants::SESSION_CREATEGAME_TEAMB, $username);
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
}

function sessionExtract($session, $username){
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
				$_SESSION[$session][$count++] = $username;			
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
			$arr[] = $row['USERNAME'];
		}
		echo implode("~#~", $arr);		
	}else{
		echo "No user found";
	}
}

function sessionOutput($error, $output){
	echo print_r($error . "#~#" . $output, true);
}
?>