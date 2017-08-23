<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '/var/www/html/platform/class/Ovirt.php';
require '/var/www/html/platform/class/Constants.php';

$x = Curl::curl_get_and_getresponse(Constants::OVIRT_API_URL."/vms");
$xml = simplexml_load_string($x);
include '/var/www/html/platform/plattemplate/connection.php';
foreach($xml->vm as $vm){
	$sql = mysqli_query($connection, "SELECT FOLDER,VMNO FROM backend WHERE COMPLETED='1' LIMIT 1");
	while($row = mysqli_fetch_assoc($sql)){
		$vmno = $row['VMNO'];
		for($i = 0; $i<=$vmno; $i++){
			if($vm->name == $row['FOLDER'].$i){
				$r = Ovirt::ovirt_create_template_with_vmid($row['FOLDER'].$i, $vm['id']);
				$result = simplexml_load_string($r);
				if($result->reason == "Operation Failed"){
					echo "Failed".$r;
				}else{
					$f = $row['FOLDER'];
					$retrieve = mysqli_query($connection, "SELECT BACKUP, SCENARIONAME, CTF FROM backend WHERE FOLDER='$f'");
					while($r = mysqli_fetch_assoc($retrieve)){
						$backup = $r['BACKUP'];
						$sce = $r['SCENARIONAME'];
						$ctf = $r['CTF'];
						$checkscenario = mysqli_query($connection, "SELECT TYPE FROM smenu WHERE TEMP_SCENARIO='$sce'");
						if(mysqli_num_rows($checkscenario) == 1){
							$update = mysqli_query($connection, "UPDATE smenu SET $backup='$f', VMNO='$vmno' WHERE TEMP_SCENARIO='$sce'");
							if($update){
								if($ctf == "T"){
									exec('cp '.Constants::SECGEN_URL.'/projects/'.$f.'/marker.xml '.Constants::PROJECT_DIR.'/marker/'.$f.'.xml');
									echo "Sucessfully Completed Task for : ".$f."\n";
								}else{
									echo "Sucessfully Completed Task for : ".$f."\n";
								}		
							}else{
								echo "Failed to Complete the Task for : ".$f."\n";
							}
						}else{
							if($ctf == "T"){
								$type = "ctf";
							}else{
								$type = "game";
							}
							$tempsize = Constants::OVIRT_DEFAULT_TEMPLATE_SIZE;
							$insert = mysqli_query($connection, "INSERT INTO smenu (TYPE, TEMP_SIZE, TEMP_SCENARIO, BACKUP1, VMNO) VALUES ('$type','$tempsize','$sce','$f','$vmno')");
							if($insert){
								echo "Successfully Completed New Sceanrio".$f."\n";
							}else{
								echo "Failed to create new scenario".$f."\n";
							}
						}

					}
				}
			}			
		}
	}
}
?>