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
						download("Console.vv",output[1]);					
					break;
					
					case "start":
						$('#status').text(output[1]);	
					break;
					
					case "stop":
						$('#status').text(output[1]);	
					break;	
					
					case "delete":
						$('#status').text(output[1]);	
					break;	
					
					case "error":
						$('#status').text(output[1]);	
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
