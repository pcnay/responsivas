<?php
	require_once "conexion.php";
	class ModeloCintas
	{
		// Crear Modelo.
		static public function mdlIngresarCinta($tabla,$datos)
		{
			// Para el "id_cintas" se agrega de forma ascedente de forma automatica
			
			//var_dump($datos);
			//exit;

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES (:num_serial,:fecha_inic,:fecha_final,:ubicacion,:comentarios)");
			$stmt->bindParam(":num_serial",$datos["nueva_cinta"],PDO::PARAM_STR); 
			$stmt->bindParam(":fecha_inic",$datos["nueva_fecha_inic"],PDO::PARAM_STR); 
			$stmt->bindParam(":fecha_final",$datos["nueva_fecha_fin"],PDO::PARAM_STR);
			$stmt->bindParam(":ubicacion",$datos["nueva_ubic"],PDO::PARAM_STR);
			$stmt->bindParam(":comentarios",$datos["nuevoComent"],PDO::PARAM_STR);

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

		} // static public function mdlIngresarCinta($tabla,$datos)

		// ======================================================
		// Editar Cintas
		// ======================================================
		static public function mdlEditarCinta($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET num_serial = :num_serial, fecha_inic = :fecha_inic, fecha_final = :fecha_final, ubicacion = :ubicacion, comentarios = :comentarios WHERE id_cintas = :id");
			$stmt->bindParam(":num_serial",$datos["editar_num_serie"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha_inic",$datos["editar_fecha_inic"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha_final",$datos["editar_fecha_fin"],PDO::PARAM_STR);
			$stmt->bindParam(":ubicacion",$datos["editar_ubicacion"],PDO::PARAM_STR);
			$stmt->bindParam(":comentarios",$datos["editar_comentarios"],PDO::PARAM_STR);
			$stmt->bindParam(":id",$datos["id_cintas"],PDO::PARAM_STR); 

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

		} // static public function mdlEditarCinta($tabla,$datos)

		// ==============================================
		// Borrar Cinta.
		// ==============================================
		static public function mdlBorrarCinta($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cintas = :id");
			
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



		// Mostrar Cintas.
    // "static" debido a que tiene parámetros.
    static public function mdlMostrarCintas($tabla,$item,$valor)
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

		} // static public function mdlMostrarCintas($tabla,$item,$valor)


	} // class ModeloCintas

?>