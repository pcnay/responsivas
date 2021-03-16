<?php
	class ControladorResponsivas
	{
		static public function ctrMostrarResponsivas($item,$valor)
		{
			$tabla = "t_Responsivas";
			$respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla, $item,$valor);
			return $respuesta;
		}

		// Crear Responsiva.
		static public function ctrCrearResponsiva()
		{
			// Debe existir la variable Global de tipo POST
			if (isset($_POST["nuevoNumResp"]))
			{
				// Actualizar las compras del Cliente.
				
				// Reducir el Stock y Aumnetar las ventas de los productos.
				// Convertirlo de formato JSon a Arreglo, para poder accesar al contenido del detalle de las responsivas.
				$listarProductos = json_decode($_POST["listaProductos"],true);

				var_dump($listarProductos);

			}

		} // static public functio ctrCrearVenta()

	} // class ControladorResponsivas
?>