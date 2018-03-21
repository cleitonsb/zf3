$(function(){
	
	 /**
	 * Salva usuario
	 */
	$("#btnSalvar").on('click', function(){
		$('#usuario').ajaxForm({
			url: "/admin/usuarios/salvar",
			dataType:  'json', 
			beforeSubmit:  function(){
				$("#loader").show();
			}, 
	    	success: function(data, status) { 
	    		if(data.sucesso == "true"){
	    			toastr.success('Sucesso ao salvar o registro!.', 'Sucesso!');
						    									
				}else{
					
					$(".help-block").html('');
					
					for(var i = 0; i<data.length; i++){
						
						console.log(data[i].campo);
						
						//-- marca o campo com alerta
						$("#"+data[i].campo+"Helper").parent().addClass('has-error');
						
						//-- lista os erros
						for(var j = 0; j<data[i].msg.length; j++){
							$("#"+data[i].campo+"Helper").append(data[i].msg[j]+"<br>");
						}
					}
					
					$("#loader").hide();
				}
	    		
	    		
	    		/*if(resposta.erro !== undefined){
	    			new PNotify({
                		title: "Erro!",
              		  	type: "error",
              		  	text: "Erro ao salvar o usuário! Tente novamente.",
              		  	styling: 'fontawesome',		  
                	});	
	    		}else{
    	    		new PNotify({
                		title: "Sucesso!",
              		  	type: "success",
              		  	text: "Usuário cadastrado com sucesso!",
              		  	styling: 'fontawesome',		  
                	});
    	    		
    	    		$("#idusuario").val(resposta.sucesso);
    	    		
    	    		if(resposta.arquivo == "1"){
    	    			$("#avatarContainer").html('<img alt="Avatar" class="img-responsive" src="/public/sistema/uploads/usuarios/'+resposta.sucesso+'_avatar.jpg" >')
    	    		}
	    		}
	    		*/
	    		$("#loader").hide();
            },  
            error: function(resposta, status) {
            	$("#loader").hide();
            	
            	toastr.error('Erro ao salvar o registro! Tente novamente.', 'Erro!');
            	
            } ,
	    }).submit(); 
	});
	
	$("#rowResultado").on('click','.usuario', function(){
		var idusuario = $(this).attr('data-idusuario');
		window.location = "/admin/usuarios/cadastro?usuario="+idusuario;
	});
	
	$("#btnRemover").click(function(){
		
		var id = $('#idusuario').val();
		
		bootbox.confirm("Deseja remover o usuário ID "+id+"?", function(result) {
			if(result == true){					
				$.ajax({
					url: "/admin/usuarios/remove",
					method: "POST",
					asysnc: false,
					cache: false,
				    dataType: "json",
				    data: {
				    	id : id,
				    },
				    beforeSend: function(){
				    	$("#loader").show();
				    },
				}).done(function (data, status, jqXHR) {
					
					if(status == "success"){ 
						 if(data.erro !== undefined){ 
							 new PNotify({
		                		title: "Erro!",
		              		  	type: "error",
		              		  	text: "Erro ao inativar o usuário! Tente novamente.",
		              		  	styling: 'fontawesome',		  
							 });
						 }else{
							 bootbox.alert("Usuário inativado com sucesso!", function() {
								 window.location = "/admin/usuarios";
							 });
						 }
					}
					
					$("#loader").hide();
							    
				}).fail(function (jqXHR, status) {
					console.log(status);
				    console.log(jqXHR.status);
				    
				    new PNotify({
		        		title: "Erro!",
		      		  	type: "error",
		      		  	text: "Erro ao inativar o usuário! Tente novamente.",
		      		  	styling: 'fontawesome',		  
		        	});
				    
				    $("#loader").hide();
				});	
			}
		}); 
	});
	
	$("#btnBuscar").click(function(){
	
		var busca = $("#busca").val();
		
		if(busca == ""){
			new PNotify({
        		title: "Atenção!",
      		  	type: "warning",
      		  	text: "Digite um termo para a busca!",
      		  	styling: 'fontawesome',		  
        	});
		}else{
			buscaRegistros();
		} 
	});
});

buscaRegistros = function(){
	
	var pagina = localStorage.getItem('pagina');
	
	$.ajax({
		url: "/admin/usuarios/busca",
		method: "POST",
		asysnc: false,
		cache: false,
	    data: {
	    	busca  : $("#busca").val(),
	    	pagina : pagina,
	    },
	    beforeSend: function(){
	    	$("#loader").show();
	    },
	}).done(function (data, status, jqXHR) {
		
		if(status == "success" && data != 'erro:true'){ 
			 $("#rowResultado").html(data);				 
		}else{
			new PNotify({
        		title: "Erro!",
      		  	type: "error",
      		  	text: "Erro ao buscas os usuários! Tente novamente.",
      		  	styling: 'fontawesome',		  
        	});
		}
		
	    $("#loader").hide();
	    
	}).fail(function (jqXHR, status) {
		console.log(status);
	    console.log(jqXHR.status);
	    
	    new PNotify({
    		title: "Erro!",
  		  	type: "error",
  		  	text: "Erro ao buscas os usuários! Tente novamente.",
  		  	styling: 'fontawesome',		  
    	});
	    
	    $("#loader").hide();
	});
}