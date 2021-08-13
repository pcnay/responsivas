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
	// Obtener el Modelo	
	function Obtener_IdModelo($Arreglo_modelo,$reg_csv)
	{
		$columna_1 = 0;					

		$separar_cadena = explode(" ",$reg_csv);
		for ($l=0;$l<count($Arreglo_modelo);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{

					$encontro = strpos($Arreglo_modelo[$l][$n],$separar_cadena[$k]);
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

				if ($contador_pal == 3)
				{
					print("<br>");
					print_r ("Valor del indice = ".$Arreglo_modelo[$l][$n-1]);
					return $Arreglo_modelo[$l][$n-1];
				}

			} // for ($n=0;$n<2;$n++)

		} // for ($l=0;$l<count($Arreglo_modelo);$l++)


	} // function Obtener_IdModelo() 

	// Obtener la Marca.
	function Obtener_IdMarca($Arreglo_marca,$reg_csv_marca)
	{
		$columna_1 = 0;					
		
		$separar_cadena = explode(" ",$reg_csv_marca);
		for ($l=0;$l<count($Arreglo_marca);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{
					print("<br>");
					$encontro = strpos($Arreglo_marca[$l][$n],$separar_cadena[$k]);
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

				if ($contador_pal == 1 )
				{
					print("<br>");
					print_r ("Valor del indice = ".$Arreglo_marca[$l][$n-1]);
					return $Arreglo_marca[$l][$n-1];
				}

			} // for ($n=0;$n<2;$n++)

		} // for ($l=0;$l<count($Arreglo_modelo);$l++)


	} // function Obtener_IdMarca() 

	// Obtener el periferico.
	function Obtener_IdPeriferico($Arreglo_periferico,$reg_csv_perif)
	{
		$columna_1 = 0;					
		
		$separar_cadena = explode(" ",$reg_csv_perif);
		for ($l=0;$l<count($Arreglo_periferico);$l++)
		{
			for ($n=0;$n<2;$n++)
			{
				$contador_pal = 0;
				for ($k=0;$k<count($separar_cadena);$k++)
				{
		
					$encontro = strpos($Arreglo_periferico[$l][$n],$separar_cadena[$k]);
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

				if ($contador_pal == 1 )
				{
					print("<br>");
					print_r ("Valor del indice = ".$Arreglo_periferico[$l][$n-1]);
					return $Arreglo_periferico[$l][$n-1];
				}

			} // for ($n=0;$n<2;$n++)

		} // for ($l=0;$l<count($Arreglo_modelo);$l++)


	} // function Obtener_IdMarca() 


	// Obtener los modelos.
	$tabla = "t_Modelo";
	$item = null;
	$valor = null;
	$Arreglo_modelos = ModeloModelos::mdlMostrarModelos($tabla,$item,$valor);

	// Pasandolo a un areglo.
	$arreglo = array();
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
				$arreglo[$q][$a] = $Arreglo_modelos[$q]["id_modelo"];
			if ($a == 1)
				$arreglo[$q][$a] = $Arreglo_modelos[$q]["descripcion"];
		}
		
	}

	for ($q=0;$q<count($Arreglo_modelos);$q++)
	{
		for($a=0;$a<2;$a++)
		{
			print_r("Contenido de -arreglo-".$arreglo[$q][$a]);
			print_r("<br>");
		}
	}



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

				$tabla = "t_Productos";
				$item = "num_serie";
				$orden = 'nombre';
				
				$datos_grabar = [];

				$Arreglo_modelo[0][0] = "3";
				$Arreglo_modelo[0][1] = "elitebook 840 g4";
				$Arreglo_modelo[1][0] = "14";
				$Arreglo_modelo[1][1] = "elitebook 745 g6";
				$Arreglo_modelo[2][0] = "24";
				$Arreglo_modelo[2][1] = "elitebook 747 g3";
				
				$Arreglo_marca[0][0] = "10";
				$Arreglo_marca[0][1] = "hp";
				$Arreglo_marca[1][0] = "11";
				$Arreglo_marca[1][1] = "dell";

				$Arreglo_periferico[0][0] = "10";
				$Arreglo_periferico[0][1] = "laptop";
				$Arreglo_periferico[1][0] = "3";
				$Arreglo_periferico[1][1] = "desktop";

				$reg_csv = strtolower("Elitebook 745 g6");
				$reg_csv_marca = strtolower("HP");
				$reg_csv_perif = strtolower("desktop");

					$datos_grabar = ["id_modelo"=>Obtener_IdModelo($Arreglo_modelo,$reg_csv)];		
					$datos_grabar = ["id_marca"=>Obtener_IdMarca($Arreglo_marca,$reg_csv_marca)];
					$datos_grabar = ["id_periferico"=>Obtener_IdPeriferico($Arreglo_periferico,$reg_csv_perif)];
		
			 var_dump($datos_grabar);

			 print("<br>");


	/*
				
				while(($inv_it = fgetcsv($csv_file_it)) !== FALSE)
				{
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));
					if (!empty($inv_it[8]))
						{
							$valor = $inv_it[8];

							$exite_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
							// if (!empty($exite_prod))
							if (!$exite_prod)
							{
								print_r('Asset = '.$inv_it[0].' ');
								print_r('Current Hostname = '.$inv_it[4].' ');
								print_r('Kind = '.$inv_it[5].' ');						
								print_r('Brand  = '.$inv_it[6].' ');
								print_r('Modelo = '.$inv_it[7].' ');						
								print_r('Serial = '.$inv_it[8].' ');						
								print "<br>";
								$num_reg_no_existen++;
							}
							else
							{
								$num_reg_existen++;
							}

						}

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


				} //while(($inv_it = fgetcsv($csv_file_inv)) !== FALSE)

				print_r('<br>');
				print_r("Total de Registros Si Existen: ".$num_reg_existen);
				print_r("Total de Registros NO Existen: ".$num_reg_no_existen);

				fclose($csv_file_it);
*/

			} // if(is_uploaded_file($_FILES['file']['tmp_name']))

		} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))


?>