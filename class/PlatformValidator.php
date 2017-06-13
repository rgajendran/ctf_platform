<?php

class PlatformValidator{
	
		public function RemoveVMNameextraInfo($vmname){
			$len = strpos($vmname, "_");
			$lastlen = strrpos($vmname,"_");
			
			##cal
			$tlen = strlen($vmname) - $lastlen;
			
			$last = substr($vmname,0, -$tlen);
			$frst = substr($last, $len+1);
			return $frst;		
		}
}

?>