  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SUBIR INVENTARIO I.T. - CSV
      </h1>
      <ol class="breadcrumb">
        <li><a href="Inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reportes</li>
      </ol>
    </section>

		<div class="panel panel-default">
			<div class="panel-body">
			<br>
				<div class="row">
					<form action="" method="post" enctype="multipart/form-data" id="import_form">
						<div class="col-md-3">
							<input type="file" name="file" />
						</div>
						<div class="col-md-5">
							<input type="submit" class="btn btn-primary" name="import_inv" value="IMPORTAR">
						</div>
					</form>
				</div>
  		</div>
		</div>	
  <!-- /.content-wrapper -->

<?php

	// Obtener los Modelos, Marcas, Perifericos.
	$tabla = "t_Modelo";
	$item = null;
	$valor = null;
	$Arreglo_modelos = ModeloModelos::mdlMostrarModelos($tabla,$item,$valor);
	//print_r("<br>");
	//print_r("<br>");
	//print_r("Imprimiendo los modelos");
	//var_dump($Arreglo_modelos);

	$tabla = "t_Marca";
	$item = null;
	$valor = null;
	$Arreglo_marcas = ModeloMarcas::mdlMostrarMarcas($tabla,$item,$valor);
	//print_r("<br>");
	//print_r("<br>");
	//print_r("Imprimiendo las Marcas");
	//var_dump($Arreglo_marcas);

	$tabla = "t_Periferico";
	$item = null;
	$valor = null;
	$Arreglo_perifericos = ModeloPerifericos::mdlMostrarPerifericos($tabla,$item,$valor);
	//print_r("<br>");
	//print_r("<br>");
	//print_r("Imprimiendo los Perifericos");
	//var_dump($Arreglo_perifericos);



	// Pasandolo a un arreglo bidimencional los Modelos obtenidos
	$Modelos_Obtenidos = array();
	for ($q=0;$q<count($Arreglo_modelos);$q++)
	{
		//print_r("Valor = ".$Arreglo_modelos[$q]["id_modelo"]);
		//print("<br>");
		//print_r("Valor = ".$Arreglo_modelos[$q]["descripcion"]);
		//print("<br>");

		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Modelos_Obtenidos[$q][$a] = $Arreglo_modelos[$q]["id_modelo"];
			if ($a == 1)
				$Modelos_Obtenidos[$q][$a] = strtolower($Arreglo_modelos[$q]["descripcion"]);
		}
		
	}

	// Pasandolo a un arreglo bidimencional las Marcas obtenidas
	$Marcas_Obtenidas = array();
	for ($q=0;$q<count($Arreglo_marcas);$q++)
	{
		//print_r("Valor = ".$Arreglo_modelos[$q]["id_modelo"]);
		//print("<br>");
		//print_r("Valor = ".$Arreglo_modelos[$q]["descripcion"]);
		//print("<br>");

		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Marcas_Obtenidas[$q][$a] = $Arreglo_marcas[$q]["id_marca"];
			if ($a == 1)
				$Marcas_Obtenidas[$q][$a] = strtolower($Arreglo_marcas[$q]["descripcion"]);
		}
		
	}

	//var_dump($Marcas_Obtenidas);

	// Pasandolo a un arreglo bidimencional los Perifericos obtenidos
	$Perifericos_Obtenidos = array();
	for ($q=0;$q<count($Arreglo_perifericos);$q++)
	{
		//print_r("Valor = ".$Arreglo_modelos[$q]["id_modelo"]);
		//print("<br>");
		//print_r("Valor = ".$Arreglo_modelos[$q]["descripcion"]);
		//print("<br>");

		$contador = 0;
		for ($a=0;$a<2;$a++)
		{
			if ($a == 0)
				$Perifericos_Obtenidos[$q][$a] = $Arreglo_perifericos[$q]["id_periferico"];
			if ($a == 1)
				$Perifericos_Obtenidos[$q][$a] = strtolower($Arreglo_perifericos[$q]["nombre"]);
		}
		
	}


	// Obtener la Marca.
	function Obtener_IdMarca($Arreglo_marca,$reg_csv_marca)
	{
		$columna_1 = 0;					
		
		//var_dump($Arreglo_marca);
		$separar_cadena = explode(" ",$reg_csv_marca);
		//print ("Tamaño -separar_cadena- : ".count($separar_cadena));

		$Marcas = 'Sin Marca ';
		for ($l=0;$l<count($Arreglo_marca);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{
					$encontro = strpos($Arreglo_marca[$l][$n],$separar_cadena[$k]);

					if ($encontro === false)
					{
						//print_r("Valor NO encontrado ");
					}
					else
					{
						$contador_pal++;
					}
				} // for ($k=0;$k<count($separar_cadena);$k++)

				if ($contador_pal == count($separar_cadena))
				{
					$Marcas = $Arreglo_marca[$l][$n-1];
					return $Marcas;
				}

			} // for ($n=0;$n<2;$n++)

		} // for ($l=0;$l<count($Arreglo_marca);$l++)

		return $Marcas;

	} // function Obtener_IdMarca() 

	// Obtener el Modelo	
	function Obtener_IdModelo($Arreglo_modelos,$reg_csv)
	{
		$columna_1 = 0;					

		$separar_cadena = explode(" ",$reg_csv);

		$Modelos = "Sin Modelos";
		for ($l=0;$l<count($Arreglo_modelos);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{

					$encontro = strpos($Arreglo_modelos[$l][$n],$separar_cadena[$k]);
					if ($encontro === false)
					{
						//print_r("Valor NO encontrado ");
					}
					else
					{
						$contador_pal++;
						//print_r("Valor encontrado ".$separar_cadena[$k].' '.$encontro);
						//print("<br>");
					}
				} // for ($k=0;$k<2;$k++)

				if ($contador_pal == count($separar_cadena))
				{
//					print("<br>");
//					print_r ("Valor del indice modelo = ".$Arreglo_modelos[$l][$n-1]);
						$Modelos = $Arreglo_modelos[$l][$n-1];
					return $Modelos;
				}

			} // for ($n=0;$n<2;$n++)

		} // for ($l=0;$l<count($Arreglo_modelo);$l++)

		return $Modelos;

	} // function Obtener_IdModelo() 


	// Obtener el periferico.
	function Obtener_IdPeriferico($Arreglo_perifericos,$reg_csv_perif)
	{
		$columna_1 = 0;					
		$Perifericos = "Sin Perifericos ";
		$separar_cadena = explode(" ",$reg_csv_perif);
		for ($l=0;$l<count($Arreglo_perifericos);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{				
					$encontro = strpos($Arreglo_perifericos[$l][$n],$separar_cadena[$k]);
					
					if ($encontro === false)
					{
						//print_r("Valor NO encontrado ");
					}
					else
					{
						$contador_pal++;
					}

				} // for ($k=0;$k<2;$k++)

					if ($contador_pal == count($separar_cadena))
					{
						//print_r("Valor NO encontrado ");
//						print("<br>");
//						print_r ("Valor del indice periferico = ".$Arreglo_perifericos[$l][$n-1]);
							$Perifericos = $Arreglo_perifericos[$l][$n-1];
						return $Perifericos;					
					}				

			} // for ($n=0;$n<2;$n++)			

		} // for ($l=0;$l<count($Arreglo_periferico);$l++)
		return $Perifericos;

	} // function Obtener_IdPerifericos() 



	// var_dump($Perifericos_Obtenidos);


	/*
	//Desṕlegando el contenido  del arrenglo recien creado 
	for ($q=0;$q<count($Arreglo_modelos);$q++)
	{
		for($a=0;$a<2;$a++)
		{
			print_r("Contenido de -arreglo-".$arreglo[$q][$a]);
			print_r("<br>");
		}
	}
*/



	//var_dump($Arreglo_modelos);

// Importando el archivo CSV
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		{
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
				$csv_file_it = fopen($_FILES['file']['tmp_name'], 'r');
				//fgetcsv($csv_file);
				// get data records from csv file
				print_r ('Inica el ciclo');

				$datos_grabar = array();
				$num_reg_no_existen = 0;
				$num_reg_existen = 0;
				$ruta = "vistas/img/productos/default/anonymous.png";

				while(($inv_it = fgetcsv($csv_file_it)) !== FALSE)
				{
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));

					if (!empty($inv_it[8]))
					{
						$valor = $inv_it[8]; // Serial
						$item = "num_serie";
						$tabla = "t_Productos";
						$orden = "nombre";
						$exite_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
						// if (!empty($exite_prod))
						// if (!$exite_prod)
							// Verifica si ya existe el serial en la tabla
						if (empty($exite_prod))
						{
							$datos_grabar = array("id_modelo"=>Obtener_IdModelo($Modelos_Obtenidos,strtolower($inv_it[7])),		
																		"id_marca"=>Obtener_IdMarca($Marcas_Obtenidas,strtolower($inv_it[6])),
																		"id_periferico"=>Obtener_IdPeriferico($Perifericos_Obtenidos,strtolower($inv_it[5])),"asset"=>$inv_it[0],
																		"nomenclatura"=>$inv_it[4],
																		"num_serie"=>$inv_it[8],
																		"id_telefonia" =>1,
																		"id_plan_tel" =>1,
																		"num_tel" =>'',
																		"cuenta" =>'',
																		"direcc_mac_tel" =>'',
																		"imei_tel" =>'',
																		"num_ip" =>'',
																		"edo_tel" =>'NO Aplica',
																		"id_empleado" =>1,
																		"id_almacen" =>1,
																		"id_edo_epo" =>1,
																		"stock" =>1,
																		"precio_compra" =>0,
																		"precio_venta" =>0,
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
					
																								
							print_r('Asset = '.$inv_it[0].' ; ');
							print_r('Current Hostname = '.$inv_it[4].' ; ');
							print_r('Periferico  Kind = '.$datos_grabar["id_periferico"].' ; ');						
							print_r('Brand  Marca = '.$datos_grabar["id_marca"].' ; ');
							print_r('Modelo = '.$datos_grabar["id_modelo"].' ; ');						
							print_r('Serial = '.$inv_it[8].' ; ');						
							print "<br>";
														
							$num_reg_no_existen++;
												// Grabar el registro en la tabla.
							$respuesta = "error";
							$tabla = "t_Productos";
							$respuesta = ModeloProductos::mdlIngresarProducto($tabla,$datos_grabar);

							if ($respuesta != "ok")
							{
								print_r ("error al grabar el registros : ".$datos_grabar["num_serie"]);
								print ("<br>");
							}
						}
						else
						{
							$num_reg_existen++;
						}

					} // if (!empty($inv_it[8]))


/*	

						$tabla = "t_Cintas";

						$datos=array();									
						$datos = array("num_serial"=>$cinta_record[0],
														"fecha_inic"=>$fecha_inic,
														"fecha_final"=>$fecha_final,
														"ubicacion"=>$cinta_record[3],
														"comentarios"=>$comentario_adic);
	
						//var_dump($datos);								
	
					$localizar_Cinta = ModeloSubirCsv::localizarCinta($tabla,$datos);	
					
					// En el caso de que exista la cinta, revisara cada campo para actualizar.

					//if (!$localizar_Cinta)
					if ($localizar_Cinta)
					{
						// Para actualizar cada campo de la tabla 
						if ($datos["fecha_inic"] != $localizar_Cinta["fecha_inic"])
						{
							// Se pasan como parametro los campos de: El "num_serial" que es por el cual buscara, "campo_actualizar"
	
							$campoActualizar = 'fecha_inic';
							$contenidoActualizar = date("Y-m-d",strtotime($datos["fecha_inic"]));
							$campoCondicion = 'num_serial';
							$valorCondicion = $datos["num_serial"];							
							$actualizar = ModeloSubirCsv::actualizarCsvCinta($tabla,$campoActualizar,$contenidoActualizar,$campoCondicion,$valorCondicion);							
						}
	
						if ($datos["fecha_final"] != $localizar_Cinta["fecha_final"])
						{
							// Se pasan como parametro los campos de: El "num_serial" que es por el cual buscara, "campo_actualizar"
	
							$campoActualizar = 'fecha_final';
							$contenidoActualizar = date("Y-m-d",strtotime($datos["fecha_final"]));
							$campoCondicion = 'num_serial';
							$valorCondicion = $datos["num_serial"];							
							$actualizar = ModeloSubirCsv::actualizarCsvCinta($tabla,$campoActualizar,$contenidoActualizar,$campoCondicion,$valorCondicion);							

						}

						if ($datos["ubicacion"] != $localizar_Cinta["ubicacion"])
						{
							// Se pasan como parametro los campos de: El "num_serial" que es por el cual buscara, "campo_actualizar"
	
							$campoActualizar = 'ubicacion';
							$contenidoActualizar = $datos["ubicacion"];
							$campoCondicion = 'num_serial';
							$valorCondicion = $datos["num_serial"];							
							$actualizar = ModeloSubirCsv::actualizarCsvCinta($tabla,$campoActualizar,$contenidoActualizar,$campoCondicion,$valorCondicion);							

						}
					}
					else
					{	
						// Graba cada registro en la tabla
						$respuesta = ModeloSubirCsv::mdlSubirCsv($tabla,$datos);
					}

						/*
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Cinta fue encontrada ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									//window.location="cintas";
								}
	
								});
			
							</script>';          	
						exit;

*/

				} //while(($inv_it = fgetcsv($csv_file_inv)) !== FALSE)

				print_r('<br>');
				print_r("Total de Registros Si Existen: ".$num_reg_existen);
				print_r("Total de Registros NO Existen: ".$num_reg_no_existen);

				fclose($csv_file_it);


			} // if(is_uploaded_file($_FILES['file']['tmp_name']))

		} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))


?>