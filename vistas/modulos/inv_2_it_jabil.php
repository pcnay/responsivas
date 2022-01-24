
// Importando el archivo CSV
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		{
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
				$csv_file_it = fopen($_FILES['file']['tmp_name'], 'r');
				//fgetcsv($csv_file);
				// get data records from csv file
				
				$datos_grabar = array();
				$num_reg_no_existen = 0;
				$num_reg_existen = 0;
				$contador = 0;
				$ruta = "vistas/img/productos/default/anonymous.png";

				while(($inv_it = fgetcsv($csv_file_it)) !== FALSE)
				{
					// **** Para subir el inventario de IT
								
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));


					// Revisando si el Serial esta vacio.
					if (!empty($inv_it[4])) 
					{
						$contador++;
						//echo "Serial No vacio";

						//print_r ("Procesando registro .. \n ".$contador);
	
						$valor = $inv_it[4]; // Serial
						$item = "num_serie";
						$tabla = "t_Productos";
						$orden = "nombre";

						// Descomentar para que determinar si existe el producto.
						$existe_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
												
						// if (!empty($exite_prod))
						// if (!$exite_prod)
						/*
							Company			[2] = Planta 3
							Location			[3] = Almacen
							Serial Number		[4]
							Arrival Date		[5]
							Type				[6] = Periferico (Laptop, Monitor)
							Model			[7]
							Brand			[8]
							Status			[9]
							CC				[10]
							User Id			[14]
							Hostname			[15]
							Assigned Date		[17]
						*/


						// Verifica si ya existe el serial en la tabla
						$eXiste_prod = "S";
						$modelo_sinEspacios = trim($inv_it[7]); // Eliminar_Espacios($inv_it[7]);
						$marca_sinEspacios = trim($inv_it[8]); //Eliminar_Espacios($inv_it[6]);
						$periferico_sinEspacios =trim($inv_it[6]); // Eliminar_Espacios($inv_it[5]);

						if ($eXiste_prod=="S")
						{
							//echo "existe producto \r"; Eliminar_Espacios
							$Modelo = Obtener_IdModelo($Modelos_Obtenidos,strtolower($modelo_sinEspacios));
							$Marca = Obtener_IdMarca($Marcas_Obtenidas,strtolower($marca_sinEspacios));
							$Periferico = Obtener_IdPeriferico($Perifericos_Obtenidos,strtolower($periferico_sinEspacios));
																
							$tabla = "t_Empleados";
							$item = "ntid";
							$valor = $inv_it[14]; // NTID Empleado.
							$orden = "apellidos";
							$empleado = 0;
							

							if (empty($valor))
							{
								$EncontroEmpleado = "No asignado";
								$Id_Empleado = 1;
							}
							else
							{								
								$empleado = ModeloEmpleados::mdlMostrarEmpleados($tabla,$item,$valor,$orden); 
								if ($empleado)
								{
									$EncontroEmpleado = Eliminar_Espacios($inv_it[14]);	// NTID Empleado							
									$Id_Empleado = $empleado['id_empleado'];									
								}
								else
								{
									$EncontroEmpleado = 'NO encontrado '.Eliminar_Espacios($inv_it[11]);
									echo "<br>";
									echo "Empleado no Encontrado ".Eliminar_Espacios($inv_it[11]);
									$Id_Empleado = 1;
									$num_reg_no_existen++;
								}
							}

						
							$Precio = ObtenerPrecio($Periferico);

							$datos_grabar = array("id_modelo"=>$Modelo,		
																		"id_marca"=>$Marca,
																		"id_periferico"=>$Periferico,
																		"nomenclatura"=>$inv_it[15],
																		"num_serie"=>$inv_it[4],
																		"asset"=>$inv_it[15],
																		"id_telefonia" =>1,
																		"id_plan_tel" =>1,
																		"num_tel" =>'',
																		"cuenta" =>'',
																		"direcc_mac_tel" =>'',
																		"imei_tel" =>'',
																		"num_ip" =>'',
																		"edo_tel" =>'NO Aplica',
																		"id_empleado" =>$Id_Empleado,
																		"id_almacen" =>1,
																		"id_edo_epo" =>1,
																		"stock" =>1,
																		"precio_compra" =>$Precio,
																		"precio_venta" =>$Precio,
																		"comentarios" =>rtrim(" "),
																		"loftware" =>'',
																		"id_ubicacion" =>3,
																		"id_linea" =>1,
																		"estacion" =>'',
																		"npa" =>'',
																		"idf" =>'',
																		"patch_panel" =>'',
																		"puerto" =>'',
																		"funcion" =>'',
																		"jls" =>'',
																		"qdc" =>'',
																		"cuantas_veces" =>1,
																		"imagen"=>$ruta
																	);

							
							//$num_reg_no_existen++;
							// Grabar el registro en la tabla.
							//if (($datos_grabar["id_modelo"] != "Sin Modelos") && ($datos_grabar["id_marca"] != "Sin Marcas") && ($datos_grabar["id_periferico"] != "Sin Perifericos") && ($datos_grabar["id_empleado"] != 1))
							if (($datos_grabar["id_modelo"] != "Sin Modelos") && ($datos_grabar["id_marca"] != "Sin Marcas") && ($datos_grabar["id_periferico"] != "Sin Perifericos"))
							{
								//$respuesta = "error";
								$respuesta = "ok";
								$tabla = "t_Productos";
								
								if ($existe_prod)
								{									
									$num_reg_existen++;
									$valor2 = $existe_prod["id_producto"];

									if (($existe_prod["asset"] != $datos_grabar["asset"]) && (!empty($datos_grabar["asset"])))
									{
										// $item1 = Actualizar de forma dinamica, Stok, precio, descripcion,
										// $valor1 = Es el valor del campo($item1) a modificar
										// $valor2 = Es el valor del "id" que se quiere modificar.
										$tabla = "t_Productos";
										$item1 = "asset";
										$valor1 = $datos_grabar["asset"];									
										$valor2 = $existe_prod["id_producto"];

										$AsignarAsset = ModeloProductos::mdlActualizarProducto($tabla,$item1,$valor1,$valor2);
									}

								}
								else
								{
									// Descomentarla para que grabe en la tabla
									$tabla = "t_Productos";
									$respuesta = ModeloProductos::mdlIngresarProducto($tabla,$datos_grabar);
									$num_reg_no_existen++;	

									$valor = $inv_it[4]; // Serial
									$item = "num_serie";
									$tabla = "t_Productos";
									$orden = "nombre";
									$existe_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
								}

								if ($respuesta == "ok")
								{										
									// Se le asigna al empleado el componente de computo, en la tabla de "Productos"

									// $item1 = Actualizar de forma dinamica, Stok, precio, descripcion,
									// $valor1 = Es el valor del campo($item1) a modificar
									// $valor2 = Es el valor del "id" que se quiere modificar.

									$tabla = "t_Productos";
									$item1 = "id_empleado";
									$valor1 = $datos_grabar["id_empleado"];									
									$valor2 = $existe_prod["id_producto"];
									//$valor2 = empty($existe_prod["id_producto"])?$datos_grabar["id_empleado"]:$existe_prod["id_producto"];
									/*
									print_r("<pre>");
									print_r("Id Empleado : ".$valor1);
									echo ("<br>");
									print_r("Id Producto : ".$valor2);
									echo ("<br>");
									print_r("Id Empleado en tabla de Producto : ".$existe_prod["id_empleado"]);
									print_r("</pre>");									
									exit;
									*/

									if ($existe_prod["id_empleado"] != $datos_grabar["id_empleado"])
									{
										 $AsignarEpo = ModeloProductos::mdlActualizarProducto($tabla,$item1,$valor1,$valor2);

										 // Actualizando la existencia(Stock) del producto
										 $tabla = "t_Productos";
										 $item1 = "stock";
										 if ( $datos_grabar["id_empleado"] == 1 )
										 {
											 $valor1 = 1;									
										 }
										 else
										 {
											$valor1 = 0;
										 }

										 // Asignar el equipo a otro Empleado.
										 $valor2 = $existe_prod["id_producto"];
	 
										 $ActExist = ModeloProductos::mdlActualizarProducto($tabla,$item1,$valor1,$valor2);

									 	if ($AsignarEpo != "ok")
										{
												echo "<br>";
												echo "Error al Asignar Equipo .".$inv_it[4];
										}
										else
										{
												// } // if (!$inv_it[13])

											//echo "Producto Asignado al Empleado : ".$valor1;
										}
										if ($ActExist != "ok")
										{
												echo "<br>";
												echo "Error al Actualizar -Stock Producto ".$inv_it[4];
										}
										else
										{
											//echo "Producto Asignado al Empleado : ".$valor1;
										}


									} // if ($existe_prod["id_empleado"] != $datos_grabar["id_empleado"])

									// Actualizar el centro de Costos del Empleado.
								// Actualizar el centro de costos.
								//Es el empleado que se encuentra en el archivo “CSV”
								// datos_grabar[‘id_empleado’]
								// CC        ->$inv_it[10]

								// Verificando si existe el centro de costos, pero antes revisar que no este vacio
								if (!empty($inv_it[10]))
								{
									$tabla = 't_Centro_Costos';
									$item = "num_centro_costos";
									$valor = trim($inv_it[10]);
									$Verif_CC = ModeloCentro_Costos::mdlMostrarCentro_Costos($tabla,$item,$valor);

									if ($Verif_CC)
									{						
										// $tabla = La tabla a utilizar					
										// $item1 = Campo a Modificar
										// $campoValidar = Campo que se usara para validar la condicion.
										// $valor1 = Es el contenido de "$item1" el valor a Grabar en la tabla
										// $valor2 = Es el valor de la condicion a validar
										// 
										$tabla = 't_Empleados';												
										$item1 = "id_centro_costos";
										$campoValidar = "id_empleado";
										$valor1 = $Verif_CC['id_centro_costos'];
										$valor2 =  $datos_grabar["id_empleado"];
										$Act_CC = 0;
										
										if ($valor2 != 1)
										{
											$Act_CC = ModeloEmpleados::mdlActualizarEmpCualquierCampo($tabla,$item1,$campoValidar,$valor1,$valor2);
										}


										if (!$Act_CC)
										{
											echo "<br>";
											echo "Error al Actualizar el Centro de Costos en tabla Empleados";
										}													
									} // if ($Verif_CC)
									else
									{
										echo "<br>";
										echo "NO se encontro el Centro de Costos = ".$inv_it[10]." NTID Empleado = ".$inv_it[14];
									}
								
								} // if (!empty($inv_it[10]))								
								else // if (!empty($inv_it[10])   if ($respuesta == "ok")
								{
									print_r ("error al grabar el registros en la Base de Datos  : ".$datos_grabar["num_serie"]);
									print ("<br>");									
								}
							}
							else   // if ($datos_grabar["id_modelo"] != "Sin Modelos") ....
							{
								print_r("Registros NO GRABADOS ===> : ");
								print_r('Asset = '.$inv_it[0].' ; ');
								print_r('Current Hostname = '.$inv_it[4].' ; ');
								print_r('Periferico  Kind = '.$datos_grabar["id_periferico"].' ; ');		
								print_r('Brand  Marca = '.$datos_grabar["id_marca"].' ; ');
								print_r('Modelo = '.$datos_grabar["id_modelo"].' ; ');						
								print_r('Serial = '.$inv_it[8].' ; ');
								print_r('Numero Empleado = '.$EncontroEmpleado.' ; ');				
								print "<br>";
							}
							
						}
						else // if (empty($exite_prod))
						{
							//$num_reg_existen++;							
						}

					} // if (!empty($inv_it[4]))

				} //while(($inv_it = fgetcsv($csv_file_inv)) !== FALSE)

				print_r('<br>');
				print_r("Seriales NO Grabados =  ".$num_reg_no_existen);
				print_r('<br>');
				print_r("Seriales Grabados = ".$num_reg_existen);

				fclose($csv_file_it);

			} // if(is_uploaded_file($_FILES['file']['tmp_name']))

		} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
?>