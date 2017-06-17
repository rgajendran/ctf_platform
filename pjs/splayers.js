function runButtonClick(){
	
	this.exec = function(command, vmname,id){
		$.ajax({
			method: "POST",
			url: "plattemplate/spvmexec.php",
			data: {exec:command, vm:id,vmnm:vmname},
			success: function(status){
				var output = status.split("~#~");
				switch(output[0]){
					case "run":
						$('#status').text(output[1]);		
									
					break;
					
					case "start":
						$('#status').text(output[1]);
						$("#side_menu").load("plattemplate/availablevm.php");	
						$.notify("VM Started",{position:"bottom center", className:"success"});
					break;
					
					case "stop":
						$('#status').text(output[1]);		
						$("#side_menu").load("plattemplate/availablevm.php");	
						$.notify("VM Stopped",{position:"bottom center", className:"warn"});			
					break;	
					
					case "delete":
						$('#status').text(output[1]);	
						$.notify("VM Deleted",{position:"bottom center", className:"error"});
					break;	
					
					case "error":
						$('#status').text(output[1]);	
						$.notify(output[1],{position:"bottom center", className:"error"});
					break;
					
					case "running":
						download("Open-Me.vv",output[1]);
						$.notify("Open downloaded file",{position:"bottom center", className:"info"});
					break;													
				}
			}	
		});
	};
	
}

function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}

var Ovirt = new runButtonClick();
