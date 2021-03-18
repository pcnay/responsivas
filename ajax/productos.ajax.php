<?php
	require_once "../controladores/productos.controlador.php";
	require_once "../modelos/productos.modelo.php";

	// Se agregan estos archivos, ya que no se cargan al iniciar el archivo "index.php",se carga al ejecutar el archivo "productos.ajax.php"

	class AjaxProductos
	{
		// Validar si existe el Serial.
		public $validarSerial;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarSerial()
		{
			$item = "num_serie";
			$valor = $this->validarSerial;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}


		// Editar "Productos"
		// Para obtener un producto que se va a editar.
		public $idProducto;
		public $traerProductos;
		public $nombreProducto;

		public function ajaxEditarProducto()
		{

			if($this->nombreProducto != "")
			{
				// Para poder obtener el registro que se selecciono del ComboBox.
			}	

			// Para el caso de que se edita utilizando un dispositivo movil
			if ($this->traerProductos == "ok")
			{
				$item = null;
				$valor = null;
				$orden = "id";
				$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
				echo json_encode($respuesta);	
			}
			else if ($this->nombreProducto != "")
			{
				$item = "Periferico";
				$valor = $this->nombreProducto;
				$orden = "id_producto";
				$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
				echo json_encode($respuesta);
			
			}		// if ($this->traerProductos == "ok")
			else
			{
				$item = "id_producto";
				$valor = $this->idProducto;
				$orden = "nombre";
				$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
				echo json_encode($respuesta);
			}
				
		} // public function ajaxEditarProducto()

	} // class AjaxProductos

	
	// Para editar el producto.
	if (isset($_POST["idProducto"]))
	{
		$editarProducto = new AjaxProductos();
		$editarProducto->idProducto = $_POST["idProducto"];
		$editarProducto->ajaxEditarProducto();
	}
	
	// Traer el Producto, para dispositivos mobiles.
	if (isset($_POST["traerProductos"]))
	{
		$traerProductos = new AjaxProductos();
		$traerProductos->traerProductos = $_POST["traerProductos"];
		$traerProductos->ajaxEditarProducto();
	}

	// Para obtener el nombre del producto.	
	if (isset($_POST["nombreProducto"]))
	{
		$traerProductos = new AjaxProductos();
		$traerProductos->nombreProducto = $_POST["nombreProducto"];
		$traerProductos->ajaxEditarProducto();
	}

	// Validar que NO se repita el Serial.
	if (isset($_POST["validarSerial"]))
	{
		$valSerial = new AjaxProductos();
		$valSerial->validarSerial = $_POST["validarSerial"];
		$valSerial->ajaxValidarSerial();
	}


?>