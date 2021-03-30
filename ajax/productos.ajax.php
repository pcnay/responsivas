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

		// Validar si existe el Numero de Telefono
		public $validarNumTel;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarNumTel()
		{
			$item = "num_tel";
			$valor = $this->validarNumTel;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}

		// Validar si existe la Direccion MAC del telefono
		public $validarDireccMac;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarDireccMac()
		{
			$item = "direcc_mac_tel";
			$valor = $this->validarDireccMac;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}

		// Validar si existe el IMEI del telefono
		public $validarImei;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarImei()
		{
			$item = "imei_tel";
			$valor = $this->validarImei;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);
		}

		// Validar si existe la Cuenta asignada al Telefono
		public $validarCuenta;

		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarCuenta()
		{
			$item = "cuenta";
			$valor = $this->validarCuenta;
			
			$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
			echo json_encode($respuesta);

		}
		
		// No declarar "static" en esta funcion, no la soporte el servidor Cloud de Google.
		public function ajaxValidarNomenclatura()
		{
			$item = "nomenclatura";
			$valor = $this->validarNomenclatura;
			
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

	// Validar que NO se repita el Numero de Telefono.
	if (isset($_POST["validarNumTel"]))
	{
		$valNumTel = new AjaxProductos();
		$valNumTel->validarNumTel = $_POST["validarNumTel"];
		$valNumTel->ajaxValidarNumTel();
	}

	// Validar que NO se repita la Direccion MAC del Tel.
	if (isset($_POST["validarDireccMac"]))
	{
		$valDireccMac = new AjaxProductos();
		$valDireccMac->validarDireccMac = $_POST["validarDireccMac"];
		$valDireccMac->ajaxValidarDireccMac();
	}

	// Validar que NO se repita el Imei del Tel.
	if (isset($_POST["validarImei"]))
	{
		$valImei = new AjaxProductos();
		$valImei->validarImei = $_POST["validarImei"];
		$valImei->ajaxValidarImei();
	}

	// Validar que NO se repita la Cuenta del Tel.
	if (isset($_POST["validarNumCta"]))
	{
		$valCtaTel = new AjaxProductos();
		$valCtaTel->validarCuenta = $_POST["validarNumCta"];
		$valCtaTel->ajaxValidarCuenta();
	}
	
	// Validar que NO se repita la Nomenclatura.
	if (isset($_POST["validarNomenclatura"]))
	{
		$valNomenclatura = new AjaxProductos();
		$valNomenclatura->validarNomenclatura = $_POST["validarNomenclatura"];
		$valNomenclatura->ajaxValidarNomenclatura();
	}
?>