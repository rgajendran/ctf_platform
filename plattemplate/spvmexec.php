<?php
require '../class/Constants.php';
require '../class/Ovirt.php';
require '../class/OLink.php';
require '../class/Validator.php';
require '../class/PlatformDB.php';

Validator::DetectErrors();

if(isset($_POST['exec']) && isset($_POST['vm'])){
	$command = $_POST['exec'];
	$vmid = $_POST['vm'];
	$allowedExec = array(Constants::OVIRT_VM_EXEC_RUN,Constants::OVIRT_VM_EXEC_START,Constants::OVIRT_VM_EXEC_STOP,Constants::OVIRT_VM_EXEC_DELETE);
	if(in_array($command, $allowedExec)){
		switch($command){
			case Constants::OVIRT_VM_EXEC_START:
					$xml =  simplexml_load_string(Ovirt::ovirt_start_vm(OLink::get_vmstart_link($vmid)));
					if($xml->status == Constants::OVIRT_API_REPLY_STATUS_COMPLETE){
						echo "VM Started";
					}else{
						Constants::ERROR_VMSTART.Constants::ERROR_CODE_3005;
					}
				break;
				
			case Constants::OVIRT_VM_EXEC_STOP:
					$xml = simplexml_load_string(Ovirt::ovirt_shutdown_vm(OLink::get_vmshutdown_link($vmid)));
					if($xml->status == Constants::OVIRT_API_REPLY_STATUS_COMPLETE){
						echo "VM Shutdown Complete";
					}else{
						Constants::ERROR_VMSHUTDOWN.Constants::ERROR_CODE_3006;
					}
				break;
				
			case Constants::OVIRT_VM_EXEC_DELETE:
					$c = new Creditional();		
					if(PlatformDB::checkIfVMIdExistsForUser($vmid, $c->getUsername()) == 1){
						$xml = simplexml_load_string(Ovirt::ovirt_delete_vm(OLink::get_deletevm_link($vmid)));
						if($xml->status == Constants::OVIRT_API_REPLY_STATUS_COMPLETE){
							if(PlatformDB::deleteVMfromDbWithVmIdandUser($vmid, $c->getUsername()) == Constants::DB_SUCCESS){
								echo "VM Deleted";
							}else{
								echo Constants::ERROR_VM_UNABLE_TO_DELETE.Constants::ERROR_CODE_3009;
							}
						}else{
							Constants::ERROR_VMDELETE.Constants::ERROR_CODE_3007;
						}							
					}else{
						echo Constants::ERROR_VM_DOESNT_EXISTS_FORUSER.Constants::ERROR_CODE_3007;
					}
					
				break;
				
			case Constants::OVIRT_VM_EXEC_RUN:
				echo $command." ".$vmid;
				break;			
		}
	}else{
		echo Constants::ERROR_INVALID_COMMAND.Constants::ERROR_CODE_3004;
	}
}else{
	echo Constants::ERROR_EXESP_INVALID_REQUEST.Constants::ERROR_CODE_3003;
}

?>