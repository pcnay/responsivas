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

/*
ALTER TABLE t_Productos ADD qdc VARCHAR(15) DEFAULT NULL;
ALTER TABLE t_Productos ADD jls VARCHAR(15) DEFAULT NULL;
 Para agregar una columna a la tabla t_Empleados. 
	ALTER TABLE t_Productos ADD asset VARCHAR(15) DEFAULT NULL;
	ALTER TABLE t_Productos ADD loftware VARCHAR(10) DEFAULT NULL;
	ALTER TABLE t_Productos ADD area VARCHAR(20) DEFAULT NULL;
	ALTER TABLE t_Productos ADD linea VARCHAR(25) DEFAULT NULL;
	ALTER TABLE t_Productos ADD estacion VARCHAR(50) DEFAULT NULL;
	ALTER TABLE t_Productos ADD npa VARCHAR(15) DEFAULT NULL;
	ALTER TABLE t_Productos ADD idf VARCHAR(5) DEFAULT NULL;
	ALTER TABLE t_Productos ADD patch_panel VARCHAR(5) DEFAULT NULL;
	ALTER TABLE t_Productos ADD puerto VARCHAR(5) DEFAULT NULL;
	ALTER TABLE t_Productos ADD funcion VARCHAR(20) DEFAULT NULL;
/*
INSERT INTO t_Usuarios (id_usuario,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Administrador','admin','Resp2020Ene','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);
*/

/*
 Para agregar una columna a la tabla t_Empleados. 
	ALTER TABLE t_Responsivas ADD fecha_devolucion date NULL;
*/


/*
CREATE TABLE t_Centro_Costos
(
  id_centro_costos SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	num_centro_costos VARCHAR(30) NOT NULL,
  descripcion VARCHAR(80) NOT NULL	
);
*/



/* Para agregar una columna a la tabla t_Empleados .  */
	/*
	ALTER TABLE 't_Empleados' CHANGE 'id_centro_costos' 'id_centro_costos' SMALLINT(5) UNSIGNED NOT NULL;
*/

/*
	ALTER TABLE t_Empleados ADD FOREIGN KEY(id_centro_costos) REFERENCES t_Centro_Costos(id_centro_costos) ON DELETE RESTRICT ON UPDATE CASCADE;
*/




/*
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');

INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
INSERT INTO t_Cintas (id_cintas,num_serial,fecha_inic,fecha_final,ubicacion,comentarios) VALUES
  (0,'URL30405','2021-01-20','2021-01-23','UBICACION XX','COMENTARIOS VARIOS');
*/

/* Para agregar una columna a la tabla t_Empleados. 
	ALTER TABLE t_Productos ADD stock SMALLINT UNSIGNED DEFAULT 0;
*/

/* Para agregar una columna a la tabla t_Empleados.
	ALTER TABLE t_Empleados ADD foto varchar(100) NOT NULL;
*/


/* Para agregar una columna a la tabla t_Productos . 
	ALTER TABLE t_Productos ADD especificaciones TEXT NULL ;

*/

/*
CREATE TABLE t_Cintas
(
  id_cintas SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  num_serial VARCHAR(15) NOT NULL,
  fecha_inic DATE NULL,
	fecha_final DATE NULL,
  ubicacion VARCHAR(20) NOT NULL,
	comentarios TEXT
  
);
*/




/*
INSERT INTO t_Empleados (id_empleado,id_ubicacion,id_puesto,id_depto,id_supervisor,nombre,apellidos,ntid,correo_electronico,centro_costos,foto,fecha) VALUES
  (0,1,1,1,1,'nombreUno','apellidoUno','ntidUno','correoelectronicoUno','centrocostoUno','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP);
*/

/*

INSERT INTO t_Empleados (id_empleado,id_ubicacion,id_puesto,id_depto,id_supervisor,nombre,apellidos,ntid,correo_electronico,centro_costos,foto,fecha) VALUES
  (0,1,1,1,1,'nombreDos','apellidoDos','ntidDos','correoelectronicoDos','centrocostoDos','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP),	
	(0,1,1,1,1,'nombreTres','apellidoTres','ntidTres','correoelectronicoTres','centrocostoTres','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP),
	(0,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP);
/*
	......
	.......
	......

(0,1,1,1,1,'nombreCuatro','apellidoCuatro','ntidCuatro','correoelectronicoCuatro','centrocostoCuatro','vistas/img/productos/default/anonymous.png',CURRENT_TIMESTAMP);

*/


