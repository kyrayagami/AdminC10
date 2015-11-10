<?php
include("../../conexion2.php");
sleep(3);
if($statusConexion){
	$respuesta="DONE";
	$mensaje="";
	$ContenidoHTML="";
	$consulta="";
	if($_POST!="" && !empty($_POST)){
		switch ($_POST['Op']) {
				case 'nuevo':
						$consulta=mysql_query("
							insert into programas_prueba
							(nombre,estatus) 
							values(
							'".$_POST['nombre']."',
							'ACTIVO')"
							,$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Insertado";
							$ContenidoHTML=consultaProgramas($conex);					
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la insercion del registro";
						}
					break;
				case 'editar':
						$consulta=mysql_query("
							update programas_prueba set
							nombre='".$_POST['nombre']."',
							estatus='".$_POST['estatus']."',
							descripcion='".$_POST['descripcion']."',
							correo='".$_POST['correo']."'
							where id_programa=".$_POST['id_programa']
							,$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Actualizado";
							$ContenidoHTML=consultaProgramas($conex);					
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la actualizacion del registro";
						}
					break;			
				case 'eliminar':
						$consulta=mysql_query("delete from programas_prueba 
							where id_programa=".$_POST['id_programa'],$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Eliminado";
							$ContenidoHTML=consultaProgramas($conex);	
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
$salidaJSON=array("respuesta" => $respuesta,"mensaje" => $mensaje,"contenido" => $ContenidoHTML,"consulta" => $consulta);
echo json_encode($salidaJSON);
?>