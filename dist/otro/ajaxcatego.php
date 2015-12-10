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
							insert into categoria
							(categoria) 
							values(
							'".$_POST['nombre']."')"
							,$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Insertado";
							$ContenidoHTML=consultaCategoria($conex);					
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la insercion del registro";
						}
					break;
				case 'editar':
						$consulta=mysql_query("
							update categoria set
							categoria='".$_POST['nombre_up']."'							
							where id_categoria=".$_POST['id_categoria']
							,$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Actualizado";
							$ContenidoHTML=consultaCategoria($conex);					
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la actualizacion del registro";
						}
					break;			
				case 'eliminar':
						$consulta=mysql_query("delete from categoria 
							where id_categoria=".$_POST['id_categoria'],$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Eliminado";
							$ContenidoHTML=consultaCategoria($conex);	
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
$salidaJSON=array("respuesta" => $respuesta,"mensaje" => $mensaje,"contenido" => $ContenidoHTML);
echo json_encode($salidaJSON);
?>