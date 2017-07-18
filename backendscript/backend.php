<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require '/var/www/html/platform/class/Validator.php';
require '/var/www/html/platform/class/Constants.php';
include '/var/www/html/platform/plattemplate/connection.php';

$sql = mysqli_query($connection, "SELECT * FROM backend");
if(mysqli_num_rows($sql) > 0){
	$pro = mysqli_query($connection, "SELECT * FROM backend WHERE PROCESSING='1'");
	if(mysqli_num_rows($pro) == 0){
		printoutput("Working");
	}else{
		printoutput("Command Execution in Progress");
	}
}else{
	printoutput("No Commands Found");
}

function printoutput($output){
	$datetime = Validator::getCurrentTime();
	$dir = Constants::LOC_LOG_DIR;
	exec('echo '.$output.' '.$datetime.' >> '.$dir.'/status.txt');
}

?>