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
<!--
  <meta charset="utf-8">
  -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
   <!--
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  -->
  <title>Administracion</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
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
        <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>          
          <ul class="treeview-menu">
            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
          </ul>          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <small class="label pull-right bg-red">3</small>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <small class="label pull-right bg-yellow">12</small>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
      </ul>
      -->
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
              <h3 class="box-title">Horarios</h3>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

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
<!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
</body>
</html>
