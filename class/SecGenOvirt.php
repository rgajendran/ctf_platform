<?php
class SecGenOvirt{
	
	public static function spinup_secgen_ovirt_all($secgen_scenario, $ovirt_username, $ovirt_password, $ovirt_vmname, $ovirt_url, $ovirt_cluster, $ovirt_box_template, $ovirt_ip, $ovirt_network_name, $command){
		return "ruby ".Constants::SECGEN_URL."secgen.rb \
		--scenario $secgen_scenario \
		--ovirtuser $ovirt_username \
		--ovirtpass $ovirt_password \
		--ovirt-vmname $ovirt_vmname \		
		--ovirt-url $ovirt_url \
		--ovirt-cluster $ovirt_cluster \
		--ovirt-template $ovirt_box_template \
		--ovirt-ip $ovirt_ip \
		--ovirt-network $ovirt_network_name $command";
	}
	
	public static function spinup_secgen_ovirt_custom($secgen_scenario, $ovirt_vmname, $ovirt_cluster, $ovirt_box_template, $ovirt_network_name, $command){
		return "ruby secgen.rb 
		--scenario $secgen_scenario 
		--ovirtuser Constants::OVIRT_USERNAME 
		--ovirtpass Constants::OVIRT_PASSWORD
		--ovirt-vmname $ovirt_vmname
		--ovirt-url Constants::OVIRT_API_URL
		--ovirt-cluster $ovirt_cluster
		--ovirt-template $ovirt_box_template
		--ovirt-network $ovirt_network_name $command";
	}
	
	public static function spinup_secgen_ovirt_short($secgen_scenario, $ovirt_vmname, $command){
		return "ruby ".Constants::SECGEN_URL."secgen.rb
		--scenario $secgen_scenario
		--ovirtuser ".Constants::OVIRT_USERNAME."
		--ovirtpass ".Constants::OVIRT_PASSWORD."
		--ovirt-vmname $ovirt_vmname
		--ovirt-url ".Constants::OVIRT_API_URL."
		--ovirt-cluster ".Constants::OVIRT_DEFAULT_CLUSTER."
		--ovirt-template ".Constants::OVIRT_DEFAULT_BOX."
		--ovirt-network ".Constants::OVIRT_DEFAULT_NETWORK." $command";
	}	
	
}

?>