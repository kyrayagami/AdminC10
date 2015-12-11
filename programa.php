<?php
error_reporting(0);
include("conexion2.php");
   $contenido="";   
    if($statusConexion==true){
      $contenido=consultaProgramas($conex); 
      $catego = obtenerCategoria($conex);
  }
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
    <div id="div_frm_pro">
          <form id="frm_programa" name="frm_programa" action="" method="post">
            <fieldset>
              <label>Nombre del Programa</label>            
              <input type="text" id="nombre_pro" name="nombre_pro" placeholder="nombre del programa" required />
            </fieldset>
            <fieldset id="btnp">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loaderp">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
    <div id="div_frm_pro2">
          <form id="frm_edit_progra" action="" method="post">
            <fieldset>
              <label>ID</label>
              <br>
              <input type="text" id="id_programa" name="id_programa" placeholder="ID" readonly/>
              <br>
              <label>Nombre del Programa</label>
              <br>
              <input type="text" id="nombre_pro_up" name="nombre_pro_up" placeholder="Nombre del programa" required/>
              <br>
              <label>Descripcion</label>
              <br>
              <!--<input type="text" id="descripcion_pro" name="descripcion_pro" placeholder="Descripcion" required/>-->
              <textarea cols="25"rows="3" id="descripcion_pro" name="descripcion_pro" placeholder="Descripcion del programa" required/>
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo_pro" name="correo_pro" placeholder="Correo" required />
              <br>              
              <label>Logo del programa (link) </label><br>
              <input type="text" id="logo_pro" name="logo_pro" placeholder="Logo del programa" required /><br>
              <label>Slide del programa (link)</label><br>
              <input type="text" id="imagen_slide_pro" name="imagen_slide_pro" placeholder="Slide del programa" required /><br>
              <label>Descripcion Slide</label><br>
              <input maxlength="50" type="text" id="desc_slide" name="desc_slide" placeholder="Descripcion Slider" required /><br>              
              <label>Imagen del programa (link)</label><br>
              <input type="text" id="imagen_pro" name="imagen_pro" placeholder="Imagen del programa" required /><br>
              <label>Categoria</label><br>         
              <select name="id_categoria" id="id_categoria" required>
                    <option value="">Seleccione una Categoria</option>
                    <?php echo $catego;?>                    
              </select>
              <br>
              <label>Estatus</label><br>         
              <select name="estatus_pro" id="estatus_pro" required >
                    <option value="">Seleccione un Estatus</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>                    
              </select>              
            </fieldset>
            <fieldset id="btnp2">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loaderp2">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
    <section class="content">                                  
          <div class="col-xs-9">
            <div>
              <button id="agregar_programa" class="btn btn-primary btn-md ">Agregar</button>
            </div>
          </div>        
          <div class="col-xs-12"> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Programas</h3>
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
              <table id="tprogramas" class="table table-bordered">          
                <thead>
                  <tr>
                      <th>ID</th>                    
                      <th>Nombre</th>                      
                      <th>Descripcion</th>
                      <th>Correo</th>
                      <th>Categoria</th> 
                      <th style="display:none;">Logo</th>
                      <th style="display:none;">Slide</th>
                      <th style="display:none;">Imagen</th>                      
                      <th>Estatus</th>
                      <th>Acciones</th> 
                  </tr>  
                </thead>              
                <tbody id="lis_programas">
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
    <script type="text/javascript" src="dist/js/program.js"></script>