$(function(){
	var tipo='';
	$('#div_frm_productor').dialog({		
		autoOpen:false,
		modal:true,
		title:'Productor',
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
	$('#div_frm_productor2').dialog({		
		autoOpen:false,
		modal:true,
		title:'Editar Productor',
		width:350,
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
	$('#agregar_productor').on('click',function(){
		$('#div_frm_productor').dialog('open');
		tipo='nuevo';
		$('#frm_productor input[type=text]').val('');
		$('#frm_productor input[type=email]').val('');	
		$('#frm_productor textarea').val('');
		//$("#dia").find('option').removeAttr("selected");
		//$('#status_user option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT		
	});
	$('#loaderpr').hide();
	$('#loaderpr2').hide();
	$('#frm_productor').on('submit',function(event){		
		event.preventDefault();
		event.stopImmediatePropagation();
		var datos=$(this).serialize();
		//alert(""+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxproductor.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btnpr').hide();
				$('#loaderpr').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA				
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_productores").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_productor').dialog('close');//CERRAMOS EL FORM
					$('#btnpr').show();
					$('#loaderpr').hide();//OCULTAMOS EL LOADER
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loaderpr').hide();	
					$('#btnpr').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loaderpr').hide();//OCULTAMOS EL DIV LOADER
				$('#btnpr').show();
			}
		});			
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});

	$("#lis_productores").on("click","a",function(){
		var pos=$(this).parent().parent();	
		$("#id_productor").val($(pos).children("td:eq(0)").text());			
		$("#nom_productor_up").val($(pos).children("td:eq(1)").text());
		$("#correo_productor_up").val($(pos).children("td:eq(2)").text());
		$("#desc_productor_up").val($(pos).children("td:eq(3)").text());
		$("#img_poductor_up").val($(pos).children("td:eq(4)").text());
		$("#estatus_productor").val($(pos).children("td:eq(5)").text());
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
			$("#div_frm_productor2").dialog("open");			
		}
		// aqui faltaria agregar si se va a desactivar o algo asi
		else{
			if(confirm("¿Seguro de eliminar el Registro:"+$(pos).children("td:eq(1)").text()+"?")){
				//$("#opcion").val("eliminar");
				tipo='eliminar';
				$("#frm_edit_productor").submit();
			}
		}
	});

	$('#frm_edit_productor').on('submit',function(event){
		event.preventDefault();
		event.stopImmediatePropagation();		
		var datos=$(this).serialize();
		//alert("tipo es = "+tipo+" datos: "+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxproductor.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btnpr2').hide();
				$('#loaderpr2').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA								
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_productores").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_productor2').dialog('close');//CERRAMOS EL FORM
					$('#loaderpr2').hide();//OCULTAMOS EL LOADER										
					$('#btnpr2').show();
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loaderpr2').hide();
					$('#btnpr2').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loaderpr2').hide();//OCULTAMOS EL DIV LOADER
				$('#btnpr2').show();
			}
		});			
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});
});