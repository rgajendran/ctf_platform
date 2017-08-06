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
	
	$('#teamsearch').keypress(function(event){
		var key = (event.keyCode ? event.keyCode : event.which);
		if(key == 13){
			teamsearchjs();
		};
	});	
});

$(document).ready(function(){
	$('#createg').click(function(){
		var title = $('#title').val();
		var desc = $('#desc').val();
		var starttime = $('#starttime').val();
		var endtime = $('#endtime').val();
		var scenario = $('#scena').val();
		var teama = $('#teama').val();
		var teamb = $('#teamb').val();
		var gametype = $('#gtype').val();
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {title:title, desc:desc, starttime:starttime, endtime:endtime, scenario:scenario, teama:teama, teamb:teamb, gametype:gametype},
			success: function(status){
				var split = status.split("#*#");
				switch(split[0]){
					case "error":
						$.notify(split[1],{position:"bottom center", className:"error"});
					break;
					
					case "success":
						$.notify(split[1],{position:"bottom center", className:"success"});
					break;
				}
			}	
		});
	});
});

$(document).ready(function(){
	$('#gtype').change(function(){
		
		var input = $(this).val();
		if(input == "openforall"){
			$(location).attr('href', "multiplayer.php?option=cgame&type=openforall");
		}else if(input == "closed"){
			$(location).attr('href', "multiplayer.php?option=cgame&type=closed");
		}
		
	});
	
});


var teamajs = function(){
	var string = $("#searcha").val();
	$.ajax({
		method: "POST",
		url: "plattemplate/findplayers.php",
		data: {team:"a", val:string},
		success: function(status){
			console.log(status);
			$('#plotteama').empty();
			$('#plotteamaadd').empty();
			var split = status.split('~#~');
			for(var i=0; i<split.length; i++){
				var addh3 = document.createElement("p");
				var text = document.createTextNode(split[i]);
				addh3.setAttribute("class","splayer");
				addh3.appendChild(text);				
				document.getElementById("plotteama").appendChild(addh3);	
					
				if(split[i] != "No user found" && split[i] != "Type more than 3 characters"){
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
			console.log(status);
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
				
				if(split[i] != "No user found" && split[i] != "Type more than 3 characters"){
					var button = document.createElement("p");
					var btext = document.createTextNode("+");
					button.appendChild(btext);
					button.setAttribute("class","plusbtn");
					button.setAttribute("onclick","go.execTeamB('"+split[i]+"')");
					document.getElementById("plotteambadd").appendChild(button);		
				}				
			}	
		}
	});	
};

var teamsearchjs = function(){
	var string = $("#teamsearch").val();
	$.ajax({
		method: "POST",
		url: "plattemplate/findplayers.php",
		data: {team:"team", search:string},
		success: function(status){
			$('#plotsearchteama').empty();
			$('#plotsearchteamaadd').empty();
			var split = status.split('~#~');
			for(var i=0; i<split.length; i++){
				var addh3 = document.createElement("p");
				var text = document.createTextNode(split[i]);
				addh3.setAttribute("class","splayer");
				addh3.setAttribute("onclick","s");
				addh3.appendChild(text);				
				document.getElementById("plotsearchteama").appendChild(addh3);
				if(split[i] != "Type more than 3 characters"){
					if(split[i] != "No user found"){
						var button = document.createElement("p");
						var btext = document.createTextNode("+");
						button.appendChild(btext);
						button.setAttribute("class","plusbtn");
						button.setAttribute("onclick","go.execSearchTeam('"+split[i]+"')");
						document.getElementById("plotsearchteamaadd").appendChild(button);
					}		
				}				
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
	
	this.execSearchTeam = function(usernames){
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {team:"st",username:usernames},
			success: function(status){
					$('#viewsearchteama').empty();
					$('#viewsearchteamaadd').empty();
					var split = status.split('#~#');
					if(split[0] == "error"){
						$.notify("Username already selected",{position:"bottom center", className:"warn"});
						viewSessionArrayTeamSearch(split[1],"deleteTeamSearch");
					}else if(split[0] == "success"){
						viewSessionArrayTeamSearch(split[1],"deleteTeamSearch");
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
	
	this.deleteTeamSearch = function(uns){
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {tms:"s",un:uns},
			success: function(status){
					$('#viewsearchteama').empty();
					$('#viewsearchteamaadd').empty();
					var split = status.split('#~#');
					if(split[0] == "error"){
						$.notify("Unable to remove username",{position:"bottom center", className:"warn"});
						viewSessionArrayTeamSearch(split[1],"deleteTeamSearch");
					}else if(split[0] == "success"){
						$.notify("Successfully removed",{position:"bottom center", className:"success"});
						viewSessionArrayTeamSearch(split[1],"deleteTeamSearch");
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
	
	function viewSessionArrayTeamSearch(string,funs){
		var split = string.split('~#~');
		if(split[0] == ''){			
	    	var addh3 = document.createElement("p");
	    	var text = document.createTextNode("Please choose players");
	    	addh3.setAttribute("class","vplayer");
	    	addh3.appendChild(text);
	    	document.getElementById("viewsearchteama").appendChild(addh3);
	    }else{
			for(var i=0; i<split.length; i++){ 
				var addh3 = document.createElement("p");
				var text = document.createTextNode(split[i]);
				addh3.setAttribute("class","vplayer");
				addh3.appendChild(text);				
				document.getElementById("viewsearchteama").appendChild(addh3);
				var button = document.createElement("p");
				var btext = document.createTextNode("-");
				button.appendChild(btext);
				button.setAttribute("class","plusbtn");
				button.setAttribute("onclick","go."+funs+"('"+split[i]+"')");
				document.getElementById("viewsearchteamaadd").appendChild(button);											
			}
		}
	};
	
}

function Commands(){
	this.redirect = function(link){
		$(location).attr('href', link);
	};
	
	this.reqAccept = function(id){
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {gameid:id},
			success: function(status){
				$(location).attr('href', 'multiplayer.php?option=request');
				$.notify(status,{position:"bottom center", className:"warn"});
			}
		});
	};
}

function CreateTeam(){
	this.create = function(){
		var str = $("#oteamCreate").val();
		$.ajax({
			method: "POST",
			url: "plattemplate/findplayers.php",
			data: {teamname:str},
			success: function(status){
				console.log(status);
				var split = status.split("#*#");
				if(split[0] == "error"){
					$.notify(split[1],{position:"bottom center", className:"warn"});
				}else if(split[0] == "good"){
					$.notify(split[1],{position:"bottom center", className:"success"});
					$(location).attr('href', 'multiplayer.php?option=team');
				}
			}
		});
	};
}

var submit = new Commands();
var go = new execFunction();
var createteam = new CreateTeam();
