<?php
include("conexion.php");	
/*
session_start();

if($_SESSION['login'] != 'true') {
	echo "<meta http-equiv='refresh' content='0; URL=index.html'>";
	}
*/
if($_POST['accion'] == 'Guardar'){
	$id_conductor = $_POST['id_conductor'];
	$nombre =	$_POST['conductor'];
	$mail 	=	$_POST['mail'];
	$desripcion =	$_POST['descripcion'];
	$id_img = $_POST['id_imagen'];
	$img = $_POST['url'];
	if ($_FILES["archivo"]["name"] != '' ) { 
		if (file_exists(''.$img.'')) unlink($img);
		$tamano = $_FILES["archivo"]['size'];
		$tipo = $_FILES["archivo"]['type']; 
		$archivo = $conductor;
		$prefijo = substr(md5(uniqid(rand())),0,6);
        // guardamos el archivo a la carpeta files  
        $destino =  "files/".$prefijo."_".$archivo;  
        if (copy($_FILES['archivo']['tmp_name'],$destino)) {  
			$status = "Archivo subido: <b>".$archivo."</b>";  
        } else {  
        	$status = "Error al subir el archivo";  
		}
	} else {
		$status = "Error al subir archivo";
		$destino = $_POST['url'];
	}
			$sql = "UPDATE conductores SET conductores.conductor = '$nombre', conductores.mail = '$mail', conductores.descripcion_conductor = '$desripcion' WHERE conductores.id_conductor = '$id_conductor'";
			mysql_query($sql, $conexion) or die(mysql_error());
	//		echo $sql; 
			$sql = "UPDATE imagenes SET imagenes.url = '$destino' WHERE imagenes.id_imagen = '$id_img'";
			mysql_query($sql, $conexion) or die(mysql_error());
}

if($_GET['id_conductor']){
		$id_conductor = $_GET['id_conductor'];
		$sql = "SELECT conductores.*, conductores_imagenes.*, imagenes.* FROM conductores, conductores_imagenes, imagenes WHERE conductores.id_conductor = conductores_imagenes.id_conductor and imagenes.id_imagen = conductores_imagenes.id_imagen AND conductores.id_conductor = $id_conductor ORDER BY conductor";
		$conductores = mysql_query($sql, $conexion) or die(mysql_error());	
		$row=mysql_fetch_array($conductores);
		$nombre = $row['conductor'];
		$mail = $row['mail'];
		$descripcion = $row['descripcion_conductor'];
		$img = $row['url'];
		$id_img = $row['id_imagen'];

		}	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
		<title>Promovision | Administración</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<link rel="shortcut icon" href="favicon.ico" />	
		<script type="text/javascript" src="js/prototype.js"></script>
		<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
		<script type="text/javascript" src="js/lightbox.js"></script>
		<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
      </head>
	  <body>
		<div id = "nuevoProductor" >
		<h1>Editar conductor</h1>	
		<form method="POST" enctype="multipart/form-data" action="" onsubmit="return validar(this)" >
			<div>
				<img src="<?php echo $img; ?>">
				<input name="url" id="url" type="hidden" value="<?php echo $img; ?>" size="30"/>
				<input name="id_imagen" id="id_imagen" type="hidden" value="<?php echo $id_img; ?>" size="30"/>
				<input name="id_conductor" id="id_conductor" type="hidden" value="<?php echo $id_conductor; ?>" size="30"/>
			</div>
			<div>
				<label for="archivo">Fotografia del conductor <b>(500px x 300px )</b>:</label><br />
				<input name="archivo" id="archivo" type="file" size="30"/>
			</div>
			<div>
				<label for="conductor">Nombre del Conductor:</label><br />
				<input name="conductor" type="text" size="30" value='<?php echo $nombre; ?>' />
			</div>
			<div>
				<label for="mail">Mail:</label><br />
				<input name="mail" type="text" size="30" value='<?php echo $mail; ?>' />
			</div>
			<div>
				<label for="descripcion">Biografía:</label><br />
				<textarea cols=50 rows=9 name="descripcion"><?php echo $descripcion; ?></textarea>
			</div>
			<div>
				<input type="submit" name="accion" value="Guardar">
			</div>
		</form>
		</div>
	</body>
</html>