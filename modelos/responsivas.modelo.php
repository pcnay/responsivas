<?php
	require_once "conexion.php";
	
	class ModeloResponsivas
	{
		// Mostrar Responsivas
		static public function mdlMostrarResponsivas($tabla,$item,$valor,$ordenar)
		{
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE $item = :$item ORDER BY fecha_asignado ASC");
				$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();				
			}
			else
			{
				// Para que tome el último número de factura de la tabla.
				switch ($ordenar)
				{
					case ('id_responsiva'):
						$condicion = 'id_responsiva';
						$sube_baja = 'ASC';
					break;
					case ('por_fecha'):
						$condicion = 'fecha_asignado';
						$sube_baja = 'DESC';
					break;	

		
				}	// switch ($ordenar)			

				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla ORDER BY $condicion $sube_baja");
				$stmt->execute();
				
				return $stmt->fetchAll();
				
				$stmt->close();
				$stmt=null;

				
			} // if ($item != null)


		} // static public function mdlMostrarVentas($tabla, $item, $valor)


		// $respuesta = ModeloResponsivas::mdlIngresarResponsiva($tabla,$datos);
		// Guardar Responsiva en la Tabla 
		static public function mdlIngresarResponsiva($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare ("INSERT INTO $tabla(id_empleado,id_usuario,id_almacen,activa,num_folio,modalidad_entrega,num_ticket,comentario,productos,impuesto,neto,total,fecha_devolucion,fecha_asignado) VALUES (:id_empleado,:id_usuario,:id_almacen,:activa,:num_folio,:modalidad_entrega,:num_ticket,:comentario,:productos,:impuesto,:neto,:total,:fecha_devolucion,:fecha_asignado)");

			$stmt->bindParam(":id_empleado",$datos["id_empleado"],PDO::PARAM_INT);
			$stmt->bindParam(":id_usuario",$datos["id_usuario"],PDO::PARAM_INT);
			$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_INT);
			$stmt->bindParam(":activa",$datos["activa"],PDO::PARAM_STR);
			$stmt->bindParam(":num_folio",$datos["num_folio"],PDO::PARAM_INT);			
			$stmt->bindParam(":modalidad_entrega",$datos["modalidad_entrega"],PDO::PARAM_STR);
			$stmt->bindParam(":num_ticket",$datos["num_ticket"],PDO::PARAM_STR);
			$stmt->bindParam(":comentario",$datos["comentarios"],PDO::PARAM_STR);
			$stmt->bindParam(":productos",$datos["productos"],PDO::PARAM_STR);
			$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
			$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
			$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha_devolucion",$datos["fecha_devolucion"],PDO::PARAM_STR);
			$stmt->bindParam(":fecha_asignado",$datos["fecha_asignado"],PDO::PARAM_STR);

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

	} // static public function mdlIngresarResponsiva($tabla,$datos)

}	// 	class ModeloResponsivas

?>