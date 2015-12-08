$(function(){
	var tipo='';
	$('#div_frm').dialog({		
		autoOpen:false,
		modal:true,
		title:'Conductor',
		width:375,
		height:'auto',
		show:{
			effect:"clip",
			duration:400
		},
		hide:{
			effect:"clip",
			duration:400
		}
	});	
	$('#div_frm2').dialog({		
		autoOpen:false,
		modal:true,
		title:'Editar Conductor',
		width:375,
		height:'auto',
		show:{
			effect:"clip",
			duration:300
		},
		hide:{
			effect:"clip",
			duration:300
		}
	});
	$('#agregar').on('click',function(){
		$('#div_frm').dialog('open');
		tipo='nuevo';
		$('#frm_c input[type=text]').val('');
		$('#frm_c input[type=email]').val('');		
		$('#frm_c textarea').val('');
		$("#estatus").find('option').removeAttr("selected");
		$("#respuesta").html('');
		$("#imagen").val('');
		//$('#status_user option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT		
	});
	$('#loader').hide();
	$('#loader2').hide();
	/*
	$('#imagen').on('change',function(){
		event.preventDefault();
		event.stopImmediatePropagation();
		var formData = new FormData($("#frm_img")[0]);
		// data: 'ACCION=imagen&'+img,
		$.ajax({
			url: "dist/otro/subirImagen.php",
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			success: function(respons){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA				
				if(respons.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#respuesta").html(respons.contenido);
					//$("#lis_conductores").html(response.contenido);//cargo los registros que devuelve ajax
					//$('#div_frm').dialog('close');//CERRAMOS EL FORM
					//$('#btn').show();
					//$('#loader').hide();//OCULTAMOS EL LOADER					
				}
				else{
					alert("Ocurrio un error en la imagen, intentelo de nuevo . "+respons);
					//$('#loader').hide();	
					//$('#btn').show();
					$("#respuesta").html(respons);
				}					
			},
			error: function(){//SI OCURRE UN ERROR 
				
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				/*
				$('#loader').hide();//OCULTAMOS EL DIV LOADER
				$('#btn').show();*/ /*
			}
		});
	});*/
	$('#frm_c').on('submit',function(event){		
		event.preventDefault();
		event.stopImmediatePropagation();
		//var formData = new FormData($('#frm_c'));
		//var formData = new FormData($(this)[0]);
		var formData = new FormData($('#frm_c')[0]);
		//var formData = new FormData($("#frm_img")[0]);
		formData.append("Op", tipo);
		//alert((formData)[1]);
		//alert(formData);
		$.ajax({
			type:'POST',
			//dataType:"json",
			url:"dist/otro/ajaxconductor.php",
			//data: 'Op='+tipo+'&'+formData,//'Op='+ $("#opcion").val() +'&'+datos,
			data: formData,
			mimeType: "multipart/form-data",
    		contentType: false,
        	//cache: false,
        	processData:false,
			beforeSend: function(){
				$('#btn').hide();
				$('#loader').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA				
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				//$("#lis_conductores").html(response.contenido);
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_conductores").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm').dialog('close');//CERRAMOS EL FORM
					$('#btn').show();
					$('#loader').hide();//OCULTAMOS EL LOADER
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loader').hide();	
					$('#btn').show();
					//$("#lis_conductores").html(response.contenido); ///quitar despues
				}
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loader').hide();//OCULTAMOS EL DIV LOADER
				$('#btn').show();
			}
		});	
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});
/*
	$("#lis_conductores").on("click","a",function(){
		var pos=$(this).parent().parent();		
		
		//$("#frm_edit_conductor input[type=text],input[type=email],select,textarea").each(function(index){
		//	$(this).val($(pos).children("td:eq("+index+")").text());
			//var dat
			//alert("dat : "+index);
			//alert(" .. "+ $(pos).children("td:eq("+index+")").text());
		//});
		$("#id_conductor").val($(pos).children("td:eq(0)").text());
		$("#nombre_up").val($(pos).children("td:eq(1)").text());
		$("#correo_up").val($(pos).children("td:eq(2)").text());
		$("#biografia_up").val($(pos).children("td:eq(3)").text());
		$("#estatus").val($(pos).children("td:eq(4)").text());
		//var valor = $(pos).children("td:eq(4)").text();
		//var combo = $("#id_categoria").length();
		//var combo = document.forms["tu_formulario"].tuSelect;

   		//var cantidad = $("#id_categoria option").length;
   		//alert("Cantidad : "+cantidad + "valor a buscar : "+valor);
   		//for (i = 0; i < cantidad; i++) {
      		//if ($("#id_categoria option")[i].text== valor) {
         		//$("#id_categoria option")[i].selected = true;
      		//}
   		}
		if($(this).text()=="Editar"){
			//$("#opcion").val("editar");
			tipo='editar';			
			$("#div_frm2").dialog("open");			
		}
		// aqui faltaria agregar si se va a desactivar o algo asi
		else 
			if ($(this).text()=="Eliminar"){
				if(confirm("¿Seguro de eliminar el Registro:"+$(pos).children("td:eq(1)").text()+"?")){
					//$("#opcion").val("eliminar");
					tipo='eliminar';
					$("#frm_edit_conductor").submit();
				}
			}
	});

	$('#frm_edit_conductor').on('submit',function(){		
		var datos=$(this).serialize();
		alert("tipo es = "+tipo+" datos: "+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxconductor.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btn2').hide();
				$('#loader2').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA								
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_conductores").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm2').dialog('close');//CERRAMOS EL FORM
					$('#loader2').hide();//OCULTAMOS EL LOADER										
					$('#btn2').show();
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loader2').hide();
					$('#btn2').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loader2').hide();//OCULTAMOS EL DIV LOADER
				$('#btn2').show();
			}
		});			
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});*/
});