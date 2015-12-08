<?php
include("../../conexion2.php");
sleep(2);
if($statusConexion){
    $respuesta="DONE";
    $mensaje="";
    $ContenidoHTML="";
    $consulta="";
    if (isset($_FILES["imagen"])){
            $file= $_FILES["imagen"];
            $tamano = $file["size"];
            $tipo = $file["type"];
            //$archivo = $_POST['nombre'];
            $destino='';
            $resultado='';
            $prefijo = substr(md5(uniqid(rand())),0,6);            
                // guardamos el archivo a la carpeta files
                $destino =  "../../files/".$prefijo."_".$archivo.$file["name"];
                //if (copy($_FILES['imagen']['tmp_name'],$destino)) {
                //if (copy($file['tmp_name'],$destino)) {
                //move_uploaded_file
                //$resultado = @move_uploaded_file($file['tmp_name'],$destino);
                if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
                {
                    $ContenidoHTML="Error, el archivo no es una imagen"; 
                }else{
                if(move_uploaded_file($file['tmp_name'],$destino)){
                //if ($resultado) {
                // cambio de destino
                    $destino="files/".$prefijo."_".$archivo.$file["name"];
                    $sql=mysql_query("INSERT INTO imagenes(url) VALUES('".$destino."')", $conex);
                    $consult=mysql_query("SELECT * FROM imagenes where url='".$destino."'",$conex);
                    $row=mysql_fetch_array($consult);
                    $id_img = $row['id_imagen'];
                    $mensaje="Imagen Insertada";
                    $ContenidoHTML='<input type="hidden" name="id_imagen" id="id_imagen" value="'.$id_img.'">';
                }else{
                    //$status = "Error al subir la imagen";
                    //$ContenidoHTML  = $destino;
                    $respuesta="BAD Error al subir la imagen";
                }     
                }
    /*
    $file = $_FILES["file"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
    $carpeta = "../../imagenes/";
    
    if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
    {
      echo "Error, el archivo no es una imagen"; 
    }
    else if ($size > 1024*1024)
    {
      echo "Error, el tamaño máximo permitido es un 1MB";
    }
    else if ($width > 500 || $height > 500)
    {
        echo "Error la anchura y la altura maxima permitida es 500px";
    }
    else if($width < 60 || $height < 60)
    {
        echo "Error la anchura y la altura mínima permitida es 60px";
    }
    else
    {
        $src = $carpeta.$nombre;
        //move_uploaded_file($ruta_provisional, $src);
        if(move_uploaded_file($ruta_provisional, $src)){
            $src= "imagenes/".$nombre;
            echo "<img src='$src'>";
        }        
    }*/
    }
    else{
        //$status = "Error (archivo vacio)";
        //$ContenidoHTML  = $destino;
        $respuesta="BAD 2";
    }
}

//$salidaJSON=array("respuesta" => $respuesta,"mensaje" => $mensaje,"contenido" => $ContenidoHTML);
//*echo json_encode($salidaJSON);*/
$salida=$ContenidoHTML;
echo $salida;
?>