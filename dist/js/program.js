$(function(){
	var tipo='';
	$('#div_frm').dialog({		
		autoOpen:false,
		modal:true,
		title:'Programa',
		width:300,
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
		title:'Editar Programa',
		width:300,
		height:'auto',
		show:{
			effect:"clip",
			duration:500
		},
		hide:{
			effect:"clip",
			duration:500
		}
	});
	$('#agregar').on('click',function(){
		$('#div_frm').dialog('open');
		tipo='nuevo';
		$('#frm_programa input[type=text]').val('');
		//$('#status_user option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT		
	});
	$('#loader').hide();
	$('#loader2').hide();
	$('#frm_programa').on('submit',function(){		
		var datos=$(this).serialize();
		//alert(""+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxprogram.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btn').hide();
				$('#loader').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA				
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_programas").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm').dialog('close');//CERRAMOS EL FORM
					$('#btn').show();
					$('#loader').hide();//OCULTAMOS EL LOADER
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loader').hide();	
					$('#btn').show();
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

	$("#lis_programas").on("click","a",function(){
		var pos=$(this).parent().parent();
		$("#frm_edit_progra input[type=text],select").each(function(index){
			$(this).val($(pos).children("td:eq("+index+")").text());
			//var dat
			//alert("dat : "+index);
			//alert(" .. "+ $(pos).children("td:eq("+index+")").text());
		});
		if($(this).text()=="Editar"){
			//$("#opcion").val("editar");
			tipo='editar';
			$("#div_frm2").dialog("open");
		}
		// aqui faltaria agregar si se va a desactivar o algo asi
		else{
			if(confirm("¿Seguro de eliminar el Registro:"+$(pos).children("td:eq(1)").text()+"?")){
				//$("#opcion").val("eliminar");
				tipo='eliminar';
				$("#frm_edit_progra").submit();
			}
		}
	});

	$('#frm_edit_progra').on('submit',function(){		
		var datos=$(this).serialize();
		//alert("tipo es = "+tipo+" datos: "+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxprogram.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btn2').hide();
				$('#loader2').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA								
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_programas").html(response.contenido);//cargo los registros que devuelve ajax
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
	});
});