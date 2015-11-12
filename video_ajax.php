    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements  no borrar -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos del video</h3>
            </div>

            <form role="form">
              <div class="box-body">
                

                <div class="form-group">
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Selccione el programa</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">El balcon del canal 10</a></li>
                    <li><a href="#">Bacalar</a></li>
                    <li><a href="#">Cancun</a></li>
                    <li class="divider"></li>
                  </ul>
                </div>
                <h4>Programa</h4>
                <h4>"Programa seleccionado"</h4>
                </div>



                <h3>Información</h3>
                <div class="form-group">
                  <label for="exampleInputEmail1">Título:</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Correo eletronico">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Imágen del video:</label>
                  <input type="file" id="exampleInputFile">
                </div>
      

                <div class="form-group">
                  <label for="exampleInputEmail1">ID Vimeo:</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="ID Vimeo">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Title del video:</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="itle del video">
                </div>
                
                <div class="form-group">
                <form action="#">
                 <label for="exampleInputEmail1">Calendario</label>
                <!-- add class="tcal" to your input field -->
                <div><input type="text" name="date" class="tcal" value="" placeholder="Calendario" /></div>
                </form>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>



            </form>
          </div>
        </div>
      </div>
  </section>