
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*include '/var/www/html/platform/plattemplate/connection.php';
date_default_timezone_set('Europe/London');
$timezone = 'Europe/London'; 
$dates = new DateTime('now', new DateTimeZone($timezone));
$local = strtotime($dates->format('Y-m-d H:i:s'));
$sql = mysqli_query($connection, "INSERT INTO log (date, log) VALUES ('$local', 'Crontab Job')");
if($sql){
	echo "Cron Success ".$local;
}else{
	echo "Cron Failure ".$local;
}

exec('nohup ruby /var/www/html/SecGen/secgen.rb --scenario /var/www/html/SecGen/scenarios/default_scenario.xml --ovirtuser admin@internal --ovirtpass oVirtEngine --ovirt-template vagrant-debianl --ovirt-url https://ctffrontend/ovirt-engine/api r > /tmp/reporterror.txt &');
 * $arr = array(1 => true, 2 => false, 3 => true);
$val = array_search(true, $arr);
if(empty(array_search(true, $arr))){
	echo "No Match"."<br>";
}else{
	echo "Matched"."<br>";
}

foreach(array_keys($arr, true) as $keys){
	echo "Number : "."\$back".$keys."temp"."<br>";
}
*/
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../plattemplate/connection.php';
date_default_timezone_set('Europe/London');
$timezone = 'Europe/London'; 
$date = new DateTime('now', new DateTimeZone($timezone));
$localtime = $date->format('Y-m-d H:i:s');
session_start();
if(isset($_SESSION['USERID'])){
	$userid = $_SESSION['USERID'];
	$getgame = mysqli_query($connection, "SELECT GAME_ID FROM game_players WHERE PLAYER='$userid' AND P_STATUS='1'");
	if(mysqli_num_rows($getgame) > 0){
		while($grow = mysqli_fetch_assoc($getgame)){
			$gid = $grow['GAME_ID'];
			$result = mysqli_query($connection, "SELECT GAME_ID, START_TIME, END_TIME FROM game WHERE GAME_ID='$gid'");
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					$starttime = $row['START_TIME'];
					$endtime = $row['END_TIME'];
					if(strtotime($endtime)>strtotime($localtime) && strtotime($starttime)<strtotime($localtime)){
						echo $row['GAME_ID'];
					}		
				}
			}		
		}		
	}
}

*/

for($i = 0; $i<20; $i++){
	echo (rand(1, 3))."<br>";
}



















?>