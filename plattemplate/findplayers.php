<?php
require '../class/Validator.php';
require '../class/Constants.php';

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
}

function doTask($type, $username){
	include '../plattemplate/connection.php';
	$sql = mysqli_query($connection, "SELECT USERNAME FROM loginusers WHERE USERNAME LIKE '$username%'");
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

?>