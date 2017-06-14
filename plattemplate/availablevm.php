<h4 align="center" id="topic">Available VM's</h4>
<table>
	<?php
	require 'class/PlatformValidator.php';
	require 'class/Validator.php';
	require 'class/Constants.php';
	require 'class/Ovirt.php';
	$c = new Creditional();
	$resultvm = mysqli_query($connection, "SELECT VMNAME,VMID FROM vm WHERE USERNAME='".$c->getUsername()."'");
	$pv = new PlatformValidator();
	if($resultvm){
		if(mysqli_num_rows($resultvm) == 0){
				echo '<tr class="tg">
				    	<td>No VM\'s available</td>
				  	</tr>';
		}else{
			while($vmrow = mysqli_fetch_assoc($resultvm)){
				$vmname = $pv->RemoveVMNameextraInfo($vmrow['VMNAME']);
				$vmid = $vmrow['VMID'];
				if(in_array(Ovirt::ovirt_vm_status(OLink::get_vmstatus_link($vmid)), Ovirt::GraphicsAllowedVMOptions())){
					echo "<tr class=\"tg\">
						    <td class=\"t-name\">$vmname</td>
						    <td class=\"t-icon\"><img src=\"images/icon/run.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_RUN."\",\"$vmname\",\"$vmid\");'/></td>
						    <td class=\"t-icon\"><img src=\"images/icon/start.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_START."\",\"$vmname\",\"$vmid\");'/></td>
						    <td class=\"t-icon\"><img src=\"images/icon/stop.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_STOP."\",\"$vmname\",\"$vmid\");'/></td>
						    <td class=\"t-icon\"><img src=\"images/icon/delete.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_DELETE."\",\"$vmname\",\"$vmid\");'/></td>
						  </tr>";					
				}else{
					echo "<tr class=\"tg\">
						    <td class=\"t-name\">$vmname</td>
						    <td class=\"t-icon\"><img class=\"img\" src=\"images/icon/run.png\" width=\"23\" height=\"23\"/></td>
						    <td class=\"t-icon\"><img src=\"images/icon/start.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_START."\",\"$vmname\",\"$vmid\");'/></td>
						    <td class=\"t-icon\"><img class=\"img\" src=\"images/icon/stop.png\" width=\"23\" height=\"23\"/></td>
						    <td class=\"t-icon\"><img src=\"images/icon/delete.png\" width=\"23\" height=\"23\" onclick='Ovirt.exec(\"".Constants::OVIRT_VM_EXEC_DELETE."\",\"$vmname\",\"$vmid\");'/></td>
						  </tr>";					
				}

			}	
		}						
	}else{
		echo mysqli_error($connection);
	}

	?>			  				  				  
</table>