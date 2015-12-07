<?php
include("conexion2.php");
   $contenido="";  
    if($statusConexion==true){
      $contenido=consultaCategoria($conex);    
  }
?>    
    <section class="content-header">
      <h1>
       Categorias
      </h1>
      <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a>Categorias</a></li>        
      </ol>
    </section>
    <!-- Main content -->    
    <div id="div_frm_c">
          <form id="frm_categoria" name="frm_categoria" action="" method="post">
            <fieldset>              
              <label>Nombre de la categoria</label>          
              <input type="text" id="nombre" name="nombre" placeholder="nombre de la categoria" required />
            </fieldset>
            <fieldset id="btn_c">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loader_c">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div> 
    <div id="div_frm_c2">
          <form id="frm_categoria_edit" action="" method="post">
            <fieldset>
              <label>ID</label>
              <br>
              <input type="text" id="id_categoria" name="id_categoria" placeholder="ID" readonly/>
              <label>Nombre de la categoria</label>            
              <input type="text" id="nombre" name="nombre" placeholder="nombre de la categoria" required />
            </fieldset>
            <fieldset id="btn_c">
              <input type="submit" id="enviar" value="Finalizar" class="btn btn-primary" />
            </fieldset>
            <fieldset id="loader_c">
              <span>Espere un momento</span>
              <img src="dist/img/loader.gif">
            </fieldset>
          </form>            
    </div>    
    <section class="content">                                  
          <div class="col-xs-9">
            <div>
              <button id="agregar_c" class="btn btn-primary btn-md ">Agregar</button>
            </div>
          </div>        
          <div class="col-xs-12"> 
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de categorias</h3>
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
              <table id="tcategoria" class="table table-bordered">          
                <thead>
                  <tr>
                      <th>ID</th>                    
                      <th>Nombre</th>                                                        
                      <th>Acciones</th> 
                  </tr>  
                </thead>              
                <tbody id="lis_categorias">
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
    <script type="text/javascript" src="dist/js/categoria.js"></script>