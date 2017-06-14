   
         	<?php       	

require 'class/Constants.php';
require 'class/Ovirt.php';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://ctffrontend/ovirt-engine/api/vms");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_USERPWD, Constants::OVIRT_USERNAME . ":" . Constants::OVIRT_PASSWORD);
	curl_setopt($ch, CURLOPT_HTTPHEADER, Ovirt::postheader());
	
	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    return 'Error:' . curl_error($ch);
	}
	curl_close ($ch);
	echo "<pre>".$result."</pre>";
?> 
