<?php
	require_once "../controladores/cintas.controlador.php";
	require_once "../modelos/cintas.modelo.php";

	// Se agregan estos archivos, ya que no se cargan al iniciar el archivo "index.php",se carga al ejecutar el archivo "cintas.ajax.php"

	class AjaxCintas
	{
		// Editar "Cintas"
		// Para obtener la "Cinta" que se va a editar.
		public $idCinta;
		public $traerCinta;
		public $nombreCinta;

		public function ajaxEditarCinta()
		{
			// Para el caso de que se edita utilizando un dispositivo movil
			if ($this->traerCinta == "ok")
			{
				$item = null;
				$valor = null;
				$orden = "num_serial";
				$respuesta = ControladorCintas::ctrMostrarCintas($item,$valor,$orden);
				echo json_encode($respuesta);	
			}
			else 
			{
				$item = "id_cintas";
				$valor = $this->idCinta;
				$orden = "num_serial";
				$respuesta = ControladorCintas::ctrMostrarCintas($item,$valor,$orden);
				echo json_encode($respuesta);
			}

		}

	} // class AjaxCintas

	
	// Para editar la Cinta.
	if (isset($_POST["idCinta"]))
	{
		$editarCinta = new AjaxCintas();
		$editarCinta->idCinta = $_POST["idCinta"];
		$editarCinta->ajaxEditarCinta();
	}
	
	// Traer la Cinta, para dispositivos moviles.
	if (isset($_POST["traerCinta"]))
	{
		$traerCinta = new AjaxCintas();
		$traerCinta->traerCinta = $_POST["traerCinta"];
		$traerCinta->ajaxEditarCinta();
	}

?>