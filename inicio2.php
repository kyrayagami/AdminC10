<?php
/*
if($_POST)
{
  $nombre = $_POST['nombre'];  
  $sql="INSERT INTO programas_prueba (nombre) VALUES ('$nombre')";
  mysql_query($sql, $conexion) or die(mysql_error()); 
  $_POST['nombre']= '';
}  
*/
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE  | Dashboard</title>

  <!--inicio links de los horario para agregar a la siguiente-->
  <link rel="stylesheet" type="text/css" media="all" href="Archivos/jsDatePick_ltr.css">
<link href="Archivos/css_003.css" rel="stylesheet" type="text/css">
<link href="Archivos/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="Archivos/style_002.css">

<link rel="stylesheet" href="Archivos/bjqs.css">
<!-- load jQuery and the plugin -->
<link href="Archivos/css_002.css" rel="stylesheet" type="text/css"> 
<!-- demo.css contains additional styles used to set up this demo page - not required for the slider --> 
<link rel="stylesheet" href="Archivos/demo.css"
  <!--final links de canal once para agregar a la siguiente-->

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
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">  
  <link rel="stylesheet" href="dist/css/jquery-ui-1.10.3.custom/jquery-ui-1.10.3.custom/css/no-theme/jquery-ui-1.10.3.custom.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
  <script type="text/javascript"> 
    $(document).ready(function(){
      $('#boton_carga_horario').click(function(){
        $.ajax({
          url: 'horario.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  
      $('#btn_programa').click(function() {
        $.ajax({
          url: 'programa.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });
      $('#btn_horario').click(function(){
        $.ajax({
          url: 'horario_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });
    });
  </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript">  
      function validar(){
        if(document.getElementById('nombre').value == ''){
          alert("Escriba el nombre");
          return false;
        }
      }
  </script>  

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
        </ul>
      </div>
    </nav>
  </header>
  <!-- menu de arriba-->
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
        <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> 
            <span>Agregar </span>
            <span class="label label-primary pull-right">8</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" data-toggle="modal" data-target="#Modalcatego"><i class="fa fa-circle-o"></i> Categorìa</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Conductor</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Galeria</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Nota</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Productor</a></li>            
            
            <li><a href="#" data-toggle="modal" data-target="#Modalprogra"><i class="fa fa-circle-o"></i> Programa</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Publicidad</a></li>            
            <li><a href="#"><i class="fa fa-circle-o"></i> Slide</a></li>
          </ul>
        </li>
        -->
        <li>
          <a id="btn_categoria" href="#"> 
          <i class="fa fa-reddit-square"></i>
          <span>Categoria</span>          
          </a>
        </li>
        
        <li>
          <a id="btn_galeria" href="#"> 
          <i class="fa fa-photo"></i>
          <span>Galeria</span>          
          </a>
        </li>
        <li>
          <a id="btn_notas" href="#"> 
          <i class="fa fa-file"></i>
          <span>Notas</span>          
          </a>
        </li>        
        <li>
          <a id="btn_productor" href="#"> 
          <i class="fa fa-user"></i>
          <span>Productor</span>          
          </a>
        </li>
        <li>
          <a id="btn_programa" href="#"> 
          <i class="fa fa-puzzle-piece"></i>
          <span>Programa</span>          
          </a>
        </li>
        <li>
          <a id="boton_cargar" href="#">
          <i class="fa fa-circle-o"></i> 
          <span>Prueba ajax</span>
          </a>
        </li>  

        <li>
          <a id="btn_horario" href="#">
            <i class="fa fa-th"></i> 
            <span> Horarios de Programas</span>
          </a>
        </li>      
        <li>
          <a id="boton_carga_horario" href="#">
          <span>Horarios_</span>
        </li>
        
        <li class="treeview">          
          <a href="#">
            <i class="fa fa-eye"></i>
            <span>Ver </span>
            <i class="fa fa-angle-left pull-right"></i>          
          </a>
          
          <ul class="treeview-menu">          
            <li><a href="#"><i class="fa fa-circle-o"></i> Categorìas</a></li>
            <li><a id="ver_conductores" ><i class="fa fa-circle-o"></i> Conductores</a></li>
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
  </aside>
  <!--  hast aqui llega el menu lateral izquierdo-->
<!--modal -->
  <div class="modal fade" id="Modalprogra" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Agregar nuevo programa</h3>
        </div>
        <form method="POST" enctype="multipart/form-data" action="" onSubmit="return validar(this);">
        <div class="modal-body">          
            <p>Nombre del programa</p>
            <input name="nombre" id = "nombre" type="text" size="30" />                                  
        </div>        
        <div class="modal-footer">
          <input type="submit" class="btn btn-success ">
          <!--
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          -->
        </div>        
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" id="Modalcatego" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Agregar nuevo Categoria</h3>
        </div>
        <form method="POST" enctype="multipart/form-data" action="" onSubmit="return validar(this);">
        <div class="modal-body">
            <p>Nombre(Categoria)</p>
            <input name="nombre" id = "nombre" type="text" size="30" />
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success ">
          <!--
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
          -->
        </div>        
        </form>
      </div>
    </div>
  </div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" name="div_dinamico" id="div_dinamico">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>    
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
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
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