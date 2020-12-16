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
												echo '<option value = "'.$value["id_almacen"].'">'.$value["descripcion"].'</option>';
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
											foreach ($almacen as $key => $value)
											{
												echo '<option value = "'.$value["id_edo_epo"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->  								         
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->

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

						<!-- Captura el IDF -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoIdf" name="nuevoIdf" required>
	                  <option value="">Seleccionar Idf</option>
										<?php
											// Se obtendrán el Idf desde la base de datos.
											$item = null;
											$valor = null;
											$Idf = ControladorIdf::ctrMostrarIdf($item,$valor);
											foreach ($Idf as $key => $value)
											{
												echo '<option value = "'.$value["id_idf"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class="col-xs-12 col-sm-6"> -->

						<!-- Captura el Patch Panel -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoPatchPanel" name="nuevoPatchPanel" required>
	                  <option value="">Seleccionar Patch Panel</option>
										<?php
											// Se obtendrán el Patch Panel de la base de datos.
											$item = null;
											$valor = null;
											$PatchPanel = ControladorPatchPanel::ctrMostrarPatchPanel($item,$valor);
											foreach ($PatchPanel as $key => $value)
											{
												echo '<option value = "'.$value["id_patch_panel"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
	          </div> <!-- <div class= "col-xs-12 col-sm-6" -->

						<!-- Captura el Puerto -->
						<div class= "col-xs-12 col-sm-6">
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoPuerto" name="nuevoPuerto" required>
	                  <option value="">Seleccionar Puerto</option>
										<?php
											// Se obtendrán el Patch Panel de la base de datos.
											$item = null;
											$valor = null;
											$Puerto = ControladorPuertos::ctrMostrarPuertos($item,$valor);
											foreach ($Puerto as $key => $value)
											{
												echo '<option value = "'.$value["id_puerto"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6" -->

						<!-- Captura el Periferico -->
						<div class= "col-xs-12 col-sm-6">						
	            <div class="form-group">
	              <div class = "input-group">
	                <span class="input-group-addon"><i class="fa fa-th"></i></span>
	                <select class="form-control input-lg" id= "nuevoPeriferico" name="nuevoPeriferico" required>
	                  <option value="">Seleccionar Periferico</option>
										<?php
											// Se obtendrán el Periferico desde la base de datos.
											$item = null;
											$valor = null;
											$Periferico = ControladorPeriferico::ctrMostrarPeriferico($item,$valor);
											foreach ($Periferico as $key => $value)
											{
												echo '<option value = "'.$value["id_periferico"].'">'.$value["descripcion"].'</option>';
											}
										?>
	                </select>                
	              </div> <!-- <div class = "input-group"> -->           
	            </div> <!-- <div class="form-group"> -->
	          </div> <!-- <div class= "col-xs-12 col-sm-6" -->

						<!-- Captura del Stock del producto -->
						<!-- Clases de BootStrap para las formularios-->
						<div class= "col-xs-12 col-sm-6">
							<div class="form-group">
								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									<!-- min="0" Para que solo permita números positivos. -->
									<input type="number" class="form-control input-lg" name="nuevoStock" min="0"  placeholder = "Ingresar Cantidad" required>
								</div> <!-- <div class = "input-group"> -->           
							</div> <!-- <div class="form-group"> -->
						</div> <!-- <div class= "col-xs-12 col-sm-6"> -->					

						<!-- Captura de Precio Compra -->
						<!-- Clases de BootStrap para las formularios-->
						<!-- Se realizara un cambio en estos dos campos, colocando uno a lado del otro, además cuando se teclee el precio compra, calcule de forma automática el precio de venta. -->
						<div class="form-group row">
							
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

							<!-- Captura de Precio Venta -->
							<!-- Clases de BootStrap para las formularios-->
							<!-- "col-xs-6" = Se cambia debido a que cuando se utiliza cel. o tablet se pierden los valores -->

							<div class="col-xs-12 col-sm-6">							

								<div class = "input-group">
									<span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
									<!-- min="0" Para que solo permita números positivos. 
										step="any" = Para que acepte decimales.
									-->
									<input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder = "Ingresar Precio Venta" required>
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
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

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
