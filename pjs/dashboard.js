$(document).ready(function(){
	$('#singleplayer').click(function(){
		$(location).attr("href", "./singleplayer.php");
	});	
	$('#multiplayer').click(function(){
		$(location).attr("href", "./multiplayer.php");
	});
	$('#options').click(function(){
		$(location).attr("href", "./template/logout.php");
	});	
	$('#back').click(function(){
		$(location).attr("href", "./dashboard.php");
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
				$.notify(status,{position:"bottom center", className:"success"});
				reloadAfterThree();
			}	
		});
	});
});

function reloadAfterThree() {
  setTimeout(
    function() {
		$(location).attr('href', 'singleplayer.php?scenario=Liverpool');
    }, 3000);
}