<?php
	require_once "conexion.php";
	class ModeloEmpleados
	{
		// Mostrar Empleados.
		static public function mdlMostrarEmpleados($tabla,$item,$valor,$orden)
		{
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $orden ASC ");
				$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");				
				$stmt->execute();
				return $stmt->fetchAll();				 
			}
			$stmt->close();
			$stmt=null;
		}

		// Guardar el Empleado, en la tabla "t_Empleados"
		static public function mdlIngresarEmpleado($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_puesto,id_depto,id_supervisor,id_ubicacion,ntid,nombre,apellidos,correo_electronico,centro_costos,foto) VALUES (:id_puesto,:id_depto,:id_supervisor,:id_ubicacion,:ntid,:nombre,:apellidos,:correo_electronico,:centro_costos,:imagen)");

			$stmt->bindParam(":id_puesto",$datos["id_puesto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_depto",$datos["id_depto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_supervisor",$datos["id_supervisor"],PDO::PARAM_INT);
			$stmt->bindParam(":id_ubicacion",$datos["id_ubicacion"],PDO::PARAM_INT);
			$stmt->bindParam(":ntid",$datos["ntid"],PDO::PARAM_STR);
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":apellidos",$datos["apellidos"],PDO::PARAM_STR);
			$stmt->bindParam(":correo_electronico",$datos["correo_electronico"],PDO::PARAM_STR);
			$stmt->bindParam(":centro_costos",$datos["centro_costos"],PDO::PARAM_STR);
			$stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);

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

		} //static public function mdlIngresarEmpleado($tabla,$datos)

		// Editar Empleado.

		static public function mdlEditarEmpleado($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_puesto = :id_puesto, id_depto = :id_depto, id_supervisor = :id_supervisor, id_ubicacion = :id_ubicacion, ntid = :ntid, nombre = :nombre, apellidos = :apellidos, correo_electronico = :correo_electronico, centro_costos = :centro_costos, imagen = :imagen WHERE ntid = :ntid");

			$stmt->bindParam(":id_puesto",$datos["id_puesto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_depto",$datos["id_depto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_supervisor",$datos["id_supervisor"],PDO::PARAM_INT);
			$stmt->bindParam(":id_ubicacion",$datos["id_ubicacion"],PDO::PARAM_INT);

			$stmt->bindParam(":ntid",$datos["ntid"],PDO::PARAM_STR);
			$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
			$stmt->bindParam(":apellidos",$datos["apellidos"],PDO::PARAM_STR);
			$stmt->bindParam(":correo_electronico",$datos["correo_electronico"],PDO::PARAM_STR);
			$stmt->bindParam(":centro_costos",$datos["centro_costos"],PDO::PARAM_STR);
			$stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);
			
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

		} //static public function mdlIngresarEmpleado($tabla,$datos)
		
		// ==============================================================================
		// Borrar Empleado 
		// ==============================================================================
		static public function mdlEliminarEmpleado($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_empleado = :id");
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
			$stmt=null;

		}

		/*
		// Actualizar Producto, cuando se realiza la Venta. 
		static public function mdlActualizarProducto($tabla,$item1,$valor1,$valor2)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1  WHERE id = :id");
			$stmt->bindParam(":".$item1, $valor1,PDO::PARAM_STR);
			$stmt->bindParam(":id", $valor2,PDO::PARAM_STR);

			if($stmt->execute())
			{
				return "ok";
			}
			else
			{
				return "error";
			}

			$stmt->close();
			$stmt = null;

		} // 		static public function mdlActualizarProducto.......

		

		static public function mdlMostrarSumaVentas($tabla)
		{
			$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");
			$stmt->execute();
			return $stmt->fetch();
			$stmt->close();
			$stmt = null;
		}
	*/

	} // class ModeloEmpleados

?>