<?php
//sleep(2);
include('conexion2.php');
 $con_horario="";
 $dia_semana = date("N");
 //$dia= "<script> document.write(dia_semana) </script>";
 //$dia_semana=$_POST['dia'];
// echo $dia_semana;
 if($statusConexion==true){
  $con_horario= consulta_horario_prueba($conex,$dia_semana);
 }
 error_reporting(0);
?>


<!-- Main content -->
    <section class="content">    
      <div class="row">
        <div class="col-xs-3">                     
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Semana</h4>

            </div>
            <div class="box-body">
              <!-- the events -->

                  <div id="external-events">
                    <form method="post" action="" id="frm_dias" name="frm_dias" >
                      <button id="consulta_domingo" type="button" class="btn btn-block bg-yellow btn-default">Domingo</button>
                      <button id="consulta_lunes" type="button" class="btn btn-block bg-green btn-default">Lunes</button>   
                      <button id="consulta_martes" type="button" class="btn btn-block bg-aqua btn-default">Martes</button>
                      <button id="consulta_miercoles" type="button" class="btn btn-block bg-light-blue btn-default">Miercoles</button>
                      <button id="consulta_jueves" type="button" class="btn btn-block bg-red btn-default">Jueves</button>
                      <button id="consulta_viernes" type="button" class="btn btn-block bg-purple btn-default">Viernes</button>
                      <button id="consulta_sabado" type="button" class="btn btn-block bg-orange btn-default">Sabado</button>    
                    </form>                                                      
                  </div>
 
            </div>
            <!-- /.box-body -->
          </div> 
        </div>
        <div class="col-xs-9"> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Horarios</h3>
               <div class="box-tools">
              </div>
            </div>        
            <div class="box-body table-responsive no-padding">                          
              <table cellpadding="0" cellspacing="0" align="center"  border="0" width="680">
                <tbody>
                  <tr>
                  <td align="left" valign="top" width="670">
                    <div id="page-wrap" align="center"> 
                      <div id="example-one" align="center">              
                        <ul class="nav">
                        <!--
                          <li class="fecha-nav">
                          <span class="tit_fecha_num" align="center"> 22 </span> 
                          <span class="tit_fecha" align="center"> DE OCTUBRE DE 2015 </span>
                          </li>
                          -->
                          <li class="espacio-nav">&nbsp;</li>
                          <li class="nav-one"><a href="#manana">MAÑANA</a></li>
                          <li class="nav-two"><a href="#tarde" class="current" >TARDE</a></li>
                          <li class="nav-three"><a href="#noche">NOCHE</a></li>                                                               
                        </ul>   
                        <!-- div prueba 
                        se imprime el dia 
                        lunes
                        martes

                      -->

                        <div id="prueba" align="center">      
                          <div class="list-wrap" align="center">                            
                            <ul style="position: relative; top: 0px; left: 0px; display: none;" id="manana" >
                              <?php echo $con_horario[0]; ?>                          
                            </ul>                        
                            <!--- tarde -->
                            <ul id="tarde">
                              <?php echo $con_horario[1]; ?>
                          
                            </ul>  
                            <!--- noche -->     
                            <ul style="position: relative; top: 0px; left: 0px; display: none;" id="noche" >
                              <?php echo $con_horario[2]; ?>
                              <!---->
                            </ul>
                          </div> <!-- END List Wrap -->    
                        </div> <!-- prueba -->
                      </div> <!-- END Organic Tabs (Example One) -->                                  
                    </div>
                  </td>
                  </tr>
                </tbody>              
              </table>                
            </div>                    
          <!-- box -->
        </div>
      </div>
    </section>


<!--scrip para mostar los detalles del horario-->
  <script src="Archivos/bjqs-1.js"></script>      
  <script type="text/javascript" src="Archivos/organictabs.js"></script>
    <!--cambio de tabs-->
    <script type="text/javascript">
        $(function() {
    
            $("#example-one").organicTabs();
            
            $("#example-two").organicTabs({
                "speed": 200
            });
    
        });
    </script>

  <script type="text/javascript">
    function show(bloq) {
      obj = document.getElementById(bloq);
     obj.style.display = (obj.style.display=='none') ? 'block' : 'none';
    }
  </script>
<!--fin del script-->


  <script type="text/javascript"> 
  /* 
 $(document).ready(function(){
//semana 

      $('#consulta_lunes').click(function() {
        $.ajax({
          url: 'lunes_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  
      $('#consulta_martes').click(function() {
        $.ajax({
          url: 'martes_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  
     $('#consulta_miercoles').click(function() {
        $.ajax({
          url: 'miercoles_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  
     $('#consulta_jueves').click(function() {
        $.ajax({
          url: 'jueves_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  
     $('#consulta_viernes').click(function() {
        $.ajax({
          url: 'viernes_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  
     $('#consulta_sabado').click(function() {
        $.ajax({
          url: 'sabado_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  
     $('#consulta_domingo').click(function() {
        $.ajax({
          url: 'domingo_ajax.php',
          success: function(data) {
            $('#div_dinamico').html(data);
          } 
        });
      });  

//
    });
*/
  </script>
  <script type="text/javascript">  
      function validar(){
        if(document.getElementById('nombre').value == ''){
          alert("Escriba el nombre");
          return false;
        }
      }
  </script>