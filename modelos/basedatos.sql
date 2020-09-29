/*
-- Ejecutarlo desde una terminal de Mysql 
-- Se debe accesar al directorio donde se encuentra el "script.sql" y ejecutar el comenado "mysql" desde una terminal
-- $ mysql -u nom-usr -p NombreBaseDatos < script.sql
-- Otra Forma :
--    mysql -u usuario -p NombreBaseDatos
--    source script.sql ó \. script.sql
*/

DROP DATABASE IF EXISTS bd_responsivas;

CREATE DATABASE IF NOT EXISTS bd_responsivas;
/* SET time_zone = 'America/Tijuana'; */

USE bd_responsivas;


/* Solo se ejecuta la primera vez. */
CREATE USER 'usuario_responsiva'@'localhost' IDENTIFIED BY 'responsivas-2020';
GRANT ALL on bd_responsivas.* to 'usuario_responsiva'  IDENTIFIED BY 'responsivas-2020';

/* 
Mostrar todos los usuarios 
  select user from mysql.user;
Para borrar un usuario:
Para borrar un usuario para todos los hosts:
	drop user ventas-pos;

Para borrar un usuario en especifico
	delete from mysql.user where user = ‘ventas-pos’

Para borrar mas de un usuario en el host
	drop user ‘ventas-pos’@’localhost’;
	
	flush privileges;

*/

/* Tabla de Datos */
/* Se ocupa los 9 espacios, no se desperdicia espacio.*/
  /* CHAR(X) = cuando se define de algun tamaño pero no se utiliza, se despedicia espacio, por ejemplo
  CHAR(30), pero el valor de "title" es de 20, se desperdicio 60 espacios.
  VARCHAR(80) se adapta al tamaño del titulo.
  En la base de datos se puede guardar, videos, documentos en formato binario, pero creceria mucho.
  Se sube el video, documento, solo se graba la URL en el campo de la base de datos.
	
	estado INTEGER UNSIGNED DEFAULT 0,

	Tipos De Datos que maneja MySQL, MariaDb
	https://www.anerbarrena.com/tipos-dato-mysql-5024/

  */


CREATE TABLE t_Periferico
(
  id_periferico SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(80) NOT NULL,  
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE t_Almacen
(
  id_almacen SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(80) NOT NULL  
);

CREATE TABLE t_Edo_epo
(
  id_edo_epo SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(80) NOT NULL  
);

CREATE TABLE t_Marca
(
  id_marca SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(45) NOT NULL  
);

CREATE TABLE t_Modelo
(
  id_modelo SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(45) NOT NULL  
);

CREATE TABLE t_Puerto
(
  id_puerto SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(45) NOT NULL  
);

CREATE TABLE t_Patch_panel
(
  id_patch_panel SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	id_puerto SMALLINT UNSIGNED NOT NULL,
  descripcion VARCHAR(45) NOT NULL,
	FOREIGN KEY(id_puerto) REFERENCES t_Puerto(id_puerto)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE t_Idf
(
  id_idf SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	id_patch_panel SMALLINT UNSIGNED NOT NULL,
  descripcion VARCHAR(45) NOT NULL,  
	FOREIGN KEY(id_patch_panel) REFERENCES t_Patch_panel(id_patch_panel)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE t_Planta
(
  id_planta SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(45) NOT NULL,
	domicilio VARCHAR(100) NOT NULL,
	telefono VARCHAR(45)  
);

CREATE TABLE t_Usuarios
(
  id_usuario SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  usuario VARCHAR(45) NOT NULL,
  clave VARCHAR(80) NOT NULL,
  perfil VARCHAR(45) NOT NULL,
  vendedor VARCHAR(45) NULL,
  foto VARCHAR(45) NULL,
  estado TINYINT UNSIGNED DEFAULT 0,
  ultimo_login DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE t_Puesto
(
  id_puesto SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(45) NOT NULL	
);

CREATE TABLE t_Ubicacion
(
  id_ubicacion SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(45) NOT NULL	
);

CREATE TABLE t_Supervisor
(
  id_supervisor SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(50) NOT NULL	
);

CREATE TABLE t_Depto
(
  id_depto SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  descripcion VARCHAR(50) NOT NULL	
);


CREATE TABLE t_Empleados
(
  id_empleado SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,  
	id_ubicacion SMALLINT UNSIGNED NOT NULL,
	id_puesto SMALLINT UNSIGNED NOT NULL,
	id_supervisor SMALLINT UNSIGNED NOT NULL,
	id_depto SMALLINT UNSIGNED NOT NULL,
  nombre VARCHAR(20) NOT NULL,
	apellidos VARCHAR(45) NOT NULL,
	ntid VARCHAR(20) NOT NULL,
	correo_electronico VARCHAR(50) NOT NULL,
	centro_costos VARCHAR(20) NOT NULL,	
	fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(id_ubicacion) REFERENCES t_Ubicacion(id_ubicacion)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_puesto) REFERENCES t_Puesto(id_puesto)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_supervisor) REFERENCES t_Supervisor(id_supervisor)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_depto) REFERENCES t_Depto(id_depto)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE t_Productos
(
  id_producto SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,  
	id_almacen SMALLINT UNSIGNED NOT NULL,
	id_edo_epo SMALLINT UNSIGNED NOT NULL,
	id_marca SMALLINT UNSIGNED NOT NULL,
	id_modelo SMALLINT UNSIGNED NOT NULL,
	id_idf SMALLINT UNSIGNED NOT NULL,
	id_patch_panel SMALLINT UNSIGNED NOT NULL,
	id_puerto SMALLINT UNSIGNED NOT NULL,
	id_periferico SMALLINT UNSIGNED NOT NULL,
  nomenclatura VARCHAR(45) NOT NULL,
	num_serie VARCHAR(45) NOT NULL,
	imagen_producto VARCHAR(100) NOT NULL,
	precio_compra decimal(10,2) DEFAULT NULL,
	precio_venta decimal(10,2) DEFAULT NULL,
	cuantas_veces TINYINT DEFAULT NULL,
	fecha_arribo DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	comentarios TEXT,
	FOREIGN KEY(id_almacen) REFERENCES t_Almacen(id_almacen)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_edo_epo) REFERENCES t_Edo_epo(id_edo_epo)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_marca) REFERENCES t_Marca(id_marca)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_modelo) REFERENCES t_Modelo(id_modelo)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_idf) REFERENCES t_Idf(id_idf)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_patch_panel) REFERENCES t_Patch_panel(id_patch_panel)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_puerto) REFERENCES t_Puerto(id_puerto)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_periferico) REFERENCES t_Periferico(id_periferico)
	ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE t_Responsivas
(
  id_responsiva SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,  
	id_planta SMALLINT UNSIGNED NOT NULL,
	id_empleado SMALLINT UNSIGNED NOT NULL,
	id_producto SMALLINT UNSIGNED NOT NULL,
	id_usuario SMALLINT UNSIGNED NOT NULL,
	id_ubicacion SMALLINT UNSIGNED NOT NULL,
  num_folio VARCHAR(45) NOT NULL,
	prestamo CHAR(1) NOT NULL,	
	responsiva_firmada VARCHAR(100),
	comentario TEXT,
	devolucion TEXT,
	fecha_asignado DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY(id_planta) REFERENCES t_Planta(id_planta)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_empleado) REFERENCES t_Empleados(id_empleado)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_producto) REFERENCES t_Productos(id_producto)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_usuario) REFERENCES t_Usuarios(id_usuario)
	ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY(id_ubicacion) REFERENCES t_Ubicacion(id_ubicacion)
	ON DELETE RESTRICT ON UPDATE CASCADE	
);


/*
INSERT INTO t_Usuario (id_usuario,nombre,usuario,clave,perfil,vendedor,foto,estado,ultimo_login,fecha) VALUES
  (1,'Usuario Administrador','admin','1234','Administrador','','',1,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);

*/






