<?php
	require_once "conexion.php";
	
	class ModeloSubirCsv
	{
		// Subir Cintas.
		static public function mdlSubirCsv($tabla,$datos)
		{
			
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES (0,:num_serial,:fecha_inic,:fecha_final,:ubicacion,:comentarios)");
			$stmt->bindParam(":num_serial",$datos["num_serial"],PDO::PARAM_STR); 
			$stmt->bindParam(":fecha_inic",$datos["fecha_inic"],PDO::PARAM_STR); 
			$stmt->bindParam(":fecha_final",$datos["fecha_final"],PDO::PARAM_STR); 
			$stmt->bindParam(":ubicacion",$datos["ubicacion"],PDO::PARAM_STR); 
			$stmt->bindParam(":comentarios",$datos["comentarios"],PDO::PARAM_STR); 

			if ($stmt->execute())
			{
				//$stmt->close();
				//$stmt = null;
				return "ok";				
			}
			else
			{
				//$stmt->close();
				//$stmt = null;
				return "error";
			}
			
		} // static public function mdlIngresarMarca($tabla,$datos)

		// Localizar Cintas.
		static public function localizarCinta($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("SELECT num_serial,fecha_inic,fecha_final,ubicacion FROM  $tabla WHERE num_serial = :num_serial ");
			$stmt->bindParam(":num_serial",$datos["num_serial"],PDO::PARAM_STR); 
			$stmt->execute();

			return $stmt->fetch(); // Retorna solo una linea.	
			
		} // static public function localizarCinta($tabla,$datos)
		

	} //	class ModeloSubirCsv
?>
