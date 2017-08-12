<?php
class Constants{
	
const LOCKPICK = 'lockpick';
const SPLAYERDEFAULT = 'singleplayer.php?scenario=Liverpool';                           # Platform singleplayer.php
const SECGEN_URL = '/var/www/html/SecGen';                                              # Platform SecGen unused
const LOC_LOG_DIR = '/var/www/html/log';                                                # Log Directory
const PROJECT_DIR = '/var/www/html/platform';                                           # Project Directory
const OVIRT_USERNAME = 'admin@internal';                                                # Ovirt
const OVIRT_PASSWORD = 'oVirtEngine';                                                   # Ovirt
const OVIRT_DEFAULT_TEMPLATE_SIZE = '1073741824';                                       # Ovirt
const OVIRT_API_URL = 'https://ctffrontend/ovirt-engine/api';                           # Ovirt
const OVIRT_DEFAULT_BOX = 'vagrant-debianl';                                            # Ovirt
const OVIRT_DEFAULT_CLUSTER = 'ovirtcluster';                                           # Ovirt
const OVIRT_DEFAULT_NETWORK = 'ovirtmgmt';                                              # Ovirt
const OVIRT_CURL_POST = 'POST';                                                         # Ovirt Curl
const OVIRT_CURL_GET = 'GET';                                                           # Ovirt Curl
const OVIRT_CURL_DELETE = 'DELETE';                                                     # Ovirt Curl
const DB_SUCCESS = 'SUCCESS';                                                           # DB
const DB_FAILURE = 'FAILURE';                                                           # DB				
const OVIRT_VM_EXEC_START = 'start';                                                    # Ovirt VM start command
const OVIRT_VM_EXEC_STOP = 'stop';                                                      # Ovirt VM stop command
const OVIRT_VM_EXEC_RUN = 'run';                                                        # Ovirt VM run command
const OVIRT_VM_EXEC_DELETE = 'delete';                                                  # Ovirt VM delete command
const OVIRT_API_REPLY_STATUS_COMPLETE = 'complete';                                     # Ovirt VM API reply success
const OVIRT_VM_STATUS_POWERING_UP = 'powering_up';                                      # Ovirt VM status
const OVIRT_VM_STATUS_UP = 'up';                                                        # Ovirt VM status
const ERROR_EXESP_CHARACTERS_5TO40 = "VM name should be between 5 to 30 characters";    # Errors exesp.php 
const ERROR_EXESP_LIMIT_VM_TO_FIVE = "You can only create 5 VM's, delete unused VM's";  # Errors exesp.php
const ERROR_EXESP_INVALID_REQUEST = "Technical Error";                                  # Errors exesp.php,spvmexec
const ERROR_EXESP_FAILED_TO_CREATE = "Failed to Create VM";                             # Errors exesp.php
const ERROR_INVALID_COMMAND = "Invalid command";                                        # Errors spvmexec
const ERROR_VMSTART = "Unable to start VM";                                             # Errors spvmexec 
const ERROR_VMSHUTDOWN = "Unable to shutdown VM";                                       # Errors spvmexec
const ERROR_VMDELETE = "Unable to delete VM";                                           # Errors spvmexec
const ERROR_VM_DOESNT_EXISTS_FORUSER = "Unable to find requested VM";                   # Errors spvmexec
const ERROR_VM_UNABLE_TO_DELETE = "Unable to delete VM, Try again later";               # Errors spvmexec
const ERROR_VM_NOTUP_OR_POWERINGUP = "VM has not started yet";                          # Errors spvmexec
const SUCCESS_EXESP_CREATED_VM = "VM Created";                                          # Success exesp.php
const SINGLE_PLAYER_ALLOWED_VMS_TO_CREATE = 4;											# PlatformDB (number starts from 0)
const MULTIPLAYER_ALLOWED_PLAYERS_NUMBER = 5;											# findplayer.php 
const SESSION_CREATEGAME_TEAMA = "teama";                                               # multiplayer, findplayers session name
const SESSION_CREATEGAME_TEAMB = "teamb";                                               # multiplayer, findplayers session name
const SESSION_CREATETEAM = "createteam";
const ERROR_TIME_INVALID = "Invalid Time";                                              # 
const ERROR_FINDPLAYER_UNABLE_TO_FINDSCENARIO = "Unable to find scenario";              # findplayer.php scenario name modified
#### Findplayer                                                                         # findplayer.php [STARTS_HERE]
const FP_GAME_TYPE_CLOSED = 'closed';                                                   # findplayer.php switch option
const FP_GAME_TYPE_OPENFORALL = 'openforall';                                           # findplayer.php switch option
#### Error Codes                                                                        # Errors code starts from here
const ERROR_CODE_3001 = ' [3001]';                                                      # exesp post value mismatch                              [LOW]
const ERROR_CODE_3002 = ' [3002]';                                                      # exesp ovirt template name invalid                      [LOW]
const ERROR_CODE_3003 = ' [3003]';                                                      # spvmexec post value mismatch                           [LOW]
const ERROR_CODE_3004 = ' [3004]';                                                      # spvmexec value mismatch [User Trying to xscript]       [LOW]
const ERROR_CODE_3005 = ' [3005]';                                                      # spvmexec api vm start error                            [LOW]
const ERROR_CODE_3006 = ' [3006]';                                                      # spvmexec api vm shutdown error                         [LOW]
const ERROR_CODE_3007 = ' [3007]';                                                      # spvmexec api vm delete failed                          [LOW]
const ERROR_CODE_3008 = ' [3008]';                                                      # spvmexec unable to find vm in the user vm db           [Low]
const ERROR_CODE_3009 = ' [3009]';                                                      # spvmexec unable to delete db vm after delete ovirt vm  [CRITICAL]
const ERROR_CODE_3010 = ' [3010]';                                                      # spvmexec unable to find ovirtvm however db vm exists   [CRITICAL]	
const ERROR_CODE_3011 = ' [3011]';                                                      # spvmexec vm not started yet                            [LOW]
const ERROR_CODE_3012 = ' [3012]';                                                      # findplayers invalid request                            [LOW]
const ERROR_CODE_3013 = ' [3013]';                                                      # findplayers length exceeds                             [LOW]
const ERROR_CODE_3014 = ' [3014]';                                                      # findplayer unable to find scenario (Name modified)     [CRITICAL]
const ERROR_CODE_3015 = ' [3015]';                                                      # findplayer unable to delete hint or secgenflag table   [CRITICAL]
const ERROR_CODE_3016 = ' [3016]';                                                      # findplayer unable to delete scenariologger             [CRITICAL]
const ERROR_CODE_3017 = ' [3017]';                                                      # findplayer used template detection error               [LOW]
const ERROR_CODE_3018 = ' [3018]';                                                      # findplayer unable to insert hint or secgenflag data    [CRITICAL]
const ERROR_CODE_3019 = ' [3019]';                                                      # findplayer unable to delete scoreboard or team         [CRITICAL]
}

?>