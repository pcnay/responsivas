<?php
	require_once "conexion.php";
	class ModeloDeptos
	{
		// Crear Deptos.
		static public function mdlIngresarDepto($tabla,$datos)
		{
			// Para el "id_depto" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion) VALUES (:descripcion)");
			$stmt->bindParam(":descripcion",$datos["nuevoDepto"],PDO::PARAM_STR); 
			
			if ($stmt->execute())
			{
				return "ok";				
			}
			else
			{
				return "error";
			}
			$stmt->close();
			$stmt = null;

		} // static public function mdlIngresarDepto($tabla,$datos)

		// ======================================================
		// Editar Depto.
		// ======================================================
		static public function mdlEditarDepto($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE id_depto = :id");
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_depto"],PDO::PARAM_STR); 

			if ($stmt->execute())
			{
				return "ok";				
			}
			else
			{
				return "error";
			}
			$stmt->close();
			$stmt = null;

		} // static public function mdlEditarDepto($tabla,$datos)

		// ==============================================
		// Editar Depto.
		// ==============================================
		static public function mdlBorrarDepto($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_depto = :id");
			
		 	$stmt->bindParam(":id",$datos,PDO::PARAM_INT); 

			if ($stmt->execute())
			{
				return "ok";				
			}
			else
			{
				return "error";
			}
			$stmt->close();
			$stmt = null;

		} // static public function mdlBorrarDepto($tabla,$datos)



		// Mostrar Depto.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarDeptos($tabla,$item,$valor)
    {
      //var_dump($tabla);
			//exit;
			// Determinar si se quiere un registro.
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item,$valor, PDO::PARAM_STR);
				$stmt->execute();
	
				return $stmt->fetch(); // Retorna solo una linea.	
			}
			else // Cuando son todos los registros
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
				$stmt->execute();

				return $stmt->fetchAll(); // Retorna varias linea.	

			}

			$stmt->close();
			$stmt = null; 

		} // static public function mdlMostrarDeptos($tabla,$item,$valor)


	} // class ModeloDeptos

?>