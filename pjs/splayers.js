function runButtonClick(){
	
	this.exec = function(command, id){
		$.ajax({
			method: "POST",
			url: "plattemplate/spvmexec.php",
			data: {exec:command, vm:id},
			success: function(status){
				$('#status').text(status);		
			}	
		});
	};
	
}

var Ovirt = new runButtonClick();
