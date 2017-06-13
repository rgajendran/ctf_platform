<?php

class OLink{	
/*------------------- oVirt Link -------------------------*/

	public static function get_vmpath_link(){													# vm directory
		return Constants::OVIRT_API_URL."/vms";
	}
	
	public static function get_deletevm_link($vmid){ 										# specific vm (can used to delete vm)
		return Constants::OVIRT_API_URL."/vms/$vmid";
	}	
	
	public static function get_vmstatus_link($vmid){ 										# specific vm (get complete status)
		return Constants::OVIRT_API_URL."/vms/$vmid";
	}
	
	public static function get_vmconsoleid_link($vmid){											# get specific graphic console id
		return Constants::OVIRT_API_URL."/vms/$vmid/graphicsconsoles";
	}	
	
	public static function get_vmremote_connectionfile_link($vmid,$gid){
		return Constants::OVIRT_API_URL."/vms/$vmid/graphicsconsoles/$gid/remoteviewerconnectionfile";	# get connectionfile
	}
	
	public static function get_vmstart_link($vmid){												# start vm with id
		return Constants::OVIRT_API_URL."/vms/$vmid/start";
	}
	
	public static function get_vmshutdown_link($vmid){												# shutdown vm with id
		return Constants::OVIRT_API_URL."/vms/$vmid/shutdown";
	}	
}
?>