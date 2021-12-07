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

function Obtener_nombre_apellidos($emp_jabil)
{
  //echo "NO existe NTID Empleado ".$valor;
  //echo "Valor de -emp_jabil0 ".
  
  // Reemplazar el caracter "?" por "Ñ"
  $NombreCompleto = str_replace("?", "Ñ",$emp_jabil);
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
  $nombreCompleto = Array();
  switch ($num_cadenas)
  {
    case (2): 
      $nombre = $nombre_separados[0];
      $apellidos = $nombre_separados[1];  
      $nombreCompleto = Array("nombre" =>$nombre,
                            "apellidos" => $apellidos);
      break;
    case (3):
      $nombre = $nombre_separados[0];
      $apellidos = $nombre_separados[1].' '.$nombre_separados[2];
      $nombreCompleto = Array("nombre" =>$nombre,
                            "apellidos" => $apellidos);
      break;
    case (4):
      $nombre = $nombre_separados[0].' '.$nombre_separados[1];
      $apellidos = $nombre_separados[2].' '.$nombre_separados[3];
      $nombreCompleto = Array("nombre" =>$nombre,
                            "apellidos" => $apellidos);
      break;
    case (5):
      $nombre = $nombre_separados[0].' '.$nombre_separados[1].' '.$nombre_separados[2];
      $apellidos = $nombre_separados[3].' '.$nombre_separados[4];
      $nombreCompleto = Array("nombre" =>$nombre,
                            "apellidos" => $apellidos);
      break;
    case (6):
      $nombre = $nombre_separados[0].' '.$nombre_separados[1].' '.$nombre_separados[2].' '.$nombre_separados[3];
      $apellidos = $nombre_separados[4].' '.$nombre_separados[5];
      $nombreCompleto = Array("nombre" =>$nombre,
                            "apellidos" => $apellidos);
      break;
  }

  return $nombreCompleto;
} // Obtener_nombre_apellidos($emp_jabil)


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

// Obtener el Id Puesto.
function Obtener_Puesto($puesto_depurado)
{


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

  // $obtener_supervisor[1] = Es el nombre y apellido, contenplar que algunas veces tienen números los apellidos.
  // Por lo que se debe eliminar los numeros, para que la busqueda sea efectiva.
  $nombre_supervisor = preg_replace('/[0-9]+/', '', $obtener_supervisor[1]);
  //echo "<br>";
  //echo "Supervisor Extraido : ".$obtener_supervisor[1]." -> ";
  //echo "Supervisor Sin Numeros : ".$nombre_supervisor." -> ";

  $tabla = "t_Supervisor";
  $existe_supervisor = ModeloSupervisores::mdlObtenerId_Super($tabla,$nombre_supervisor);
  
  //print_r($existe_supervisor);
  $id_Supervisor = " ";

  if ($existe_supervisor)
  {
    $Id_Supervisor = $existe_supervisor["id_supervisor"];
  }
  else
  {
    // Agregar el supervisor, se tiene que agregar con los numeros como esta en el Active Directory.
    $datos = Array("descripcion"=>$obtener_supervisor[1]);
    $tabla = "t_Supervisor";

    //$supervisor_ingresado = ModeloSupervisores::mdlIngresarSupervisor($tabla,$datos);
    if ($supervisor_ingresado == "ok")
    {
      $Id_Supervisor = "Ingresado a la Tabla de Supervisores";
    }
    else
    {
      $Id_Supervisor = "Error Al Grabar el Supervisor ";
    }

  }

  return $Id_Supervisor;
}

function Arreglar_fecha($depurar_fecha)
{
  $separar_fecha = explode(" ",$depurar_fecha);
  $fecha_editada = date("Y-m-d",strtotime($separar_fecha[0]));
  $hora = "";
  
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
        $hora_formato24 = 1;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];
      break;
      case (2): 
        $hora_formato24 = 2;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (3): 
        $hora_formato24 = 3;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (4): 
        $hora_formato24 = 4;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (5): 
        $hora_formato24 = 5;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (6): 
        $hora_formato24 = 6;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (7): 
        $hora_formato24 = 7;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (8): 
        $hora_formato24 = 8;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (9): 
        $hora_formato24 = 9;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (10): 
        $hora_formato24 = 10;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (11): 
        $hora_formato24 = 11;
        $hora = $hora_formato24.":".$separar_hora[1].":".$separar_hora[2];       
      break;
      case (12): 
        $hora_formato24 = 12;
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
          $emp_Noencontrado++;
          echo "<br>";

          // Obtener el Nombre y Apellidos del Empleado
          $nombre_apellidos = Obtener_nombre_apellidos($emp_jabil[0]);
          $Nombre = $nombre_apellidos["nombre"];
          $Apellidos = $nombre_apellidos["apellidos"];      

          // Eliminando los espacios de Numero de empleado 
          $NtId_depurado = Eliminar_Espacios($emp_jabil[2]);

          // Depurando el Puesto:
          // ? por ó(produccion, informacion) , í (ingenieria, tecnologias, lider), é (tecnico) 
          // Limpiar la cadena:
          $puesto_sinEspacios =  Eliminar_Espacios($emp_jabil[3]);
          //$puesto_separado = explode(" ",$cadena_sinEspacios);
          $puesto_depurado = Corregir_Cadena ($puesto_sinEspacios);
          $Id_Puesto = Obtener_Puesto($puesto_depurado);

          
          // se debe obtener el numero de Departamento para poder grabarlo en la base de datos.
          $departamento_depurado = Eliminar_Espacios($emp_jabil[4]);
          $Id_Depto = BuscarId_Depto($departamento_depurado);

          // Depurando el correo eléctronico
          $correo_electronico = Eliminar_Espacios($emp_jabil[5]);
          
          // Asignar un supervisor Base, posteriormente se asignara el supevisor con el nombre completo.
          //$depurar_supervisor = Eliminar_Espacios($emp_jabil[6]);
          //$supervisor = BuscarSupervisor($depurar_supervisor);
          // Supervisor Base (tendra el valor de 81[cloud Google], 83[miportalweb.org])

          $supervisor = 81;
          
          // Grabar la fecha de creacion del usuario.
          $depurar_fecha = Eliminar_Espacios($emp_jabil[7]);
          $fecha_creacion = Arreglar_fecha($depurar_fecha);            
          $ubicacion = 4; // Mezanine

          // Se asigna a un arreglo para grabarlos a la tabla:
          $datos_grabar = Array();
          $datos_grabar = Array(
            "id_ubicacion" => $ubicacion,            
            "id_puesto" => $ubicacion,

            ""
                      );
          echo "Nombre ".$Nombre; 
          echo "Apellidos ".$Apellidos;

          //echo "Fecha Editada = ".$fecha_creacion;
          /*
          echo "Nombre ".$nombre; 
          echo "Apellidos ".$apellidos;
          echo "NTID : ".$NtId_depurado;
          echo "Puesto : ".$puesto_depurado;
          echo "Departamento : ".$Id_Depto;
          echo "Correo Electronico : ".$correo_electronico;
          echo "Fecha Editada = ".$fecha_creacion;
          */
        }

      } // if ((!empty($emp_jabil[5])) && (!empty($emp_jabil[6]))) 

    } //while(($inv_it = fgetcsv($csv_file_inv)) !== FALSE)

    fclose($csv_file_emp);

    print_r('<br>');
    print_r("Empleados Existentes =  ".$emp_encontrado);
    print_r('<br>');
    print_r("Empleados NO Existentes = ".$emp_Noencontrado);

  } // if(is_uploaded_file($_FILES['file']['tmp_name']))

} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))


?>