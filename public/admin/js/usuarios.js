$(function(){
	
	$(document).on("click",".user-cadastro", function(){
		window.location = "/admin/usuarios/cadastro/"+$(this).attr('data-id');
	});
	
	
	//buscaRegistros();
	
	/**
	 * Salva usuario
	 */
	$("#btnSalvar").click(function(){
		
		//valido avatar --
		var avatar  = $("#avatar");
        
		validado = 0;
        if(avatar.val() != ""){
			var file = avatar[0].files[0];
			var fileType = file["type"]; 
						
			var ValidImageTypes = ["image/jpeg", "image/png"];
			if ($.inArray(fileType, ValidImageTypes) < 0) {
				validado = 1;				
			}
		}
        
        //-- salvo usuario -------------------
    	if(avatar.val() == "" || validado == 0){    		
    		validaCampos(function(r){
    			
    			if(r==true){
		    		$('#formCadastro').ajaxForm({
		    			url: "/admin/usuarios/salvar",
		    			dataType:  'json', 
		    			beforeSubmit:  function(){
		    				$("#loader").show();
		    			}, 
		    	    	success: function(resposta, status) {
		    	    		console.log(status);
		    	    		console.log(resposta);
		    	    		
		    	    		console.log(resposta.erro)
		    	    		
		    	    		if(resposta.erro !== undefined){
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
		    	    		
		    	    		$("#loader").hide();
		                },  
		                error: function(resposta, status) {
		                	$("#loader").hide();
		                	
		                	new PNotify({
		                		title: "Erro!",
		              		  	type: "error",
		              		  	text: "Erro ao salvar o usuário! Tente novamente.",
		              		  	styling: 'fontawesome',		  
		                	});
		                } ,
		    	    }).submit();  
    			}
    		});
    		
    	}else{
    		$("#loader").hide();
    		
    		new PNotify({
        		title: "Erro!",
      		  	type: "warning",
      		  	text: "Formato da imagem do avatar incorreto. Favor utilizar imagens em JPEG.",
      		  	styling: 'fontawesome',		  
        	});
    	} 
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