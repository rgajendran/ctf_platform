<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../class/Constants.php';
require '../class/Ovirt.php';
require '../class/Validator.php';
require '../class/PlatformDB.php';

if(isset($_POST['exec']) && isset($_POST['vm']) && isset($_POST['vmnm'])){
	$command = $_POST['exec'];
	$vmid = $_POST['vm'];
	$vmname = $_POST['vmnm'];
	$allowedExec = array(Constants::OVIRT_VM_EXEC_RUN,Constants::OVIRT_VM_EXEC_START,Constants::OVIRT_VM_EXEC_STOP,Constants::OVIRT_VM_EXEC_DELETE);
	if(in_array($command, $allowedExec)){
		switch($command){
			case Constants::OVIRT_VM_EXEC_START:
					$c = new Creditional();	
					if(PlatformDB::checkIfVMIdExistsForUser($vmid, $c->getUsername()) == 1){
						$xml =  simplexml_load_string(Ovirt::ovirt_start_vm(OLink::get_vmstart_link($vmid)));
						if(!empty($xml)){
							if($xml->status == Constants::OVIRT_API_REPLY_STATUS_COMPLETE){
								Output("start","Starting ".$vmname);
							}else{
								Output("start",Constants::ERROR_VMSTART.Constants::ERROR_CODE_3005);
							}
						}else{
							Output("start",Constants::ERROR_VM_UNABLE_TO_DELETE.Constants::ERROR_CODE_3010);
						}		
					}else{
						Output("start",Constants::ERROR_VM_DOESNT_EXISTS_FORUSER.Constants::ERROR_CODE_3007);
					}
				break;
				
			case Constants::OVIRT_VM_EXEC_STOP:
					$c = new Creditional();	
					if(PlatformDB::checkIfVMIdExistsForUser($vmid, $c->getUsername()) == 1){
						if(in_array(Ovirt::ovirt_vm_status(OLink::get_vmstatus_link($vmid)), Ovirt::GraphicsAllowedVMOptions())){
							$xml = simplexml_load_string(Ovirt::ovirt_shutdown_vm(OLink::get_vmshutdown_link($vmid)));
							if(!empty($xml)){
								if($xml->status == Constants::OVIRT_API_REPLY_STATUS_COMPLETE){
									Output("stop","Shutting down :".$vmname);
								}else{
									Output("stop",Constants::ERROR_VMSHUTDOWN.Constants::ERROR_CODE_3006);
								}
							}else{
								Output("stop",Constants::ERROR_VM_UNABLE_TO_DELETE.Constants::ERROR_CODE_3010);
							}
						}else{
							Output("stop",Constants::ERROR_VM_NOTUP_OR_POWERINGUP.Constants::ERROR_CODE_3011);
						}		
					}else{
						Output("stop",Constants::ERROR_VM_DOESNT_EXISTS_FORUSER.Constants::ERROR_CODE_3007);
					}	
				break;
				
			case Constants::OVIRT_VM_EXEC_DELETE:
					$c = new Creditional();		
					if(PlatformDB::checkIfVMIdExistsForUser($vmid, $c->getUsername()) == 1){
						$xml = simplexml_load_string(Ovirt::ovirt_delete_vm(OLink::get_deletevm_link($vmid)));
						if(!empty($xml)){
							if($xml->status == Constants::OVIRT_API_REPLY_STATUS_COMPLETE){
								if(PlatformDB::deleteVMfromDbWithVmIdandUser($vmid, $c->getUsername()) == Constants::DB_SUCCESS){
									Output("delete","Deleting ".$vmname);
								}else{
									Output("delete",Constants::ERROR_VM_UNABLE_TO_DELETE.Constants::ERROR_CODE_3009);
								}
							}else{
								Output("delete",Constants::ERROR_VMDELETE.Constants::ERROR_CODE_3007);
							}
						}else{
							Output("delete",Constants::ERROR_VM_UNABLE_TO_DELETE.Constants::ERROR_CODE_3010);
						}
							
					}else{
						Output("delete",Constants::ERROR_VM_DOESNT_EXISTS_FORUSER.Constants::ERROR_CODE_3007);
					}
					
				break;
				
			case Constants::OVIRT_VM_EXEC_RUN:
				$c = new Creditional();	
				if(PlatformDB::checkIfVMIdExistsForUser($vmid, $c->getUsername()) == 1){
					if(in_array(Ovirt::ovirt_vm_status(OLink::get_vmstatus_link($vmid)), Ovirt::GraphicsAllowedVMOptions())){
						$gid= Ovirt::ovirt_getgraphicsconsoleId_vm(OLink::get_vmconsoleid_link($vmid));
						$remotefile = Ovirt::ovirt_graphicconsole_ticket(OLink::get_vmremote_connectionfile_link($vmid, $gid));
						Output("running",$remotefile);
					}else{
						Output("run",Constants::ERROR_VM_NOTUP_OR_POWERINGUP.Constants::ERROR_CODE_3011);
					}
				}else{
					Output("run",Constants::ERROR_VM_DOESNT_EXISTS_FORUSER.Constants::ERROR_CODE_3007);
				}					
				break;			
		}
	}else{
		Output("error",Constants::ERROR_INVALID_COMMAND.Constants::ERROR_CODE_3004);
	}
}else{
	Output("error",Constants::ERROR_EXESP_INVALID_REQUEST.Constants::ERROR_CODE_3003);
}

function Output($command, $string){
	$a = array($command,$string);
	$s = implode("~#~", $a);
	print_r($s);
}

?>