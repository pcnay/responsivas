/*
	Tipos de datos de MariaDB
  https://www.anerbarrena.com/tipos-dato-mysql-5024/


-- Ejecutarlo desde una terminal de Mysql 
-- Se debe accesar al directorio donde se encuentra el "script.sql" y ejecutar el comenado "mysql" desde una terminal


-- $ mysql -u nom-usr -p NombreBaseDatos < script.sql
-- Otra Forma :
--    mysql -u usuario -p NombreBaseDatos
--    source script.sql ó \. script.sql
*/

USE bd_responsivas;







/* Para agregar una columna a la tabla t_Empleados.
	ALTER TABLE t_Empleados ADD foto varchar(100) NOT NULL;
*/


/* Para agregar una columna a la tabla t_Productos . 
	ALTER TABLE t_Productos ADD especificaciones TEXT NULL ;

*/

/*
INSERT INTO t_Empleados (id_empleado,id_ubicacion,id_puesto,id_depto,id_supervisor,nombre,apellidos,ntid,correo_electronico,centro_costos,foto,fecha) VALUES
  (0,1,1,1,1,'nombreUno','apellidoUno','ntidUno','correoelectronicoUno','centrocostoUno','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP);


INSERT INTO t_Empleados (id_empleado,id_ubicacion,id_puesto,id_depto,id_supervisor,nombre,apellidos,ntid,correo_electronico,centro_costos,foto,fecha) VALUES
  (0,1,1,1,1,'nombreDos','apellidoDos','ntidDos','correoelectronicoDos','centrocostoDos','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP),	
	(0,1,1,1,1,'nombreTres','apellidoTres','ntidTres','correoelectronicoTres','centrocostoTres','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP),
	(0,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP),
	......
	.......
	......

(0,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP);

*/

/*
INSERT INTO t_Usuarios (id_usuario,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Usuario Administrador','admin','1234','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
*/


