<?php
	require_once "funciones.php";

	class ControladorProductos
	{
		// Mostrar productos Ajax
		static public function ctrMostrarProductosAjax($item,$valor)
		{
			$tabla = "t_Productos";
			$respuesta = ModeloProductos::mdlMostrarProductosAjax($tabla,$item,$valor);
			return $respuesta;			
		}

		// Mostrar productos DataTable
		static public function ctrMostrarProductos($item,$valor)
		{
			$tabla = "t_Productos";
			$orden = "nomenclatura";
			$respuesta = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
			return $respuesta;			
		}
			
		// Mostrar productos DataTable
		static public function ctrMostrarProductosImpAlm($item,$valor)
		{
			$tabla = "t_Productos";
			$orden = "nomenclatura";
			$respuesta = ModeloProductos::mdlMostrarProductosImpAlm($tabla,$item,$valor,$orden);
			return $respuesta;			
		}

		// Mostrar Telefonos Asignados.
		static public function ctrMostrarProductosTelAsig($item,$valor)
		{
			$tabla = "t_Productos";			
			$respuesta = ModeloProductos::mdlMostrarProductosTelAsig($tabla,$item,$valor);
			return $respuesta;			
		}

		// Mostrar Existencia De Perifericos.
		static public function ctrMostrarProductosExistPerif($item,$valor)
		{
			$tabla = "t_Productos";			
			$respuesta = ModeloProductos::mdlMostrarProductosExistPerif($tabla,$item,$valor);
			return $respuesta;			
		}


		// Crear producto
		static public function ctrCrearProducto()
		{
			if (isset($_POST["nuevoPeriferico"]))
			{
				// if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoSerial"]))
				if (preg_match('/^[0-9]+$/',$_POST["nuevoPeriferico"]))
				{
					/*
					(preg_match('/^[0-9]+$/',$_POST["nuevoPeriferico"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoMarca"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoModelo"]) &&					
					preg_match('/^[0-9]+$/',$_POST["nuevoAlmacen"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoEdoEpo"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoIdf"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoPatchPanel"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoPuerto"]) &&
					preg_match('/^[0-9.]+$/',$_POST["nuevoStock"]) &&
					preg_match('/^[0-9]+$/',$_POST["nuevoPrecioCompra"]) && 
					preg_match('/^[0-9]+$/',$_POST["porcentaje"]))				

					//preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/',$_POST["especificaciones"]) && 
					//preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ, ]+$/',$_POST["comentarios"]))
					*/

					$tabla = "t_Productos";

					$ruta = "vistas/img/productos/default/anonymous.png";
          /* Para guardar las fotos, sera de la siguiente manera: 
          1.- En una carpeta del servidor se subira la foto
          2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.

           */
          
		// Validando que se encuentre la foto en la etiqueta de "vistas/modulos/usuarios.php" seccion de "modalAgregarUsuario" etiqueta tipo "File" "nuevaImagen"
          if (isset($_FILES["nuevaImagen"]["tmp_name"]))
          {
            // Crea un nuevo array
            //Definiendo el tamaño de la foto de 500X500.
            // getimagesize($_FILES["nuevaImagen"]["tmp_name"]), es un arreglo que en la primera, segunda posicion tiene el tamaño de la foto "Ancho" y "Alto"
            list($ancho,$alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
            //var_dump(getimagesize($_FILES["nuevaImagen"]["tmp_name"])); 

            // Los tamaños de la foto a guardar en la computadora
            $nuevoAncho = 500;
            $nuevoAlto = 500;

            // Crear el directorio donde se guardara la foto del producto
						// $directorio = "vistas/img/productos/".$_POST["nuevoPeriferico"];
						$directorio = "vistas/img/productos/varios";
						// Si se esta utilizando servidor de Linux, se tiene que dar permisos totales a la carpeta de "productos".
            mkdir ($directorio,0777);

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaImagen"]["type"] == "image/jpeg")
            {
              $aleatorio = mt_rand(100,999); // Utilizado para el nombre del archivo.
							// $ruta = "vistas/img/productos/".$_POST["nuevoPeriferico"]."/".$aleatorio.".jpg";
							$ruta = "vistas/img/productos/varios"."/".$aleatorio.".jpg";
              $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
							$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)
              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
							imagejpeg($destino,$ruta);
							
            }

            // De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
            if ($_FILES["nuevaImagen"]["type"] == "image/png")
            {
              $aleatorio = mt_rand(100,999);
              $ruta = "vistas/img/productos/varios"."/".$aleatorio.".png";
              $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
              // Cuando se define el nuevo tamaño de al foto, mantenga los colores.
              $destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
							// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
							// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)

              imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
              // Guardar la foto en la computadora.
              imagejpeg($destino,$ruta);
            }
            
          }

					// Estos campos se extraen de las etiquetas de la captura de form de los productos, y se colocan en un arreglo.		
					$veces = 0;			
					$tabla = "t_Productos";
					// "id_empleado" Solo se utiliza para guardar su ID, pero no se relacionan con la tabla "t_Empleados", para asignar nombre de quien lo tiene asignado.
					$datos = array("id_periferico" =>$_POST["nuevoPeriferico"],
												"num_serie" =>$_POST["nuevoSerial"],
												"id_telefonia" =>$_POST["nuevaTelefonia"],
												"id_plan_tel" =>$_POST["nuevoPlanTelefonia"],
												"num_tel" =>$_POST["nuevoNumTel"],
												"cuenta" =>$_POST["nuevaCuenta"],
												"direcc_mac_tel" =>$_POST["nuevaDireccMac"],
												"imei_tel" =>$_POST["nuevoImei"],
												"num_ip" =>$_POST["nuevoNumIp"],
												"edo_tel" =>$_POST["nuevoEdoTel"],
												"id_empleado" =>1,
												"id_marca" =>$_POST["nuevoMarca"],
												"id_modelo" =>$_POST["nuevoModelo"],
												"id_almacen" =>$_POST["nuevoAlmacen"],
												"id_edo_epo" =>$_POST["nuevoEdoEpo"],
												"nomenclatura" =>$_POST["nuevaNomenclatura"],
												"stock" =>$_POST["nuevoStock"],												
												"precio_compra" =>$_POST["nuevoPrecioCompra"],
												"precio_venta" =>$_POST["nuevoPrecioVenta"],									
												"comentarios" =>rtrim($_POST["nuevoComent"]),
												"asset" =>$_POST["nuevoAsset"],
												"loftware" =>$_POST["nuevoLoftware"],
												"area" =>$_POST["nuevaArea"],
												"linea" =>$_POST["nuevaLinea"],
												"estacion" =>$_POST["nuevaEstacion"],
												"npa" =>$_POST["nuevoNpa"],
												"idf" =>$_POST["nuevoIdf"],
												"patch_panel" =>$_POST["nuevoPatchPanel"],
												"puerto" =>$_POST["nuevoPuerto"],
												"funcion" =>$_POST["nuevaFuncion"],
												"jls" =>$_POST["nuevoJls"],
												"qdc" =>$_POST["nuevoQdc"],
												"cuantas_veces" =>$veces,												
												"imagen" =>$ruta);
					
					$respuesta = ModeloProductos::mdlIngresarProducto($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
							Swal.fire ({
								type: "success",
								title: "El Producto ha sido guardado correctamente ",
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
					else
					{
						echo '<script>           
						Swal.fire ({
							type: "error",
							title: "Error al Grabar el Producto",
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
				}
				else // if (preg_match('/^[A-Z0-9-]+$/',$_POST["nuevoSerial"]) && preg_match('/^[0-9-]+$/',$_POST ....
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "Error al Capturar Datos",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="productos";
							}

							});			
					</script>';				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]))  

			} //if (isset($_POST["nuevaDescripcion"]))
		
		} // 	static public function ctrCrearProducto() 


	// ******************************************************************
	// Editar
	// ******************************************************************

	// Editar Producto
	static public function ctrEditarProducto()
	{
		if (isset($_POST["editarPeriferico"]))
		{
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarPeriferico"]))
			{
				$tabla = "t_Productos";

				// "vistas/img/productos/default/anonymous.png"; se cambia por es la misma foto
				$ruta = $_POST["imagenActual"];
				//print_r ($ruta);
				//exit;

				/* Para guardar las fotos, sera de la siguiente manera: 
				1.- En una carpeta del servidor se subira la foto
				2.- En la base de datos solo se guardara la ruta donde esta almacenada la foto en el servidor.
					*/
				
				// Validando que se encuentre la foto en la etiqueta de "vistas/modulos/productos.php" seccion de "modalEditarProducto" etiqueta tipo "File" "nuevaImagen"
				// Se agrega otra condicion "!empty($_FIL...." para que cuando no se modifique la foto no realize de nuevo el proceso 
				if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"]))
				{
					// Crea un nuevo array
					//Definiendo el tamaño de la foto de 500X500.
					// getimagesize($_FILES["nuevaImagen"]["tmp_name"]), es un arreglo que en la primera, segunda posicion tiene el tamaño de la foto "Ancho" y "Alto"
					list($ancho,$alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
					//var_dump(getimagesize($_FILES["nuevaImagen"]["tmp_name"])); 

					// Los tamaños de la foto a guardar en la computadora
					$nuevoAncho = 500;
					$nuevoAlto = 500;


					// Crear el directorio donde se guardara la foto del producto
					$directorio = "vistas/img/productos/varios";
					
					if (!empty($_POST["imagenActual"]) && ($_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"))
					{
						// Borrar la foto
						unlink ($_POST["imagenActual"]);
					}
					else
					{
						// Si se esta utilizando servidor de Linux, se tiene que dar permisos totales a la carpeta de "productos" 0755.
						// mkdir ($directorio,0755);
						mkdir ($directorio,0777);
					}
					
					// De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
					if ($_FILES["editarImagen"]["type"] == "image/jpeg")
					{
						$aleatorio = mt_rand(100,999); // Utilizado para el nombre del archivo.
						$ruta = "vistas/img/productos/varios"."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
						// Cuando se define el nuevo tamaño de al foto, mantenga los colores.
						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
						
						// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
						// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)
						imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
						// Guardar la foto en la computadora.
						imagejpeg($destino,$ruta);
						
					}

					// De acuerdo al tipo de imagen aplicamos las funciones por defecto de PHP.
					if ($_FILES["editarImagen"]["type"] == "image/png")
					{
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/productos/varios"."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
						// Cuando se define el nuevo tamaño de al foto, mantenga los colores.
						$destino = imagecreatetruecolor($nuevoAncho,$nuevoAlto);
						// Ajustar la imagen al tamaño definidos en las variables "$nuevoAncho", y "$nuevoAlto"
						// imagecopyresized (dst_image,src_image,dst_x, dst_y,src_x,src_y,dst_w,dst_h,src_w,src_h)

						imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
						// Guardar la foto en la computadora.
						imagejpeg($destino,$ruta);
					}
					
				}

				// Estos campos se extraen de las etiquetas de la captura de form de los productos, y se colocan en un arreglo.					
				$datos = array("id_producto" => $_POST["IdProducto"],
											"id_periferico" =>$_POST["editarPeriferico"],
											"num_serie" =>$_POST["editarSerial"],
											"id_telefonia" =>$_POST["editarTelefonia"],
											"id_plan_tel" =>$_POST["editarPlanTelefonia"],
											"num_tel" =>$_POST["editarNumTel"],
											"cuenta" =>$_POST["editarCuenta"],
											"direcc_mac_tel" =>$_POST["editarDireccMac"],
											"imei" =>$_POST["editarImei"],
											"num_ip" =>$_POST["editarNumIp"],
											"edo_tel" =>$_POST["editarEdoTel"],
											"id_marca" =>$_POST["editarMarca"],
											"id_modelo" =>$_POST["editarModelo"],
											"id_almacen" =>$_POST["editarAlmacen"],
											"id_edo_epo" =>$_POST["editarEdoEpo"],
											"nomenclatura" =>$_POST["editarNomenclatura"],
											"stock" =>$_POST["editarStock"],
											"precio_compra" =>$_POST["editarPrecioCompra"],
											"precio_venta" =>$_POST["editarPrecioVenta"],
											"comentarios" =>$_POST["editarComent"],
											"asset" =>$_POST["editarAsset"],
											"loftware" =>$_POST["editarLoftware"],
											"area" =>$_POST["editarArea"],
											"linea" =>$_POST["editarLinea"],
											"estacion" =>$_POST["editarEstacion"],
											"npa" =>$_POST["editarNpa"],
											"idf" =>$_POST["editarIdf"],
											"patch_panel" =>$_POST["editarPatchPanel"],
											"puerto" =>$_POST["editarPuerto"],
											"funcion" =>$_POST["editarFuncion"],
											"jls" =>$_POST["editarJls"],
											"qdc" =>$_POST["editarQdc"],
											"imagen" =>$ruta);

				//var_dump($datos);
				//return;
							
				$respuesta = ModeloProductos::mdlEditarProducto($tabla,$datos);
				
				if ($respuesta == "ok")
				{
					echo '<script>           
						Swal.fire ({
							type: "success",
							title: "El Producto ha sido Editado correctamente ",
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
			}
			else
			{
				echo '<script>           
				Swal.fire ({
					type: "error",
					title: "El producto no puede ir con los campos vacios o llevar caracteres especiales ",
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

			} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]))  

		} //if (isset($_POST["nuevaDescripcion"]))
	
	} // static public function ctrEditarProducto() 



	// ******************************************************************
	// Borrar Producto
	// ******************************************************************
	static public function ctrEliminarProducto()
	{
		// Si viene en camino la siguiente variable GET : idProducto
		if (isset($_GET['idProducto']))
		{
			$tabla = "t_Productos";
			$datos = $_GET["idProducto"];
			if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png")
			{
				// Borrar el archivo
				unlink ($_GET["imagen"]);
				//$borrar_directorio = new EliminarDirectorio();
				//$borrar_directorio->eliminar_directorio('vistas/img/productos/'.$_GET["codigo"]);
				rmdir($_GET["imagen"]);				
			}

			$respuesta = ModeloProductos::mdlEliminarProductos($tabla,$datos);
			if ($respuesta = "ok")
			{
				echo '<script>           
				Swal.fire ({
					type: "success",
					title: "El Producto ha sido borrada correctamente ",
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

			} // if ($respuesta = "ok")

		}
	} // static public function ctrEliminarProducto() 

	// ===================================================
	// Mostrar Suma De Ventas 
	// ===================================================
	
	static public function ctrSumaTotalPerifericos($id_periferico,$id_edo_epo)
	{
		$tabla = "t_Productos";
		$respuesta = ModeloProductos::mdlMostrarSumaPerifericos($id_periferico,$id_edo_epo,$tabla);
		return $respuesta;
	}
	
} // class ControladorProductos



?>
