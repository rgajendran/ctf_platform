$(document).ready(function(){
	var teama = $('#setteama');
    $('#teama').keyup( function() {
       teama.text( $(this).val() );
    }).change( function() {
       teama.text( $(this).val() );
    });
    
  	var teamb = $('#setteamb');
    $('#teamb').keyup( function() {
       teamb.text( $(this).val() );
    }).change( function() {
       teamb.text( $(this).val() );
    });	
});

$(document).ready(function(){
	$('#searcha').keypress(function(event){
		var key = (event.keyCode ? event.keyCode : event.which);
		if(key == 13){
			teamajs();
		};
	});
	
	$('#searchb').keypress(function(event){
		var key = (event.keyCode ? event.keyCode : event.which);
		if(key == 13){
			teambjs();
		};
	});
});

var teamajs = function(){
	var string = $("#searcha").val();
	$.ajax({
		method: "POST",
		url: "plattemplate/findplayers.php",
		data: {team:"a", val:string},
		success: function(status){
			$('#setteama').text(status);
		}
	});	
};

var teambjs = function(){
	var string = $("#searchb").val();
	$.ajax({
		method: "POST",
		url: "plattemplate/findplayers.php",
		data: {team:"b", val:string},
		success: function(status){
			$('#setteamb').text(status);	
		}
	});	
};