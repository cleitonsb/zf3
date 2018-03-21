$(document).ready(function() {

	//-- busco o endereco pelo CEP
	$(".cep").keyup(function(){
		var rad = ($(this).attr('data-rad') !== undefined) ? $(this).attr('data-rad') : "";
    	var cep = $(this).val();
    	cep = cep.replace("-","");
    	    	
    	if(cep.length >=8){
    		
			$.ajax({
				url: "http://viacep.com.br/ws/"+cep+"/json",
				method: "get",
				asysnc: false,
				cache: false,
				dataType:  'json', 
			    beforeSend: function(){
			    	$("#loader").show();
			    },
			}).done(function (data, status, jqXHR) {
				
				if(status == "success"){ 
					$("#"+rad+"bairro").val(data.bairro);
					$("#"+rad+"logradouro").val(data.logradouro); console.log("#"+rad+"logradouro");
					$("#"+rad+"uf").val(data.uf).trigger("chosen:updated");
					
					var selectCid = (rad) ? rad+"idcidade" : "";
					
					buscaCidades(data.uf, selectCid, data.localidade);					
				}
				
				$("#loader").hide();
						    
			}).fail(function (jqXHR, status) {
				console.log(status);
			    console.log(jqXHR.status);
			    
			    $("#loader").hide();
			});
    	}
	});
	
	/**
	 * Lista cidades conforme mudanca no select UF
	 */
	$(".uf-select").change(function(){
		var uf 		= $(this).val();
		var select  = $(this).attr('data-cid');
		buscaCidades(uf, select);
	});
    	
});

//-- busca de cidades 
buscaCidades = function(uf, selectCid, cidade){ 
	
	if(uf != '0' && uf != ''){
		selectCid = (selectCid) ? "#"+selectCid : "#idcidade";
		
		$.ajax({
			url: "/admin/cidades/busca/"+uf,
			method: "GET",
			asysnc: false,
			cache: false,
		    dataType: "json",
		    beforeSend: function(){
		    	$(selectCid).html('<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>');
		    },
		}).done(function (data, status, jqXHR) {
			
			if(status == "success"){ 
				 if(data.erro !== undefined){ 
					 //$("#dashEtapas ul").html("<div class='padding25'>"+data.erro+"</div>");
				 }else{
					 for(var i = 0; i<data.length; i++){
						 
						 var select = (cidade == data[i].nome) ? 'selected="selected"' : "";
						 
						 $(selectCid).append('<option '+select+' value="'+data[i].idcidade+'">'+data[i].nome+'</option>').trigger("chosen:updated");						 
					 }				 
				 }
			}
					    
		}).fail(function (jqXHR, status) {
			console.log(status);
		    console.log(jqXHR.status);
		});	
	}
}