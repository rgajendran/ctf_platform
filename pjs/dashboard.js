$(document).ready(function(){
	$('#singleplayer').click(function(){
		$(location).attr("href", "./singleplayer.php");
	});	
	$('#multiplayer').click(function(){
		$(location).attr("href", "./singleplayer.php");
	});
	$('#options').click(function(){
		$(location).attr("href", "./template/logout.php");
	});			
});

$(document).ready(function(){
	$('#play').click(function(){
		var scenario = $('#scenario').val();
		var vmname = $('#vmname').val();
		$.ajax({
			method: "POST",
			url: "plattemplate/exesp.php",
			data: {scenario: scenario, vmn:vmname},
			success: function(status){
				$('#status').text(status);
			}	
		});
	});
});
