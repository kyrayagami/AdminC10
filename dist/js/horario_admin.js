$(function(){	
	var tipo='';
	$('#div_frm_h').dialog({		
		autoOpen:false,
		modal:true,
		title:'Agregar al Horario',
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
	$('#div_frm_h2').dialog({		
		autoOpen:false,
		modal:true,
		title:'Editar Horario',
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
	$('#agregar_h').on('click',function(){
		$('#div_frm_h').dialog('open');
		$('#frm_horario input[type=text]').val('');				
		$('#frm_horario input[type=time]').val('');		
		//$('#id_programa option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT
		$('#id_programa').prop('selected' , false);   //prop('selected' , false);
		$('#dia option[selected]').removeAttr('selected');	
		tipo='nuevo';		
	});
	$('#loader_h').hide();
	$('#loader_h2').hide();
	
	$('#frm_horario').on('submit',function(){		
		var datos=$(this).serialize();
		alert(""+datos);		
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxhorario.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btn_h').hide();
				$('#loader_h').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA				
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_horario").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_h').dialog('close');//CERRAMOS EL FORM
					$('#btn_h').show();
					$('#loader_h').hide();//OCULTAMOS EL LOADER
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loader_h').hide();	
					$('#btn_h').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loader_h').hide();//OCULTAMOS EL DIV LOADER
				$('#btn_h').show();
			}
		});			
		//return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
		
	});
	
	$("#thorarioLunes").on("click","a",function(){
		var pos=$(this).parent().parent();
		//var pos2=$(this).parent();
		//alert("prueba . "+pos.children("td:eq(5)").text());
		//alert("datos : "+$(pos).children("td:eq(1)").text()+" . "+$(pos).children("td:eq(2)").text()+" . "+$(pos).children("td:eq(5)").text());
		
		$("#id_horario").val($(pos).children("td:eq(0)").text());
		//$("#hora_parse").val($(pos).children("td:eq(1)").text());
		//console.info(""+pos);
		//$("#horaTermino_up").val($(pos).children("td:eq(2)").text());
		//$("#id_programa_up").val($(pos).children("td:eq(3)").text());
		
		$("#descripcion_up").val($(pos).children("td:eq(4)").text());
		$("#tipo_up").val($(pos).children("td:eq(5)").text());	
		
		/*
		$("#frm_horario_update input[type=time], select, input[type=text]").each(function(index){
			//alert("index : "+index);
			//$("#id_horario").val
			$(this).val($(pos).children("td:eq("+index+")").text());
			//alert(" pos :"+index+" "+ $(pos).children("td:eq("+index+")").text());
		});
		*/
		if($(this).text()=="Editar"){
			//$("#opcion").val("editar");
			tipo='editar';
			$("#div_frm_h2").dialog("open");
		}
		// aqui faltaria agregar si se va a desactivar o algo asi
		else{
			if(confirm("¿Seguro de eliminar el Registro:"+$(pos).children("td:eq(3)").text()+" del horario?")){
				//$("#opcion").val("eliminar");
				tipo='eliminar';
				$("#frm_horario_update").submit();
			}
		}
	});	
	$('#frm_horario_update').on('submit',function(){		
		var datos=$(this).serialize();
		//alert(datos);		
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxhorario.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btn_h2').hide();
				$('#loader_h2').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA				
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					//$("#lis_horario").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_h2').dialog('close');//CERRAMOS EL FORM
					$('#btn_h2').show();
					$('#loader_h2').hide();//OCULTAMOS EL LOADER
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loader_h2').hide();	
					$('#btn_h2').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loader_h2').hide();//OCULTAMOS EL DIV LOADER
				$('#btn_h2').show();
			}
		});			
		//return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA		
	});
});