<?php
//session_start();
include("conexion.php");  
/*
if($_SESSION['login'] != 'true') {
  echo "<meta http-equiv='refresh' content='0; URL=index.html'>";
  }
  */
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
    
    
$sql = "SELECT conductores.*, conductores_imagenes.*, imagenes.* FROM conductores, conductores_imagenes, imagenes WHERE conductores.id_conductor = conductores_imagenes.id_conductor and imagenes.id_imagen = conductores_imagenes.id_imagen ORDER BY conductor";
$conductores = mysql_query($sql, $conexion) or die(mysql_error());  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Administracion</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <script type="text/javascript" src="dist/js/prototype.js"></script>
  <script type="text/javascript" src="dist/js/scriptaculous.js?load=effects,builder"></script>  
  <link rel="stylesheet" href="dist/css/lightbox.css" type="text/css" media="screen" />
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]

  
  -->
  <script type="text/javascript" src="dist/js/lightbox.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="inicio.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">                  
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!--
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--          
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
          -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->

      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>          
        </div>
      </div>           
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> 
            <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> 
            <span>Agregar </span>
            <span class="label label-primary pull-right">8</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Categorìa</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Conductor</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Galeria</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Nota</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Productor</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Programa</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Publicidad</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Slide</a></li>
          </ul>
        </li>
        
        <li>
          <a href="#">
            <i class="fa fa-th"></i> <span> Horarios de Programas</span>
            <small class="label pull-right bg-green">new</small>
          </a>
        </li>      
        <li class="treeview">
          <a href="#">
            <i class="fa fa-eye"></i>
            <span>Ver </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Categorìas</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Conductores</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Galeria</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Notas</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Productores</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Programas</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Publicidades</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Slides</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Videos</a></li>
          </ul>
        </li>      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Simple Tables
        <small>preview of simple tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
        <li>Horarios</li>
        <!--<li class="active">Programas</li>-->
      </ol>
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">                  
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Foto</th>
                    <th>Estatus</th>
                    <th>Nombre</th>
                    <th>Mail</th>
                    <th>Descripción</th>
                    <th>Acciones</th>               
                </tr>
                </thead>
                <tbody>
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
                        echo  '<td><input type="hidden" name="id_conductor" value="'.$row['id_conductor'].'"><input type="submit" name="accion" value="Desactivar"><input type="submit" name="accion" value="Editar"><input type="submit" name="accion" value="Eliminar"></td></tr></form>';
                      else
                        echo  '<td><input type="hidden" name="id_conductor" value="'.$row['id_conductor'].'"><input type="submit" name="accion" value="Activar"><input type="submit" name="accion" value="Editar"><input type="submit" name="accion" value="Eliminar"></td></tr></form>';
          
                      }
                      ?>                        
                </tbody>                       
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->        
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.2
    </div>
    <strong>Copyright &copy; 2014-2015</strong> All rights
    reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>
</html>
