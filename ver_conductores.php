<?php
//session_start();
include("conexion.php");  
/*
if($_SESSION['login'] != 'true') {
  echo "<meta http-equiv='refresh' content='0; URL=index.html'>";
  }
  */
  /*
if($_POST['accion'] == 'Agregar'){
      $conductor = $_POST['conductor'];
      $mail = $_POST['mail'];
      $descripcion = $_POST['descripcion'];
      $sql = "INSERT INTO conductores(conductor, mail, estatus, descripcion_conductor) VALUES('$conductor', '$mail', 'ACTIVO', '$descripcion')";
      mysql_query($sql, $conexion) or die(mysql_error()); 
      $status = "";    
      
      // obtenemos los datos del archivo   
      $tamano = $_FILES["archivo"]['size'];   
      $tipo = $_FILES["archivo"]['type'];   
      $archivo = $conductor;   
      $prefijo = substr(md5(uniqid(rand())),0,6);         
   
      if ($archivo != "") {  
              // guardamos el archivo a la carpeta files  
              $destino =  "files/".$prefijo."_".$archivo;  
              if (copy($_FILES['archivo']['tmp_name'],$destino)) {  
                  $status = "Archivo subido: <b>".$archivo."</b>";  
              } else {  
                  $status = "Error al subir el archivo";  
              }  
      } else {  
              $status = "Error al subir archivo";  
      }
      
      $sql = "INSERT INTO imagenes(alt, url, metatags) VALUES('$conductor','$destino','$conductor')";
      mysql_query($sql, $conexion) or die(mysql_error()); 
      
      $sql = "SELECT * FROM conductores WHERE conductor = '$conductor'";
      $conductores = mysql_query($sql, $conexion) or die(mysql_error());  
      
      $row=mysql_fetch_array($conductores);
      $id_conductor = $row['id_conductor'];
      
      $sql = "SELECT * FROM imagenes WHERE url = '$destino'";
      $conductores = mysql_query($sql, $conexion) or die(mysql_error());  
      
      $row=mysql_fetch_array($conductores);
      $id_imagen = $row['id_imagen'];
    
      $sql = "INSERT INTO conductores_imagenes(id_imagen, id_conductor) VALUES('$id_imagen','$id_conductor')";
      mysql_query($sql, $conexion) or die(mysql_error());       
    } 

if($_POST['accion'] == 'Desactivar'){
      $conductor = $_POST['id_conductor'];
      $sql = "UPDATE conductores SET estatus = 'INACTIVO' WHERE conductores.id_conductor = '$conductor'";
      mysql_query($sql, $conexion) or die(mysql_error()); 
    }
    
if($_POST['accion'] == 'Eliminar'){
      $conductor = $_POST['id_conductor'];
      $sql = "DELETE FROM  conductores WHERE conductores.id_conductor = '$conductor'";
      mysql_query($sql, $conexion) or die(mysql_error()); 
      $sql = "DELETE FROM  conductores_imagenes WHERE conductores_imagenes.id_conductor = '$conductor'";
      mysql_query($sql, $conexion) or die(mysql_error()); 
    } 
    
if($_POST['accion'] == 'Activar'){
      $conductor = $_POST['id_conductor'];
      $sql = "UPDATE conductores SET estatus = 'ACTIVO' WHERE conductores.id_conductor = '$conductor'";
      mysql_query($sql, $conexion) or die(mysql_error()); 
    } 

if($_POST['accion'] == 'Editar'){
      $conductor = $_POST['id_conductor'];
      echo '<meta HTTP-EQUIV="REFRESH" content="0; url=conductores_edita.php?id_conductor='.$conductor.'">';  
    } 
  
*/  
    
$sql = "SELECT conductores.*, conductores_imagenes.*, imagenes.* FROM conductores, conductores_imagenes, imagenes WHERE conductores.id_conductor = conductores_imagenes.id_conductor and imagenes.id_imagen = conductores_imagenes.id_imagen ORDER BY conductor";
$conductores = mysql_query($sql, $conexion) or die(mysql_error());  
?>        
    <section class="content-header">
      <h1>
        Tabla Conductores
        <small>preview of simple tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li>Ver Conductores</li>
        <!--<li class="active">Programas</li>-->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">    
      <div class="row">
      <!--
        <div class="col-xs-3">                     
        <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Semana</h4>
            </div>
            <div class="box-body">
              <!-- the events -----
              <div id="external-events">                                            
                <button type="button" class="btn btn-block bg-yellow btn-default">Domingo</button>
                <button type="button" class="btn btn-block bg-green btn-default">Lunes</button>   
                <button type="button" class="btn btn-block bg-aqua btn-default">Martes</button>
                <button type="button" class="btn btn-block bg-light-blue btn-default">Miercoles</button>
                <button type="button" class="btn btn-block bg-red btn-default">Jueves</button>
                <button type="button" class="btn btn-block bg-purple btn-default">Viernes</button>
                <button type="button" class="btn btn-block bg-orange btn-default">Sabado</button>

              </div>
            </div>
            <!-- /.box-body 
          </div> 
          </div>
          -->
          <div class="col-xs-9"> 
          <div class="box">

            <div class="box-header">
              <h3 class="box-title">Conductores</h3>
              <!--
               <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                  <li><a href="#manana">Ma&ntilde;ana</a></li>
                  <li><a href="#tarde">Tarde</a></li>
                  <li><a href="#noche">Noche</a></li>                  
                </ul>
              </div>
              -->
            </div>            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">            
              <table id="thorarios" class="table table-condensed">
              <!--
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="width: 200px">Horario</th>
                  <th>Nombre del Programa</th>                
                  <th style="width: 40px">Label</th>
                </tr>
                -->
                <tr>
                    <th>Foto</th>
                    <th>Estatus</th>
                    <th>Nombre</th>
                    <th>Mail</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>               
                </tr>
                <?php
                      while($row=mysql_fetch_array($conductores)){
                      echo '
                      <form method="POST" action=""><tr>
                      <td><a href="'.$row['url'].'" rel="lightbox" title="'.$row['conductor'].'"><img src="'.$row['url'].'" width="100px" height="100px" alt="'.$row['url'].'"></a></td>
                      <td>'.$row['estatus'].'</td>
                      <td>'.$row['conductor'].'</td>
                      <td>'.$row['mail'].'</td>
                      <td>'.substr($row['descripcion_conductor'], 0, 100).'..........</td>';
                      if($row['estatus']== 'ACTIVO')    
                        echo  '<td><input type="hidden" name="id_conductor" value="'.$row['id_conductor'].'"><input type="submit" name="accion" class="btn btn-warning" value="Desactivar"><input type="submit" name="accion" class="btn btn-info" value="Editar"><input type="submit" name="accion" class="btn btn-danger" value="Eliminar"></td></tr></form>';
                      else
                        echo  '<td><input type="hidden" name="id_conductor" value="'.$row['id_conductor'].'"><input type="submit" name="accion"  class="btn btn-success" value="Activar"><input type="submit" name="accion" class="btn btn-info" value="Editar"><input type="submit" name="accion" class="btn btn-danger" value="Eliminar"></td></tr></form>';
                      }
                      ?>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->                              
      </div>
    </section>    