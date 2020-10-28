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
			// https://datatables.net/examples/ajax/simple.html
			// donde se toman los ejercicios para el uso de DataTable.

			echo '{
				"data": [
					[
						"Tiger Nixon",
						"System Architect",
						"Edinburgh",
						"5421",
						"2011/04/25",
						"$320,800"
					],
					[
						"Garrett Winters",
						"Accountant",
						"Tokyo",
						"8422",
						"2011/07/25",
						"$170,750"
					],
					[
						"Ashton Cox",
						"Junior Technical Author",
						"San Francisco",
						"1562",
						"2009/01/12",
						"$86,000"
					],
					[
						"Cedric Kelly",
						"Senior Javascript Developer",
						"Edinburgh",
						"6224",
						"2012/03/29",
						"$433,060"
					],
					[
						"Airi Satou",
						"Accountant",
						"Tokyo",
						"5407",
						"2008/11/28",
						"$162,700"
					],
					[
						"Brielle Williamson",
						"Integration Specialist",
						"New York",
						"4804",
						"2012/12/02",
						"$372,000"
					],
					[
						"Herrod Chandler",
						"Sales Assistant",
						"San Francisco",
						"9608",
						"2012/08/06",
						"$137,500"
					],
					[
						"Rhona Davidson",
						"Integration Specialist",
						"Tokyo",
						"6200",
						"2010/10/14",
						"$327,900"
					],
					[
						"Colleen Hurst",
						"Javascript Developer",
						"San Francisco",
						"2360",
						"2009/09/15",
						"$205,500"
					],
					[
						"Sonya Frost",
						"Software Engineer",
						"Edinburgh",
						"1667",
						"2008/12/13",
						"$103,600"
					],
					[
						"Jena Gaines",
						"Office Manager",
						"London",
						"3814",
						"2008/12/19",
						"$90,560"
					],
					[
						"Quinn Flynn",
						"Support Lead",
						"Edinburgh",
						"9497",
						"2013/03/03",
						"$342,000"
					],
					[
						"Charde Marshall",
						"Regional Director",
						"San Francisco",
						"6741",
						"2008/10/16",
						"$470,600"
					],
					[
						"Haley Kennedy",
						"Senior Marketing Designer",
						"London",
						"3597",
						"2012/12/18",
						"$313,500"
					],
					[
						"Tatyana Fitzpatrick",
						"Regional Director",
						"London",
						"1965",
						"2010/03/17",
						"$385,750"
					],
					[
						"Michael Silva",
						"Marketing Designer",
						"London",
						"1581",
						"2012/11/27",
						"$198,500"
					],
					[
						"Paul Byrd",
						"Chief Financial Officer (CFO)",
						"New York",
						"3059",
						"2010/06/09",
						"$725,000"
					],
					[
						"Gloria Little",
						"Systems Administrator",
						"New York",
						"1721",
						"2009/04/10",
						"$237,500"
					],
					[
						"Bradley Greer",
						"Software Engineer",
						"London",
						"2558",
						"2012/10/13",
						"$132,000"
					],
					[
						"Dai Rios",
						"Personnel Lead",
						"Edinburgh",
						"2290",
						"2012/09/26",
						"$217,500"
					],
					[
						"Jenette Caldwell",
						"Development Lead",
						"New York",
						"1937",
						"2011/09/03",
						"$345,000"
					],
					[
						"Yuri Berry",
						"Chief Marketing Officer (CMO)",
						"New York",
						"6154",
						"2009/06/25",
						"$675,000"
					],
					[
						"Caesar Vance",
						"Pre-Sales Support",
						"New York",
						"8330",
						"2011/12/12",
						"$106,450"
					],
					[
						"Doris Wilder",
						"Sales Assistant",
						"Sydney",
						"3023",
						"2010/09/20",
						"$85,600"
					],
					[
						"Angelica Ramos",
						"Chief Executive Officer (CEO)",
						"London",
						"5797",
						"2009/10/09",
						"$1,200,000"
					],
					[
						"Gavin Joyce",
						"Developer",
						"Edinburgh",
						"8822",
						"2010/12/22",
						"$92,575"
					],
					[
						"Jennifer Chang",
						"Regional Director",
						"Singapore",
						"9239",
						"2010/11/14",
						"$357,650"
					],
					[
						"Brenden Wagner",
						"Software Engineer",
						"San Francisco",
						"1314",
						"2011/06/07",
						"$206,850"
					],
					[
						"Fiona Green",
						"Chief Operating Officer (COO)",
						"San Francisco",
						"2947",
						"2010/03/11",
						"$850,000"
					],
					[
						"Shou Itou",
						"Regional Marketing",
						"Tokyo",
						"8899",
						"2011/08/14",
						"$163,000"
					],
					[
						"Michelle House",
						"Integration Specialist",
						"Sydney",
						"2769",
						"2011/06/02",
						"$95,400"
					],
					[
						"Suki Burks",
						"Developer",
						"London",
						"6832",
						"2009/10/22",
						"$114,500"
					],
					[
						"Prescott Bartlett",
						"Technical Author",
						"London",
						"3606",
						"2011/05/07",
						"$145,000"
					],
					[
						"Gavin Cortez",
						"Team Leader",
						"San Francisco",
						"2860",
						"2008/10/26",
						"$235,500"
					],
					[
						"Martena Mccray",
						"Post-Sales support",
						"Edinburgh",
						"8240",
						"2011/03/09",
						"$324,050"
					],
					[
						"Unity Butler",
						"Marketing Designer",
						"San Francisco",
						"5384",
						"2009/12/09",
						"$85,675"
					],
					[
						"Howard Hatfield",
						"Office Manager",
						"San Francisco",
						"7031",
						"2008/12/16",
						"$164,500"
					],
					[
						"Hope Fuentes",
						"Secretary",
						"San Francisco",
						"6318",
						"2010/02/12",
						"$109,850"
					],
					[
						"Vivian Harrell",
						"Financial Controller",
						"San Francisco",
						"9422",
						"2009/02/14",
						"$452,500"
					],
					[
						"Timothy Mooney",
						"Office Manager",
						"London",
						"7580",
						"2008/12/11",
						"$136,200"
					],
					[
						"Jackson Bradshaw",
						"Director",
						"New York",
						"1042",
						"2008/09/26",
						"$645,750"
					],
					[
						"Olivia Liang",
						"Support Engineer",
						"Singapore",
						"2120",
						"2011/02/03",
						"$234,500"
					],
					[
						"Bruno Nash",
						"Software Engineer",
						"London",
						"6222",
						"2011/05/03",
						"$163,500"
					],
					[
						"Sakura Yamamoto",
						"Support Engineer",
						"Tokyo",
						"9383",
						"2009/08/19",
						"$139,575"
					],
					[
						"Thor Walton",
						"Developer",
						"New York",
						"8327",
						"2013/08/11",
						"$98,540"
					],
					[
						"Finn Camacho",
						"Support Engineer",
						"San Francisco",
						"2927",
						"2009/07/07",
						"$87,500"
					],
					[
						"Serge Baldwin",
						"Data Coordinator",
						"Singapore",
						"8352",
						"2012/04/09",
						"$138,575"
					],
					[
						"Zenaida Frank",
						"Software Engineer",
						"New York",
						"7439",
						"2010/01/04",
						"$125,250"
					],
					[
						"Zorita Serrano",
						"Software Engineer",
						"San Francisco",
						"4389",
						"2012/06/01",
						"$115,000"
					],
					[
						"Jennifer Acosta",
						"Junior Javascript Developer",
						"Edinburgh",
						"3431",
						"2013/02/01",
						"$75,650"
					],
					[
						"Cara Stevens",
						"Sales Assistant",
						"New York",
						"3990",
						"2011/12/06",
						"$145,600"
					],
					[
						"Hermione Butler",
						"Regional Director",
						"London",
						"1016",
						"2011/03/21",
						"$356,250"
					],
					[
						"Lael Greer",
						"Systems Administrator",
						"London",
						"6733",
						"2009/02/27",
						"$103,500"
					],
					[
						"Jonas Alexander",
						"Developer",
						"San Francisco",
						"8196",
						"2010/07/14",
						"$86,500"
					],
					[
						"Shad Decker",
						"Regional Director",
						"Edinburgh",
						"6373",
						"2008/11/13",
						"$183,000"
					],
					[
						"Michael Bruce",
						"Javascript Developer",
						"Singapore",
						"5384",
						"2011/06/27",
						"$183,000"
					],
					[
						"Donna Snider",
						"Customer Support",
						"New York",
						"4226",
						"2011/01/25",
						"$112,000"
					]
				]
			}';

			/*
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
		 */

		} // public function mostrarTablaEmpleados()

	} // class TablaEmpleados

	// Activar la tabla de Empleados.
	$activarEmpleados = new TablaEmpleados();
	$activarEmpleados->mostrarTablaEmpleados();


?>