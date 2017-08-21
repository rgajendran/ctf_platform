function alert(){
	var modal = document.getElementById('myModal');
	
	var span = document.getElementsByClassName("close")[0];
	
	this.menu = function(cid,vm,teams) {
	    modal.style.display = "block";
	    document.getElementById('dialog-title').innerHTML = vm;
	    document.getElementById('dialog-id').innerHTML = cid;
	    //-------------------------------------------------------------------	
	    if(checkSessionStorage() != "undefined"){
    		if (sessionStorage.getItem(cid+"-"+vm) == null){     	
				$.ajax({
					method: "POST",
					url: "template/viewhint.php",
					data: {cids: cid,team:teams,vms:vm},
					success: function(status){
						sessionStorage.setItem(cid+"-"+vm,status);	
						insertHint(status);			
					}	
				});
			}else{
				var status = sessionStorage.getItem(cid+"-"+vm);	
				insertHint(status);	
			}
	    }else{
	    	$.ajax({
				method: "POST",
				url: "template/viewhint.php",
				data: {cids: cid,team:teams,vms:vm},
				success: function(status){
					insertHint(status);					
				}	
			});
	    }	
	    
	};
	
	function insertHint(value){
		var status = value;	
		$('#moBody').empty();
		$('#moBodyLocked').empty();
		var OCSplit = status.split("#~#");
		for(var i=0; i<OCSplit.length;i++){
			var split = OCSplit[i].split("~#~");
			var cn = 0;
			for(var e=0; e<split.length;e++){
				if(i == OCSplit.length-1){		
					if(e == 0){
						var str = split[0];
						if(str == ""){
							document.getElementById("fsubmit").innerHTML = "No Further Hints";
						}else if(str == "No Further Hints"){
							document.getElementById("fsubmit").innerHTML = "No Further Hints";
						}else{
							var res = str.replace("Hint Locked","");
							document.getElementById("fsubmit").innerHTML = "Unlock Hint "+res;
						}

					}
					var addh3 = document.createElement("h3");
					var text =  document.createTextNode(split[e]);
					addh3.appendChild(text);				
					addh3.setAttribute("class","hintclose");
					document.getElementById("moBodyLocked").appendChild(addh3);		
				}else{
					cn++;
					var addh3 = document.createElement("h3");
					if(split[e] == ""){
						var text = document.createTextNode(split[e]);	
					}else{
						var text = document.createTextNode(cn+") "+split[e]);	
					}
					addh3.appendChild(text);
					addh3.setAttribute("class","hintok");
					document.getElementById("moBody").appendChild(addh3);	
				}			
					
			}
		}
	}
	
	function checkSessionStorage(){
   		return window.sessionStorage;
	}

	span.onclick = function() {
	    modal.style.display = "none";
    	var text = document.getElementById('flag_hint').innerText;
	    document.getElementById('flag_hint').innerHTML = " ";
	};
	
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	        var text = document.getElementById('flag_hint').innerText;
	        document.getElementById('flag_hint').innerHTML = " ";
	    }
	};
}

function vm(){
	var mo = document.getElementById('QModal');	
	var btn = document.getElementById("myBtn");	
	var sp = document.getElementsByClassName("Qclose")[0];	
	this.menu = function(header) {
	    mo.style.display = "block";
	    document.getElementById("vmheader").innerHTML = header;
		$.ajax({
			method: "POST",
			url: "plattemplate/createvmforgame.php",
			data: {chooser:header},
			success: function(status){
				var split = status.split("##");		
				for(var z =0; z < split.length; z++){
					if(z == 0){ 
						$(document).ready(function(){
							$('#t-run').html(split[0]);	
						});					
					}else if(z == 1){
						$(document).ready(function(){
							$('#t-start').html(split[1]);		
						});					
					}else if(z == 2){
						$(document).ready(function(){
							$('#t-stop').html(split[2]);	
						});						
					}	
				}
			}	
		});	  
		
		$(document).ready(function(){
		   $("#t-run").attr('title', 'Start & View '+header+'\'s VM');
		   $("#t-start").attr('title', 'Create '+header+'\'s VM');
		   $("#t-stop").attr('title', 'Shutdown '+header+'\'s VM');
		});		  
	};	
	this.vmoption = function(option){
		var val =  document.getElementById("vmheader").innerHTML;
		document.getElementById("Qmodal-status").innerHTML = "Please wait...";
		$.ajax({
			method: "POST",
			url: "plattemplate/createvmforgame.php",
			data: {vals:val, opt:option},
			success: function(status){
				console.log(status);
				var sp = status.split("##");
				switch(sp[0]){
					
					case "create":
						switch(sp[1]){
							case "success":
								Vm.menu(sp[2]);
								document.getElementById("Qmodal-status").innerHTML = "VM Created";
							break;
							
							case "error":
								document.getElementById("Qmodal-status").innerHTML = sp[2];
							break;
						}
					break;
					
					case "start":
						switch(sp[1]){
							case "success":
								document.getElementById("Qmodal-status").innerHTML = sp[2];
								$.ajax({
									method: "POST",
									url: "plattemplate/createvmforgame.php",
									data: {vals:val, opt:"run"},
									success: function(status){
										var ss = status.split("##");
										switch(ss[1]){
											case "error":
												document.getElementById("Qmodal-status").innerHTML = sp[2];
											break;
											
											case "running":
												download("Open-Me.vv",ss[2]);
												document.getElementById("Qmodal-status").innerHTML = "Task Completed";
												mo.style.display = "none";
												$.notify("Open downloaded file",{position:"bottom center", className:"info"});							
											break;
										}									
									}
								});
							break;
							
							case "error":
								document.getElementById("Qmodal-status").innerHTML = sp[2];
							break;
						}					
					
					break;
					
					case "stop":
						switch(sp[1]){
							case "success":
								document.getElementById("Qmodal-status").innerHTML = sp[2];
							break;
							
							case "error":
								document.getElementById("Qmodal-status").innerHTML = sp[2];
							break;
						}					
					break;
				}
				
			}	
		});
	};
	
	sp.onclick = function() {
	    mo.style.display = "none";
	};	
	window.onclick = function(ev) {
	    if (ev.target == mo) {
	        mo.style.display = "none";
	    }
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

var Vm = new vm();
var Alert = new alert();
