<?php
	require_once "conexion.php";
	class ModeloProductos
	{
		// Mostrar productos.
		static public function mdlMostrarProductos($tabla,$item,$valor,$orden)
		{
			/*

			Funciona esta Consulta			
				Tablas Relacionadas : Marca, Modelo, edo_epo.

			SELECT tp.imagen_producto AS Imagen,tperif.nombre AS Periferico,tp.num_serie AS Serial,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta FROM t_Productos tp INNER JOIN t_Marca tm ON
			 tp.id_marca = tm.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Edo_epo tedoepo ON tp.id_edo_epo = tedoepo.id_edo_epo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico WHERE tp.id_producto = 1 ORDER BY tperif.nombre ASC

			*/

			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $orden ASC ");
				$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT tp.imagen_producto AS Imagen,tperif.nombre AS Periferico,tp.num_serie AS Serial,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta FROM t_Productos tp INNER JOIN t_Marca tm ON
				tp.id_marca = tm.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Edo_epo tedoepo ON tp.id_edo_epo = tedoepo.id_edo_epo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico ORDER BY tperif.nombre ASC");				
				$stmt->execute();
				return $stmt->fetchAll();				 
			}
			$stmt->close();
			$stmt=null;
		}

		// Guardar el Producto, en la tabla "t_Productos"
		static public function mdlIngresarProducto($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria,codigo, descripcion,imagen,stock,precio_compra,precio_venta) VALUES (:id_categoria,:codigo,:descripcion,:imagen,:stock,:precio_compra,:precio_venta)");

			$stmt->bindParam(":id_categoria",$datos["id_categoria"],PDO::PARAM_INT);
			$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
			$stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);
			$stmt->bindParam(":stock",$datos["stock"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_compra",$datos["precio_compra"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_venta",$datos["precio_venta"],PDO::PARAM_STR);

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

		} //static public function mdlIngresarProducto($tabla,$datos)

		// Editar el Producto.

		static public function mdlEditarProducto($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria,codigo = :codigo, descripcion = :descripcion, imagen = :imagen, stock = :stock,precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

			$stmt->bindParam(":id_categoria",$datos["id_categoria"],PDO::PARAM_INT);
			$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
			$stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
			$stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);
			$stmt->bindParam(":stock",$datos["stock"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_compra",$datos["precio_compra"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_venta",$datos["precio_venta"],PDO::PARAM_STR);

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

		} //static public function mdlIngresarProducto($tabla,$datos)
		
		// ==============================================================================
		// Borrar Productos 
		// ==============================================================================
		static public function mdlEliminarProductos($tabla,$datos)
		{
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
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
	
	} // class ModeloProductos

?>