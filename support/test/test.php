
<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '/var/www/html/platform/plattemplate/connection.php';
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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '/var/www/html/platform/plattemplate/connection.php';

require '../../class/PlatformDB.php';
require '../../class/Constants.php';
require '../../class/DBV.php';

session_start();
$avsession = array(Constants::SESSION_CREATEGAME_TEAMA, Constants::SESSION_CREATEGAME_TEAMB);
/*if(PlatformDB::checkIfPlayerPlayedTemplate(array_merge($_SESSION[$avsession[0]],$_SESSION[$avsession[1]]), PlatformDB::smenuGetTemplateByBackupNumber('liverpool', DBV::smenu_template1))){
	echo "True";
}else{
	echo "False";
}*/

//echo PlatformDB::checkIfPlayerPlayedTemplate(array_merge($_SESSION[$avsession[0]],$_SESSION[$avsession[1]]), PlatformDB::smenuGetTemplateByBackupNumber('liverpool', DBV::smenu_template1));

//echo "<br>".PlatformDB::smenuGetTemplateByBackupNumber('liverpool', DBV::smenu_template1)."<br>";

$template = "ilK5UQ0Pya";
$snsarray = $_SESSION['teama']+$_SESSION['teamb'];


foreach($snsarray as $key => $value){
	$result = mysqli_query($connection, "SELECT TEMPLATE FROM scenariologger WHERE USERID='$key' AND TEMPLATE='$template'");
	if(mysqli_num_rows($result) == 0){
		echo $key."<br>";
	}else{
		echo $key."<br>";
	}                
}

print_r($snsarray);



































?>