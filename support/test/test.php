
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
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '/var/www/html/platform/plattemplate/connection.php';

$sql = mysqli_query($connection, "SELECT * FROM backend");
if(mysqli_num_rows($sql) > 0){
	
}else{
	exec('');
}





?>