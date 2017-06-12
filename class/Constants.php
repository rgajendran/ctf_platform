<?php
class Constants{
	const LOCKPICK = 'lockpick';
	const SPLAYERDEFAULT = 'singleplayer.php?scenario=Edge%20Hill';										#Platform singleplayer.php
	const SECGEN_URL = '/var/www/html/SecGen/';															#Platform SecGen unused
	const OVIRT_USERNAME = 'admin@internal'; 															#Ovirt
	const OVIRT_PASSWORD = 'oVirtEngine';																#Ovirt
	const OVIRT_DEFAULT_TEMPLATE_SIZE = '1073741824';													#Ovirt
	const OVIRT_API_URL = 'https://ctffrontend/ovirt-engine/api';										#Ovirt
	const OVIRT_DEFAULT_BOX = 'vagrant-debian7';														#Ovirt
	const OVIRT_DEFAULT_CLUSTER = 'ovirtcluster';														#Ovirt
	const OVIRT_DEFAULT_NETWORK = 'ovirtmgmt';															#Ovirt
	const OVIRT_CURL_POST = 'POST';																		#Ovirt Curl
	const OVIRT_CURL_GET = 'GET';																		#Ovirt Curl
	const OVIRT_CURL_DELETE = 'DELETE';																	#Ovirt Curl
	const DB_SUCCESS = 'SUCCESS';																		#DB
	const DB_FAILURE = 'FAILURE';																		#DB				
	const OVIRT_VM_EXEC_START = 'start';																#Ovirt VM start command
	const OVIRT_VM_EXEC_STOP = 'stop';																	#Ovirt VM stop command
	const OVIRT_VM_EXEC_RUN = 'run';																	#Ovirt VM run command
	const OVIRT_VM_EXEC_DELETE = 'delete';																#Ovirt VM delete command
	const OVIRT_API_REPLY_STATUS_COMPLETE = 'complete';
	const ERROR_EXESP_CHARACTERS_5TO40 = "VM name should be between 5 to 30 characters";				#Errors exesp.php 
	const ERROR_EXESP_LIMIT_VM_TO_FIVE = "You can only create 5 VM's, delete unused VM's";				#Errors exesp.php
	const ERROR_EXESP_INVALID_REQUEST = "Technical Error";												#Errors exesp.php,spvmexec
	const ERROR_EXESP_FAILED_TO_CREATE = "Failed to Create VM";											#Errors exesp.php
	const ERROR_INVALID_COMMAND = "Invalid command";													#Errors spvmexec
	const ERROR_VMSTART = "Unable to start VM";															#Errors spvmexec 
	const ERROR_VMSHUTDOWN = "Unable to shutdown VM";													#Errors spvmexec
	const ERROR_VMDELETE = "Unable to delete VM";														#Errors spvmexec
	const ERROR_VM_DOESNT_EXISTS_FORUSER = "Unable to find requested VM";								#Errors spvmexec
	const ERROR_VM_UNABLE_TO_DELETE = "Unable to delete VM";											#Errors spvmexec
	const SUCCESS_EXESP_CREATED_VM = "VM Created";														#Success exesp.php
	
	####Error Codes
	const ERROR_CODE_3001 = ' [3001]';																	#exesp post value mismatch								[Minor]
	const ERROR_CODE_3002 = ' [3002]';																	#exesp ovirt template name invalid						[Minor]
	const ERROR_CODE_3003 = ' [3003]';																	#spvmexec post value mismatch							[Minor]
	const ERROR_CODE_3004 = ' [3004]';																	#spvmexec value mismatch [User Trying to xscript]		[Minor]
	const ERROR_CODE_3005 = ' [3005]';																	#spvmexec api vm start error							[Minor]
	const ERROR_CODE_3006 = ' [3006]';																	#spvmexec api vm shutdown error							[Minor]
	const ERROR_CODE_3007 = ' [3007]';																	#spvmexec api vm delete failed							[Minor]
	const ERROR_CODE_3008 = ' [3008]';																	#spvmexec unable to find vm in the user vm db			[Minor]
	const ERROR_CODE_3009 = ' [3009]';																	#spvmexec unable to delete db vm after delete ovirt vm 	[Critical]	
}

?>