<?php
	require_once "conexion.php";
	class ModeloTelefonias
	{
		// Crear Cia Telefonica.
		static public function mdlIngresarTelefonia($tabla,$datos)
		{
			// Para el "id_telefonia" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre",$datos["nuevaTelefonia"],PDO::PARAM_STR); 
			
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

		} // static public function mdlIngresarTelefonia($tabla,$datos)

		// ======================================================
		// Editar Cia. Telefonica.
		// ======================================================
		static public function mdlEditarTelefonia($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id_telefonia = :id");
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_telefonia"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarTelefonia($tabla,$datos)

		// ==============================================
		// Borrar Cia. Telefonica.
		// ==============================================
		static public function mdlBorrarTelefonia($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_telefonia = :id");
			
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

		} // static public function mdlBorrarTelefonia($tabla,$datos)

		// Mostrar Cia. Telefonica.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarTelefonias($tabla,$item,$valor)
    {
      //var_dump($tabla);
			//exit;
			// Determinar si se quiere un registro.
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY nombre");
				$stmt->bindParam(":".$item,$valor, PDO::PARAM_STR);
				$stmt->execute();
	
				return $stmt->fetch(); // Retorna solo una linea.	
			}
			else // Cuando son todos los registros
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
				$stmt->execute();

				return $stmt->fetchAll(); // Retorna todos los registros.	

			}

			$stmt->close();
			$stmt = null; 

		} // static public function mdlMostrarTelefonias($tabla,$item,$valor)


	} // class ModeloTelefonias

?>