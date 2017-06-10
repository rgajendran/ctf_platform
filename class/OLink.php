<?php

class OLink{	
/*------------------- oVirt Link -------------------------*/

	public static function get_vmpath(){													# vm directory
		return Constants::OVIRT_API_URL."/vms";
	}
	
	public static function delete_vmwithid($vmid){ 								# specific vm (can used to delete vm)
		return Constants::OVIRT_API_URL."/vms/$vmid";
	}	
	
	public static function get_vmconsoleid($vmid){							# get specific graphic console id
		return Constants::OVIRT_API_URL."/vms/$vmid/graphicsconsoles";
	}	
	
	public static function get_vmremote_connectionfile($vmid,$gid){
		return Constants::OVIRT_API_URL."/vms/$vmid/graphicsconsoles/$gid/remoteviewerconnectionfile";
	}
}
?>