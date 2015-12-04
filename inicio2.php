<?php include ('verificar_sesion.php');?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminC10  | Dashboard</title>

  <!--inicio links de los horario para agregar a la siguiente-->
<link rel="stylesheet" type="text/css" media="all" href="Archivos/jsDatePick_ltr.css">
<link href="Archivos/css_003.css" rel="stylesheet" type="text/css">
<link href="Archivos/css.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="Archivos/style_002.css">
<link rel="stylesheet" href="Archivos/bjqs.css">
<!-- load jQuery and the plugin -->
<link href="Archivos/css_002.css" rel="stylesheet" type="text/css"> 
<!-- demo.css contains additional styles used to set up this demo page - not required for the slider --> 
<link rel="stylesheet" href="Archivos/demo.css">
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
          url: 'domingo_ajax.php',
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


      
      $('#btn_categoria').click(function(){
        $.ajax({
          url: 'categoria.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });      

//agregado nuevo      
      $('#btn_conductor').click(function(){
        $.ajax({
          url: 'conductores.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });      
      $('#btn_productor').click(function(){
        $.ajax({
          url: 'productor_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });

      $('#btn_galeria').click(function(){
        $.ajax({
          url: 'galeria_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });

      $('#btn_publi').click(function(){
        $.ajax({
          url: 'publi_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });
      $('#btn_slide').click(function(){
        $.ajax({
          url: 'slide_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });     
//final del agregado
      $('#btn_adm_horario').click(function(){
        $.ajax({
          url: 'administrar_horario.php',
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
<body class="hold-transition skin-blue sidebar-mini" onload="mueveReloj()">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="inicio2.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>10</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>C10</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>

<!--Reloj escondido y dia de la semana-->
        <form name="form_reloj">
         <input type="hidden" name="reloj" size="29" style="background-color : Black; color : White; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_reloj.reloj.blur()"> 
        </form>         
<!---->

      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">                  
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">            
            <span class="hidden-xs"> <?php //echo $_SESSION['nom']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
                          
              <!-- Menu Footer-->

                <div >
                  <form action="destruir.php" method="post">
                    <input type="submit" class="btn btn-block bg-yellow btn-default" value="Salir">
                  </form>
                </div>

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
        <li>
              <a id="btn_adm_horario" href="#">
                <i class="fa fa-circle-o"></i> 
                <span>Administrar Horarios</span>
              </a>
        </li>
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
          <a id="btn_conductor" href="#"> 
          <i class="fa fa-puzzle-piece"></i>
          <span>Conductor</span>          
          </a>
        </li>            
        <li>
          <a id="btn_publi" href="#"> 
          <i class="fa fa-puzzle-piece"></i>
          <span>Publicidad</span>          
          </a>
        </li>
        <li>
          <a id="btn_slide" href="#"> 
          <i class="fa fa-puzzle-piece"></i>
          <span>Slide</span>          
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
        <!--
        <li>
          <a id="boton_cargar" href="#">
          <i class="fa fa-circle-o"></i> 
          <span>Prueba ajax</span>
          </a>
        </li> 
        --> 

        <li>         

          <a id="btn_horario" href="#">
            <i class="fa fa-th"></i> 
            <span> Horarios de Programas</span>
          </a>
        </li>      
        <!--
        <li>
          <a id="boton_carga_horario" href="#">
          <span>Horarios_</span>
          </a>
        </li>
        -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Horarios </span>
            <i class="fa fa-angle-left pull-right"></i>       
          </a>
          <ul class="treeview-menu">
            <li>
              <!--<a id="btn_horario" href="#">-->
              <a>
              <i class="fa fa-circle-o"></i> 
              <span> Ver Horarios</span>
              </a>
            </li>                      
          </ul>
        </li>         
      </ul>      
    </section>    
  </aside>
  <!--  hast aqui llega el menu lateral izquierdo-->
<!--modal -->
<!--
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
        </div>        
        </form>
      </div>
    </div>
  </div>
  -->  
  <!-- Content Wrapper. Contains page content -->
  <!--
  <input type="text" name="dia_semana" id="dia_semana" value="">
  -->
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

<!--
envio de reloj
-->

<script language="JavaScript">
  function mueveReloj(){
    momentoActual = new Date()
    hora = momentoActual.getHours()
    minuto = momentoActual.getMinutes()
    segundo = momentoActual.getSeconds()

    str_segundo = new String (segundo)
    if (str_segundo.length == 1)
       segundo = "0" + segundo

    str_minuto = new String (minuto)
    if (str_minuto.length == 1)
       minuto = "0" + minuto

    str_hora = new String (hora)
    if (str_hora.length == 1)
       hora = "0" + hora 

    horaImprimible = hora + " : " + minuto + " : " + segundo

    document.form_reloj.reloj.value = horaImprimible

    setTimeout("mueveReloj()",1000)
  }
</script>

<script type="text/javascript">
 $(document).ready(function(){

      var d=new Date();
      var dia=new Array(7);              
      dia[0]=7;
      dia[1]=1;
      dia[2]=2;
      dia[3]=3;
      dia[4]=4;
      dia[5]=5;
      dia[6]=6;

     // document.dia_semana.value = dia[d.getDay()];
      //var dia_seman = dia[d.getDay()];
      var asigna = dia[d.getDay()];
      //document.getElementById(dia_semana);
      //alert("dia"+asigna);
      //asigna.value=dia[d.getDay()];
            //$("#dia_semana").val(dia[d.getDay]);

      $('#btn_horario').click(function(){
        $.ajax({
            url: 'prueba_horario.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  

   //document.write("Hoy es : "+ dia_semana);
});
</script>
<!--
finaliza el envio de reloj
-->

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