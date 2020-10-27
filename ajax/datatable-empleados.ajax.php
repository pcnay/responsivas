<?php
	// Para poder extraer los datos de la tabla de "empleados" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "empleados.php", se carga mucho después.

	require_once "../controladores/empleados.controlador.php";
	require_once "../modelos/empleados.modelo.php";

	require_once "../controladores/perifericos.controlador.php";
	require_once "../modelos/perifericos.modelo.php";

	require_once "../controladores/puestos.controlador.php";
	require_once "../modelos/puestos.modelo.php";

	require_once "../controladores/deptos.controlador.php";
	require_once "../modelos/deptos.modelo.php";

	require_once "../controladores/supervisores.controlador.php";
	require_once "../modelos/supervisores.modelo.php";

	require_once "../controladores/ubicaciones.controlador.php";
	require_once "../modelos/ubicaciones.modelo.php";

	class TablaEmpleados
	{
		// Mostrar la tabla de Empleados.
		public function mostrarTablaEmpleados()
		{
			// Extraer la información de la tabla.
			$item = null;
			$valor = null;
			$orden = "id_empleado";
			$empleados = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);

			//var_dump($productos);
			//return;
			//exit;

			 $datosJson = '{
				"data": [';
				for ($i =0;$i<count($empleados);$i++)
				{
					// Se obtiene la imagen del "Empleado", se pasa a variable para agregarlo al JSon.
					$imagen = "<img src='".$empleados[$i]["imagen"]."' width='40px'>";

					// se extrae el Puesto
					$item = "id_puesto";
					$valor = $empleados[$i]["id_puesto"];
					$puesto = ControladorPuestos::ctrMostrarPuestos($item,$valor);
					
					// se extrae el Depto
					$item = "id_depto";
					$valor = $empleados[$i]["id_depto"];
					$depto = ControladorDeptos::ctrMostrarDeptos($item,$valor);

					// se extrae el Supervisor
					$item = "id_supervisor";
					$valor = $empleados[$i]["id_supervisor"];
					$supervisor = ControladorSupervisores::ctrMostrarSupervisores($item,$valor);
					
					// se extrae la Ubicacion
					$item = "id_ubicacion";
					$valor = $empleados[$i]["id_ubicacion"];
					$ubicacion = ControladorUbicaciones::ctrMostrarUbicaciones($item,$valor);

					// $imagen = "<img src='/vistas/img/empleados/101/105.png' width='40px'>";
					// Se utilizan estos datos para pasarlos con Ajax a las funciones de JavaScript para obtener la información del "Empleado" 
					// se agrega btnEditarEmpleado" = Boton para editar 
					// idEmpleado='".$Empleado[$i]["id_empleado"]."' para editar el empleado.
					// data-toggle='modal' = Para desplegar una ventanta Modal.
					// data-target='#modalEditarEmpleado' = Pantalla para editar los productos 
					// btnEliminarEmpleado= Boton para eliminar Empleado
					// idEmpleado='".$empleado[$i]["id_empleado"]."' = Para obtener el Nt Id del Empleado
					// imagen='".$empleado[$i]["imagen"]."' = Para obtener la ruta de la imagen.

					// Esta parte se utiliza las variables de sesion en DataTable.
					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial")
					{
						$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarEmpleado' idEmpleado='".$empleados[$i]["id_empleado"]."' data-toggle='modal' data-target='#modalEditarEmpleado'><i class='fa fa-pencil'></i></button>";
					}
					else
					{
						// se extrae los datos utilizados para el boton de "Editar" y "Borrar"
						$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarEmpleado' idEmpleado='".$empleados[$i]["id_empleado"]."' data-toggle='modal' data-target='#modalEditarEmpleado'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarEmpleado' idEmpleado='".$empleados[$i]["id_empleado"]."' apellido ='".$empleados[$i]["apellidos"]."' imagen='".$empleados[$i]["imagen"]."' ><i class='fa fa-times'></i></button></div>";
					}					

					$datosJson  .= '[
							"'.($i+1).'",
							"'.$imagen.'",
							"'.$empleados[$i]["ntid"].'",
							"'.$empleados[$i]["nombre"].'",
							"'.$empleados[$i]["apellidos"].'",
							"'.$empleados[$i]["correo_electronico"].'",
							"'.$puesto["descripcion"].'",
							"'.$depto["descripcion"].'",
							"'.$supervisor["descripcion"].'",
							"'.$empleados[$i]["centro_costo"].'",							
							"'.$botones.'"
						],';
				}
				// Una vez que se termina el ciclo, al final de la cadena "$datosJson" se le elimina ","
				$datosJson = substr($datosJson,0,-1);
				$datosJson .=	']}';

			echo  $datosJson;

			//return; // para que no continue la ejecución.


			// Se utilizan las variables de PHP para no romper la cadena en el JSON.
		 
		} // public function mostrarTablaEmpleados()

	} // class TablaEmpleados

	// Activar la tabla de Empleados.
	$activarEmpleados = new TablaEmpleados();
	$activarEmpleados->mostrarTablaEmpleados();


?>