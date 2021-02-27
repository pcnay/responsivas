<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Crear Responsiva     
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li class="active">Crear Responsiva</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">

			<!-- Se devide en dos partes la pantalla, para regitrar los productos, y la otra para seleccionar los productos. -->
			<!-- Donde se captura el formulario -->
			<!-- Se definen los puntos de quiebre de las pantallas -->
			<!-- Es la sección del Formulario, es para responsive, varias pantallas  -->
			<div class = "col-lg-5 col-xs-12">
				
			<!-- En tamaños de pantalla grande se visualizara la lista de los productos 
					Pero en dispositivos tablets en formato Vertical y dispositivos Mobiles se va a ocultar 
			-->
			<!-- Para colocar la linea verde hasta la mitad de la pantalla. -->
				<div class="box box-success">
					<!-- Se agrega una franja blanca abajo de la linea de color verder-->
					<div class="box-header with-border"></div>

					<form role="form" method="post">
							<!-- Se crea el cuerpo de este modulo -->
							<div class="box-body">


									<div class="box">

										<!-- Corresponde a la entrada del Usuario  -->
										<div class="form-group">
											<div class = "input-group">								
												<span class="input-group-addon"><i class="fa fa-users"></i></span>
												<input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

												<!-- Este valor se va a guardar en la tabla de Responsiva .-->
												<input type="hidden" name = "idUsuario" value ="<?php echo $_SESSION["id"]; ?>">

											</div> <!-- <div class = "input-group"> -->
										</div> <!-- <div class="form-group"> -->

										<!-- Corresponde a la entrada de Numero responsiva -->
										<div class="form-group">
											<div class = "input-group">								
												<span class="input-group-addon"><i class="fa fa-users"></i></span>
												<?php
													// Se obtiene el último numero de responsiva.
													$item = null;
													$valor = null;
													$responsiva= ControladorResponsivas::ctrMostrarResponsivas($item,$valor);
													if (!$responsiva)
													{
														echo '<input type="text" class="form-control" id="nuevoNumResp" name="nuevoNumResp" value="1" readonly>';
													}
													else 
													{
														foreach ($responsiva as $key => $value)
														{

														}
														$num_responsiva = $value["num_folio"]+1;
														echo '<input type="text" class="form-control" id="nuevoNumResp" name="nuevoNumResp" value="'.$num_responsiva.'" readonly>';

													}

												?>
												
											</div> <!-- <div class = "input-group"> -->
										</div> <!-- <div class="form-group"> -->

										<!-- Corresponde a la entrada del Empleado -->
										<div class="form-group">
											<div class = "input-group">								
												<span class="input-group-addon"><i class="fa fa-users"></i></span>

												<input type="text" class="form-control" id="agregarEmpleado" name="agregarEmpleado" placeholder="Agregar Empleado" required>
												
												<!-- Revisar esta etiqueta para la utilizacion 
												<select class="form-control" id="seleccionarEmpleado" name="seleccionarEmpleado" required> 
													<option value="">Selecciona Empleado</option>
												</select>
												-->

												<span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarEmpleado" data-dismiss="modal">Agregar Empleado</button></span>
												
											</div> <!-- <div class = "input-group"> -->
										</div> <!-- <div class="form-group"> -->

									<!-- Entrada del Producto -->
									<div class="form-group row nuevoProducto">

										<!-- Para cada renglon que se agregue de los productos. -->
										<!-- style="padding-right:0px" Aumentar el ancho de las cajas, reduce el ancho entre las cajas -->
										<div class="col-xs-6" style="padding-right:0px">
											<div class="input-group">
												<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

												<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="Descripcion Del Prodcuto" required>

											</div><!-- <div class="input-group"> -->

										</div> <!-- <div class="col-xs-6" style="padding-right:0px"> -->

										<!-- Columna de la "cantidad" -->
										<div class="col-xs-3">
											<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>
										</div> <!-- <div class="col-xs-3"> -->
										
										<!-- Columna del "Precio" -->
										<!-- style="padding-right:0px" Aumentar el ancho de las cajas, reduce el ancho entre las cajas -->
										<div class="col-xs-3" style="padding-left:0px">
											<div class="input-group">
											<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
												<input type="number" class="form-control" id="nuevaPrecioProducto" name="nuevaPrecioProducto" placeholder="00000000" readonly required>
												

											</div>	<!-- <div class="input-group">  -->

										</div> <!-- <div class="col-xs-3" style="ppading-left:0px"> -->

									</div> <!-- <div clss="form-group row nuevoProducto"> -->

									<!-- Boton para agregar producto, en pantallas grandes desarparece. -->
									<button type="button" class="btn btn-default hidden-lg">Agregar Producto</button>

									<hr>
									<div class="row">
										<div class="col-xs-8 pull-right">
											<table class="table">
												<thead>
													<tr>
														<th>Impuesto</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="width: 50%">
															<div class="input-group">														
																<input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>
																<span class="input-group-addon"><i class="fa fa-percent "></i></span>
																
															</div>
														</td>
														<td style="width: 50%">
															<div class="input-group">
																<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
																<input type="number" class="form-control" min="0" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" readonly required>
																
															</div>
														</td>

													</tr>
												
												</tbody>

											</table>
										</div> <!-- <div class="col-xs-8 pull-right"> -->
									</div> <!-- <div class="row">  -->
									
										<hr>

										<!-- Para colocar en 6 columnas el forma de pago.-->
									
										<div class="form-group row">
											<div class="col-xs-6">
												<!-- Para crear el metodo de pago. -->
												<div class="input-group">
													<select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
														<option value="">Seleccione Metodo De Pago</option>
														<option value="efectivo">Efectivo</option>
														<option value="tarjetaCredito">Tarjeta Credito</option>
														<option value="tarjetaDebito">Tarjeta Debito</option>
													</select>
												</div> <!-- <div class="input-group"> -->									
											</div> <!-- <div class="col-xs-6"> -->

											<div class="col-xs-6" style="padding-left:0px">
												<!-- Para crear el metodo de pago. -->
												<div class="input-group">
													<input type="text" classs="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Codigo Transaccion" required >
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>

												</div> <!-- <div class="input-group"> -->									
											</div> <!-- <div class="col-xs-6"> -->

										</div> <!-- <div class="form-group row">  -->

									<br/>

									</div> <!-- <div class="box"> -->

							</div> <!-- <div class="box-body"> -->

							<!-- Se colocan el boton para guardar los cambios -->
							<div class="box-footer">						
								<button type="submit" class="btn btn-primary pull-right" >Guardar Venta</button>
							</div>

					</form>
					
				</div> <!-- <div class="box box-success"> -->
					
			</div> <!-- <div class = "col-lg-5 col-xs-12"> -->


				<!-- PANTALLA DE PRODUCTOS 
					Para mostrar solamente en pantallas de escritorio de Desktop, para los demas tamaños se oculto -->					<!-- Para solo se muestra para pantalla grande, los demas tamaños : medianas, pequeñas, y telefonos, se ocultaran.
				-->


				<div class="col-lg-7 hidden-md hidden-sm bidden-xs">
					<!-- Muestra una línea hasta la mitad de la pantalla -->
					<div class="box box-warning">
						<div class="box-header with-border">

						<table class="table table-bordered table-striped dt-responsive tablas">
							<thead>
								<tr>
									<th style="width:10px">#</th>
									<th>Imagen</th>
									<th>NTID</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Puesto</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>#1</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>234545</td>
									<td>JUAN MANUEL</td>
									<td>PEREZ PEREZ</td>
									<td>INGENIERO DE SOPORTE</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
							</tbody>
						</table>
						
						</div><!-- <div class="box-header with-border"> -->

					</div> <!-- <div class="box box-warning"> -->

				</div> <!-- <div class="col-lg-7 hidden-md hidden-sm bidden-xs"> -->

				<div class="col-lg-7 hidden-md hidden-sm bidden-xs">

					<!-- Muestra una línea hasta la mitad de la pantalla -->
					<div class="box box-warning">
						<div class="box-header with-border">

						<table class="table table-bordered table-striped dt-responsive tablaResponsivas">
							<thead>
								<tr>
									<th style="width:10px">#</th>
									<th>Imagen</th>
									<th>Descripcion</th>
									<th>Serial</th>
									<th>Stock</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>#1</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>COMPUTADORA DE ESCRITORIO</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#2</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>LAPTOP</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#3</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>TECLADO</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#4</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>RATON</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#5</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>COMPUTADORA DE ESCRITORIO</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#6</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>COMPUTADORA DE ESCRITORIO</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#7</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>COMPUTADORA DE ESCRITORIO</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#8</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>COMPUTADORA DE ESCRITORIO</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#9</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>COMPUTADORA DE ESCRITORIO</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						
								<tr>
									<td>#10</td>
									<td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
									<td>COMPUTADORA DE ESCRITORIO</td>
									<td>MXL30493OSLDK</td>
									<td>10</td>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-primary">Agregar </button>			
										</div>
									</td>
								</tr>						

							</tbody>
						</table>
						
						</div><!-- <div class="box-header with-border"> -->

					</div> <!-- <div class="box box-warning"> -->

				</div> <!-- <div class="col-lg-7 hidden-md hidden-sm bidden-xs"> -->

<!-- Otra pantalla -->


<!-- Fin Otra pantalla -->



		</div> <!-- <div class="row"> -->

	</section> <!-- <section class="content"> -->

</div> <!-- <div class="content-wrapper"> -->


<!-- Modal -->
<div id="modalAgregarEmpleado" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Empleado</h4>
        </div>

				<!-- CUERPO DE LA VENTANA MODAL -->

				<!-- Captura el NT ID del empleado -->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->

						<!-- Capturar el NT ID -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-id-card"></i></span>
                <input type="text" class="form-control input-lg" id = "nuevo_ntid" name="nuevo_ntid" placeholder = "Ingresar NT ID" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura de nombre del Empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" placeholder = "Ingresar Nombre" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Capturar el Apelllido del Empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoApellido" name="nuevoApellido" placeholder = "Ingresar Apellidos" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Capturar el correo electronico -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-envelope"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoCorreoElect" name="nuevoCorreoElect" placeholder = "Ingresar Correo Electronico" required>
              </div> <!-- <div class = "input-group"> -->       
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el puesto del empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="far fa-building"></i></span>
                <select class="form-control input-lg" id= "nuevoPuesto" name="nuevoPuesto" required>
                  <option value="">Seleccionar Puesto</option>
									<?php
										// Se obtendrán los Puestos desdes la base de datos.
										$item = null;
										$valor = null;						

										$puestos = ControladorPuestos::ctrMostrarPuestos($item,$valor);
										foreach ($puestos as $key => $value)
										{
											echo '<option value = "'.$value["id_puesto"].'">'.$value["descripcion"].'</option>';
										}
									?>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->


						<!-- Captura el Depto que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="far fa-building"></i></span>
                <select class="form-control input-lg" id= "nuevoDepto" name="nuevoDepto" required>
                  <option value="">Seleccionar Depto</option>
									<?php
										// Se obtendrán los Deptos desdes la base de datos.
										$item = null;
										$valor = null;						

										$depto = ControladorDeptos::ctrMostrarDeptos($item,$valor);
										foreach ($depto as $key => $value)
										{
											echo '<option value = "'.$value["id_depto"].'">'.$value["descripcion"].'</option>';
										}
									?>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el Supervisor que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id= "nuevoSupevisor" name="nuevoSupervisor" required>
                  <option value="">Seleccionar Supervisor</option>
									<?php
										// Se obtendrán el Supervisor desdes la base de datos.
										$item = null;
										$valor = null;						

										$supervisor = ControladorSupervisores::ctrMostrarSupervisores($item,$valor);
										foreach ($supervisor as $key => $value)
										{
											echo '<option value = "'.$value["id_supervisor"].'">'.$value["descripcion"].'</option>';
										}
									?>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura la Ubicacion que pertenece el empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fas fa-street-view"></i></span>
                <select class="form-control input-lg" id= "nuevaUbicacion" name="nuevaUbicacion" required>
                  <option value="">Seleccionar Ubicacion</option>
									<?php
										// Se obtendrán la Ubicacion desdes la base de datos.
										$item = null;
										$valor = null;						

										$ubicacion = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);
										foreach ($ubicacion as $key => $value)
										{
											echo '<option value = "'.$value["id_ubicacion"].'">'.$value["descripcion"].'</option>';
										}
									?>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

						<!-- Captura el Centro De Costos del empleado -->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="far fa-building"></i></span>
                <select class="form-control input-lg" id= "nuevoCentro_Costos" name="nuevoCentro_Costos" required>
                  <option value="">Seleccionar Centro De Costos</option>
									<?php
										// Se obtendrán el Centro De Costos desde de la base de datos.
										$item = null;
										$valor = null;						

										$centro_costos = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);
										foreach ($centro_costos as $key => $value)
										{
											echo '<option value = "'.$value["id_centro_costos"].'">'.$value["num_centro_costos"].'</option>';
										}
									?>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->



						<!-- Subir Imagen del Usuario 
						Se coloca la clase "previsualizar" para poder utilizarla con javascript para subir la imagen del Usuario.
						-->
            <div class="form-group">
              <div class="panel text-up">SUBIR IMAGEN DEL EMPLEADO</div> 
              <input type="file" class="nuevaImagen" name="nuevaImagen">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <img src="vistas/img/empleados/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
          </div>

        </form>

				<!-- Para Guardar la información en la base de datos  -->
				<?php
					$crearEmpleado = new ControladorEmpleados();
					$crearEmpleado->ctrCrearEmpleado();
					
				?>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarEmpleado" class="modal fade" role="dialog"> -->
