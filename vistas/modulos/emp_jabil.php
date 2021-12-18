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

function ObtenerCadena_Correcta($cadena_error)
{
  switch ($cadena_error)
  {
    case "T?cnico":
      $cadena_corregida = "Técnico";
      break;
    case "Tecnico":
      $cadena_corregida = "Técnico";
      break;
    case "Producci?n":
      $cadena_corregida = "Producción";
      break;
    case "Automatizaci?n":
      $cadena_corregida = "Automatización";
      break;
    case "Automatizacion":
      $cadena_corregida = "Automatización";
      break;
    case "el?ctrica":
      $cadena_corregida = "eléctrica";
      break;
    case "El?ctrica":
      $cadena_corregida = "Eléctrica";
      break;
    case "electrica":
      $cadena_corregida = "eléctrica";
      break;
    case "Log?stica":
      $cadena_corregida = "Logística";
      break;
    case "L?der":
      $cadena_corregida = "Líder";
      break;
    case "Lider":
      $cadena_corregida = "Líder";
      break;
    case "L?ider":
      $cadena_corregida = "Líder";
      break;
    case "Inspecci?n":
      $cadena_corregida = "Inspección";
      break;
    case "ingenier?a":
      $cadena_corregida = "Ingeniería";
      break;
    case "Ingenier?a":
      $cadena_corregida = "Ingeniería";
      break;
    case "Tecnolog?as":
      $cadena_corregida = "Tecnologías";
      break;
    case "Validaci?n":
      $cadena_corregida = "Validación";
      break;
    case "Planeaci?n":
      $cadena_corregida = "Planeación";
      break;
  } // switch ($cadena_error)
 
  return $cadena_corregida;

} // function ObtenerCadena_Correcta($cadena_error)


function Corregir_Cadena ($cadena_sinEspacios)
{
  
  // Para capturar los datos : $datos = array ("T?cnivo"=>'Técnico')
  // $datos["T?cnico"] -> Para accesar al elemento del arreglo.
  $salida = " ";
  $patron_busqueda = array
      (0 => "T?cnico",
      1 => "Tecnico",      
      2 => "Producci?n",      
      3 => "Automatizaci?n",      
      4 => "Automatizacion",      
      5 => "el?ctrica",      
      6 => "El?ctrica",      
      7 => "electrica",      
      8 => "Log?stica",
      9 => "L?der",      
      10 => "Lider",      
      11 => "Inspecci?n",      
      12 => "Ingenier?a",      
      13 => "Tecnolog?as",      
      14 => "Validaci?n",      
      15 => "Planeaci?n",      
      16 => "ingenier?a",
      17 => "L?ider");

  $cambios_cadena = 'N';
  $cadena = $cadena_sinEspacios;

  for ($i=0;$i<count($patron_busqueda);$i++)
  {
    // Determinando si existe la cadena
    // Separando la cadena en partes para revisar cada una de ellas si tiene el signo "?"  
    $texto_separados = explode(" ",$cadena_sinEspacios);   

    for ($k=0;$k<count($texto_separados);$k++)
    {
      if (!function_exists('str_contains'))
      {
        function str_contains($haystack, $needle)
        {
         return $needle !== '' && mb_strpos($haystack, $needle) !== false;
        }
      }
            
      if (str_contains($cadena_sinEspacios,$patron_busqueda[$i]))
      {
        $cadena = str_replace($patron_busqueda[$i],ObtenerCadena_Correcta($patron_busqueda[$i]),$cadena_sinEspacios);    $cadena_sinEspacios = $cadena;
      }   
    } 
  } // for ($i=0;$i<count($patron_busqueda);$i++)

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
    case (7):
      $nombre = $nombre_separados[0].' '.$nombre_separados[1].' '.$nombre_separados[2];
      $apellidos = $nombre_separados[3];$nombre_separados[4].' '.$nombre_separados[5].' '.$nombre_separados[6];
      $nombreCompleto = Array("nombre" =>$nombre,
                            "apellidos" => $apellidos);
      break;
    default:
      $nombre = null;
      $apellidos = null;
      $nombreCompleto = Array("nombre" =>$nombre,
      "apellidos" => $apellidos);

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
  // "$puesto_depurado" = Es el nombre completo de puesto.
  // Buscar por nombre de puesto, si no existe agregarlo, posteriormente se hará una depuración de nombre similares.
  $tabla = "t_Puesto";
  $item = "descripcion";
  $valor = $puesto_depurado;

  $Puesto = ModeloPuestos::mdlMostrarPuestos($tabla,$item,$valor);

  if ($Puesto == null)
  {
    // $Descrip_puesto = "NO se encontro puesto";
    $tabla = "t_Puesto";
    $datos = Array();									
    $datos = Array("nuevoPuesto"=>$puesto_depurado);
    $Alta_puesto = ModeloPuestos::mdlIngresarPuesto($tabla,$datos);

    $item = "descripcion";
    $valor = $puesto_depurado;
    $Obtener_Puesto = ModeloPuestos::mdlMostrarPuestos($tabla,$item,$valor);
    $Id_Puesto = $Obtener_Puesto["id_puesto"];
    //echo "<br>";
    //echo "Se grabo Id Puesto";
  }
  else
  {
    $Id_Puesto = $Puesto["id_puesto"];
  }

  return $Id_Puesto;
}

function ObtenerCorreoElect($depurar_supervisor)
{  
  // Separar la cadena delimitada por "," para depurar.  
  $separar_renglon = explode(",",$depurar_supervisor);
  //echo "Indice 0 = ".$separar_renglon[0];
  //echo "Indice 1 = ".$separar_renglon[1];

  // Separar para obtener el nombre del supervisor que se deliminata con "="
  $obtener_supervisor = explode("=",$separar_renglon[0]);
  //echo "Indice 0 = ".$obtener_supervisor[0];
  //echo "Indice 1 = ".$obtener_supervisor[1];


  // Agregar el caracter "_" a la cadena.
  
  $supervisor_reemplazar_caracter = str_replace(" ", "_",$obtener_supervisor[1]);
  
  //print_r($supervisor_reemplazar_caracter);

  $supervisor_correoElect = $supervisor_reemplazar_caracter."@jabil.com";

  // $obtener_supervisor[1] = Es el nombre y apellido, contenplar que algunas veces tienen números los apellidos.
  // Por lo que se debe eliminar los numeros, para que la busqueda sea efectiva.
  // $nombre_supervisor = preg_replace('/[0-9]+/', '', $obtener_supervisor[1]);
  
  return $supervisor_correoElect;
}

// Obtener Supervisor
function BuscarSupervisor($depurar_supervisor)
{
  $Id_Supervisor = "";

  // Obtener Correo Electrónico.
  $correo_elect = ObtenerCorreoElect($depurar_supervisor);
   
  $tabla = "t_Empleados";
  $item = "correo_electronico";
  $valor = $correo_elect;
  $orden = "apellidos";
  $existe_empleado = ModeloEmpleados::mdlMostrarEmpleados($tabla,$item,$valor,$orden);
      
  if ($existe_empleado)
  {
    //echo "<br>";
    //echo "Encontro el Empleado".' '.$existe_empleado["nombre"].' '.$existe_empleado["apellidos"];
    //$Id_Supervisor = $existe_supervisor["id_supervisor"];
    $Nombre_completo = $existe_empleado["nombre"].' '.$existe_empleado["apellidos"];

    // Buscar el Supervisor.
    $tabla = "t_Supervisor";
    $item = "descripcion";
    $valor = $Nombre_completo;
    
    $buscar_supervisor = ModeloSupervisores::mdlMostrarSupervisores($tabla,$item,$valor);

    if ($buscar_supervisor)
    {
      //echo "Encontro Supervisor ";
      $Id_Supervisor = $buscar_supervisor["id_supervisor"]; //.' '.$buscar_supervisor["descripcion"];
    }
    else
    {
      //echo "Grabar Supervisor ";
      // Grabar Supervisor:
      $tabla = "t_Supervisor";
      $datos = Array();
      $datos = Array("nuevoSupervisor"=>$valor);
      $grabar_supervisor = ModeloSupervisores::mdlIngresarSupervisor($tabla,$datos);

      if ($grabar_supervisor)
      {
        // Buscar el Supervisor.
        $tabla = "t_Supervisor";
        $item = "descripcion";
        $valor = $Nombre_completo;     
    
        $buscar_supervisor = ModeloSupervisores::mdlMostrarSupervisores($tabla,$item,$valor);
        if ($buscar_supervisor)
        {
          $Id_Supervisor = $buscar_supervisor["id_supervisor"]; //.' '.$buscar_supervisor["descripcion"];
        }

      } // if ($grabar_supervisor)
      else
      {
        echo "<br>";
        echo "Error al Grabar el Supervisor";
      }

      // Buscar el Supervisor.
      /*
      $tabla = "t_Supervisor";
      $item = "descripcion";
      $valor = $Nombre_completo;
    
      $buscar_supervisor = ModeloSupervisores::mdlMostrarSupervisores($tabla,$item,$valor);
      $Id_Supervisor = $buscar_supervisor["id_supervisor"];
      */

    }
  }
  else
  {
    echo "<br>";
    echo "NO se encuentra el Supervisor : ".$correo_elect;
  }
 
  return $Id_Supervisor;
}

function Arreglar_fecha($depurar_fecha)
{
  $separar_fecha = explode(" ",$depurar_fecha);
  $fecha_editada = date("Y-m-d",strtotime($separar_fecha[0]));
  $hora = "";
  
  if (count($separar_fecha) == 2)
  {
    $hora = $separar_fecha[1];
  }
  else
  {
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
          $hora_formato24 = 00;
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

  } // else   if (count($separar_fecha) == 2)

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
    
    echo " TRABAJANDO .............. ";
    
    while(($emp_jabil = fgetcsv($csv_file_emp)) !== FALSE)
    {
      // **** Para subir el inventario de IT
            
      // Para convertirlo a forma de "YYYY-MM-DD" para poderlo gabar en MySQL.
      // $fecha_inicio = date("Y-m-d",strtotime($cinta_record[1]));


      // Revisando que no este vacio: "Correo Electronico", "Supervisor".
    if ((!empty($emp_jabil[5])) && (!empty($emp_jabil[6])) && ($emp_jabil[0] != "extensionAttribute14")) 
      {
        // strtoupper = Convierte el texto a Mayusculas.
        $valor = trim($emp_jabil[2]); // Eliminando ambos espacios, Numero de Empleado "NTID"
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
          if (!empty($emp_jabil[0]))
          {
            $nombre_apellidos = Obtener_nombre_apellidos($emp_jabil[0]);
          
            $Nombre = $nombre_apellidos["nombre"];
            $Apellidos = $nombre_apellidos["apellidos"];      
          }
          else
          {
            $Nombre = "Usuario SVC";
            $Apellidos = "Usuario SVC";
          }

          // Eliminando los espacios de Numero de empleado 
          $NtId_depurado = Eliminar_Espacios($emp_jabil[2]);

          // Depurando el Puesto:
          // ? por ó(produccion, informacion) , í (ingenieria, tecnologias, lider), é (tecnico) 
          // Limpiar la cadena:
          $puesto_sinEspacios =  Eliminar_Espacios($emp_jabil[3]);
          //$puesto_separado = explode(" ",$cadena_sinEspacios);
          $puesto_depurado = Corregir_Cadena ($puesto_sinEspacios);
          //echo "Num Emp : ".$NtId_depurado." Nombre Puesto : ".$puesto_depurado;

          $Id_Puesto = Obtener_Puesto($puesto_depurado);
          //echo "Puesto : ".$Id_Puesto;
          
          // se debe obtener el numero de Departamento para poder grabarlo en la base de datos.
          $departamento_depurado = Eliminar_Espacios($emp_jabil[4]);
          $Id_Depto = BuscarId_Depto($departamento_depurado);


          // Depurando el correo eléctronico
          $correo_electronico = Eliminar_Espacios($emp_jabil[5]);
                  
          // Grabar la fecha de creacion del usuario.
          //$depurar_fecha = Eliminar_Espacios($emp_jabil[7]);
          //$fecha_creacion = Arreglar_fecha($depurar_fecha);            
          $ubicacion = 4; // Mezanine
          $centro_costos = 29; // Philips, generico después corregir.

          // Obtener el nombre completo del Supervisor.
          // Se extrae parte del nombre ya que contiene el su correo, solo se tiene que separar de la cadena y agregar el caracter "_". 


          //Antes de Grabar el supervisor, se debe grabar como "Empleado" el supervisor para después obtener su nombre completo y grabarlo en la tabla de "t_Supervisor"

          // Asignar un supervisor Base, posteriormente se asignara el supevisor con el nombre completo.
          // Supervisor Base (tendra el valor de 81[cloud Google], 83[miportalweb.org])
          //$supervisor = 81;

          //$depurar_supervisor = Eliminar_Espacios($emp_jabil[6]);
          //$supervisor = BuscarSupervisor($depurar_supervisor);
          $supervisor = 83;

          // Se asigna a un arreglo para grabarlos a la tabla de Empleados
          $datos_grabar = Array();
          $datos_grabar = Array(
                          "id_puesto" =>$Id_Puesto,
                          "id_depto" =>$Id_Depto,
                          "id_supervisor" =>$supervisor,
                          "id_ubicacion" =>$ubicacion,
                          "id_centro_costos" =>$centro_costos,
                          "nombre" =>$Nombre,
                          "apellidos" =>$Apellidos,
                          "ntid" =>$NtId_depurado,
                          "correo_electronico" =>$correo_electronico,
                          "imagen" =>$ruta);

          // Antes de grabar el "Empleado", verificar si existe.
          // NO es necesario validar ya que inicialmente se valido si existia el "Empleado"
          /*
          $tabla = "t_Empleados";
          $item = "correo_electronico";
          $valor = $datos_grabar["correo_electronico"];
          $orden = "apellidos";
          $existe_empleado = ModeloEmpleados::mdlMostrarEmpleados($tabla,$item,$valor,$orden);
              
          if (!$existe_empleado)
          {        
            $respuesta = ModeloEmpleados::mdlIngresarEmpleado($tabla,$datos);          
          }
          */

          $respuesta = ModeloEmpleados::mdlIngresarEmpleado($tabla,$datos_grabar);          
          
          if ($respuesta == "ok")
          {
            //echo "Se grabo el Empleado ";
            //$depurar_supervisor = Eliminar_Espacios($emp_jabil[6]);
            //$supervisor = BuscarSupervisor($depurar_supervisor);            
          }
          else
          {
            echo "Error al Grabar el empleado";
          }          

        }  // else - if ($existe_emp)

      } // if ((!empty($emp_jabil[5])) && (!empty($emp_jabil[6]))) 

    } //while(($inv_it = fgetcsv($csv_file_inv)) !== FALSE)

    fclose($csv_file_emp);


    // De nuevo se ejecuta para asignar el supervisor.
    $csv_file_emp = fopen($_FILES['file']['tmp_name'], 'r');
    //fgetcsv($csv_file);
    // get data records from csv file

    while(($emp_jabil = fgetcsv($csv_file_emp)) !== FALSE)
    {
      if ((!empty($emp_jabil[5])) && (!empty($emp_jabil[6])) && ($emp_jabil[0] != "extensionAttribute14")) 
      {
        // Grabar el supervisor que les corresponde al Empleado.
        $depurar_supervisor = Eliminar_Espacios($emp_jabil[6]);
        $id_Supervisor = BuscarSupervisor($depurar_supervisor);

        $tabla = "t_Empleados";
        $item1 = "id_supervisor";        
        $valor1 = $id_Supervisor;         
        $valor2 = Eliminar_Espacios($emp_jabil[2]); // NtId

        // Si Id del Supervisor esta vacio, no actualize el valor.
        if (!empty($valor1))
        {
          $respuesta = ModeloEmpleados::mdlActualizarEmpCampo($tabla,$item1,$valor1,$valor2);
        }

        // Falta asignar la fecha de creación.
        $tabla = "t_Empleados";
        $item1 = "fecha";
        $depurar_fecha = Eliminar_Espacios($emp_jabil[7]);
        $valor1 = Arreglar_fecha($depurar_fecha); // Fecha con formato para Bd.
        //echo "Fecha Desplegada : ".$valor1;
        $valor2 = Eliminar_Espacios($emp_jabil[2]); // NtId
        $respuesta = ModeloEmpleados::mdlActualizarEmpCampo($tabla,$item1,$valor1,$valor2);

        if ($respuesta == "ok")
        {
          //echo "Fecha grabada ";
        }

      } // if ((!empty($emp_jabil[5])) && (!empty($emp_jabil[6]))) 

    } // while(($emp_jabil = fgetcsv($csv_file_emp)) !== FALSE)

    fclose($csv_file_emp);



    print_r('<br>');
    print_r("Empleados Existentes =  ".$emp_encontrado);
    print_r('<br>');
    print_r("Empleados NO Existentes = ".$emp_Noencontrado);

  } // if(is_uploaded_file($_FILES['file']['tmp_name']))

} //if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))


?>