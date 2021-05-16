<?php
	require_once "conexion.php";
	
	class ModeloResponsivas
	{
		// Mostrar las responsivas que tiene el empleado asignadas
		static public function mdlMostrarResponsivasPerifAsign($tabla,$item,$valor)
		{
			$stmt = Conexion::conectar()->prepare ("SELECT r.id_empleado,r.num_folio,e.ntid,r.num_folio,r.fecha_asignado,r.productos FROM t_Responsivas r INNER JOIN t_Empleados e ON r.id_empleado = e.id_empleado  WHERE (activa = 'S' && e.ntid = :$item && r.modalidad_entrega = 'Permanente') ORDER BY r.num_folio ASC");
			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
			$stmt->execute();	
			return $stmt->fetchAll();				
		}

		// Mostrar las responsivas activas e inactivas 
		static public function mdlMostrarRespHistPerif($tabla)
		{
			$stmt = Conexion::conectar()->prepare ("SELECT r.id_responsiva,r.id_empleado,r.fecha_asignado,r.productos,r.num_folio FROM t_Responsivas r ");
			
			$stmt->execute();	
			return $stmt->fetchAll();				

		}

		static public function mdlMostrarNumResponsiva($tabla)
		{
			$stmt = Conexion::conectar()->prepare ("SELECT MAX(id_responsiva) AS ultima FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();				

		}
		
		static public function mdlMostrarRespEposPrestados()
		{
			$stmt = Conexion::conectar()->prepare ("SELECT tr.id_responsiva, te.ntid,te.nombre, te.apellidos,tr.fecha_asignado,tr.fecha_devolucion,tr.productos FROM t_Responsivas tr INNER JOIN t_Empleados te ON tr.id_empleado = te.id_empleado WHERE tr.activa = 'S' AND modalidad_entrega = 'Permanente' ");
			$stmt->execute();
			return $stmt->fetchAll();				

		}

		// Mostrar Responsivas
		static public function mdlMostrarResponsivas($tabla,$item,$valor,$ordenar)
		{
			if ($item != null)
			{
				if ($ordenar == 'ConsultaSencilla')
				{
					$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE $item = :$item && activa = 'S' ORDER BY fecha_asignado ASC");
					$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
					$stmt->execute();	
				}
				if ($ordenar == 'ConsultaCompleja')
				{
					$stmt = Conexion::conectar()->prepare ("SELECT tr.id_responsiva,tr.id_empleado,tu.id_usuario,tu.nombre AS  nombre_usuario,tr.num_folio,tr.activa,tr.modalidad_entrega,tr.productos,tr.num_ticket,tr.id_empleado,tr.comentario,tr.impuesto,tr.neto,tr.total,tr.fecha_devolucion,tr.fecha_asignado,te.nombre AS nombre_empleado,te.apellidos AS apellidos_empleado,tr.id_almacen,ta.nombre AS nombre_planta FROM t_Responsivas tr INNER JOIN t_Empleados te ON tr.id_empleado = te.id_empleado INNER JOIN t_Almacen ta ON tr.id_almacen = ta.id_almacen INNER JOIN t_Usuarios tu ON tr.id_usuario = tu.id_usuario WHERE $item = :$item && tr.activa = 'S' ");
					$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
					$stmt->execute();
				}

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

				$stmt = Conexion::conectar()->prepare ("SELECT * FROM $tabla WHERE activa = 'S' ORDER BY $condicion $sube_baja");
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


// $respuesta = ModeloResponsivas::mdlIngresarResponsiva($tabla,$datos);
		// Guardar Responsiva en la Tabla 
		static public function mdlEditarResponsiva($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare ("UPDATE $tabla SET id_empleado=:id_empleado,id_usuario=:id_usuario,id_almacen=:id_almacen,activa=:activa,num_folio=:num_folio,modalidad_entrega=:modalidad_entrega,num_ticket=:num_ticket,comentario=:comentario,productos=:productos,impuesto=:impuesto,neto=:neto,total=:total,fecha_devolucion=:fecha_devolucion,fecha_asignado=:fecha_asignado WHERE id_responsiva = :id_responsiva");

			$stmt->bindParam(":id_responsiva",$datos["id_responsiva"],PDO::PARAM_INT);
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

	} // static public function mdlEditarResponsiva($tabla,$datos)

	// Eliminar Responsiva.
/*
	$stmt = Conexion::conectar()->prepare ("UPDATE $tabla SET id_empleado=:id_empleado,id_usuario=:id_usuario,id_almacen=:id_almacen,activa=:activa,num_folio=:num_folio,modalidad_entrega=:modalidad_entrega,num_ticket=:num_ticket,comentario=:comentario,productos=:productos,impuesto=:impuesto,neto=:neto,total=:total,fecha_devolucion=:fecha_devolucion,fecha_asignado=:fecha_asignado WHERE id_responsiva = :id_responsiva");
*/
	static public function mdlEliminarResponsiva($tabla,$datos)
	{
		//$stmt = Conexion::conectar()->prepare ("DELETE FROM $tabla WHERE id_responsiva = :id_responsiva");
		$stmt = Conexion::conectar()->prepare ("UPDATE $tabla SET activa = 'N' WHERE id_responsiva = :id_responsiva");
		$stmt->bindParam(":id_responsiva",$datos,PDO::PARAM_INT);
		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		$stmt->close();
		$stmt=null;

	}

}	// 	class ModeloResponsivas

?>