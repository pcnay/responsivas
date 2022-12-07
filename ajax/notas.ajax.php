<?php
	// Se vuelve a llamar ya que en el Ajax, trabaja en 2do. plano, porque se tiene que volver a invocarlo.
// No declarar "static" en esta funcion, no la soporta el servidor Cloud de Google, por lo que deja de trabajar el programa de forma correcta.

	require_once "../controladores/notas.controlador.php";
	require_once "../modelos/notas.modelo.php";
	
	class AjaxNotas
		{
		// Validar si existe una Marca.
		public $validarMarca;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarNotas()
		{
			/* 
			$item = "descripcion";
			$valor = $this->validarMarca;

			$respuesta = ControladorMarcas::ctrMostrarMarcas($item,$valor);
			echo json_encode($respuesta);
			*/

		}

		// Editar Notas
		public $idNota;
		public function ajaxEditarNota()
		{
			$item = "id_nota";
			$valor = $this->idNota;
			$respuesta = ControladorNotas::ctrMostrarNotas($item,$valor);
			//var_dump($respuesta);
			//exit;

			echo json_encode($respuesta);
		}


	} // class AjaxMarcas

	// Instanaciando la clase para los objetos que se requieran.

	// Editando Nota.
	// datos.append("idNota",idNota); // Se crea la variable "POST", "idNota"
	if (isset($_POST["idNota"]))
	{
		$nota = new AjaxNotas();
		$nota->idNota = $_POST["idNota"];
		$nota->ajaxEditarNota();
	}

	// Validar que NO se repita la Marca.
	if (isset($_POST["validarNota"]))
	{
		/*
		$valMarca = new AjaxMarcas();
		$valMarca->validarMarca = $_POST["validarMarca"];
		$valMarca->ajaxValidarMarca();
		*/
		
	}

?>