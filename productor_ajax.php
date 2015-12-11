<?php
error_reporting(0);
include("conexion2.php");
   $contenido="";   
    if($statusConexion==true){
      $contenido=consultaProductores($conex); 
      //$catego = obtenerCategoria($conex);
  }
?>    
    <section class="content-header">
      <h1>
       Productores
      </h1>
      <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a>Productores</a></li>
      </ol>
    </section>
    <!-- Main content -->    
    <div id="div_frm_p">
          <form id="frm_productor" name="frm_productor" action="" method="post">
            <fieldset>
              <label>Nombre del Productor</label><br>            
              <input type="text" id="nombre" name="nombre" placeholder="nombre del conductor" required />
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo" name="correo" placeholder="Correo" required />
              <br>
              <label>Biografia</label><br>
              <textarea cols="30"rows="9" id="biografia" name="biografia" placeholder="Biografia del Conductor" required/>
              <br>
              <label for="exampleInputFile">Fotografia del productor </label><br>
              <input type="text" id="imagen" name="imagen" placeholder="imagen del conductor" required />
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
    <div id="div_frm_p2">
          <form id="frm_edit_productor" action="" method="post">
            <fieldset>
              <label>ID</label>
              <br>
              <input type="text" id="id_productor" name="id_productor" placeholder="ID" readonly/>
              <label>Nombre del Productor</label><br>         
              <input type="text" id="nombre_c_up" name="nombre_c_up" placeholder="nombre del conductor" required />
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo_c_up" name="correo_c_up" placeholder="Correo" required />
              <br>
              <label>Biografia</label><br>
              <textarea cols="30"rows="9" id="biografia_c_up" name="biografia_c_up" placeholder="Biografia del Conductor" required/>
              <br>
              <label for="exampleInputFile">Fotografia del productor </label><br>
              <input type="text" id="imagen_c_up" name="imagen_c_up" placeholder="imagen del conductor" required />
              <br>
              <label>Estatus</label><br>         
              <select name="estatus_c" id="estatus_c" required >
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
              <button id="agregar" class="btn btn-primary btn-md ">Agregar</button>
            </div>
          </div>        
          <div class="col-xs-12"> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Productores</h3>
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
              <table id="tproductores" class="table table-bordered">          
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
                <tbody id="lis_productores">
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
    <script type="text/javascript" src="dist/js/productor.js"></script>