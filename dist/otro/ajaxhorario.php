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
							insert into horario
							(dia,id_programa,hora_inicio,duracion,descripcion) 
							values(".$_POST['dia'].",
								".$_POST['id_programa'].",
								'".$_POST['hora']."',
								'".$_POST['duracion']."',
								'".$_POST['descripcion']."')"
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