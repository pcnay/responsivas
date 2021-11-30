  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SUBIR EMPLEADOS JABIL
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
							<input type="submit" class="btn btn-primary" name="import_emp" value="IMPORTAR">
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
    $csv_file_emp = fopen($_FILES['file']['tmp_name'], 'r');
    //fgetcsv($csv_file);
    // get data records from csv file
    
    $datos_grabar = array();
    
    $emp_encontrado = 0;
    $emp_Noencontrado = 0;
    $ruta = "vistas/img/empleados/default/anonymous.png";

    while(($emp_jabil = fgetcsv($csv_file_emp)) !== FALSE)
    {
      // **** Para subir el inventario de IT
            
      // Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
      // $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));


      // Revisando si el Serial esta vacio.
      if (!empty($emp_jabil[0]) || ($emp_jabil[3] != "Ensamblador I") || ($emp_jabil[3] != "Ensamblador II") || ($emp_jabil[3] != "Ensamblador Maestro")) 
      {
        //echo "Serial No vacio";

        //print_r ("Procesando registro .. \n ".$contador);

        $valor = strtoupper(trim($emp_jabil[2])); // Eliminando ambos espacios, Numero de Empleado "NTID"
        $item = "ntid";
        $tabla = "t_Empleados";
        $orden = "nombre";

        // Descomentar para que detemrine si existe el producto.
        $existe_emp = ModeloEmpleados::mdlMostrarEmpleados($tabla,$item,$valor,$orden);
        if ($existe_emp)
        {
          echo "<br>";
          echo "Existe empleado ".$valor;
          $emp_encontrado++;
        }
        else
        {
          echo "<br>";
          echo "NO existe NTID Empleado ".$valor;
          $emp_Noencontrado++;          
        }

      } // if (!empty($emp_jabil[0]) || ($emp_jabil[3] != "Ensamblador I") || ($emp_jabil[3] 

    } //while(($inv_it = fgetcsv($csv_file_inv)) !== FALSE)

    fclose($csv_file_emp);

    print_r('<br>');
    print_r("Empleados Existentes =  ".$emp_encontrado);
    print_r('<br>');
    print_r("Empleados NO Existentes = ".$emp_Noencontrado);

  } // if(is_uploaded_file($_FILES['file']['tmp_name']))

} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))


?>