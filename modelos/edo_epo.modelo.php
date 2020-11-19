<?php
	require_once "conexion.php";
	class ModeloEdo_Epos
	{
		// Crear Estado Del Equipo.
		static public function mdlIngresarEdo_Epo($tabla,$datos)
		{
			// Para el "id_edo_epo" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion) VALUES (:descripcion)");
			$stmt->bindParam(":descripcion",$datos["nuevoEdo_Epo"],PDO::PARAM_STR); 
			
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

		} // static public function mdlIngresarEdo_Epo$tabla,$datos)

		// ======================================================
		// Editar Estado Del Equipo.
		// ======================================================
		static public function mdlEditarEdo_Epo($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion WHERE id_edo_epo = :id");
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_edo_epo"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarEdo_Epo($tabla,$datos)

		// ==============================================
		// Editar Estado Del Equipo.
		// ==============================================
		static public function mdlBorrarEdo-Epo($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_edo_Epo = :id");
			
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

		} // static public function mdlBorrarEdo_Epo($tabla,$datos)



		// Mostrar Estado Del equipo.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarEdo_Epos($tabla,$item,$valor)
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

		} // static public function mdlMostrarEdo_Epo($tabla,$item,$valor)


	} // class ModeloEdo_Epos

?>