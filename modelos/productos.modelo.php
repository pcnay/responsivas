<?php
	require_once "conexion.php";
	class ModeloProductos
	{
		// Mostrar productos.
		static public function mdlMostrarProductos($tabla,$item,$valor)
		{
			/*

			Funciona esta Consulta			
				Tablas Relacionadas : Marca, Modelo, edo_epo.

			SELECT tp.id_producto AS id_producto,tp.imagen_producto AS Imagen,tperif.nombre AS Periferico,tp.num_serie AS Serial,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta FROM t_Productos tp INNER JOIN t_Marca tm ON
			 tp.id_marca = tm.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Edo_epo tedoepo ON tp.id_edo_epo = tedoepo.id_edo_epo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico WHERE tp.id_producto = 1 ORDER BY tperif.nombre ASC

			*/

			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT tp.id_producto AS id_producto,tp.imagen_producto AS Imagen,tperif.nombre AS Periferico,tp.num_serie AS Serial,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta FROM t_Productos tp INNER JOIN t_Marca tm ON
				tp.id_marca = tm.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Edo_epo tedoepo ON tp.id_edo_epo = tedoepo.id_edo_epo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico ORDER BY tperif.nombre ASC WHERE tp.id_producto = :$item");
				$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT tp.id_producto AS id_producto,tp.imagen_producto AS Imagen,tperif.nombre AS Periferico,tp.num_serie AS Serial,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta FROM t_Productos tp INNER JOIN t_Marca tm ON
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
			/*
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_periferico,num_serie,id_marca,id_modelo,id_almacen,id_edo_epo,stock,precio_compra,precio_venta,nomenclatura,especificaciones,comentarios,imagen_producto,cuantas_veces) VALUES (:id_periferico,:num_serie,:id_marca,:id_modelo,:id_almacen,:id_edo_epo,:stock,:precio_compra,:precio_venta,:nomenclatura,:especificaciones,:comentarios,:imagen_producto,:cuantas_veces)");
			*/
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_periferico,num_serie,id_marca,id_modelo,id_almacen,id_edo_epo,nomenclatura,imagen_producto,stock,precio_compra,precio_venta,especificaciones,comentarios) VALUES (:id_periferico,:num_serie,:id_marca,:id_modelo,:id_almacen,:id_edo_epo,:nomenclatura,:imagen_producto,:stock,:precio_compra,:precio_venta,:especificaciones,:comentarios)");

			$stmt->bindParam(":id_periferico",$datos["id_periferico"],PDO::PARAM_INT);
			$stmt->bindParam(":num_serie",$datos["num_serie"],PDO::PARAM_STR);
			$stmt->bindParam(":id_marca",$datos["id_marca"],PDO::PARAM_INT);
			$stmt->bindParam(":id_modelo",$datos["id_modelo"],PDO::PARAM_INT);
			$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_INT);
			$stmt->bindParam(":id_edo_epo",$datos["id_edo_epo"],PDO::PARAM_INT);
			$stmt->bindParam(":nomenclatura",$datos["nomenclatura"],PDO::PARAM_STR);
			$stmt->bindParam(":imagen_producto",$datos["imagen"],PDO::PARAM_STR);
			$stmt->bindParam(":stock",$datos["stock"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_compra",$datos["precio_compra"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_venta",$datos["precio_venta"],PDO::PARAM_STR);
			$stmt->bindParam(":especificaciones",$datos["especificaciones"],PDO::PARAM_STR);
			$stmt->bindParam(":comentarios",$datos["comentarios"],PDO::PARAM_STR);
			

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