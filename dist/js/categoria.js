$(function(){	
	var tipo='';
	$('#div_frm_c').dialog({		
		autoOpen:false,
		modal:true,
		title:'Categoria',
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
	$('#div_frm_c2').dialog({		
		autoOpen:false,
		modal:true,
		title:'Categoria',
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
	$('#agregar_c').on('click',function(){
		$('#div_frm_c').dialog('open');
		tipo='nuevo';
		$('#frm_categoria input[type=text]').val('');
		//$('#status_user option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT		
	});
	$('#loader_c').hide();	
	$('#frm_categoria').on('submit',function(){		
		var datos=$(this).serialize();
		//alert(""+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxcatego.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btn_c').hide();
				$('#loader_c').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA				
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_categorias").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_c').dialog('close');//CERRAMOS EL FORM
					$('#btn_c').hide();
					$('#loader_c').hide();//OCULTAMOS EL LOADER
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loader_c').hide();	
					$('#btn_c').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loader_c').hide();//OCULTAMOS EL DIV LOADER
				$('#btn_c').show();
			}
		});			
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});

	$("#lis_categorias").on("click","a",function(){
		var pos=$(this).parent().parent();
		$("#frm_categoria input[type=text]").each(function(index){
			$(this).val($(pos).children("td:eq("+index+")").text());
		});
		if($(this).text()=="Editar"){
			//$("#opcion").val("editar");
			tipo='editar';
			$("#div_frm_c").dialog("open");
		}
		// aqui faltaria agregar si se va a desactivar o algo asi
		else{
			if(confirm("¿Seguro de eliminar el Registro:"+$(pos).children("td:eq(1)").text()+"?")){
				//$("#opcion").val("eliminar");
				tipo='eliminar';
				$("#frm_categoria").submit();
			}
		}
	});
});