<?php
	require_once "conexion.php";

	class ModeloProductos
	{
		// Mostrar productos, Ajax.
		static public function mdlMostrarProductosAjax($tabla,$item,$valor)
		{
			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
				$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");				
				$stmt->execute();
				return $stmt->fetchAll();				 
			}
			$stmt->close();
			$stmt=null;

		}

		// Mostrar productos, en el DataTable.
		static public function mdlMostrarProductos($tabla,$item,$valor,$orden)
		{
			/*

			Funciona esta Consulta			
				Tablas Relacionadas : Marca, Modelo, edo_epo.

			SELECT tp.id_producto AS id_producto,tp.imagen_producto AS Imagen,tperif.nombre AS Periferico,tp.num_serie AS Serial,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta FROM t_Productos tp INNER JOIN t_Marca tm ON
			 tp.id_marca = tm.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Edo_epo tedoepo ON tp.id_edo_epo = tedoepo.id_edo_epo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico WHERE tp.id_producto = 1 ORDER BY tperif.nombre ASC

			*/
			switch ($item)
			{
				case ('id_producto'):
					$condicion = 'tp.id_producto';
				break;
				case ('Periferico'):
					$condicion = 'tperif.nombre';
				break;
				case ('num_serie'):
					$condicion = 'tp.num_serie';
				break;
				case ('num_tel'):
					$condicion = 'tp.num_tel';
				break;
				case ('direcc_mac_tel'):
					$condicion = 'tp.direcc_mac_tel';
				break;
				case ('imei_tel'):
					$condicion = 'tp.imei_tel';
				break;
				case ('num_ip'):
					$condicion = 'tp.num_ip';
				break;
				case ('cuenta'):
					$condicion = 'tp.cuenta';
				break;
				case ('nomenclatura'):
					$condicion = 'tp.nomenclatura';
				case ('id_almacen'):
					$condicion = 'tp.id_almacen';	
				break;
				case ('asset'):
					$condicion = 'tp.asset';	
				break;
				case ('loftware'):
					$condicion = 'tp.loftware';	
				break;
				case ('npa'):
					$condicion = 'tp.npa';	
				break;
			}

			if ($item != null)
			{
				$stmt = Conexion::conectar()->prepare("SELECT tp.id_producto AS id_producto,tp.id_telefonia,tp.id_plan_tel,tp.id_empleado,tp.imagen_producto AS Imagen, tp.cuantas_veces AS Cuantas_veces,tp.asset,tp.loftware,tp.area,tp.linea,tp.estacion,tp.npa,tp.idf,tp.patch_panel,tp.puerto,tp.funcion,tp.jls,tp.qdc,tperif.id_periferico,tperif.nombre AS Periferico,tp.num_serie AS Serial,tp.num_tel,tp.direcc_mac_tel,tp.imei_tel,tp.edo_tel,tp.num_ip,tp.comentarios,tp.id_marca,tp.id_almacen,tp.id_modelo,tp.cuenta,tp.id_edo_epo,tp.nomenclatura,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta, tp.precio_compra,emp.nombre AS Nom_emp,emp.apellidos AS Empleado, emp.ntid AS Ntid FROM t_Productos tp INNER JOIN t_Empleados emp ON tp.id_empleado = emp.id_empleado INNER JOIN t_Marca tm ON
				tp.id_marca = tm.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Edo_epo tedoepo ON tp.id_edo_epo = tedoepo.id_edo_epo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico  WHERE $condicion = :$item ORDER BY tperif.nombre ASC");
				$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
				//$stmt->bindParam(":".$comparar, $condicion,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT tp.id_producto AS id_producto,tp.id_telefonia,tp.id_plan_tel,tp.id_empleado,tp.imagen_producto AS Imagen, tp.cuantas_veces AS Cuantas_veces, tperif.id_periferico,tperif.nombre AS Periferico,tp.num_serie AS Serial,tp.num_tel,tp.direcc_mac_tel,tp.imei_tel,tp.edo_tel,tp.num_ip,tp.comentarios,tp.id_marca,tp.id_almacen,tp.id_modelo,tp.cuenta,tp.qdc,tp.jls,tp.id_edo_epo,tp.nomenclatura,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta, tp.precio_compra,emp.nombre AS Nom_emp,emp.apellidos AS Empleado, emp.ntid AS Ntid FROM t_Productos tp INNER JOIN t_Empleados emp ON tp.id_empleado = emp.id_empleado INNER JOIN t_Marca tm ON
				tp.id_marca = tm.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Edo_epo tedoepo ON tp.id_edo_epo = tedoepo.id_edo_epo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico ORDER BY tperif.nombre ASC");

				$stmt->execute();
				return $stmt->fetchAll();				 
			}
			$stmt->close();
			$stmt=null;
		}

	static public function mdlMostrarProductosImpAlm($tabla,$item,$valor,$orden)
	{
		if ($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT tp.id_empleado,tperif.id_periferico,tperif.nombre AS Periferico,tp.num_serie AS Serial,tp.id_almacen,alm.nombre AS Almacen, tp.id_modelo,tp.nomenclatura,tmod.descripcion AS Modelo,tp.precio_venta AS Precio_Venta,emp.nombre AS Nom_emp,emp.apellidos AS Empleado, emp.ntid AS Ntid FROM t_Productos tp INNER JOIN t_Empleados emp ON tp.id_empleado = emp.id_empleado INNER JOIN t_Almacen alm ON tp.id_almacen = alm.id_almacen INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico  WHERE tp.id_almacen = :item ORDER BY tperif.nombre ASC");
			$stmt->bindParam(":item", $valor,PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}
	
	// Obtener los Telefonos Asignados.
		static public function mdlMostrarProductosTelAsig($tabla,$item,$valor)
		{
			$stmt = Conexion::conectar()->prepare("SELECT tp.id_periferico,perif.nombre AS Nombre_perif,tp.id_marca,tmarca.descripcion AS Marca,tp.id_modelo,tmod.descripcion AS Modelo,tp.id_empleado,emp.nombre AS Nom_emp, emp.apellidos AS Apellidos_emp,tp.num_tel,tp.num_serie,tp.imei_tel,tp.precio_venta FROM t_Productos tp INNER JOIN t_Periferico perif ON tp.id_periferico = perif.id_periferico INNER JOIN t_Marca tmarca ON tp.id_marca = tmarca.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Empleados emp ON tp.id_empleado = emp.id_empleado WHERE tp.num_tel != null OR tp.num_tel != 0 OR tp.num_serie != null OR tp.imei_tel != null");
					
			$stmt->execute();
			return $stmt->fetchAll();
		}

		// Obtener Existencia De Los Perifericos.
		static public function mdlMostrarProductosExistPerif($tabla,$item,$valor)
		{
			$stmt = Conexion::conectar()->prepare("SELECT tp.id_periferico,perif.nombre AS Nom_perif,sum(tp.stock) AS Existencia FROM `t_Productos` tp INNER JOIN `t_Periferico` perif ON tp.id_periferico = perif.id_periferico  GROUP BY tp.id_periferico");
					
			$stmt->execute();
			return $stmt->fetchAll();
		}

		// Guardar el Producto, en la tabla "t_Productos"
		static public function mdlIngresarProducto($tabla,$datos)
		{
			/*
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_periferico,num_serie,id_marca,id_modelo,id_almacen,id_edo_epo,stock,precio_compra,precio_venta,nomenclatura,especificaciones,comentarios,imagen_producto,cuantas_veces) VALUES (:id_periferico,:num_serie,:id_marca,:id_modelo,:id_almacen,:id_edo_epo,:stock,:precio_compra,:precio_venta,:nomenclatura,:especificaciones,:comentarios,:imagen_producto,:cuantas_veces)");
			*/
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_periferico,num_serie,id_telefonia,id_plan_tel,num_tel,cuenta,direcc_mac_tel,imei_tel,edo_tel,num_ip,id_marca,id_modelo,id_almacen,id_edo_epo,id_empleado,nomenclatura,stock,precio_compra,precio_venta,comentarios,imagen_producto,asset,loftware,area,linea,estacion,npa,idf,patch_panel,puerto,funcion,jls,qdc) VALUES (:id_periferico,:num_serie,:id_telefonia,:id_plan_tel,:num_tel,:cuenta,:direcc_mac_tel,:imei_tel,:edo_tel,:num_ip,:id_marca,:id_modelo,:id_almacen,:id_edo_epo,:id_empleado,:nomenclatura,:stock,:precio_compra,:precio_venta,:comentarios,:imagen_producto,:asset,:loftware,:area,:linea,:estacion,:npa,:idf,:patch_panel,:puerto,:funcion,:jls,:qdc)");

			$stmt->bindParam(":id_periferico",$datos["id_periferico"],PDO::PARAM_INT);
			$stmt->bindParam(":num_serie",$datos["num_serie"],PDO::PARAM_STR);
			$stmt->bindParam(":id_telefonia",$datos["id_telefonia"],PDO::PARAM_INT);
			$stmt->bindParam(":id_plan_tel",$datos["id_plan_tel"],PDO::PARAM_INT);
			$stmt->bindParam(":num_tel",$datos["num_tel"],PDO::PARAM_INT);
			$stmt->bindParam(":cuenta",$datos["cuenta"],PDO::PARAM_STR);
			$stmt->bindParam(":direcc_mac_tel",$datos["direcc_mac_tel"],PDO::PARAM_STR);
			$stmt->bindParam(":imei_tel",$datos["imei_tel"],PDO::PARAM_STR);
			$stmt->bindParam(":edo_tel",$datos["edo_tel"],PDO::PARAM_STR);
			$stmt->bindParam(":num_ip",$datos["num_ip"],PDO::PARAM_STR);
			$stmt->bindParam(":id_marca",$datos["id_marca"],PDO::PARAM_INT);
			$stmt->bindParam(":id_modelo",$datos["id_modelo"],PDO::PARAM_INT);
			$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_INT);
			$stmt->bindParam(":id_edo_epo",$datos["id_edo_epo"],PDO::PARAM_INT);			
			$stmt->bindParam(":id_empleado",$datos["id_empleado"],PDO::PARAM_INT);
			$stmt->bindParam(":nomenclatura",$datos["nomenclatura"],PDO::PARAM_STR);
			$stmt->bindParam(":stock",$datos["stock"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_compra",$datos["precio_compra"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_venta",$datos["precio_venta"],PDO::PARAM_STR);
			$stmt->bindParam(":comentarios",$datos["comentarios"],PDO::PARAM_STR);
			$stmt->bindParam(":imagen_producto",$datos["imagen"],PDO::PARAM_STR);
			$stmt->bindParam(":asset",$datos["asset"],PDO::PARAM_STR);		
			$stmt->bindParam(":loftware",$datos["loftware"],PDO::PARAM_STR);
			$stmt->bindParam(":area",$datos["area"],PDO::PARAM_STR);
			$stmt->bindParam(":linea",$datos["linea"],PDO::PARAM_STR);
			$stmt->bindParam(":estacion",$datos["estacion"],PDO::PARAM_STR);
			$stmt->bindParam(":npa",$datos["npa"],PDO::PARAM_STR);
			$stmt->bindParam(":idf",$datos["idf"],PDO::PARAM_STR);
			$stmt->bindParam(":patch_panel",$datos["patch_panel"],PDO::PARAM_STR);
			$stmt->bindParam(":puerto",$datos["puerto"],PDO::PARAM_STR);
			$stmt->bindParam(":funcion",$datos["funcion"],PDO::PARAM_STR);
			$stmt->bindParam(":jls",$datos["jls"],PDO::PARAM_STR);
			$stmt->bindParam(":qdc",$datos["qdc"],PDO::PARAM_STR);

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
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_periferico = :id_periferico,num_serie = :num_serie,id_telefonia = :id_telefonia,id_plan_tel = :id_plan_tel,num_tel = :num_tel,cuenta = :cuenta,direcc_mac_tel = :direcc_mac_tel,imei_tel = :imei_tel,edo_tel =:edo_tel,num_ip = :num_ip,id_marca = :id_marca,id_modelo = :id_modelo,id_almacen = :id_almacen,id_edo_epo = :id_edo_epo,nomenclatura = :nomenclatura,stock = :stock,precio_compra = :precio_compra,precio_venta = :precio_venta,comentarios = :comentarios,imagen_producto = :imagen_producto,asset = :asset,loftware = :loftware,area = :area,linea = :linea,estacion = :estacion,npa = :npa,idf = :idf,patch_panel = :patch_panel,puerto = :puerto,funcion = :funcion,jls = :jls,qdc = :qdc WHERE id_producto= :id_producto");


			$stmt->bindParam(":id_producto",$datos["id_producto"],PDO::PARAM_INT);
			$stmt->bindParam(":id_periferico",$datos["id_periferico"],PDO::PARAM_INT);
			$stmt->bindParam(":num_serie",$datos["num_serie"],PDO::PARAM_STR);
			$stmt->bindParam(":id_telefonia",$datos["id_telefonia"],PDO::PARAM_INT);
			$stmt->bindParam(":id_plan_tel",$datos["id_plan_tel"],PDO::PARAM_INT);
			$stmt->bindParam(":num_tel",$datos["num_tel"],PDO::PARAM_STR);
			$stmt->bindParam(":cuenta",$datos["cuenta"],PDO::PARAM_STR);
			$stmt->bindParam(":direcc_mac_tel",$datos["direcc_mac_tel"],PDO::PARAM_STR);
			$stmt->bindParam(":imei_tel",$datos["imei"],PDO::PARAM_STR);
			$stmt->bindParam(":edo_tel",$datos["edo_tel"],PDO::PARAM_STR);
			$stmt->bindParam(":num_ip",$datos["num_ip"],PDO::PARAM_STR);
			$stmt->bindParam(":id_marca",$datos["id_marca"],PDO::PARAM_INT);
			$stmt->bindParam(":id_modelo",$datos["id_modelo"],PDO::PARAM_INT);
			$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_INT);
			$stmt->bindParam(":id_edo_epo",$datos["id_edo_epo"],PDO::PARAM_INT);
			$stmt->bindParam(":nomenclatura",$datos["nomenclatura"],PDO::PARAM_STR);
			$stmt->bindParam(":stock",$datos["stock"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_compra",$datos["precio_compra"],PDO::PARAM_STR);
			$stmt->bindParam(":precio_venta",$datos["precio_venta"],PDO::PARAM_STR);
			$stmt->bindParam(":comentarios",$datos["comentarios"],PDO::PARAM_STR);
			$stmt->bindParam(":imagen_producto",$datos["imagen"],PDO::PARAM_STR);
			$stmt->bindParam(":asset",$datos["asset"],PDO::PARAM_STR);
			$stmt->bindParam(":loftware",$datos["loftware"],PDO::PARAM_STR);
			$stmt->bindParam(":area",$datos["area"],PDO::PARAM_STR);
			$stmt->bindParam(":linea",$datos["linea"],PDO::PARAM_STR);
			$stmt->bindParam(":estacion",$datos["estacion"],PDO::PARAM_STR);
			$stmt->bindParam(":npa",$datos["npa"],PDO::PARAM_STR);
			$stmt->bindParam(":idf",$datos["idf"],PDO::PARAM_STR);
			$stmt->bindParam(":patch_panel",$datos["patch_panel"],PDO::PARAM_STR);
			$stmt->bindParam(":puerto",$datos["puerto"],PDO::PARAM_STR);
			$stmt->bindParam(":funcion",$datos["funcion"],PDO::PARAM_STR);
			$stmt->bindParam(":jls",$datos["jls"],PDO::PARAM_STR);
			$stmt->bindParam(":qdc",$datos["qdc"],PDO::PARAM_STR);

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
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id");
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

		// Actualizar Producto, por uno solo campo 
		// $valor = Es el contenido del "Id"
		// $item1a = "cuantas_veces" es el campo que se utilizara a modificar
		// $valor1a = Es el nuevo valor de "Cuantas_veces".
		//$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProducto,$item1a,$valor1a,$valor);

		static public function mdlActualizarProducto($tabla,$item1,$valor1,$valor2)
		{
			// $item1 = Actualizar de forma dinamica, Stok, precio, descripicon,
			// $valor1 = Es el valor del campo($item1) a modificar
			// $valor2 = Es el valor del "id" que se quiere modificar.

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1  WHERE id_producto = :id");
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
		
		static public function mdlMostrarSumaPerifericos($id_periferico,$id_edo_epo,$tabla)
		{
			//ON tp.id_periferico = tperif.id_periferico  WHERE $condicion = :$item ORDER BY tperif.nombre ASC");
			//	$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);

			$stmt = Conexion::conectar()->prepare("SELECT SUM(stock) as total FROM $tabla WHERE id_periferico = :item1 && id_edo_epo = :item2");

			$stmt->bindParam(":item1", $id_periferico,PDO::PARAM_INT);
			$stmt->bindParam(":item2", $id_edo_epo,PDO::PARAM_INT);

			$stmt->execute();
			
			return $stmt->fetch();
			$stmt->close();
			$stmt = null;
/*
			:imagen_producto WHERE id_producto= :id_producto");


			$stmt->bindParam(":id_producto",$datos["id_producto"],PDO::PARAM_INT);

			$stmt = Conexion::conectar()->prepare("SELECT tp.id_producto AS id_producto,tp.id_telefonia,tp.id_plan_tel,tp.id_empleado,tp.imagen_producto AS Imagen, tp.cuantas_veces AS Cuantas_veces, tperif.id_periferico,tperif.nombre AS Periferico,tp.num_serie AS Serial,tp.num_tel,tp.direcc_mac_tel,tp.imei_tel,tp.edo_tel,tp.num_ip,tp.comentarios,tp.id_marca,tp.id_almacen,tp.id_modelo,tp.cuenta,tp.id_edo_epo,tp.nomenclatura,tm.descripcion AS Marca,tmod.descripcion AS Modelo,tedoepo.descripcion AS Edo_Epo,tp.stock AS Stock,tp.precio_venta AS Precio_Venta, tp.precio_compra,emp.apellidos AS Empleado, emp.ntid AS Ntid FROM t_Productos tp INNER JOIN t_Empleados emp ON tp.id_empleado = emp.id_empleado INNER JOIN t_Marca tm ON
			tp.id_marca = tm.id_marca INNER JOIN t_Modelo tmod ON tp.id_modelo = tmod.id_modelo INNER JOIN t_Edo_epo tedoepo ON tp.id_edo_epo = tedoepo.id_edo_epo INNER JOIN t_Periferico tperif ON tp.id_periferico = tperif.id_periferico  WHERE $condicion = :$item ORDER BY tperif.nombre ASC");
			$stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
			//$stmt->bindParam(":".$comparar, $condicion,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
*/

		}
	
	} // class ModeloProductos

?>