<?php
include("../../conexion2.php");
sleep(1);
if($statusConexion){
	$respuesta="DONE";
	$mensaje="";
	$ContenidoHTML="";
	$consulta="";
	if($_POST!="" && !empty($_POST)){		
		switch ($_POST['Op']) {
				case 'nuevo':
						$file= $_FILES["imagen"];
						//$tamano = $file["size"];
            			//$tipo = $file["type"];
						$id_img='';            			
            			$archivo = $_POST['nombre'];
            			$prefijo = substr(md5(uniqid(rand())),0,6);
            			$destino =  "../../files/".$prefijo."_".$archivo.$file["name"];
						//$id_imagen = $_POST['id_imagen'];						
						//$consulta=mysql_query("INSERT INTO conductores(conductor,estatus,correo,descripcion_conductor,id_imagen) values('".$_POST['nombre']."', 'ACTIVO','".$_POST['correo']."','".$_POST['biografia']."','".$id_imagen."')",$conex);
						if(move_uploaded_file($file['tmp_name'],$destino)){                		
                		// cambio de destino
                    		$destino="files/".$prefijo."_".$archivo.$file["name"];
                    		$sql=mysql_query("INSERT INTO imagenes(url) VALUES('".$destino."')", $conex);
                    		if(mysql_affected_rows()>0){
                    			$consult=mysql_query("SELECT * FROM imagenes where url='".$destino."'",$conex);
                    			$row=mysql_fetch_array($consult);
                    			$id_imagen = $row['id_imagen'];
                    			$consulta=mysql_query("INSERT INTO conductores(conductor,estatus,correo,descripcion_conductor,id_imagen) values('".$_POST['nombre']."', 'ACTIVO','".$_POST['correo']."','".$_POST['biografia']."','".$id_imagen."')",$conex);
                				if(mysql_affected_rows()>0){
                					$mensaje="Registro Insertado";
									$ContenidoHTML=consultaConductores($conex);
                				}else{
									$respuesta="BAD";
									$mensaje="Error al realizar la insercion del registro";
								}
                    		}else{
                    			$respuesta="BAD";
                    			$mensaje="Error al subri la imagen";
                    		}
                    		/*
                    		$mensaje="Imagen Insertada";
                    		$ContenidoHTML='<input type="hidden" name="id_imagen" id="id_imagen" value="'.$id_img.'">';
                    		*/
                		}else{
                    		//$status = "Error al subir la imagen";
                    		//$ContenidoHTML  = $destino;
                    		$respuesta="BAD Error al subir la imagen";
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
							$ContenidoHTML=consultaConductores($conex);					
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
							$ContenidoHTML=consultaConductores($conex);	
						}
						else{
							$respuesta="BAD";
							$mensaje="Error al Eliminar Registro";	
						}
					break;
		}		
	}
	else{
		$file = json_encode($_FILES);
		//$dato = json_encode($_POST);
		$respuesta="BAD";
		$mensaje="Error en los datos ".$file;
	}		
}
$salidaJSON=array("respuesta" => $respuesta,"mensaje" => $mensaje,"contenido" => $ContenidoHTML);
echo json_encode($salidaJSON);
/*$file = json_encode($_FILES);
echo $file;
$dato = json_encode($_POST);
echo $dato;*/
?>