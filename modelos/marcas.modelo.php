<?php
	require_once "conexion.php";
	class ModeloMarcas
	{
		// Crear Marca.
		static public function mdlIngresarMarca($tabla,$datos)
		{
			// Para el "id_marca" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion) VALUES (:descripcion)");
			$stmt->bindParam(":descripcion",$datos["nuevaMarca"],PDO::PARAM_STR); 
			
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

		} // static public function mdlIngresarMarca($tabla,$datos)

		// ======================================================
		// Editar Marca.
		// ======================================================
		static public function mdlEditarMarca($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE id_marca = :id");
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_marca"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarMarca($tabla,$datos)

		// ==============================================
		// Editar Marca.
		// ==============================================
		static public function mdlBorrarMarca($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_marca = :id");
			
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

		} // static public function mdlBorrarMarca($tabla,$datos)



		// Mostrar Marca.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarMarcas($tabla,$item,$valor)
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

		} // static public function mdlMostrarMarcas($tabla,$item,$valor)


	} // class ModeloMarcas

?>