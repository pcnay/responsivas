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
				$num_reg = 0;
				$tabla = "t_Productos";
				$item = "num_serie";
				$orden = 'nombre';
				while(($inv_it = fgetcsv($csv_file_it)) !== FALSE)
				{
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));
					if (!empty($inv_it[8]))
						{
							$valor = $inv_it[8];
							$exite_prod = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor,$orden);
							// if (!empty($exite_prod))
							if ($exite_prod)
							{
								print_r('Asset = '.$inv_it[0].' ');
								print_r('Current Hostname = '.$inv_it[4].' ');
								print_r('Kind = '.$inv_it[5].' ');						
								print_r('Brand  = '.$inv_it[6].' ');
								print_r('Modelo = '.$inv_it[7].' ');						
								print_r('Serial = '.$inv_it[8].' ');						
								print "<br>";
								$num_reg++;
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
*/

				} //while(($inv_it = fgetcsv($csv_file_inv)) !== FALSE)

				print_r('<br>');
				print_r("Total de Registros : ".$num_reg);

				fclose($csv_file_it);


			} // if(is_uploaded_file($_FILES['file']['tmp_name']))

		} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		
?>