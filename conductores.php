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
    <div id="div_frm">
          <form enctype="multipart/form-data" id="frm_img" name="frm_img" action="" method="post">          
            <fieldset>
             <label for="exampleInputFile">Fotografia del conductor (500px x 300px)</label><br>
                  <input type="file" id="imagen" name="imagen" required>
                                  
            </fieldset>
          </form>
          <form id="frm_conductor" name="frm_conductor" action="" method="post">
            <fieldset>
              <div id="respuesta"></div><br>
              <label>Nombre del Conductor</label><br>            
              <input type="text" id="nombre" name="nombre" placeholder="nombre del conductor" required />
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo" name="correo" placeholder="Correo" required />
              <br>
              <label>Biografia</label><br>
              <textarea cols="30"rows="9" id="biografia" name="biografia" placeholder="Biografia del Conductor" required/>
              <br>
              <!--<div class="form-group">-->                              
              <!--</div>-->
            </fieldset>
            <fieldset id="btn">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loader">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
    <div id="div_frm2">
          <form id="frm_edit_conductor" action="" method="post">
            <fieldset>
              <label>Nombre del Conductor</label><br>         
              <input type="text" id="nombre_up" name="nombre_up" placeholder="nombre del conductor" required />
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo_up" name="correo_up" placeholder="Correo" required />
              <br>
              <label>Biografia</label><br>
              <textarea cols="20"rows="5" id="biografia_up" name="biografia_up" placeholder="Biografia del Conductor" />
              <br>
              <div class="form-group">
                  <label for="exampleInputFile">Fotografia del conductor (500px x 300px)</label>
                  <input type="file" id="imagen_up" name="imagen_up">
              </div>
              <br>
              <label>Estatus</label><br>         
              <select name="estatus" id="estatus" required >
                    <option value="">Seleccione un Estatus</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>                    
              </select> 
            </fieldset>
            <fieldset id="btn2">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loader2">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
    <section class="content">                                  
          <div class="col-xs-9">
            <div>
              <button id="agregar" class="btn btn-primary btn-md ">Agregar</button>
            </div>
          </div>        
          <div class="col-xs-12"> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Conductores</h3>              
            </div>            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">            
              <table id="tconductores" class="table table-bordered">          
                <thead>
                  <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Correo</th>
                      <th>Estatus</th>
                      <th>Foto</th>
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