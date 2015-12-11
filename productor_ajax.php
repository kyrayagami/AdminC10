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
    <div id="div_frm_productor">
          <form id="frm_productor" name="frm_productor" action="" method="post">
            <fieldset>
              <label>Nombre del Productor</label><br>            
              <input type="text" id="nom_productor" name="nom_productor" placeholder="nombre del productor" required />
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo_productor" name="correo_productor" placeholder="Correo" required />
              <br>
              <label>Descripcion Productor</label><br>
              <textarea cols="30"rows="5" id="desc_productor" name="desc_productor" placeholder="Descripcion del Productor" required/>
              <br>
              <label >Fotografia del productor </label><br>
              <input type="text" id="img_productor" name="img_productor" placeholder="imagen del productor" required />
            </fieldset>
            <fieldset id="btnpr">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loaderpr">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>
    <div id="div_frm_productor2">
          <form id="frm_edit_productor" action="" method="post">
            <fieldset>
              <label>ID</label>
              <br>
              <input type="text" id="id_productor" name="id_productor" placeholder="ID" readonly/>
              <label>Nombre del Productor</label><br>         
              <input type="text" id="nom_productor_up" name="nom_productor_up" placeholder="nombre del productor" required />
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo_productor_up" name="correo_productor_up" placeholder="Correo" required />
              <br>
              <label>Descripcion del productor</label><br>
              <textarea cols="30"rows="5" id="desc_productor_up" name="desc_productor_up" placeholder="Biografia del Conductor" required/>
              <br>
              <label >Fotografia del productor </label><br>
              <input type="text" id="img_poductor_up" name="img_poductor_up" placeholder="imagen del productor" required />
              <br>
              <label>Estatus</label><br>         
              <select name="estatus_productor" id="estatus_productor" required >
                    <option value="">Seleccione un Estatus</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>                    
              </select>
            </fieldset>
            <fieldset id="btnpr2">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loaderpr2">
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