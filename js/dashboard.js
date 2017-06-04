$(document).ready(function(){
	$('#singleplayer').click(function(){
		$(location).attr("href", "./singleplayer.php");
	});	
	$('#multiplayer').click(function(){
		$(location).attr("href", "./singleplayer.php");
	});
	$('#options').click(function(){
		$(location).attr("href", "./singleplayer.php");
	});			
});

$(document).ready(function(){
	$('#play').click(function(){
		var scenario = $('#scenario').val();
		$.ajax({
			method: "POST",
			url: "template/secgenvagrant.php",
			data: {scenario: scenario},
			success: function(status){
				$('#status').html(status);
			}	
		});
	});
});
