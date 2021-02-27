<?php
	class ControladorResponsivas
	{
		static public function ctrMostrarResponsivas($item,$valor)
		{
			$tabla = "t_Responsivas";
			$respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla, $item,$valor);
			return $respuesta;
		}
	}
?>