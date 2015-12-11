<?php
error_reporting(0);
include("conexion2.php");
   $contenido="";   
    if($statusConexion==true){
      $contenido=consultaConductores($conex); 
      //$catego = obtenerCategoria($conex);
  }
?>    
    <section class="content-header">
      <h1>
       Conductores
      </h1>
      <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a>Conductores</a></li>
      </ol>
    </section>
    <!-- Main content -->    
    <div id="div_frm_c">
          <form id="frm_conductor" name="frm_conductor" action="" method="post">
            <fieldset>
              <label>Nombre del Conductor</label><br>            
              <input type="text" id="nombre" name="nombre" placeholder="nombre del conductor" required />
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo" name="correo" placeholder="Correo" required />
              <br>
              <label>Biografia</label><br>
              <textarea cols="30"rows="9" id="biografia" name="biografia" placeholder="Biografia del Conductor" required/>
              <br>
              <label>Fotografia del conductor (link) </label><br>
              <input type="text" id="imagen" name="imagen" placeholder="link de la imagen de conductor" required />
            </fieldset>
            <fieldset id="btnc">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loaderc">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
    <div id="div_frm_c2">
          <form id="frm_edit_conductor" action="" method="post">
            <fieldset>
              <label>ID</label>
              <br>
              <input type="text" id="id_conductor" name="id_conductor" placeholder="ID" readonly/>
              <label>Nombre del Conductor</label><br>         
              <input type="text" id="nombre_c_up" name="nombre_c_up" placeholder="nombre del conductor" required />
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo_c_up" name="correo_c_up" placeholder="Correo" required />
              <br>
              <label>Biografia</label><br>
              <textarea cols="30"rows="9" id="biografia_c_up" name="biografia_c_up" placeholder="Biografia del Conductor" required/>
              <br>
              <label for="exampleInputFile">Fotografia del conductor (link)</label><br>
              <input type="text" id="imagen_c_up" name="imagen_c_up" placeholder="link de la imagen de conductor" required />
              <br>
              <label>Estatus</label><br>         
              <select name="estatus_c" id="estatus_c" required >
                    <option value="">Seleccione un Estatus</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>                    
              </select>
            </fieldset>
            <fieldset id="btnc2">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loaderc2">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
    <section class="content">                                  
          <div class="col-xs-9">
            <div>
              <button id="agregar_conductor" class="btn btn-primary btn-md ">Agregar</button>
            </div>
          </div>        
          <div class="col-xs-12"> 
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
              <table id="tconductores" class="table table-bordered">          
                <thead>
                  <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Descripcion</th>                      
                      <th>Foto</th>
                      <th>Estatus</th>                      
                      <th>Acciones</th> 
                  </tr>  
                </thead>              
                <tbody id="lis_conductores">
                <?php echo $contenido; ?>               
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
    <script type="text/javascript" src="dist/js/conductor.js"></script>