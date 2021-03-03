var perfilOculto = $("#perfilOculto").val();
//console.log ("perfilOculto",perfilOculto);



/* Cargar los datos - Responsivas de forma dinamica */
//$.ajax({
//	url:"ajax/datatable-responsivas.ajax.php",
//	success:function(respuesta)
//	{
//		console.log("respuesta",respuesta);
//	}
//})

/* Cargar los datos - Productos de forma dinamica */

// Para hacer que las variables de sesion se puedan usar en Datatable.



// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
// ?perfilOculto="+perfilOculto = Se manda como variable GET a "datatable-productos.ajax.php"
$('.tablaResponsivasProd').DataTable({
	"ajax":"ajax/datatable-responsivasProd.ajax.php?perfilOculto="+perfilOculto,
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
	"pageLength":3,
	"lengthMenu": [ 3, 10, 25, 50, 75, 100 ],
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


// ================================================================================
// Para deplegar los Empleados en el DataTable. 
// ================================================================================
// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
// ?perfilOculto="+perfilOculto = Se manda como variable GET a "datatable-productos.ajax.php"
$('.tablaResponsivasEmp').DataTable({
	"ajax":"ajax/datatable-responsivasEmp.ajax.php?perfilOculto="+perfilOculto,
	"defenderRender":true,
	"retrieve":true,
	"processing":true,
	"pageLength":3,
	"lengthMenu": [ 3, 10, 25, 50, 75, 100 ],
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


// Click en la tabla de los Empleados.
$(".tablaResponsivasEmp tbody").on("click","button.agregarEmpleado",function(){
	//$botones = "<div class='btn-group'><button class='btn btn-primary agregarEmpleado recuperarBoton' idEmpleado='".$empleados[$i]["id_empleado"]."'>Agregar </button></div>";

	var idEmpleado = $(this).attr("idEmpleado");
	console.log("idEmpleado",idEmpleado);
	// Desactivar el boton "Agregar", solo se activa una sola vez.
	$(this).removeClass("btn-primary agregarEmpleado");
	$(this).addClass("btn-default");

	// Se vas obtener el Empleado atraves de una consulta.
	var datos = new FormData();
	datos.append("idEmpleado",idEmpleado); // Se genera la variable global "idEmpleado", que se utiliza en "empleados.ajax.php"
	$.ajax({
		url:"ajax/empleados.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			// Para agregar el contenido en la etiqueta de "Nombre Empleado"
			$("#agregarEmpleado").val(respuesta["nombre"]+' '+respuesta["apellidos"]);
			console.log("respuesta",respuesta);
		}

	});



});


// Click en la tabla de los productos.
$(".tablaResponsivasProd tbody").on("click","button.agregarProducto",function()
{
	//	$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id_producto"]."'>Agregar </button></div>";

	var idProducto = $(this).attr("idProducto");
	console.log("idProducto",idProducto);
	// Desactivar el boton "Agregar", solo se activa una sola vez.
	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");

	// Se vas obtener el producto atraves de una consulta.
	var datos = new FormData();
	datos.append("idProducto",idProducto); // Se genera la variable global "idProducto", que se utiliza en "productos.ajax.php"
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			var descripcion = respuesta["Periferico"];
			var stock = respuesta["Stock"];
			var precio = respuesta["Precio_Venta"];
			//console.log("Nombre Periferico",respuesta["Periferico"]);
			
			// Se inicia agregar los productos en la responsivas
			$(".nuevoProducto").append(
					'<!-- Para cada renglon que se agregue de los productos -->'+
					'<!--Para evitar no se apilen los renglones al agregar productos  -->'+
					'<div class ="row" style="padding:5px 15px">'+
						
						'<!-- style="padding-right:0px" Aumentar el ancho de las cajas, reduce el ancho entre las cajas -->'+
						'<div class="col-xs-6" style="padding-right:0px">'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>'+

								'<input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="Descripcion Del Prodcuto" required>'+

							'</div> <!-- <div class="input-group"> -->'+

						'</div> <!-- <div class="col-xs-6" style="padding-right:0px"> -->'+

						'<!-- Columna de la "cantidad" -->'+
						'<div class="col-xs-3">'+
							'<input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>'+
						'</div> <!-- <div class="col-xs-3"> --> '+
						
						'<!-- Columna del "Precio" -->'+
						'<!-- style="padding-right:0px" Aumentar el ancho de las cajas, reduce el ancho entre las cajas -->'+
						'<div class="col-xs-3" style="padding-left:0px">'+
							'<div class="input-group">'+
							'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="number" class="form-control" id="nuevaPrecioProducto" name="nuevaPrecioProducto" placeholder="00000000" readonly required>'+
							'</div>	<!-- <div class="input-group">  -->'+

						'</div> <!-- <div class="col-xs-3" style="ppading-left:0px"> -->'+

					'</div> <!-- <div clss="form-group row nuevoProducto"> --> '); 


		}

	});

});

