<?php
	class ControladorResponsivas
	{
		static public function ctrMostrarResponsivas($item,$valor)
		{
			$tabla = "t_Responsivas";
			$respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla, $item,$valor);
			return $respuesta;
		}

		// Crear Responsiva.
		static public function ctrCrearResponsiva()
		{
			// Debe existir la variable Global de tipo POST
			if (isset($_POST["nuevoNumResp"]))
			{
				// Actualizar las compras del Cliente.
				
				// Reducir el Stock y Aumnetar las ventas de los productos.
				// Convertirlo de formato JSon a Arreglo, para poder accesar al contenido del detalle de las responsivas.

				$listarProductos = json_decode($_POST["listaProductos"],true);
				//var_dump($listarProductos);

				// Se obtiene los productos que se utilizan en la responsiva
				// $listarProductos = Contiene los renglones(productos) de la responsiva.
				foreach ($listarProductos as $key => $value)
				{

					// Se obtienen los productos desde la tabla de acuerdo al "Id" seleccionado
					$tablaProducto = "t_Productos";
					$item = "id_producto";
					$valor = $value["id"];
					$orden = "nombre";
					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProducto,$item,$valor,$orden);
					// Tomar en encuenta la consulta, ya que tiene valores diferentes de la consulta.

					// Muestra el contenido del campo "Serial"
					//var_dump($traerProducto["Serial"]);

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
				$tabla = "t_Productos";
				$datos = array ("id_empleado"=>$_Post[" "] );

				
			} // if (isset($_POST["nuevoNumResp"]))

		} // static public functio ctrCrearVenta()

	} // class ControladorResponsivas
?>