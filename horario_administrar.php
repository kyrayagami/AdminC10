<?php
include("conexion2.php");
   $contenido="";   
   $dias="";// crea metodo en conexion2
   $programa=""; //crear metodo para obtener los datos
    if($statusConexion==true){
      //$contenido=consultaProgramas($conex);
      $dias=obtenerDias($conex);
      $progra=obtenerProgramas($conex);
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
              <label>Dia</label>
              <br>
              <select class="form-control" id="dia" name="dia">
                <option value="">Seleccione un dia</option>
                <?php echo $dias ?>
          <!--
          <option>Lunes</option>
          <option>Martes</option>
          <option>Miercoles</option>
          <option>Jueves</option>
          <option>Viernes</option>
          <option>Sabado</option>
          <option>Domingo</option>          
          -->
              </select>
              <label>Nombre del programa</label>          
              <br>
              <select class="form-control" id="programa" name="programa" required>
                  <option value="">Seleccione un programa</option>
                    <?php echo $progra ?>
              </select>
              <label>Hora Inicio de la programacion</label><br>
              <input type="time" name="hora"><br>
              <label>Duracion de la programacion</label><br>
              <input type="time" name="duracion"><br>
              <label>Descripcion de la programacion</label><br>
              <input type="text" id="descripcion" name="descripcion" placeholder="descripcion de la programacion" required />              
            </fieldset>
            <fieldset id="btn_h">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loader_h">
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
              <h3 class="box-title">Programas</h3>              
            </div>            
            <!-- /.box-header -->
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
                      <th>Domingo</th>
                  </tr>  
                </thead>              
                <tbody id="lis_horario">
                <?php echo $contenido ?>               
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
    <script type="text/javascript" src="dist/js/horario_admin.js"></script>