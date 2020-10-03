<?php
	require_once "conexion.php";
	class ModeloPerifericos
	{
		// Crear Periferico.
		static public function mdlIngresarPeriferico($tabla,$datos)
		{
			// Para el "id_periferico" se agrega de forma ascedente de forma automatica
			// Para el campo "fecha" sea asigna tambien de forma automatica ya que esta configurado en la base de datos.
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre",$datos,PDO::PARAM_STR); 
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

		} // static public function mdlIngresarPerifico($tabla,$datos)

		// ======================================================
		// EDITAR Periferico.
		// ======================================================
		static public function mdlEditarPeriferico($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id_periferico = :id");
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_periferico"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarPeriferico($tabla,$datos)

		// ==============================================
		// BORRAR Periferico.
		// ==============================================
		static public function mdlBorrarPeriferico($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_periferico = :id");
			
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

		} // static public function mdlBorrarPeriferico($tabla,$datos)



		// Mostrar Periferico.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarPerifericos($tabla,$item,$valor)
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
			else // Cuando son todos los regoistros
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
				$stmt->execute();

				return $stmt->fetchAll(); // Retorna solo una linea.	

			}

			$stmt->close();
			$stmt = null; 

		} // static public function mdlMostrarPerifericos($tabla,$item,$valor)


	} // class ModeloPerifericos

?>