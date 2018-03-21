$(document).ready(function () {
	
	$("#loginemail").val(localStorage.getItem('loginemail'));
	 
	$("#btnEntrar").click(function(){
		$.ajax({
			url: "/execlogin",
			method: "POST",
			asysnc: false,
			cache: false,
			dataType:  'json', 
		    data: {
		    	email 	: $("#loginemail").val(),
		    	senha   : $("#loginsenha").val(),
		    	lembrar : $("#lembrar").val(),
		    },
		    beforeSend: function(){
		    	$("#loader").show();
		    	
		    	$(".help-block").html("");
		    },
		}).done(function (data, status, jqXHR) {
			
			if(status == "success"){ 
				if(data.sucesso == "true"){
					console.log("sucesso");
					localStorage.setItem('loginemail', $("#loginemail").val());	  
					
					window.location = "/admin";
									
				}else{
					for(var i = 0; i<data.length; i++){
						
						//-- marca o campo com alerta
						$("#"+data[i].campo+"Helper").parent().addClass('has-error');
						
						//-- lista os erros
						for(var j = 0; j<data[i].msg.length; j++){
							$("#"+data[i].campo+"Helper").append(data[i].msg[j]+"<br>");
						}
					}
					
					$("#loader").hide();
				}
			}else{
				$("#loader").hide();
			}
					    
		}).fail(function (jqXHR, status) {
			console.log(status);
		    console.log(jqXHR.status);
		    
		    $("#loader").hide();
		});	
	});    
});