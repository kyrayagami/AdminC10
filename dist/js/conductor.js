$(function(){
	var tipo='';
	$('#div_frm_c').dialog({		
		autoOpen:false,
		modal:true,
		title:'Conductor',
		width:350,
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
	$('#div_frm_c2').dialog({		
		autoOpen:false,
		modal:true,
		title:'Editar Conductor',
		width:350,
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
	$('#agregar_conductor').on('click',function(){
		$('#div_frm_c').dialog('open');
		tipo='nuevo';
		$('#frm_conductor input[type=text]').val('');
		$('#frm_conductor input[type=email]').val('');	
		$('#frm_conductor textarea').val('');
		//$("#dia").find('option').removeAttr("selected");
		//$('#status_user option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT		
	});
	$('#loaderc').hide();
	$('#loaderc2').hide();
	$('#frm_conductor').on('submit',function(event){		
		event.preventDefault();
		event.stopImmediatePropagation();
		var datos=$(this).serialize();
		//alert(""+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxconductor.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btnc').hide();
				$('#loaderc').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA				
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_conductores").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_c').dialog('close');//CERRAMOS EL FORM
					$('#btnc').show();
					$('#loaderc').hide();//OCULTAMOS EL LOADER
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loaderc').hide();	
					$('#btnc').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loaderc').hide();//OCULTAMOS EL DIV LOADER
				$('#btnc').show();
			}
		});			
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});

	$("#lis_conductores").on("click","a",function(){
		var pos=$(this).parent().parent();	
		$("#id_conductor").val($(pos).children("td:eq(0)").text());			
		$("#nombre_c_up").val($(pos).children("td:eq(1)").text());
		$("#correo_c_up").val($(pos).children("td:eq(2)").text());
		$("#biografia_c_up").val($(pos).children("td:eq(3)").text());
		$("#imagen_c_up").val($(pos).children("td:eq(4)").text());
		$("#estatus_c").val($(pos).children("td:eq(5)").text());
		//var valor = $(pos).children("td:eq(4)").text();
		//var combo = $("#id_categoria").length();
		//var combo = document.forms["tu_formulario"].tuSelect;
   		/*var cantidad = $("#id_categoria option").length;
   		/*alert("Cantidad : "+cantidad + "valor a buscar : "+valor);
   		for (i = 0; i < cantidad; i++) {
      		if ($("#id_categoria option")[i].text== valor) {
         		$("#id_categoria option")[i].selected = true;
      		}
   		}*/
		if($(this).text()=="Editar"){
			//$("#opcion").val("editar");
			tipo='editar';			
			$("#div_frm_c2").dialog("open");			
		}
		// aqui faltaria agregar si se va a desactivar o algo asi
		else{
			if(confirm("¿Seguro de eliminar el Registro:"+$(pos).children("td:eq(1)").text()+"?")){
				//$("#opcion").val("eliminar");
				tipo='eliminar';
				$("#frm_edit_conductor").submit();
			}
		}
	});

	$('#frm_edit_conductor').on('submit',function(event){
		event.preventDefault();
		event.stopImmediatePropagation();		
		var datos=$(this).serialize();
		//alert("tipo es = "+tipo+" datos: "+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxconductor.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btnc2').hide();
				$('#loaderc2').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA								
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_conductores").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_c2').dialog('close');//CERRAMOS EL FORM
					$('#loaderc2').hide();//OCULTAMOS EL LOADER										
					$('#btnc2').show();
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loaderc2').hide();
					$('#btnc2').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loaderc2').hide();//OCULTAMOS EL DIV LOADER
				$('#btnc2').show();
			}
		});			
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});
});