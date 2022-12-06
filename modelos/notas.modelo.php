<?php
	require_once "conexion.php";
	class ModeloNotas
	{
		// Crear Marca.
		static public function mdlIngresarNota($tabla,$datos)
		{
			// Para el "id_nota" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario,nombre_nota,descripcion_nota) VALUES (:id_usuario,:nombre_nota,:descripcion_nota)");
			$stmt->bindParam(":id_usuario",$datos["id_usuario"],PDO::PARAM_INT); 
			$stmt->bindParam(":nombre_nota",$datos["nuevaNota"],PDO::PARAM_STR); 
			$stmt->bindParam(":descripcion_nota",$datos["nuevaDescripNota"],PDO::PARAM_STR); 
			
			if ($stmt->execute())
			{
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "ok";				
			}
			else
			{
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "error";
			}

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
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "ok";				
			}
			else
			{
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "error";
			}

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
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "ok";				
			}
			else
			{
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return "error";
			}
		} // static public function mdlBorrarMarca($tabla,$datos)

		// Mostrar Notas
		// "static" debido a que tiene parámetros.
    static public function mdlMostrarNotas($tabla,$item,$valor)
    {
      //var_dump($tabla);
			//exit;
			// Determinar si se quiere un registro.
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item,$valor, PDO::PARAM_STR);
				$stmt->execute();
				$registros = $stmt->fetch();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}
			else // Cuando son todos los registros
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY nombre_nota");
				$stmt->execute();
				$registros = $stmt->fetchAll();			
				// Cerrar la conexion de la instancia de la base de datos.
				$stmt->closeCursor();
				$stmt=null;
				return $registros;
			}

		} // static public function mdlMostrarMarcas($tabla,$item,$valor)

	} // class ModeloNotas

?>