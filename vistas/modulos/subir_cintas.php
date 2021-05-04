<?php
	// Solo el administrador puede entrar a Reportes
	// Se realiza para que no entren desde la URL de la barra de direcciones
	if ($_SESSION["perfil"] == "Operador" || $_SESSION["perfil"] == "Supervisor")
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SUBIR ARCHIVOS CSV
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
							<input type="submit" class="btn btn-primary" name="import_data" value="IMPORT">
						</div>
					</form>
				</div>
  		</div>
		</div>	
  <!-- /.content-wrapper -->

<?php

		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
		{
			if(is_uploaded_file($_FILES['file']['tmp_name']))
			{
				$csv_file = fopen($_FILES['file']['tmp_name'], 'r');
				//fgetcsv($csv_file);
				// get data records from csv file
				while(($cinta_record = fgetcsv($csv_file)) !== FALSE)
				{
					// Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
					// $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));

						$fecha_inic = date("Y-m-d",strtotime($cinta_record[1]));
						$fecha_final = date("Y-m-d",strtotime($cinta_record[2]));
						$comentario_adic = $cinta_record[5];

						if ($cinta_record[1] == null || $cinta_record[1] == "" || strlen($cinta_record[1]) <= 6)
						{						
							$comentario_adic = $cinta_record[5].'       <===> Fecha Incompleta '.$cinta_record[1];
						}

						if ($cinta_record[2] == null || $cinta_record[2] == "" || strlen($cinta_record[2]) <= 6)
						{	
							if (strlen($cinta_record[1]) <= 6)					
							{
							}
							else
							{
								$comentario_adic = $cinta_record[5].'       <===> Fecha Incompleta '.$cinta_record[2];
							}
						}
						/*
						print_r('Serial = '.$cinta_record[0].' ');
						print_r('Fecha Inicial = '.$fecha_inic.' ');
						print_r('Fecha Final = '.$fecha_final.' ');						
						print_r('Ubicacion  = '.$cinta_record[4].' ');
						print_r('Comentarios = '.$comentario_adic.' ');						
						print "<br>";
						*/

						$tabla = "t_Cintas";

						$datos=array();									
						$datos = array("num_serial"=>$cinta_record[0],
														"fecha_inic"=>$fecha_inic,
														"fecha_final"=>$fecha_final,
														"ubicacion"=>$cinta_record[4],
														"comentarios"=>$comentario_adic);
	
						var_dump($datos);								

						//$respuesta = ModeloDeptos::mdlIngresarDepto($tabla,$datos);
	

				} //while(($cinta_record = fgetcsv($csv_file)) !== FALSE)

				fclose($csv_file);

			} // if(is_uploaded_file($_FILES['file']['tmp_name']))

		} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
				
?>