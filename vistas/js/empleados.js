/* Cargar los datos - Empleados de forma dinamica
	formatos de JSon.

*/

/*
// Se puede utilizar para verificar en caso de error.

$.ajax({		
	url:"ajax/datatable-empleados.ajax.php",
	success:function(respuesta){
	console.log("respuesta",respuesta);
		}
})

*/
/* 
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
  Estos tres parametros son para optimizar el DataTable.
*/

$('.tablaEmpleados').DataTable({
	"ajax":"ajax/datatable-empleados.ajax.php",
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
  "language":{ 
    "sProcessing": "Procesando ...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros",
    "sInfoPostFix": "",
    "sSearch": "Buscar",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando ...",
    "oPaginate":{
      "sFirst": "Primero",
      "sLast": "Ultimo",
      "sNext": "Siguiente",
      "sPrevious": "Anterior",
		},
		"oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
	}

});





/*
// Para hacer que las variables de sesion se puedan usar en Datatable.
var perfilOculto = $("#perfilOculto").val();
//console.log ("perfilOculto",perfilOculto);

// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
// ?perfilOculto="+perfilOculto = Se manda como variable GET a "datatable-productos.ajax.php"
$('.tablaEmpleados').DataTable({
	"ajax":"ajax/datatable-empleados.ajax.php?perfilOculto="+perfilOculto,
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
  "language":{ 
    "sProcessing": "Procesando ...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros",
    "sInfoPostFix": "",
    "sSearch": "Buscar",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando ...",
    "oPaginate":{
      "sFirst": "Primero",
      "sLast": "Ultimo",
      "sNext": "Siguiente",
      "sPrevious": "Anterior",
		},
		"oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
	}

});
*/



// Se agrega el código para obtener el último número del codigo a utilizar
$("#nuevaCategoria").change(function(){
	
	// Obtener el último de "codigo" desde la tabla "productos"
	var idCategoria = $(this).val();
	var datos = new FormData();
	datos.append("idCategoria",idCategoria);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			//console.log("respuesta",respuesta);
			// Para el caso de que no exista una categoria en la tabla de "t_Productos".
			if (!respuesta)
			{
				// No Categoria mas 01 para completar el numero, ejemplo 9 + 01 = 901
				var nuevoCodigo = idCategoria+"01";
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			else
			{
				// Se obtiene el código de la tabla de "t_Productos"
				var nuevoCodigo = Number(respuesta["codigo"])+1;
				//console.log("respuesta",nuevoCodigo);
				// Se asigna a la etiqueta "codigo" de la vista Captura de Productos.
				$("#nuevoCodigo").val(nuevoCodigo);
			}
			

		}
	})
})


// Se agrega la foto del Empleado, viene desde el formulario de captura (vistas/modulos/empleados.php)
$(".nuevaImagen").change(function(){

	// propiedad de la etiqueta "File" de JavaScript, obtiene la imagen en el indice 0
	var imagen = this.files[0]; 
  //console.log("imagen",imagen);

  // Validando que el formato de la imagen sea JPE o PNG
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
  {
    $(".nuevaImagen").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen debe estar en formato JPG o PNG",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  
  else if (imagen["size"] > 2000000) // 2 Mb
  {
    $(".nuevaImagen").val("");
      Swal.fire ({
        title: "Error al subir la imagen",
        text: "La imagen no debe pesar mas de 2 MB.",
        icon: "error",
        confirmButtonText: "Cerrar"
      });
  }
  else
  {
    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);
    
    $(datosImagen).on("load",function(event){
      var rutaImagen = event.target.result;
      // Se muestra la imagen en la pantalla, cuando se sube.
      $(".previsualizar").attr("src",rutaImagen);
    })
  }


})

// Editar Empleado
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cunado se haya cargado ().tablaEmpleados tbody).on se asigna el evento "on("click") a la clase "btnEditarEmpleado" la siguiente "function"
$(".tablaEmpleados tbody").on("click","button.btnEditarEmpleado",function(){
	// "idEmpleados" viene desde el archivo : "datatable-empleados.ajax.php -> $botones"
	var idEmpleado = $(this).attr("idEmpleado");
	console.log("idEmpleado",idEmpleado);
	
	
	// Se utilizara Ajax para obtener la información del empleados desde la base de datos.
	// Se esta agregando un dato al Ajax.
	var datos = new FormData();
	datos.append("idEmpleado",idEmpleado);
	$.ajax
	({
		url:"ajax/empleados.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta)
		{
			console.log("respuesta",respuesta);
			
			// Obtener el Puesto, la descripcion					
			var datosPuesto = new FormData();

			// respuesta["id_puesto"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosPuesto" = es una variable POST que se envia a "puesto.ajax.php".
			datosPuesto.append("idPuesto",respuesta["id_puesto"]);
			$.ajax
			({
				url:"ajax/puestos.ajax.php",
				method:"POST",
				data:datosPuesto,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(respuesta)
				{
					console.log("respuesta",respuesta);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarPuesto").val(respuesta["id_puesto"]);
					$("#editarPuesto").html(respuesta["descripcion"]);		
				}
		
			})

			// Obtener el Depto, la descripcion					
			var datosDepto = new FormData();

			// respuesta["id_depto"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosDepto" = es una variable POST que se envia a "deptos.ajax.php".
			datosDepto.append("idDepto",respuesta["id_depto"]);
			$.ajax
			({
				url:"ajax/deptos.ajax.php",
				method:"POST",
				data:datosDepto,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(respuesta)
				{
					//console.log("respuesta",respuesta);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarDepto").val(respuesta["id_depto"]);
					$("#editarDepto").html(respuesta["descripcion"]);		
				}
		
			})

			// Obtener el Supervisor, la descripcion					
			var datosSupervisor = new FormData();

			// respuesta["id_supervisor"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosSupervisor" = es una variable POST que se envia a "supervisores.ajax.php".
			datosSupervisor.append("idSupervisor",respuesta["id_supervisor"]);
			$.ajax
			({
				url:"ajax/supervisores.ajax.php",
				method:"POST",
				data:datosSupervisor,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(respuesta)
				{
					//console.log("respuesta",respuesta);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarSupervisor").val(respuesta["id_supervisor"]);
					$("#editarSupervisor").html(respuesta["descripcion"]);		
				}
		
			})

			// Obtener la Ubicacion, la descripcion					
			var datosUbicacion = new FormData();

			// respuesta["id_ubicacion"] = Viene del Ajax Anterior, ya que retorna un arreglo.
			// "datosSupervisor" = es una variable POST que se envia a "ubicaciones.ajax.php".
			datosUbicacion.append("idUbicacion",respuesta["id_ubicacion"]);
			$.ajax
			({
				url:"ajax/ubicaciones.ajax.php",
				method:"POST",
				data:datosUbicacion,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(respuesta)
				{
					//console.log("respuesta",respuesta);		
					// Asignando el valor recuperado a la etiqueta de SELECT de "empleados.php"		
					$("#editarUbicacion").val(respuesta["id_ubicacion"]);
					$("#editarUbicacion").html(respuesta["descripcion"]);		
				}
		
			})

			// Asignando los campos restantes 
			$("#id_empleado").val(respuesta["id_empleado"]);
			$("#editar_ntid").val(respuesta["ntid"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarApellido").val(respuesta["apellidos"]);
			$("#editarCorreoElect").val(respuesta["correo_electronico"]);
			$("#editarCentroCosto").val(respuesta["centro_costos"]);
			if (respuesta["foto"] != "")
			{
				$("#imagenActual").val(respuesta["foto"]);
				$(".previsualizar").attr("src",respuesta["foto"]);
			}

		} // success:function(respuesta) 

	}); // 



			/*
			// Obtener el Depto.
			var datosDepto = new FormData();
			datosDepto.append("idDepto",respuesta["id_depto"]);
			$.ajax
			({
				url:"ajax/deptos.ajax.php",
				method:"POST",
				data:datosDepto,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(respuesta)
				{
					console.log("respuesta",respuesta);					
					$("#editarDepto").val(respuesta["id_depto"]);
					$("#editarDepto").html(respuesta["descripcion"]);
		
				}
		
			})		

			// Obtener el Supervisor.
			var datosSupervisor = new FormData();
			datosSupervisor.append("idSupervisor",respuesta["id_supervisor"]);
			$.ajax
			({
				url:"ajax/supervisores.ajax.php",
				method:"POST",
				data:datosSupervisor,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(respuesta)
				{
					console.log("respuesta",respuesta);					
					$("#editarSupervisor").val(respuesta["id_supervisor"]);
					$("#editarSupervisor").html(respuesta["descripcion"]);
		
				}
		
			})		

			// Obtener la Ubicacion.
			var datosUbicacion = new FormData();
			datosUbicacion.append("idUbicacion",respuesta["id_ubicacion"]);
			$.ajax
			({
				url:"ajax/ubicaciones.ajax.php",
				method:"POST",
				data:datosUbicacion,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(respuesta)
				{
					console.log("respuesta",respuesta);					
					$("#editarUbicacion").val(respuesta["id_ubicacion"]);
					$("#editarUbicacion").html(respuesta["descripcion"]);
		
				}
		
			})		

			// Se van asignar los valores a las editas del producto a Editar.
			$("#editar_ntid").val(respuesta["ntid"]);
			$("#editarNombre").val(respuesta["nombre"]);
			$("#editarApellido").val(respuesta["apellidos"]);
			$("#editarCorreoelect").val(respuesta["correo_electronico"]);
			$("#editarCentroCosto").val(respuesta["centro_costo"]);

			if (respuesta["imagen"] != "")
			{
				$("#imagenActual").val(respuesta["imagen"]);
				//console.log("imagen",respuesta["imagen"]);
				
				$(".previsualizar").attr("src",respuesta["imagen"]);
			}

			
		}

	})	

*/

}) // $(".tablaEmpleados tbody").on("click","button.btnEditarEmpleado",function(){


// Borrar Empleado
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar
$(".tablaEmpleados tbody").on("click","button.btnEliminarEmpleado",function(){
	var idEmpleado = $(this).attr("idEmpleado");
	// console.log("idEmpleado",idEmpleado);
	// Obtener el NtId del "empleado" y la ruta de la imagen que esta grabada en la Tabla.
	var codigo = $(this).attr("ntid");
	var imagen = $(this).attr("imagen");

	
	Swal.fire ({
		type: "success",
		title: "El Empleado sido borrada correctamente ",
		text : "De lo contrario puede cancelar la Acción ",
		type:'warning',
		showCancelButton:true,		
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText:'Si Para Borrar',
		closeOnConfirm: false
		}).then(function(result){
			if (result.value)
			{
				window.location="index.php?ruta=empleados&idEmpleado="+idEmpleado+"&imagen="+imagen+"&ntid="+ntid;
			}

			});	

})
