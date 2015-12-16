<?php
include("../../conexion2.php");
sleep(3);
if($statusConexion){
	$respuesta="DONE";
	$mensaje="";
	$ContenidoProgramas="";
	$consulta="";
	if($_POST!="" && !empty($_POST)){
		switch ($_POST['Op']) {
				case 'nuevo':
						$consulta=mysql_query("
							insert into programas
							(nombre,estatus) 
							values(
							'".$_POST['nombre_pro']."',
							'ACTIVO')"
							,$conex);
						if(mysql_affected_rows()>0){
							$ContenidoProgramas=consultaProgramas($conex);
							$mensaje="Registro Insertado";							
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la insercion del registro";
						}
					break;
				case 'editar':
						$consulta=mysql_query("
							update programas set
							nombre='".$_POST['nombre_pro_up']."',
							estatus='".$_POST['estatus_pro']."',
							descripcion='".$_POST['descripcion_pro']."',
							correo='".$_POST['correo_pro']."',
							logo='".$_POST['logo_pro']."',
							img_slider='".$_POST['imagen_slide_pro']."',
							descripcion_slider='".$_POST['desc_slide']."',
							imgtop_programa='".$_POST['imagen_pro']."',							
							id_categoria='".$_POST['id_categoria']."'
							where id_programa=".$_POST['id_programa']
							,$conex);
						if(mysql_affected_rows()>0){
							$ContenidoProgramas=consultaProgramas($conex);
							$mensaje="Registro Actualizado";												
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la actualizacion del registro";
						}
					break;			
				case 'eliminar':
						$consulta=mysql_query("delete from programas 
							where id_programa=".$_POST['id_programa'],$conex);
						if(mysql_affected_rows()>0){
							$ContenidoProgramas=consultaProgramas($conex);	
							$mensaje="Registro Eliminado";							
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al Eliminar Registro";	
						}
					break;
			}			
	}
	else{
		$respuesta="BAD";
		$mensaje="Error en los datos";
	}		
}
$salidaJSON=array("respuesta" => $respuesta,"contenido" => $ContenidoProgramas,"mensaje" => $mensaje);
echo json_encode($salidaJSON);
?>