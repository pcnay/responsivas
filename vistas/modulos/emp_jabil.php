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

function Eliminar_Espacios($cadena)
{
  $sin_espacios = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $cadena);
  return $sin_espacios;
}

function Corregir_Cadena ($cadena_sinEspacios)
{
  
  // Para capturar los datos : $datos = array ("T?cnivo"=>'Técnico')
  // $datos["T?cnico"] -> Para accesar al elemento del arreglo.
  $salida = " ";
  $patron_busqueda = array(0 => "T?cnico",
                            1 => "Técnico",
                            2 => "Tecnico",
                            3 => "Técnico",
                            4 => "Producci?n",
                            5 => "Producción",
                            6 => "Automatizaci?n",
                            7 => "Automatización",
                            8 => "Automatizacion",
                            9 => "Automatización",
                            10 => "el?ctrica",
                            11 => "eléctrica",
                            12 => "El?ctrica",
                            13 => "Eléctrica",
                            14 => "electrica",
                            15 => "eléctrica",
                            16 => "Log?stica",
                            17 => "Logística",
                            18 => "L?der",
                            19 => "Líder",
                            20 => "Lider",
                            21 => "Líder",
                            22 => "Inspecci?n",
                            23 => "Inspección",
                            24 => "Ingenier?a",
                            25 => "Ingeniería",
                            26 => "Tecnolog?as",
                            27 => "Tecnologías",
                            28 => "Validaci?n",
                            29 => "Validación");
  
  $cambios_cadena = 'N';
  for ($i=0;$i<count($patron_busqueda);$i++)
  {
    // Determinando si existe la cadena
    if (str_contains($cadena_sinEspacios,$patron_busqueda[$i]))
    {
      $cadena = str_replace($patron_busqueda[$i],$patron_busqueda[$i+1],$cadena_sinEspacios);            
      $cambios_cadena = 'S';
    }

  } // for ($i=0;$i<count($patron_busqueda);$i++)

  if ($cambios_cadena === "N")
  {
    $cadena = $cadena_sinEspacios;
  }

  return $cadena;
}

// Buscar el Id del departamento.
function BuscarId_Depto($departamento_depurado)
{
  // Determinar si existe el Departamento.
  $valor = $departamento_depurado; 
  $item = "descripcion";
  $tabla = "t_Depto";
  
  $existe_depto = ModeloDeptos::mdlMostrarDeptos($tabla,$item,$valor);  
  if ($existe_depto)
  {
    $retornar_ntid = $existe_depto["id_depto"];
  }
  else
  {
    // Insertar el Depto.
    $datos=array();									
    $datos = array("nuevoDepto"=>$departamento_depurado);
    $nuevo_depto = ModeloDeptos::mdlIngresarDepto($tabla,$datos);  

    if ($nuevo_depto == "ok")
    {
      $existe_depto = ModeloDeptos::mdlMostrarDeptos($tabla,$item,$valor);  
      $retornar_ntid = $existe_depto["id_depto"];
    }
  
  }

  return $retornar_ntid;
}



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

        // Determinar si existe el empleado.
        $existe_emp = ModeloEmpleados::mdlMostrarEmpleados($tabla,$item,$valor,$orden);
        if ($existe_emp)
        {
          //echo "<br>";
          //echo "Existe empleado ".$valor;
          $emp_encontrado++;
        }
        else
        {
          echo "<br>";
          //echo "NO existe NTID Empleado ".$valor;
          //echo "Valor de -emp_jabil0 ".

          // Reemplazar el caracter "?" por "Ñ"
          $NombreCompleto = str_replace("?", "Ñ",$emp_jabil[0]);
          //echo $NombreCompleto;

          $nombre_separados = array();
          $nombre = "";
          $apellidos = "";
          
          //$nombre_separados = explode(" ",$emp_jabil[0]);
          // divide la frase mediante cualquier número de comas o caracteres de espacio,
          // lo que incluye " ", \r, \t, \n y \f
          //$nombre_separados = preg_split("/[\s,]+/", $NombreCompleto);

          // Eliminando los espacios dobles dentro de la cadena, y los extremos
          $cadena_sinEspacios =  Eliminar_Espacios($NombreCompleto);

          $nombre_separados = explode(" ",$cadena_sinEspacios);
          $num_cadenas = count($nombre_separados);
          switch ($num_cadenas)
          {
            case (2): 
              $nombre = $nombre_separados[0];
              $apellidos = $nombre_separados[1];  
              break;
            case (3):
              $nombre = $nombre_separados[0];
              $apellidos = $nombre_separados[1].' '.$nombre_separados[2];
              break;
            case (4):
              $nombre = $nombre_separados[0].' '.$nombre_separados[1];
              $apellidos = $nombre_separados[2].' '.$nombre_separados[3];
              break;
            case (5):
              $nombre = $nombre_separados[0].' '.$nombre_separados[1].' '.$nombre_separados[2];
              $apellidos = $nombre_separados[3].' '.$nombre_separados[4];
              break;
            case (6):
              $nombre = $nombre_separados[0].' '.$nombre_separados[1].' '.$nombre_separados[2].' '.$nombre_separados[3];
              $apellidos = $nombre_separados[4].' '.$nombre_separados[5];
              break;
            }

            // Eliminando los espacios de Numero de empleado 
            $NtId_depurado = Eliminar_Espacios($emp_jabil[2]);

            // Depurando el Puesto:
            // ? por ó(produccion, informacion) , í (ingenieria, tecnologias, lider), é (tecnico) 
            // Limpiar la cadena:
            $puesto_sinEspacios =  Eliminar_Espacios($emp_jabil[3]);
            //$puesto_separado = explode(" ",$cadena_sinEspacios);
            $puesto_depurado = Corregir_Cadena ($puesto_sinEspacios);
  
            $emp_Noencontrado++;         
            //echo "Nombre ".$nombre; 
            //echo "Apellidos ".$apellidos;
            
            // se debe obtener el numero de Departamento para poder grabarlo en la base de datos.
            $departamento_depurado = Eliminar_Espacios($emp_jabil[4]);
            $Id_Depto = BuscarId_Depto($departamento_depurado);
            
            echo "Nombre ".$nombre; 
            echo "Apellidos ".$apellidos;
            echo "NTID : ".$NtId_depurado;
            echo "Puesto : ".$puesto_depurado;
            echo "Departamento : ".$Id_Depto;

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