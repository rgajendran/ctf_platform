<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/var/www/html/platform/class/Ovirt.php';
require '/var/www/html/platform/class/Constants.php';
include '/var/www/html/platform/plattemplate/connection.php';

$flds = mysqli_query($connection, "SELECT FOLDER FROM backend WHERE PROCESSING='1' AND COMPLETED='0' LIMIT 1");
$vm = 0;
if(mysqli_num_rows($flds) == 1){
	while($frow = mysqli_fetch_assoc($flds)){
		$folder = "/var/www/html/SecGen/projects/".$frow['FOLDER'];
		$folderdata = $frow['FOLDER'];
		$vmc = exec("grep -o '$folder/Vagrantfile' -e 'config.vm.define' | wc -l");
		$x = Curl::curl_get_and_getresponse(Constants::OVIRT_API_URL."/vms");
		$xml = simplexml_load_string($x);
		
		for($i = 1; $i<=$vmc; $i++){
			foreach($xml->vm as $vm){
				if($vm->name == $folderdata.$i){
					$r = simplexml_load_string(Ovirt::ovirt_shutdown_vm(OLink::get_vmshutdown_link($vm['id'])));
					if($r->status == "complete"){
						$insert = mysqli_query($connection, "UPDATE backend SET COMPLETED='1', VMNO='$vmc' WHERE FOLDER='$folderdata'");
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
}else{
	echo "Not One Data Found";
}
?>