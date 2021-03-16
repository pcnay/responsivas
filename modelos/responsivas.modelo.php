<?php
	require_once "conexion.php";
	
	class ModeloResponsivas
	{
		// Mostrar Responsivas
		static public function mdlMostrarResponsivas($tabla, $item, $valor)
		{
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha_asignado ASC");
				$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();				
			}
			else
			{
				// Para que tome el último número de factura de la tabla.
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla ORDER BY id ASC");
				$stmt->execute();
				return $stmt->fetchAll();
			}
			$stmt->close();
			$stmt=null;

		} // static public function mdlMostrarVentas($tabla, $item, $valor)

		

	}
?>