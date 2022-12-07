<?php
	// Para poder extraer los datos de la tabla de "perifericos" y agregarlos al plugin DataTable.
	// Se agrega porque este archivo no se esta disparando con el "index.php", sino con el archivo "empleados.php", se carga mucho después.

	require_once "../controladores/notas.controlador.php";
	require_once "../modelos/notas.modelo.php";


	class TablaNotas
	{
		// Mostrar la tabla de Notas.
		public function mostrarTablaNotas()
		{
			// https://datatables.net/examples/ajax/simple.html
			// donde se toman los ejercicios para el uso de DataTable.
			
			// Para poder introducir etiquetas HTML en Ajax.
			// Se tiene que utilizar variables de PHP y asignarle las etiquetas de HTML como de texto
			// Se deben eliminar los espacios en blanco del contenido de la variable "$botones"
			//$imagen = "<img src='vistas/img/productos/default/anonymous.png' width='40px'>"; 
			// data-toggle = 'modal' Para abrir una ventana flotante.


			$item = null;
			$valor = null;			
			$notas = ControladorNotas::ctrMostrarNotas($item,$valor);
			//var_dump($modelos);

			// Aqui se genera la variable tipo JSon.
			// Es importante que no se agrege un caracter demas en la cadena $datosJson
			$datosJson = '{
				"data": [';
					for ($i=0;$i<count($notas);$i++)
					{						
						// Se agrega los botones con las clases y id para "editar" y "borrar"
						if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Administrador" || $_GET["perfilOculto"] == "Operador" )
						{
							$botones = " <div class='btn-group'><button class='btn btn-warning btnEditarNota' idNota = '".$notas[$i]["id_nota"]."' data-toggle='modal' data-target = '#modalEditarNota'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarNota' idNota = '".$notas[$i]["id_nota"]."'><i class='fa fa-times'></i></button></div>"; 
						}
						else
						{
							$botones = " <div class='btn-group'><button class='btn btn-warning btnEditarNota' idNota = '".$notas[$i]["id_nota"]."' data-toggle='modal' data-target = '#modalEditarNota'><i class='fa fa-pencil'></i></button></div>";	
						}
												
						$datosJson .= '[
							"'.$notas[$i]['id_nota'].'",
							"'.$notas[$i]['nombre_Usuario'].'",
							"'.$notas[$i]['nombre_nota'].'",
							"'.$notas[$i]['fecha'].'",
							"'.$botones.'"
						],';	
					}
					
					$datosJson = substr($datosJson,0,-1);
					$datosJson .= ']}';
					
					echo $datosJson;

			//return; 

		} // public function mostrarTablaMarcas()

	} // class TablaMarcas

	// Instanciar la clase
	$activarNotas = new TablaNotas();
	$activarNotas->mostrarTablaNotas();


?>