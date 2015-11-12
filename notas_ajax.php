    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements  no borrar -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Datos de la nota</h3>
            </div>

            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Titulo de la nota:</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Correo eletronico">
                </div>
                <div>
                <div>
                  <label for="exampleInputEmail1">Descripcion de la nota:</label>
                </div>
                  <textarea rows="11" cols="107" placeholder="Nota" ></textarea>
                </div>

                <div class="form-group">
                <div class="form-group"></div>
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Plazas</button>
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
                </div>

                <div class="form-group">
                <div class="form-group"></div>
                <div class="btn-group">
                  <button type="button" class="btn btn-warning">Posicion</button>
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li class="divider"></li>
                  </ul>
                </div>
                </div>

                <div class="form-group">
                <div class="form-group"></div>
                <div class="btn-group">
                  <button type="button" class="btn btn-danger">Estado</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Publicado</a></li>
                    <li><a href="#">Despublicado</a></li>
                    <li class="divider"></li>
                  </ul>
                </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">URL:</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="URL">
                </div>
                
                <div class="form-group">
                <form action="#">
                <!-- add class="tcal" to your input field -->
                <div><input type="text" name="date" class="tcal" value="" placeholder="Calendario" /></div>
                </form>
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Imagen de la nota (Cancun:655px*270px,Plazas: 200px*100px )</label>
                  <input type="file" id="exampleInputFile">
                </div>



              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </section>