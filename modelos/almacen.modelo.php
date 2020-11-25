<?php
	require_once "conexion.php";
	class ModeloAlmacenes
	{
		// Crear Almacen.
		static public function mdlIngresarAlmacen($tabla,$datos)
		{
			// Para el "id_almacen" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre",$datos["nuevoAlmacen"],PDO::PARAM_STR); 
			
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

		} // static public function mdlIngresarAlmacen($tabla,$datos)

		// ======================================================
		// Editar Almacen.
		// ======================================================
		static public function mdlEditarAlmacen($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id_almacen = :id");
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_almacen"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarAlmacen($tabla,$datos)

		// ==============================================
		// Editar Almacen.
		// ==============================================
		static public function mdlBorrarAlmacen($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_almacen = :id");
			
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

		} // static public function mdlBorrarAlmacen($tabla,$datos)



		// Mostrar Almacen.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarAlmacenes($tabla,$item,$valor)
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

		} // static public function mdlMostrarAlmacen($tabla,$item,$valor)


	} // class ModeloAlmacenes

?>