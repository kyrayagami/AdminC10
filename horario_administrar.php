<!--
<link rel="stylesheet" href="dist/css/jquery-ui-1.10.3.custom/jquery-ui-1.10.3.custom/css/no-theme/jquery-ui-1.10.3.custom.min.css"/>
-->
<?php
include("conexion2.php");
   $contenido="";   
   $dias="";// crea metodo en conexion2
   $programa=""; //crear metodo para obtener los datos
    if($statusConexion==true){
      //$contenido=consultaProgramas($conex);
      $contenido=consultHorarios2($conex);
      //$dias=obtenerDias($conex);
      //$progra=obtenerProgramas($conex);
    }
?>    
    <section class="content-header">
      <h1>
       Horario horario_administracion
      </h1>
      <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a>Horario Administracion</a></li>        
      </ol>
    </section>
<!--
    <div id="div_frm_h">
          <form id="frm_horario" name="frm_horario" action="" method="post">
            <fieldset>
              <label>Nombre del programa</label>          
              <br>
              <select class="form-control" id="id_programa" name="id_programa" required>
                  <option value="">Seleccione un programa</option>
                    <?php //echo $progra ?>
              </select>
              <label>Dia</label>
              <br>
              <select class="form-control" id="dia" name="dia" required>
                <option value="">Seleccione un dia</option>
                <?php //echo $dias ?>      
              </select>              
              <label>Hora Inicio de la programacion</label><br>
              <input type="time" id="hora" name="hora" onchange="myFunction()" />
              <input type="hidden" id="hora_parse" name="hora_parse" />
              <br>
              <label>Duracion de la programacion (min)</label><br>
              <input type="number" name="duracion" /><br>
              <label>Descripcion de la programacion</label><br>
              <input type="text" id="descripcion" name="descripcion" placeholder="descripcion de la programacion" required/>
            </fieldset>
            <fieldset id="btn_h">
              <input type="submit" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loader_h">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
      -->
    <section class="content">                                  
          <div class="col-xs-9">
            <!--<div>
              <button id="agregar_h" class="btn btn-primary btn-md ">Agregar</button>
            </div>-->
          </div>        
          <div class="col-xs-12"> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Programas</h3>              
            </div>            
            
            <div class="box-body table-responsive no-padding">            
              <table id="thorario" class="table table-condensed">          
                <thead>
                  <tr>
                      <th>Lunes</th>                    
                      <th>Martes</th>                      
                      <th>Miercoles</th>
                      <th>Jueves</th>
                      <th>Viernes</th>
                      <th>Sabado</th>
                      <th>Domingo <?php
                       //echo count($contenido)
                      //echo $contenido
                       ?>
                       </th>
                  </tr>  
                </thead>              
                <tbody id="lis_horario">
                <?php                
                
                $conta=0;                
                while(count($contenido)>$conta){
                  echo $contenido[$conta];
                  $conta++;
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
    </section>        
    <!-- /.content -->
    <script>
      function myFunction() {
          var x = document.getElementById("hora").value;
          document.getElementById("hora_parse").value = x;
        }
    </script>       
    <script type="text/javascript" src="dist/js/horario_admin.js"></script>