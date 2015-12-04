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
    <div id="div_frm">
          <form id="frm_programa" name="frm_programa" action="" method="post">
            <fieldset>
              <label>Nombre del Programa</label>            
              <input type="text" id="nombre" name="nombre" placeholder="nombre del programa" required />
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
          <form id="frm_edit_progra" action="" method="post">
            <fieldset>
              <label>ID</label>
              <br>
              <input type="text" id="id_programa" name="id_programa" placeholder="ID" readonly/>
              <br>
              <label>Nombre del Programa</label>
              <br>
              <input type="text" id="nombre" name="nombre" placeholder="Nombre del programa" required/>
              <br>
              <label>Descripcion</label>
              <br>
              <input type="text" id="descripcion" name="descripcion" placeholder="Descripcion" required/>
              <br>
              <label>Correo</label><br>   
              <input type="email" id="correo" name="correo" placeholder="Correo" required />
              <br>
              <label>Categoria</label><br>         
              <select name="id_categoria" id="id_categoria" required>
                    <option value="">Seleccione una Categoria</option>
                    <?php echo $catego;?>                    
              </select>
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
                      <th>Estatus</th>                              
                      <th>Acciones</th> 
                  </tr>  
                </thead>              
                <tbody id="lis_programas">
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
    <script type="text/javascript" src="dist/js/program.js"></script>