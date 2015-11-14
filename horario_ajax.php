<?php
include('conexion2.php');
 $con_horario="";
 if($statusConexion==true){
  $con_horario= consultaHorarios($conex);
 }
 //error_reporting(0);
?>

    <section class="content-header">
      <h1>
       Programas
      </h1>
      <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a>Programas</a></li>        
      </ol>
    </section>
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
                      <button id="7" type="button" class="btn btn-block bg-yellow btn-default">Domingo</button>
                      <button id="1" type="button" class="btn btn-block bg-green btn-default">Lunes</button>   
                      <button id="2" type="button" class="btn btn-block bg-aqua btn-default">Martes</button>
                      <button id="3" type="button" class="btn btn-block bg-light-blue btn-default">Miercoles</button>
                      <button id="4" type="button" class="btn btn-block bg-red btn-default">Jueves</button>
                      <button id="5" type="button" class="btn btn-block bg-purple btn-default">Viernes</button>
                      <button id="6" type="button" class="btn btn-block bg-orange btn-default">Sabado</button>    
                    </form>                                                      
                  </div>
           </div>
            <!-- /.box-body -->
          </div> 
        </div>

        <div class="col-xs-9"> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Parrilla de Horarios</h3>
               <div class="box-tools">            
              </div>
            </div>

            <div class="box-body table-responsive no-padding">                          
              
              <table cellpadding="0" cellspacing="0" align="center" background="Archivos/gray.jpg" border="0" width="680">
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
                        <!-- div prueba -->
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
      </div>
    </section>

  <script src="Archivos/bjqs-1.js"></script>
  <script src="Archivos/analytics.js" async=""></script>
  <script type="text/javascript" language="javascript" src="Archivos/jquery-1.js"></script>
  <script type="text/javascript" src="Archivos/csshorizontalmenu2.js"></script>
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

  