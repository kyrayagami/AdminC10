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
				// varificar antes si no hay un horarios similar	
				// validar que hora de termino sea mayor a hora de inicio
						$hora_inicio = str_replace(":", "",$_POST["hora"]);
						$hora_termino = str_replace(":", "",$_POST["horaTermino"]);
						//$ContenidoHTML="hora inicio = ".$_POST["hora"]." -- hora termino ".$hora_termino;
						if($hora_termino>$hora_inicio){
							//CONSULta							
							$hora_inicio = $_POST["hora"];
							$hora_termino = $_POST["horaTermino"];
							$dia= $_POST["dia"];
							//$ContenidoHTML="hora inicio = ".$_POST["hora"]." -- hora termino ".$hora_termino;
							$verifica = validacionhorahorarios($conex,$dia,$hora_inicio,$hora_termino);
							$ContenidoHTML=$verifica;
							if($verifica=='no'){
								$consulta=mysql_query("
									insert into horarios
									(dia,id_programa,hora_inicio,hora_termino,tipo,descripcion_h)
									values(".$_POST['dia'].",
									".$_POST['id_programa'].",
									'".$_POST['hora']."',
									'".$_POST['horaTermino']."',
									'".$_POST['tipo']."',
									'".$_POST['descripcion']."')"
								,$conex);
								if(mysql_affected_rows()>0){
									$mensaje="Registro Insertado";
									//$ContenidoHTML=consulthorarioss2($conex);					
								}
								else{
									$respuesta="BAD";
									$mensaje="Error al realizar la insercion del registro";
								}
							}
							else{
									$respuesta="DUPLICIDAD";
									$mensaje="Error al tratar de ingresar registros con la hora especificada";
							}
						}						
					break;	
					/*
				case 'editar':
						$consulta=mysql_query("
							update horarios set							
							programa='".$_POST['estatus']."',
							hora_inicio='".$_POST['hora_up']."',
							hora_termino='".$_POST['horaTermino_up']."',
							tipo='".$_POST['tipo_up']."',
							descripcion_h='".$_POST['descripcion_up']."',
							where id=".$_POST['id_horarios']
							,$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Actualizado";
							//$ContenidoHTML=consultaProgramas($conex);					
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al realizar la actualizacion del registro";
						}
					break;	*/		
				case 'eliminar':
						$consulta=mysql_query("delete from horarios 
							where id=".$_POST['id_horario'],$conex);
						if(mysql_affected_rows()>0){
							$mensaje="Registro Eliminado";
							//$ContenidoHTML=consultaProgramas($conex);	
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