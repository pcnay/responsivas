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


// Obtener Supervisor
function BuscarSupervisor($depurar_supervisor)
{
  // Separar la cadena delimitada por "," para depurar.  
  $separar_renglon = explode(",",$depurar_supervisor);
  //echo "Indice 0 = ".$supervisor_separados[0];
  //echo "Indice 1 = ".$supervisor_separados[1];
  // Separar para obtener el nombre del supervisor que se deliminata con "="
  $obtener_supervisor = explode("=",$separar_renglon[0]);

  return $obtener_supervisor[1];
}

function Arreglar_fecha($depurar_fecha)
{
  $separar_fecha = explode(" ",$depurar_fecha);
  $fecha_editada = date("Y-m-d",strtotime($separar_fecha[0]));
  
  if ($separar_fecha[2] == "PM")
  {
    $separar_hora = explode(":",$separar_fecha[1]);
    switch ($separar_hora[0])
    {
      case (1): 
        $hora_formato24 = 13;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];
      break;
      case (2): 
        $hora_formato24 = 14;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (3): 
        $hora_formato24 = 15;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (4): 
        $hora_formato24 = 16;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (5): 
        $hora_formato24 = 17;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (6): 
        $hora_formato24 = 18;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (7): 
        $hora_formato24 = 19;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (8): 
        $hora_formato24 = 20;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (9): 
        $hora_formato24 = 21;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (10): 
        $hora_formato24 = 22;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (11): 
        $hora_formato24 = 23;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (12): 
        $hora_formato24 = 24;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
    }
  }// if ($separar_fecha[2] == "PM")

  if ($separar_fecha[2] == "AM")
  {
    $separar_hora = explode(":",$separar_fecha[1]);
    switch ($separar_hora[0])
    {
      case (1): 
        $hora_formato24 = 13;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];
      break;
      case (2): 
        $hora_formato24 = 14;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (3): 
        $hora_formato24 = 15;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (4): 
        $hora_formato24 = 16;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (5): 
        $hora_formato24 = 17;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (6): 
        $hora_formato24 = 18;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (7): 
        $hora_formato24 = 19;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (8): 
        $hora_formato24 = 20;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (9): 
        $hora_formato24 = 21;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (10): 
        $hora_formato24 = 22;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (11): 
        $hora_formato24 = 23;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (12): 
        $hora_formato24 = 24;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
    }
  }// if ($separar_fecha[2] == "PM")


  $fecha_editada = $fecha_editada." ".$hora;

  return $fecha_editada;
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


      // Revisando que no este vacio: "Correo Electronico", "Supervisor".
    if ((!empty($emp_jabil[5])) && (!empty($emp_jabil[6]))) 
      {
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
            $correo_electronico = Eliminar_Espacios($emp_jabil[5]);
            
            // Obtener el supervisor.
            $depurar_supervisor = Eliminar_Espacios($emp_jabil[6]);
            $supervisor = BuscarSupervisor($depurar_supervisor);
            //echo "Elemento 1 : ".$supervisor;

            // Grabar la fecha de creacion del usuario.
            $depurar_fecha = Eliminar_Espacios($emp_jabil[7]);
            $fecha_creacion = Arreglar_fecha($depurar_fecha);            
            
            echo "Fecha Editada = ".$fecha_creacion;
            /*
            echo "Nombre ".$nombre; 
            echo "Apellidos ".$apellidos;
            echo "NTID : ".$NtId_depurado;
            echo "Puesto : ".$puesto_depurado;
            echo "Departamento : ".$Id_Depto;
            echo "Correo Electronico : ".$correo_electronico;
            */
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