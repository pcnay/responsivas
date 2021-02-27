<?php
	require_once "conexion.php";
	class ModeloCentro_Costos
	{
		// Crear el Centro de Costos.
		static public function mdlIngresarCentro_Costos($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(num_centro_costos,descripcion) VALUES (:num_centro_costos,:descripcion)");

			$stmt->bindParam(":num_centro_costos",$datos["num_centro_costos"],PDO::PARAM_STR); 
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 

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

		} // static public function mdlIngresarCentro_Costos($tabla,$datos)

		// ======================================================
		// Editar Centro de Costos.
		// ======================================================
		static public function mdlEditarCentro_Costos($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET num_centro_costos = :num_centro_costos, descripcion = :descripcion WHERE id_centro_costos = :id");

			$stmt->bindParam(":num_centro_costos",$datos["num_centro_costos"],PDO::PARAM_STR); 
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_centro_costos"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarCentro_Costos($tabla,$datos)

		// ==============================================
		// Borrar Centro De Costos.
		// ==============================================
		static public function mdlBorrarCentro_Costos($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_centro_costos = :id");
			
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

		} // static public function mdlBorrarCentro_Costos($tabla,$datos)


		// Mostrar los Centros de Costos.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarCentro_Costos($tabla,$item,$valor)
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

				return $stmt->fetchAll(); // Retorna solo una linea.	

			}

			$stmt->close();
			$stmt = null; 

		} // static public function mdlMostrarCentro_Costoso($tabla,$item,$valor)


	} // class ModeloCentro_Costos
?>