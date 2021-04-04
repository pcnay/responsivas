<?php
	
	require_once "funciones.php";
	
	class ControladorResponsivas
	{
		static public function ctrMostrarResponsivas($item,$valor,$ordenar)
		{
			$tabla = "t_Responsivas";
			$respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
			return $respuesta;
		}

		// Crear Responsiva.
		static public function ctrCrearResponsiva()
		{
			// Debe existir la variable Global de tipo POST
			if (isset($_POST["nuevoNumResp"]))
			{
				// Actualizar las compras del Empleado.
				
				// Reducir el Stock y Aumnetar las ventas de los productos.
				// Convertirlo de formato JSon a Arreglo, para poder accesar al contenido del detalle de las responsivas.

				$listarProductos = json_decode($_POST["listaProductos"],true);
				//var_dump($listarProductos);

					// Se obtiene los productos que se utilizan en la responsiva
				// $listarProductos = Contiene los renglones(productos) de la responsiva.
				foreach ($listarProductos as $key => $value)
				{
					// Se obtienen los productos desde la tabla de acuerdo al "id_producto" seleccionado, del contenido de la responsivas, es decir articulo por articulo, para actualizarlo en la base de datos, que corresponda.
					$tablaProducto = "t_Productos";
					$item = "id_producto";
					$valor = $value["id"];
					$orden = "nombre";
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProducto,$item,$valor,$orden);
					// Tomar en encuenta la consulta, ya que tiene valores diferentes de la consulta.
					
					// var_dump($traerProducto);
					// Muestra el contenido del campo "Serial"
					// var_dump($traerProducto["Serial"]);

					// Actualizando la existencia y el numero de veces que se ha vendido.
				
					// Numero de veces que se ha vendido.
					/*
						// Ingresando en Json el los productos de la responsiva 
								listarProductos.push({"id" : $(descripcion[i]).attr("idProducto"),
																			"descripcion" : $(descripcion[i]).val(),
																			"cantidad" : $(cantidad[i]).val(),
																			"stock" : $(cantidad[i]).attr("nuevoStock"),
																			"precio" : $(precio[i]).attr("precioReal"),
																			"total" : $(precio[i]).val()});	 
							} 
	
					*/

					$item1a = "cuantas_veces";
					$valor1a = $value["cantidad"]+$traerProducto["Cuantas_veces"];

					// Actualizar "cuantas veces" en la tabla de "Productos"
					// $valor = Es el contenido del "Id"
					// $item1a = "cuantas_veces" es el campo que se utilizara a modificar
					// $valor1a = Es el nuevo valor de "Cuantas_veces".

					// static public function mdlActualizarProducto($tabla,$item1,$valor1,$valor2)

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1a,$valor1a,$valor);

					if ($nuevasVentas=="error")
					{
						echo '<script>           
						Swal.fire ({
							type: "error",
							title: "Error al actualizar cuantas veces ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									window.location="productos";
								}

								});
			
							</script>';          
					}


					// Modificacion del "Stock". 
					
					$item1b = "stock"; // Es el campo que se modificara
					$valor1b = $value["stock"]; // Es el stock actual (utilizado en los renglones de la responsiva).

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1b,$valor1b,$valor);


				} // foreach ($listarProductos as $key => $value)

				// Guardar la responsiva, en la base de datos.
				
				
				// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
				$fecha_asig = date("Y-m-d",strtotime($_POST["nuevaFechaAsignado"]));
				$fecha_devol = date("Y-m-d",strtotime($_POST["nuevaFechaDevolucion"]));

				if ($fecha_devol == '1970-01-01')
					$fecha_devol = null;

				$tabla = "t_Responsivas";
				$datos = array ("id_empleado"=>$_POST["idEmpleado"],
												"id_usuario"=>$_POST["idUsuario"],
												"id_almacen"=>$_POST["nuevaPlanta"],
												"activa"=>'S',
												"num_folio"=>$_POST["nuevoNumResp"],
												"modalidad_entrega"=>$_POST["nuevoMetodoPago"],												
												"num_ticket"=>$_POST["nuevoTicket"],
												"comentarios"=>rtrim($_POST["nuevoComentario"]),
												"productos"=>$_POST["listaProductos"],
												"impuesto"=>$_POST["nuevoPrecioImpuesto"],
												"neto"=>$_POST["nuevoPrecioNeto"],
												"total"=>$_POST["totalVenta"],
												"fecha_asignado"=>$fecha_asig, 
												"fecha_devolucion"=>$fecha_devol);

				//var_dump($datos);
				//return;
			

			 $respuesta = ModeloResponsivas::mdlIngresarResponsiva($tabla,$datos);

			if ($respuesta == "ok")
			{
				echo '<script>           
				Swal.fire ({
					type: "success",
					title: "La Responsiva ha sido Guardada correctamente ",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							// window.location="responsivas";
							window.location="cap-responsiva";
						}

						});
	
					</script>';          
			}
			else
			{
				echo '<script>           
				Swal.fire ({
					type: "success",
					title: "Error Al Grabar la Responsivas, revisar los campos de Capturas",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then(function(result){
						if (result.value)
						{
							// window.location="responsivas";
							window.location="cap-responsiva";
						}

						});
	
					</script>';
			}


			} // if (isset($_POST["nuevoNumResp"]))

		} // static public functio ctrCrearVenta()

	} // class ControladorResponsivas
