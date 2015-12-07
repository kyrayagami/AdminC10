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
						$id_imagen = $_POST['id_imagen'];
						
						$consulta=mysql_query("INSERT INTO conductores(conductor,estatus,correo,descripcion_conductor,id_imagen) values('".$_POST['nombre']."', 'ACTIVO','".$_POST['correo']."','".$_POST['biografia']."','".$id_imagen."')",$conex);
						if(mysql_affected_rows()>0){
							//actualizar la tabla de imagenes
							$consult=mysql_query("
							update imagenes set 
							alt='".$_POST['nombre']."',
							metatags='".$_POST['nombre']."' 
							where id_imagen=".$id_imagen,$conex);
							$mensaje="Registro Insertado";
							$ContenidoHTML=consultaConductores($conex);
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la insercion del registro";
						}
                  		//$status = "Archivo subido: <b>".$archivo."</b>";                			
						//$sql = "INSERT INTO imagenes(alt, url, metatags) VALUES(".$conductor.",".$destino.",".$conductor.")";
					break;
				case 'editar':
				/*
						$consulta=mysql_query("
							update programas set
							conductor='".$_POST['nombre_up']."',
							estatus='".$_POST['estatus']."',
							descripcion_conductor='".$_POST['biografia_up']."',
							correo='".$_POST['correo_up']."',
							id_categoria='".$_POST['id_categoria']."'
							where id_programa=".$_POST['id_programa']
							,$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Actualizado";
							$ContenidoHTML=consultaProgramas($conex);					
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la actualizacion del registro";
						}*/
					break;			
				case 'eliminar':
						$consulta=mysql_query("delete from conductores
							where id_conductor=".$_POST['id_conductor'],$conex);
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
$salidaJSON=array("respuesta" => $respuesta,"mensaje" => $mensaje,"contenido" => $ContenidoHTML);
echo json_encode($salidaJSON);
?>