  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Productos
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Productos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarProducto">
            Agregar Producto 
          </button>       
        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDataTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/plantilla.js-->
          <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
            <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Imagen</th>
                <th>Descripcion</th>
                <th>Serial</th>
                <th>Marca</th>
								<th>Modelo</th>
                <th>Stock</th>
								<th>Edo_Epo</th>
                <th>Precio Venta</th>
                <th>Acciones </th>
              </tr>
            </thead>
            
						<!-- Cuerpo de la Tabla -->
            <!-- <tbody>


							<?php
							/*
								Se suprime para agregar el contenido de la tabla con Ajax al plugin DataTable.
								
								$item = null;
								$valor = null;
								$orden = "id";

								$productos = controladorProductos::ctrMostrarProductos($item,$valor,$orden);
								// Para mostrarlos en pantalla en las pruebas
								// var_dump($productos); 
								foreach ($productos as $key => $value)
								{
									echo ' 
									  <tr>
											<td>'.($key+1).'</td>
											<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
											<td>'.$value["codigo"].'</td>
											<!-- Clase de BootStrap -->
											<td>'.$value["descripcion"].'</td>';
											
											$item = "id";
											$valor = $value["id_categoria"];
											$categoria = ControladorCategorias::ctrMostrarCategorias($item,$valor);

											echo '<td>'.$categoria["nombre"].'</td>
											<td>'.$value["stock"].'</td>
											<td>'.$value["precio_compra"].'</td>
											<td>'.$value["precio_venta"].'</td>
											<td>'.$value["fecha"].'</td>
											<td>
												<div class="btn-group">
													<button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
													<button class="btn btn-danger"><i class="fa fa-times"></i></button>
												</div>
											</td>
										</tr>'; 
								}
								*/
							?>

            </tbody> -->

          </table> <!-- <table class="table table-bordered tabe-striped"> -->

					<!-- Se agrega esta modificacion para poder utilizar las variables de sesion en el plugin DataTable el “id” se logra permiter el ingreso  -->
					<input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

        </div> <!-- <div class="box-body"> -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Agregar Usuario" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Producto</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->
				<!-- Captura del codigo del producto -->
        <div class="modal-body">
          <div class="box-body">

						<!-- Capturar Periferico -->
            <div class= "col-xs-12 col-sm-6">
							<div class="form-group">							
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoPeriferico" name="nuevoPeriferico" required>
	                  <option value="">Seleccionar Periferico</option>
										<?php
											// Se obtendrán el Perifico desdes la base de datos.
											$item = null;
											$valor = null;
											$periferico = ControladorPerifericos::ctrMostrarPerifericos($item,$valor);
											foreach ($periferico as $key => $value)
											{
												echo '<option value = "'.$value["id_periferico"].'">'.$value["nombre"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           							
            	</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	

            <!-- Clases de BootStrap para las formularios-->
						<!-- Capturar el Número De Serie -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" class="form-control input-lg" id = "nuevoSerial" name="nuevoSerial" placeholder = "Ingresar Serial">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->


						<!-- Captura el Marca -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoMarca" name="nuevoMarca" required>
	                  <option value="">Seleccionar Marca</option>
										<?php
											// Se obtendrán la Marca desdes la base de datos.
											$item = null;
											$valor = null;
											$Marca = ControladorMarcas::ctrMostrarMarcas($item,$valor);
											foreach ($Marca as $key => $value)
											{
												echo '<option value = "'.$value["id_marca"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class = "form-group"> -->           	
            </div> <!-- <div class= "col-xs-12 col-sm-6"> -->

						<!-- Captura el Modelo -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoModelo" name="nuevoModelo" required>
	                  <option value="">Seleccionar Modelo</option>
										<?php
											// Se obtendrán el Modelo desde la base de datos.
											$item = null;
											$valor = null;
											$Modelo = ControladorModelos::ctrMostrarModelos($item,$valor);
											foreach ($Modelo as $key => $value)
											{
												echo '<option value = "'.$value["id_modelo"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	


						<!-- Captura el Almacen -->
            <div class= "col-xs-12 col-sm-6">
							<div class="form-group">							
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoAlmacen" name="nuevoAlmacen" required>
	                  <option value="">Seleccionar Almacen</option>
										<?php
											// Se obtendrán el Almacen desdes la base de datos.
											$item = null;
											$valor = null;
											$almacen = ControladorAlmacenes::ctrMostrarAlmacenes($item,$valor);
											foreach ($almacen as $key => $value)
											{
												echo '<option value = "'.$value["id_almacen"].'">'.$value["nombre"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           							
            	</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->	


						<!-- Captura el Estado Del Equipo -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoEdoEpo" name="nuevoEdoEpo" required>
	                  <option value="">Seleccionar Edo Epo</option>
										<?php
											// Se obtendrán el Estado Del Equipo desdes la base de datos.
											$item = null;
											$valor = null;
											$edoEpo = ControladorEdo_Epos::ctrMostrarEdo_Epos($item,$valor);
											foreach ($edoEpo as $key => $value)
											{
												echo '<option value = "'.$value["id_edo_epo"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->  								         
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->


						<!-- Captura el IDF 
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoIdf" name="nuevoIdf" required>
	                  <option value="">Seleccionar Idf</option>
										<?php
											/*
											// Se obtendrán el Idf desde la base de datos.
											$item = null;
											$valor = null;
											$Idf = ControladorIdf::ctrMostrarIdf($item,$valor);
											foreach ($Idf as $key => $value)
											{
												echo '<option value = "'.$value["id_idf"].'">'.$value["descripcion"].'</option>';
											}
											*/
										?>
	                </select>                
	              </div> <div class = "input-group">
	            </div> <div class="form-group">
						</div> <div class="col-xs-12 col-sm-6"> -->

						<!-- Captura el Patch Panel 
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoPatchPanel" name="nuevoPatchPanel" required>
	                  <option value="">Seleccionar Patch Panel</option>
										<?php
										/*
											// Se obtendrán el Patch Panel de la base de datos.
											$item = null;
											$valor = null;
											$PatchPanel = ControladorPatchPanel::ctrMostrarPatchPanel($item,$valor);
											foreach ($PatchPanel as $key => $value)
											{
												echo '<option value = "'.$value["id_patch_panel"].'">'.$value["descripcion"].'</option>';
											}
											*/
										?>
	                </select>                
	              </div>  <div class = "input-group">
	            </div>  <div class="form-group">
	          </div> <div class= "col-xs-12 col-sm-6" -->

            <!-- Clases de BootStrap para las formularios-->
						<!-- Capturar la Nomenclatura -->
						<div class= "col-xs-12 col-sm-6">
            	<div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-code"></i></span>
	                <input type="text" class="form-control input-lg" id = "nuevaNomenclatura" name="nuevaNomenclatura" placeholder = "Ingresar Nomenclatura">
	              </div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
            </div>  <!-- class= "col-xs-12 col-sm-6"> -->

						<!-- Captura del Stock del producto -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="number" class="form-control input-lg" id="nuevoStock" name="nuevoStock" min="0"  placeholder = "Ingresar Cantidad" required>
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Captura de Precio Compra -->
						<!-- Clases de BootStrap para las formularios-->
						<!-- Se realizara un cambio en estos dos campos, colocando uno a lado del otro, además cuando se teclee el precio compra, calcule de forma automática el precio de venta. -->
						<div class="form-group"> <!-- <div class="form-group row">-->
							
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores -->
							<div class="col-xs-12 col-sm-6">							

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales.
									-->
									<input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder = "Ingresar Precio Compra" required>
								</div> <!-- <div class = "input-group"> -->
							</div> <!-- 	<div class="col-xs-6">	-->
						</div> <!-- <div class="form-group row"> -->

							<!-- Captura de Precio Venta -->
							<!-- Clases de BootStrap para las formularios-->
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores -->

						<div class="form-group"> <!-- <div class="form-group row">-->
							<div class="col-xs-12 col-sm-6">							

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales.
									-->
									<input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder = "Ingresar Precio Venta" required>
								</div> <!-- <div class = "input-group"> -->   
								<br>

						</div> <!-- <div class="form-group"> -->

						<!-- Checkbox para porcentaje -->
						<div class="form-group">
							<div class="col-xs-6">								
									<label>
										<!-- minimal, minimal-red, flat-red se debe activar en el "Plantilla.js"-->
										<input type="checkbox" id="porcentaje" cname = "porcentaje" lass = "minimal porcentaje" checked>
										Utilizar porcentaje
									</label>

								</div> <!-- <div class="col-xs-6"> -->

						</div> <!-- <div class="form-group">  -->

						<!-- Captura el Puerto -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">	                
									<input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
										<span class="input-group-addon"><i class="fa fa-percent"></i></span>
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6" -->

						<div class="form-group">
						  <label for="especificaciones">Especificiones:</label>
						  <textarea class="form-control" rows="5" name="nuevaEspecif" id="nuevaEspecif">
							</textarea>
						</div>

						<div class="form-group">
						  <label for="comentarios">Comentarios:</label>
						  <textarea class="form-control" rows="5" name="nuevoComent" id="nuevoComent">
							</textarea>
						</div>

						<!-- Subir Imagen del producto 
						Se coloca la clase "previsualizar" para poder utilizarla con javascript para subir la imagen del producto.
						-->
            <div class="form-group">
              <div class="panel text-up">SUBIR IMAGEN DEL PRODUCTO</div> 
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">

            </div> <!-- <div class="form-group"> -->


					</div> <!-- <div class="box-body">  -->	
				</div> <!-- <div class="modal-body">  -->				


          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
          </div>

        </form>

				<!-- Para Guardar la información. -->
				<?php
					$crearProducto = new ControladorProductos();
					$crearProducto->ctrCrearProducto();
					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarProducto" class="modal fade" role="dialog"> -->


<!-- // Editar productos. -->
<!-- Modal -->
<div id="modalEditarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Producto</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->

						<!-- Captura de los Perifericos -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editarPeriferico"  readonly required>
								<!-- Se utilizara JavaScript para obtener el valor.-->
                  <option id= "editarPeriferico"></option>

                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el Serial -->
						<div class="modal-body">
							<div class="box-body">
							<!-- Clases de BootStrap para las formularios-->
								<div class="form-group">
									<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-th"></i></span>
									<input type="text" class="form-control input-lg" name="editarSerial"  id="editarSerial" required>
									<!-- Se envía como campo oculto para enviar el "id" del Producto -->
									<input type="hidden"  name="idProducto"  id="idProducto" required>
									</div> <!-- <div class = "input-group"> -->           
								</div> <!-- <div class="form-group"> -->
							</div> <!-- <div class="box-body"> -->
        		</div> <!-- <div class="modal-body"> -->

						<!-- Captura el Marca -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editarMarca"  readonly required>
								<!-- Se utilizara JavaScript para obtener el valor.-->
                  <option id= "editarMarca"></option>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el Modelo -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editarModelo"  readonly required>
								<!-- Se utilizara JavaScript para obtener el valor.-->
                  <option id= "editarModelo"></option>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el Almacen -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editarAlmacen"  readonly required>
								<!-- Se utilizara JavaScript para obtener el valor.-->
                  <option id= "editarAlmacen"></option>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el Edo Epo -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editarEdoEpo"  readonly required>
								<!-- Se utilizara JavaScript para obtener el valor.-->
                  <option id= "editarEdoEpo"></option>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el Nomenclatura -->
						<div class="modal-body">
							<div class="box-body">
							<!-- Clases de BootStrap para las formularios-->
								<div class="form-group">
									<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-th"></i></span>
									<input type="text" class="form-control input-lg" name="editarNomenclatura" id="editarNomenclatura" required>								
									</div> <!-- <div class = "input-group"> -->           
								</div> <!-- <div class="form-group"> -->
							</div> <!-- <div class="box-body"> -->
        		</div> <!-- <div class="modal-body"> -->


						<!-- Captura del Stock del producto 
							el contenido de "stock" se asignara utilizando JavaScript
						-->
						<!-- Clases de BootStrap para las formularios-->
						<div class="form-group">
							<div class = "input-group">
								<span class="input-group-addon"><i class="fa fa-check"></i></span>
								<!-- min="0" Para que solo permita números positivos. -->
								<input type="number" class="form-control input-lg" id ="editarStock" name="editarStock" min="0"  required>
							</div> <!-- <div class = "input-group"> -->           
						</div> <!-- <div class="form-group"> -->

						<!-- Captura de Precio Compra -->

						<!-- Clases de BootStrap para las formularios-->
						<!-- Se realizara un cambio en estos dos campos, colocando uno a lado del otro, además cuando se teclee el precio compra, calcule de forma automática el precio de venta. 
						el contenido de "precio_compra" se asignara utilizando JavaScript
						-->
						<div class="form-group row">
							
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores -->
							<div class="col-xs-12 col-sm-6">							

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales.
									-->
									<input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" required>
								</div> <!-- <div class = "input-group"> -->

							</div> <!-- 	<div class="col-xs-6">	-->

							<!-- Captura de Precio Venta -->
							<!-- Clases de BootStrap para las formularios-->
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores 
							el contenido de "precio_venta" se asignara utilizando JavaScript
							-->
							<div class="col-xs-12 col-sm-6">							

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales.
									-->
									<input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any"  required readonly > 
								</div> <!-- <div class = "input-group"> -->   
								<br>

								<!-- Checkbox para porcentaje -->
								<div class="col-xs-6">
									<div class="form-group">
										<label>
											<!-- minimal, minimal-red, flat-red se debe activar en el "Plantilla.js"-->
											<input type="checkbox" id="porcentaje" class = "minimal porcentaje" checked>
											Utilizar porcentaje
										</label>

									</div> <!-- <div class="form-group"> -->

								</div> <!-- <div class="col-xs-6"> -->

								<!-- Entrada para el porcentaje -->
								<div class= "col-xs-6" style="padding:0">
									<div class="input-group">
										<input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
										<span class="input-group-addon"><i class="fa fa-percent"></i></span>
									</div> <!-- <div class="input-group"> -->

								</div> <!-- <div class= "col-xs-6"> -->

							</div> <!-- 	<div class="col-xs-6">	-->

						</div> <!-- <div class="form-group"> -->


						<!-- Subir Imagen del producto 
						Se coloca la clase "previsualizar" para poder utilizarla con javascript para subir la imagen del producto.
						-->
            <div class="form-group">
              <div class="panel text-up">SUBIR IMAGEN DEL PRODUCTO</div> 
              <input type="file" class="nuevaImagen" name="editarImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">
							<!-- Se manda el nombre de la imagen actual, al Javascript utilizando un campo oculto -->
							<input type = "hidden" name = "imagenActual" id="imagenActual">							 

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </div>

        </form>

				<!-- Para Guardar la información. -->
				<?php
					$editarProducto = new ControladorProductos();
					$editarProducto->ctrEditarProducto();					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarProducto" class="modal fade" role="dialog"> -->
<?php
	$eliminarProducto = new ControladorProductos();
	$eliminarProducto->ctrEliminarProducto();
?>