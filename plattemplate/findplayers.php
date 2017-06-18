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
	session_start();
	include '../plattemplate/connection.php';
	$sql = mysqli_query($connection, "SELECT ".DBV::login_users_username." FROM ".DBV::TB_loginusers." WHERE ".DBV::login_users_username."='$username'");
	if(mysqli_num_rows($sql) == 1){
		if($_POST['team'] == "a"){
			sessionExtract('teama', $username);
		}else if($_POST['team'] == "b"){
			sessionExtract('teamb', $username);
		}
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

function sessionExtract($session, $username){
		if(!isset($_SESSION[$session])){
			$_SESSION[$session] = array();			
		}

		$count = count($_SESSION['teama']);
		if($count < Constants::MULTIPLAYER_ALLOWED_PLAYERS_NUMBER){
			$_SESSION[$session][$count++] = $username;
		}
		
		echo implode("~#~", $_SESSION[$session]);
}

?>