<?php
require 'Constants.php';

class Ovirt{
	
	public static function ovirt_create_vm($vm_name, $desc, $cluster, $template, $memory){

		$final = "curl \
				--insecure \
				-u ".Constants::OVIRT_USERNAME.":".Constants::OVIRT_PASSWORD." \
				--request POST \
				--header 'Version: 4' \
				--header 'Content-Type: application/xml' \
				--header 'Accept: application/xml' \
				-d '<vm>
						<name>$vm_name</name>
							<description>$desc</description>
								<cluster>
									<name>$cluster</name>
								</cluster>
								<template>
									<name>$template</name>
								</template>
								<memory>$memory</memory>
								<os>
									<boot>
										<devices>
											<device>hd</device>
										</devices>
									</boot>
								</os>
					</vm>' \
				".Constants::OVIRT_API_URL."/vms";
				
		return $final;
								
	}
	
	public static function ovirt_create_vm_network($vm_id, $network_name, $network_desc, $network_mac){
			$final = "curl \
				--insecure \
				-u ".Constants::OVIRT_USERNAME.":".Constants::OVIRT_PASSWORD." \
				--request POST \
				--header 'Version: 4' \
				--header 'Content-Type: application/xml' \
				--header 'Accept: application/xml' \
				-d '
				<nic>
				<name>$network_name</name>
				<description>$network_desc</description>
				    <mac>
				        <address>$network_mac</address>
				    </mac>
				</nic>' \
				".Constants::OVIRT_API_URL."/vms/$vm_id/nics";
			
			return $final;		
	}
		
}

?>
