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
			$('#plotteama').empty();
			$('#plotteamaadd').empty();
			var split = status.split('~#~');
			for(var i=0; i<split.length; i++){
				var addh3 = document.createElement("p");
				var text = document.createTextNode(split[i]);
				addh3.setAttribute("class","splayer");
				addh3.appendChild(text);				
				document.getElementById("plotteama").appendChild(addh3);	
					
				if(split[i] != "No user found"){
					var button = document.createElement("p");
					var btext = document.createTextNode("+");
					button.appendChild(btext);
					button.setAttribute("class","plusbtn");
					button.setAttribute("onclick","go.execTeamA('"+split[i]+"')");
					document.getElementById("plotteamaadd").appendChild(button);					
				}			
			}
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
			$('#plotteamb').empty();
			$('#plotteambadd').empty();
			var split = status.split('~#~');
			for(var i=0; i<split.length; i++){
				var addh3 = document.createElement("p");
				var text = document.createTextNode(split[i]);
				addh3.setAttribute("class","splayer");
				addh3.setAttribute("onclick","s");
				addh3.appendChild(text);				
				document.getElementById("plotteamb").appendChild(addh3);
				
				var button = document.createElement("p");
				var btext = document.createTextNode("+");
				button.appendChild(btext);
				button.setAttribute("class","plusbtn");
				button.setAttribute("onclick","go.execTeamB('"+split[i]+"')");
				document.getElementById("plotteambadd").appendChild(button);						
			}	
		}
	});	
};


function execFunction(){
	
	this.execTeamA = function(usernames){
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {team:"at",username:usernames},
			success: function(status){
					$('#viewteama').empty();
					$('#viewteamaadd').empty();
					var split = status.split('#~#');
					if(split[0] == "error"){
						$.notify("Username already selected",{position:"bottom center", className:"warn"});
						viewSessionArrayTeamA(split[1],"deleteTeamA");
					}else if(split[0] == "success"){
						viewSessionArrayTeamA(split[1],"deleteTeamA");
					}
			}
		});
	};

	this.execTeamB = function(usernames){
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {team:"bt",username:usernames},
			success: function(status){
					$('#viewteamb').empty();
					$('#viewteambadd').empty();
					var split = status.split('#~#');
					if(split[0] == "error"){
						$.notify("Username already selected",{position:"bottom center", className:"warn"});
						viewSessionArrayTeamB(split[1],"deleteTeamB");
					}else if(split[0] == "success"){
						viewSessionArrayTeamB(split[1],"deleteTeamB");
					}
			}
		});
	};	
		
	this.deleteTeamA = function(uns){
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {tms:"a",un:uns},
			success: function(status){
					$('#viewteama').empty();
					$('#viewteamaadd').empty();
					var split = status.split('#~#');
					if(split[0] == "error"){
						$.notify("Unable to remove username",{position:"bottom center", className:"warn"});
						viewSessionArrayTeamA(split[1],"deleteTeamA");
					}else if(split[0] == "success"){
						$.notify("Successfully removed",{position:"bottom center", className:"success"});
						viewSessionArrayTeamA(split[1],"deleteTeamA");
					}
			}
		});		
	};
	
	this.deleteTeamB = function(uns){
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {tms:"b",un:uns},
			success: function(status){
					$('#viewteamb').empty();
					$('#viewteambadd').empty();
					var split = status.split('#~#');
					if(split[0] == "error"){
						$.notify("Unable to remove username",{position:"bottom center", className:"warn"});
						viewSessionArrayTeamB(split[1],"deleteTeamB");
					}else if(split[0] == "success"){
						$.notify("Successfully removed",{position:"bottom center", className:"success"});
						viewSessionArrayTeamB(split[1],"deleteTeamB");
					}
			}
		});		
	};
		
	function viewSessionArrayTeamA(string, funs){
		    var split = string.split("~#~");
		    if(split[0] == ''){
		    	var addh3 = document.createElement("p");
		    	var text = document.createTextNode("Please choose players");
		    	addh3.setAttribute("class","vplayer");
		    	addh3.appendChild(text);
		    	document.getElementById("viewteama").appendChild(addh3);
		    }else{
				for(var i=0; i<split.length; i++){ 
					var addh3 = document.createElement("p");
					var text = document.createTextNode(split[i]);
					addh3.setAttribute("class","vplayer");
					addh3.appendChild(text);				
					document.getElementById("viewteama").appendChild(addh3);
					
					var button = document.createElement("p");
					var btext = document.createTextNode("-");
					button.appendChild(btext);
					button.setAttribute("class","plusbtn");
					button.setAttribute("onclick","go."+funs+"('"+split[i]+"')");
					document.getElementById("viewteamaadd").appendChild(button);							
				}		    	
		    }
	};
	
	function viewSessionArrayTeamB(string,funs){
		var split = string.split('~#~');
		if(split[0] == ''){			
	    	var addh3 = document.createElement("p");
	    	var text = document.createTextNode("Please choose players");
	    	addh3.setAttribute("class","vplayer");
	    	addh3.appendChild(text);
	    	document.getElementById("viewteamb").appendChild(addh3);
	    }else{
			for(var i=0; i<split.length; i++){ 
				var addh3 = document.createElement("p");
				var text = document.createTextNode(split[i]);
				addh3.setAttribute("class","vplayer");
				addh3.appendChild(text);				
				document.getElementById("viewteamb").appendChild(addh3);
				
				var button = document.createElement("p");
				var btext = document.createTextNode("-");
				button.appendChild(btext);
				button.setAttribute("class","plusbtn");
				button.setAttribute("onclick","go."+funs+"('"+split[i]+"')");
				document.getElementById("viewteambadd").appendChild(button);							
			}
		}
	};
	
}

var go = new execFunction();
