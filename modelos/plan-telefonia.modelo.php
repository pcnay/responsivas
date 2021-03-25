<?php
	require_once "conexion.php";
	class ModeloPlanTelefonias
	{
		// Crear Planes de Telefonia.
		static public function mdlIngresarPlanTelefonia($tabla,$datos)
		{
			// Para el "id_plan_tel" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre",$datos["nuevoPlanTelefonia"],PDO::PARAM_STR); 
			
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

		} // static public function mdlIngresarPlanTelefonia($tabla,$datos)

		// ======================================================
		// Editar Plan De Telefonia.
		// ======================================================
		static public function mdlEditarPlanTelefonia($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id_plan_tel = :id");
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR); 
			$stmt->bindParam(":id",$datos["id_plan_tel"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarPlanTelefonia($tabla,$datos)

		// ==============================================
		// Borrar Plan de Telefonia.
		// ==============================================
		static public function mdlBorrarPlanTelefonia($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_plan_tel = :id");
			
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

		} // static public function mdlBorrarPlanTelefonia($tabla,$datos)

		// Mostrar Plan De Telefonias.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarPlanTelefonias($tabla,$item,$valor)
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

		} // static public function mdlMostrarPlanTelefonias($tabla,$item,$valor)


	} // class ModeloPlanTelefonias

?>