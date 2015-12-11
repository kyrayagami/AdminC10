$(function(){
	var tipo='';
	$('#div_frm_pro').dialog({		
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
	$('#div_frm_pro2').dialog({		
		autoOpen:false,
		modal:true,
		title:'Editar Programa',
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
	$('#agregar_programa').on('click',function(){
		$('#div_frm_pro').dialog('open');
		tipo='nuevo';
		$('#frm_programa input[type=text]').val('');
		$('#frm_programa textarea').val('');
		//$("#dia").find('option').removeAttr("selected");
		//$('#status_user option[selected]').removeAttr('selected');//REMOVEMOS EL ATTRIBUTO SELECTED DEL SELECT		
	});
	$('#loaderp').hide();
	$('#loaderp2').hide();
	$('#frm_programa').on('submit',function(event){		
		var datos=$(this).serialize();
		//alert(""+datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxprogram.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btnp').hide();
				$('#loaderp').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA				
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_programas").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_pro').dialog('close');//CERRAMOS EL FORM
					$('#btnp').show();
					$('#loaderp').hide();//OCULTAMOS EL LOADER
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loaderp').hide();	
					$('#btnp').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loaderp').hide();//OCULTAMOS EL DIV LOADER
				$('#btnp').show();
			}
		});			
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});

	$("#lis_programas").on("click","a",function(){
		var pos=$(this).parent().parent();		
		/*
		$("#frm_edit_progra input[type=text],input[type=email],select").each(function(index){
			$(this).val($(pos).children("td:eq("+index+")").text());
			//var dat
			//alert("dat : "+index);
			//alert(" .. "+ $(pos).children("td:eq("+index+")").text());
		});
		*/
		$("#id_programa").val($(pos).children("td:eq(0)").text());
		$("#nombre_pro_up").val($(pos).children("td:eq(1)").text());
		$("#descripcion_pro").val($(pos).children("td:eq(2)").text());
		$("#correo_pro").val($(pos).children("td:eq(3)").text());
		//$("#id_programa").val($(pos).children("td:eq(4)").text());
		$("#logo_pro").val($(pos).children("td:eq(5)").text());
		$("#imagen_slide_pro").val($(pos).children("td:eq(6)").text());
		$("#desc_slide").val($(pos).children("td:eq(7)").text());		
		$("#imagen_pro").val($(pos).children("td:eq(8)").text());		
		$("#estatus_pro").val($(pos).children("td:eq(9)").text());
		//alert("img "+ $(pos).children("td:eq(5)").text());		
		//alert("img "+ $(pos).children("td:eq(7)").text());
		var valor = $(pos).children("td:eq(4)").text();
		//var combo = $("#id_categoria").length();
		//var combo = document.forms["tu_formulario"].tuSelect;
   		var cantidad = $("#id_categoria option").length;
   		//alert("Cantidad : "+cantidad + "valor a buscar : "+valor);
   		for (i = 0; i < cantidad; i++) {
      		if ($("#id_categoria option")[i].text== valor) {
         		$("#id_categoria option")[i].selected = true;
      		}
   		}
		if($(this).text()=="Editar"){
			//$("#opcion").val("editar");
			tipo='editar';			
			$("#div_frm_pro2").dialog("open");			
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

	$('#frm_edit_progra').on('submit',function(event){				
		//alert("tipo es = "+tipo+" datos: "+datos);
		event.preventDefault();
		event.stopImmediatePropagation();
		var datos=$(this).serialize();
		alert(datos);
		$.ajax({
			type:'POST',
			dataType:"json",
			url:"dist/otro/ajaxprogram.php",
			data: 'Op='+tipo+'&'+datos,//'Op='+ $("#opcion").val() +'&'+datos,
			beforeSend: function(){
				$('#btnp2').hide();
				$('#loaderp2').show();//MOSTRAMOS EL DIV LOADER EL CUAL CONTIENE LA IMAGEN DE CARGA								
			},
			success: function(response){//ACCION QUE SUCEDE DESPUES DE REALIZAR CORRECTAMENTE LA PETCION EL CUAL NOS TRAE UNA RESPUESTA
				if(response.respuesta=="DONE"){//MANDAMOS EL MENSAJE QUE NOS DEVUELVE EL RESPONSE
					$("#lis_programas").html(response.contenido);//cargo los registros que devuelve ajax
					$('#div_frm_pro2').dialog('close');//CERRAMOS EL FORM
					$('#loaderp2').hide();//OCULTAMOS EL LOADER										
					$('#btnp2').show();
				}
				else{
					alert("Ocurrio un error al ejecutar la operacion, intentelo de nuevo");
					$('#loaderp2').hide();
					$('#btnp2').show();
				}								
			},
			error: function(){//SI OCURRE UN ERROR 
				alert('El servicio no esta disponible intentelo mas tarde');//MENSAJE EN CASO DE ERROR
				$('#loaderp2').hide();//OCULTAMOS EL DIV LOADER
				$('#btnp2').show();
			}
		});			
		return false;//RETORNAMOS FALSE PARA QUE NO HAGA UN RELOAD EN LA PAGINA
	});
});