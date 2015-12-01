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
      $dias=obtenerDias($conex);
      $progra=obtenerProgramas($conex);
      $L = consult_horario_por_dia($conex,1);
      $M = consult_horario_por_dia($conex,2);
      $Mi= consult_horario_por_dia($conex,3);
      $J = consult_horario_por_dia($conex,4);
      $V = consult_horario_por_dia($conex,5);
      $S = consult_horario_por_dia($conex,6);
      $D = consult_horario_por_dia($conex,7);
    }
?>    
    <section class="content-header">
      <h1>
       Horario Administracion
      </h1>
      <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a>Horario Administracion</a></li>        
      </ol>
    </section>
    <div id="div_frm_h">
          <form id="frm_horario" name="frm_horario" action="" method="post">
            <fieldset> 
              <label>Nombre del programa</label>          
              <br>
              <select id="id_programa" name="id_programa" required>
                  <option value="">Seleccione un programa</option>
                    <?php echo $progra; ?>
              </select>    
              <br>              
              <label>Hora Inicio de la programación</label><br>
              <input type="time" id="hora" name="hora"/><br>              
              <label>Hora Termino de la programación</label><br>
              <input type="time" id="horaTermino" name="horaTermino"/><br>
              <!--<input type="number" name="duracion" /><br>-->                      
              <label>Tipo</label><br>
              <select id="tipo" name="tipo" required>
                  <option value="">Tipo de programación</option>
                  <option value="en vivo">En vivo</option>
                  <option value="estelar">Estelar</option>
                  <option value="repeticion">Repetición</option>
              </select><br>                                  
              <label>Descripcion de la programacion</label><br>
              <input type="text" id="descripcion" name="descripcion" placeholder="descripcion de la programacion" required/>
              <br>              
              <label>Dia</label>
              <br>
              <!--<select class="form-control" id="dia" name="dia" required> -->
              <select id="dia" name="dia" required>
                <option value="">Seleccione un dia</option>
                <?php echo $dias; ?>       
              </select>
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
     <div id="div_frm_h2">
          <form id="frm_horario_update" name="frm_horario_update" action="" method="post">          
            <fieldset>
              <label>ID</label>
              <br>
              <input type="text" id="id_horario" name="id_horario" placeholder="ID" readonly/><br>
              <!--
              <label>Hora Inicio de la programación</label><br>
              <input type="time" id="hora_up" name="hora_up" value="" /><br>
              <input type="hidden" id="hora_parse" name="hora_parse" value="00:00:00" onchange="myFunction()" />
              <label>Hora Termino de la programación</label><br>
              <input type="time" id="horaTermino_up" name="horaTermino_up"/><br>
              -->              
              <label>Nombre del programa</label>          
              <br>
              <select id="id_programa_up" name="id_programa_up" required>
                  <option value="">Seleccione un programa</option>
                    <?php echo $progra; ?>
              </select>    
                            
              <br>                           
              <label>Descripcion de la programacion</label><br>
              <input type="text" id="descripcion_up" name="descripcion_up" placeholder="descripcion de la programacion" required/>
              <br>
              <label>Tipo de Programacion</label><br>
              <select id="tipo_up" name="tipo_up" required>
                  <option value="">Tipo</option>
                  <option value="en vivo">En vivo</option>
                  <option value="estelar">Estelar</option>
                  <option value="repeticion">Repetición</option>
              </select><br>
            </fieldset>
            <fieldset id="btn_h2">
              <input type="submit" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loader_h2">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
    <!-- Main content -->    
    <section class="content">                                  
          <div class="col-xs-9">
            <div>
              <button id="agregar_h" class="btn btn-primary btn-md ">Agregar</button>
            </div>
          </div>        
          <div class="col-xs-12"> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Programacion</h3>              
            </div>            
            <!-- /.box-header -->

          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Lunes</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Martes</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Miercoles</a></li>
              <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Jueves</a></li>
              <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Viernes</a></li>
              <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Sabado</a></li>
              <li class=""><a href="#tab_7" data-toggle="tab" aria-expanded="false">Domingo</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <table id="thorarioLunes" class="table table-bordered">
                  <thead>
                    <tr>                      
                      <th>ID</th>
                      <th style="width: 100px">Hora Inicio</th>
                      <th>Hora Termino</th>
                      <th>Programa</th> 
                      <th>Descripcion</th>  
                      <th style="width: 10px">Estado</th>                    
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>                 
                    <?php echo $L;?>
                  </tbody>
                </table>
              </div>              
              <div class="tab-pane" id="tab_2">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th style="width: 100px">Hora Inicio</th>
                      <th>Hora Termino</th>
                      <th>Programa</th> 
                      <th>Descripcion</th>  
                      <th style="width: 10px">Estado</th>                    
                      <th>Acciones</th>                      
                    </tr>
                  </thead>
                  <tbody>                 
                    <?php echo $M; ?>                    
                  </tbody>
                </table>
                
              </div>              
              <div class="tab-pane" id="tab_3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th style="width: 100px">Hora Inicio</th>
                      <th>Hora Termino</th>
                      <th>Programa</th> 
                      <th>Descripcion</th>  
                      <th style="width: 10px">Estado</th>                    
                      <th>Acciones</th>                      
                    </tr>
                  </thead>
                  <tbody>                 
                    <?php echo $Mi; ?>                    
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="tab_4">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th style="width: 100px">Hora Inicio</th>
                      <th>Hora Termino</th>
                      <th>Programa</th> 
                      <th>Descripcion</th>  
                      <th style="width: 10px">Estado</th>                    
                      <th>Acciones</th>                      
                    </tr>
                  </thead>
                  <tbody>                 
                    <?php echo $J; ?>                    
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="tab_5">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th style="width: 100px">Hora Inicio</th>
                      <th>Hora Termino</th>
                      <th>Programa</th> 
                      <th>Descripcion</th>  
                      <th style="width: 10px">Estado</th>                    
                      <th>Acciones</th>                      
                    </tr>
                  </thead>
                  <tbody>                 
                    <?php echo $V; ?>                    
                  </tbody>
                </table>
              </div>              
              <div class="tab-pane" id="tab_6">
                
              </div>
              <div class="tab-pane" id="tab_7">
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>           
          
          <!-- /.box -->        
        </div>
        <!-- /.col -->                                    
    </section>        
    <!-- /.content -->
    <script>
      function myFunction() {
          var x = document.getElementById("hora_parse").value;
          document.getElementById("hora_up").value = x;
        }
    </script>       
    <script type="text/javascript" src="dist/js/horario_admin.js"></script>