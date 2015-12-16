$(function(){	
	var tipo='';
	$('#div_frm_h').dialog({		
		autoOpen:false,
		modal:true,
		title:'Nuevo Horario',
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
		tipo='nuevo';
		$('#frm_horario input[type=text]').val('');
		$('#frm_horario input[type=time]').val('');
		// $("select[name='CCards'] option:selected").index()
		//$('#id_programa option[selected]').removeAttr('selected');
		$("#id_programa").find('option').removeAttr("selected");
		$("#tipo").find('option').removeAttr("selected");
		$("#dia").find('option').removeAttr("selected");
		//$('#status_user option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT		
	});
	$('#loader_h').hide();
	//$('#loader_h2').hide();
	$('#frm_horario').on('submit',function(event){		
		event.preventDefault();
		event.stopImmediatePropagation();tipo='nuevo';
		var datos=$(this).serialize();	
		//alert(datos);
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
					//$("#lis_horario").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_h').dialog('close');//CERRAMOS EL FORM
					$('#btn_h').show();
					$('#loader_h').hide();//OCULTAMOS EL LOADER
					location.href="inicio2.php";
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
	//$("#thorarioLunes").on("click","a",function(){
	$("table.table.table-bordered").on("click","a",function(){
		var pos=$(this).parent().parent();
		$("#id_horario").val($(pos).children("td:eq(0)").text());
		$("#descripcion_up").val($(pos).children("td:eq(4)").text());
		$("#tipo_up").val($(pos).children("td:eq(5)").text());
		if($(this).text()=="Editar"){
			//$("#opcion").val("editar");
			tipo='editar';
			$("#div_frm2").dialog("open");
		}
		// aqui faltaria agregar si se va a desactivar o algo asi
		else{
			if(confirm("¿Seguro de eliminar el Registro: "+$(pos).children("td:eq(3)").text()+ " con horario de "
				+$(pos).children("td:eq(1)").text()+"-"+$(pos).children("td:eq(2)").text()+" ?")){
				//$("#opcion").val("eliminar");
				tipo='eliminar';
				$("#frm_horario_update").submit();
			}
		}
	});

	$('#frm_horario_update').on('submit',function(){
		event.preventDefault();
		event.stopImmediatePropagation();		
		var datos=$(this).serialize();
		//alert("tipo es = "+tipo+" datos: "+datos);
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
					//$("#lis_programas").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_h2').dialog('close');//CERRAMOS EL FORM
					$('#loader_h2').hide();//OCULTAMOS EL LOADER										
					$('#btn_h2').show();
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
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});
});