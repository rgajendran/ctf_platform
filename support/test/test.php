
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

$team = 2;
$filename = "marker";
$tablename = "tSSWhEdPtz";

include '../../template/connection.php';
if(file_exists("../../marker/".$filename.".xml")){
	$xml = simplexml_load_file("../../marker/".$filename.".xml");
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
								echo mysqli_error($connection);
							}			
						}
					}else{
						echo "Error 2";
					}		

				}
			}
		}				
	}
	echo "Success 3";
}else{
	echo "Error 3";
}



























?>