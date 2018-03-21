$(function(){
	validaCampos = function(callback){
		
		var valida = 0;		
		$(".require").each(function(){
			
			var campo = $(this);
						
			if(campo.hasClass("select2")){
				
				var valor = $('option:selected', campo[0]).val();
				
				if(valor == "0"){
    				
    				new PNotify({
                		title: "Atenção!",
              		  	type: "warning",
              		  	text: "O campo <strong>"+campo.attr("data-nome")+"</strong> não pode ficar em branco!",
              		  	styling: 'fontawesome',		  
                	});	
    				
    				valida = 1;
    				callback(false);
    				return false;
    			}
			}else{
    			if(campo.val() == ""){
    				
    				new PNotify({
                		title: "Atenção!",
              		  	type: "warning",
              		  	text: "O campo <strong>"+campo.attr("placeholder")+"</strong> não pode ficar em branco!",
              		  	styling: 'fontawesome',		  
                	});	
    				
    				valida = 1;
    				callback(false);
    				return false;
    			}
			}
		});
		
		if(valida == 0){
			callback(true);
		}
	}	
	
	/**
	 * Retorna true caso a img seja invalida
	 */
	validaFileimg = function(callback){
		
		$(".up-imagem").each(function(){
			
			if($(this).val() != ""){
				var file = this.files[0];
				var fileType = file["type"]; 
							
				var ValidImageTypes = ["image/jpeg", "image/png"];
				if ($.inArray(fileType, ValidImageTypes) < 0) {
					callback(true);				
				}			
			}
		});		
	}
})