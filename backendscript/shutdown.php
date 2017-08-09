<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/var/www/html/platform/class/Ovirt.php';
require '/var/www/html/platform/class/Constants.php';

include '/var/www/html/platform/plattemplate/connection.php';

$flds = mysqli_query($connection, "SELECT FOLDER FROM backend WHERE PROCESSING='1'");
$vm = 0;
if(mysqli_num_rows($flds) == 1){
	while($frow = mysqli_fetch_assoc($flds)){
		$folder = "/var/www/html/SecGen/projects/".$frow['FOLDER'];
		$folderdata = $frow['FOLDER'];
		$vm = exec("grep -o '$folder/Vagrantfile' -e 'config.vm.define' | wc -l");
		$update = mysqli_query($connection, "UPDATE backend SET VMNO='$vm' WHERE FOLDER='$folderdata' AND PROCESSING='1'");
		if($update){
			$x = Curl::curl_get_and_getresponse(Constants::OVIRT_API_URL."/vms");
			$xml = simplexml_load_string($x);

			$sql = mysqli_query($connection, "SELECT FOLDER,VMNO FROM backend WHERE PROCESSING='1'");
			while($row = mysqli_fetch_assoc($sql)){
				$folder = $row['FOLDER'];
				for($i = 0; $i<=$row['VMNO']; $i++){
					foreach($xml->vm as $vm){
						if($vm->name == $folder.$i){
							$r = simplexml_load_string(Ovirt::ovirt_shutdown_vm(OLink::get_vmshutdown_link($vm['id'])));
							if($r->status == "complete"){
								$insert = mysqli_query($connection, "UPDATE backend SET COMPLETED='1' WHERE FOLDER='$folder'");
								if($insert){
									echo "Shutdown Complete";
								}else{
									echo "Shutdown Incomplete";		
								}
							}
						}
					}		
				}
			}			
		}
	}	
}
?>