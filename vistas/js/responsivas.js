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
	//console.log("idEmpleado",idEmpleado);
	// Desactivar el boton "Agregar", solo se activa una sola vez.
	//$(this).removeClass("btn-primary agregarEmpleado");
	//$(this).addClass("btn-default");

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
			//console.log("respuesta",respuesta);
		}

	});



});


// Click en la tabla de los productos.
$(".tablaResponsivasProd tbody").on("click","button.agregarProducto",function()
{
	//	$botones = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id_producto"]."'>Agregar </button></div>";

	var idProducto = $(this).attr("idProducto");
	//console.log("idProducto",idProducto);
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
			// console.log("Nombre Periferico",respuesta["Periferico"]);

			// Evitar agregar Producto cuando el Stocl esta en CERO
			if (stock == 0)
			{
				Swal.fire ({
					title: "NO hay stock disponible",
					type:"error",
					confirmButtonText: "Cerrar"
					});
					$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");
					return;
			}
			
			// Se inicia agregar los productos en la responsivas, esta clase viene desde :
			// <!-- Entrada del Producto -->
			//<div class="form-group row nuevoProducto">
			// Se utiliza el atributo "value" para asignar los valores que se obtienen de la tabla de Productos cuando
			//se selecciona.

			$(".nuevoProducto").append
			(
					'<!-- Para cada renglon que se agregue de los productos -->'+
					'<!--Para evitar no se apilen los renglones al agregar productos  -->'+
					'<div class ="row" style="padding:5px 15px">'+
						
						'<!-- style="padding-right:0px" Aumentar el ancho de las cajas, reduce el ancho entre las cajas -->'+
						'<div class="col-xs-6" style="padding-right:0px">'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto = "'+idProducto+'" ><i class="fa fa-times"></i></button></span>'+

								'<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value ="'+descripcion+'" readonly required>'+

							'</div> <!-- <div class="input-group"> -->'+

						'</div> <!-- <div class="col-xs-6" style="padding-right:0px"> -->'+

						'<!-- Columna de la "cantidad" -->'+
						'<div class="col-xs-3 ingresoCantidad">'+
							'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock = "'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
						'</div> <!-- <div class="col-xs-3"> --> '+
						
						'<!-- Columna del "Precio" -->'+
						'<!-- style="padding-right:0px" Aumentar el ancho de las cajas, reduce el ancho entre las cajas -->'+
						'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
							'<div class="input-group">'+
							'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value ="'+precio+'" readonly required>'+
							'</div>	<!-- <div class="input-group">  -->'+

						'</div> <!-- <div class="col-xs-3" style="ppading-left:0px"> -->'+

					'</div> <!-- <div clss="form-group row nuevoProducto"> --> '
			); 
			
			// Sumar totalpreicos
			sumarTotalPrecios();
			agregarImpuesto();

			//Agrupar productos en formato JSon, en un solo renglons se agregan el detalle de la Responsiva.
			listarProductos();
			
			// Asignar fornmatos al precio de los productos.
			$(".nuevoPrecioProducto").number(true,2);

		}

	});

});


// Cuando cargue la tabla cada vez que se nevegue en ella
// Es para realizar una funcion cuando se esta navegando en la tabla, es recomendada por DataTable. 
$(".tablaResponsivasProd").on("draw.dt",function()
{
	//console.log("tabla");
	if(localStorage.getItem("quitarProducto") != null)
	{
		// Convierte el String de Local Storage a un Json
		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto")); 
		for (var i = 0; i < listaIdProductos.length; i++)
		{
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');		
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');		
		}
	}
})



// Quitar un producto de la responsiva  y recuperar el boton de "Agregar"

var idQuitarProducto = [];
localStorage.removeItem("quitarProducto");

$(".formularioResponsiva").on("click","button.quitarProducto",function(){
	// Conforme se agregan los "parent" se van borrando, pero con los 4 parent lleva a este nivel
	// '<div class ="row" style="padding:5px 15px">', es decir donde se inicia el "append"
	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto"); // Para obtener el "id_producto"


	// Se agrega un ajuste, ya que cuando se agrega un producto desde otras paginas, se desactiva el boton cuando se agrego, pero se regresa a esa misma pagina, pero el boton queda desactivado cuando se quita el producto de la responsiva.

	if (localStorage.getItem("quitarProducto")== null)
	{
		idQuitarProducto = [];

	}
	else
	{
		idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
	}
	idQuitarProducto.push({"idProducto":idProducto});
	localStorage.setItem("quitarProducto",JSON.stringify(idQuitarProducto)); // se genera la clase 


	// Para remover cuando esta deshabilitado, y habilitarlo.
	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	// Viene desde "cap-responsiva.php", <Div> ... id ="nuevoProducto" ...
	// que no tenga renglones en las responsivas.
	if($(".nuevoProducto").children().length == 0)	
	{
		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);
	}
	else
	{
		// Actualizando el total de los precios de las responsivas
		sumarTotalPrecios();	
		agregarImpuesto();
		//Agrupar productos en formato JSon, en un solo renglons se agregan el detalle de la Responsiva.
		listarProductos();

	}
	
}) 

// ===========================================================
// Agregando producto desde el boton para dispositivos.
// ============================================================
var numProducto = 0;
$(".btnAgregarProducto").click(function(){
	numProducto ++;
	var datos = new FormData()
	datos.append("traerProductos","ok");

	// Para obtener todos los productos, utilizando Ajax.
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
			//	console.log('productos',respuesta);
			
			$(".nuevoProducto").append(
					'<!-- Para cada renglon que se agregue de los productos -->'+
					'<!--Para evitar no se apilen los renglones al agregar productos  -->'+
					'<div class ="row" style="padding:5px 15px">'+
						
						'<!-- style="padding-right:0px" Aumentar el ancho de las cajas, reduce el ancho entre las cajas -->'+
						'<div class="col-xs-6" style="padding-right:0px">'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto ><i class="fa fa-times"></i></button></span>'+

								'<select class="form-control nuevaDescripcionProducto" idProducto name="nuevaDescripcionProducto" required>'+

								'<option>Seleccione el Produdcto</option>'+
								'</select>'+

							'</div> <!-- <div class="input-group"> -->'+

						'</div> <!-- <div class="col-xs-6" style="padding-right:0px"> -->'+

						'<!-- Columna de la "cantidad" -->'+
						'<div class="col-xs-3 ingresoCantidad">'+
							'<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock="'+Number(stock-1)+'" required>'+
						'</div> <!-- <div class="col-xs-3"> --> '+
						
						'<!-- Columna del "Precio" -->'+
						'<!-- style="padding-right:0px" Aumentar el ancho de las cajas, reduce el ancho entre las cajas -->'+
						'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+
							'<div class="input-group">'+
							'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+
							'</div>	<!-- <div class="input-group">  -->'+

						'</div> <!-- <div class="col-xs-3" style="ppading-left:0px"> -->'+

					'</div> <!-- <div clss="form-group row nuevoProducto"> --> '); // .append

			// Agregar los productos al SELECT.
			respuesta.forEach(funcionForEach);
			
			function funcionForEach(item,index)
			{
				if (item.stock != 0)
				{
					//console.log ("item",item.Periferico);
					//$(".nuevaDescripcionProducto").append(
						$("#producto"+numProducto).append(
						'<option idProducto="'+item.id_producto+'" value="'+item.Periferico+'">'+item.Periferico+'</option>'				
						)
				}

			} // function funcionForEach(intem,index)
			
			// total de precios 
			sumarTotalPrecios();
			agregarImpuesto();

			// Asignar fornmatos al precio de los productos.
			$(".nuevoPrecioProducto").number(true,2);


	
			//respuesta.forEach(funcionForEach);		


		} // success:function(respuesta)


	})
})

// Seleccionar Producto, desde dispositivos Moviles.
// Cuando en el "Select" se selecciona un producto, se lanza este evento.
$(".formularioResponsiva").on("change","select.nuevaDescripcionProducto",function(){
	// Obtener el "idProducto"

	// var obtenerNombreProducto = $(this).('#addLocationIdReq').val(); 
	//var select = document.getElementById("addLocationIdReq");
	//var obtenerNombreProducto = select.option[select .selectedIndex].value;
	 obtenerNombreProducto = $(this).val();
	// console.log("nombreProducto",obtenerNombreProducto);

	// Se sube 3 niveles hasta llegar a '<div class ="row" style="padding:5px 15px">' btnAgregarProducto tamaño Tablet solamente se aplica $(.nuevpProdcuto)
	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");

	// Se vas obtener el producto atraves de una consulta.
	var datos = new FormData();
	datos.append("nombreProducto",obtenerNombreProducto);
	 // Se genera la variable global "nombreProducto", que se utiliza en "productos.ajax.php"
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
			// console.log("respuesta",respuesta)

			$(nuevaCantidadProducto).attr("stock",respuesta["stock"]);
			$(nuevaCantidadProducto).attr("nuevoStock",Number(respuesta["stock"]-1));
			$(nuevoPrecioProducto).val(respuesta["precio_venta"]);
			// Asignando el atributo.
			$(nuevoPrecioProducto).attr("precioReal",respuesta["precio_venta"]);

			//Agrupar productos en formato JSon, en un solo renglons se agregan el detalle de la Responsiva.
			listarProductos();

		} // function(respuesta)

	}) // $.ajax

}) // $(".formularioResponsiva").on("onchange","select.nuevaDescripcionProducto",function(){


// =============================================================
// Modificar el precio compra en base a la cantidad de productos 
// Cuando se modifica el "Input" de la etiqueta "Cantidad"
// =============================================================
$(".formularioResponsiva").on("change","input.nuevaCantidadProducto",function(){
	// Se salen tres padres de la etiquetas , para accesar a la etiqueta "ingresoPrecio" para obtener el precio del Producto.
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	//console.log("precio",precio.val());

	// Para aregar el valor de precio actual.
	// console.log("$(this).val()",$(this).val());
	// precio.attr("precioReal"); = Es para que sea el valor inicial y no se acumule con el anterior sino que teme siempre el valor real, y lo multiple por las cantidad,
	var precioFinal = $(this).val()*precio.attr("precioReal");

	// $(this).val() = Donde esta el stock actual del producto
	var nuevoStock = Number($(this).attr("stock")) - Number($(this).val());
	// Se le asigna el nuevo Stock, a la clase "nuevoStock".
	$(this).attr("nuevoStock",nuevoStock);

	// Para asignar el precio en la etiqueta de precio.
	precio.val(precioFinal);

	// Para actualizar el stock de los productos.
	// Verificando que no rebase el stock disponible 
	if (Number($(this).val()) > Number($(this).attr("stock")))
	{

		// Si la cantidad es superior al Stock regresar valores iniciales.
		$(this).val(1);
		var precioFinal = $(this).val()*precio.attr("precioReal");
		precio.val(precioFinal);
		sumarTotalPrecios();
		agregarImpuesto();
		//Agrupar productos en formato JSon, en un solo renglons se agregan el detalle de la Responsiva.
		listarProductos();

		Swal.fire ({
			title: "La cantidad supera el Stock",
			text:"Solo hay "+$(this).attr("stock")+" unidades !",
			type:"error",
			confirmButtonText: "Cerrar"
			});
			
	}
	// Sumar total de precios
	sumarTotalPrecios();
	agregarImpuesto();
	//Agrupar productos en formato JSon, en un solo renglons se agregan el detalle de la Responsiva.
	listarProductos();

})


// ===========================================================================
// Sumar todos los precios 
// ===========================================================================
function sumarTotalPrecios()
{
	// Acumula los precios de los productos que se encuentran en la clase : "nuevoPrecioProducto"
	var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];

	for (var i=0; i<precioItem.length; i++)
	{
		arraySumaPrecio.push(Number($(precioItem[i]).val()));
		
	}

	//console.log("arraySumaPrecio",arraySumaPrecio);
	function sumaArrayPrecios(total,numero)
	{
		return total+numero;
	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	// console.log("sumaTotalPrecio",sumaTotalPrecio);	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	//Se asigna este valor al id de "cap-responsiva.php" -> total=
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);

}

// Funcion Agregar Impuesto.
function agregarImpuesto()
{
	//Proviene del archivo "cap-responsiva.php", del DVD nuevoImpuestoVenta
	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");
	var precioImpuesto = Number(precioTotal*(impuesto/100));
	var totalConImpuesto = Number(precioImpuesto)+Number(precioTotal);

	// Asignar a las etiquetas de Cap-responsivas.php
	$("#nuevoTotalVenta").val(totalConImpuesto);
	$("#nuevoPrecioImpuesto").val(precioImpuesto);
	$("#nuevoPrecioNeto").val(precioTotal);
}

// Cuando cambia el Impuesto. Se lanza este evento.
$("#nuevoImpuestoVenta").change(function(){
	agregarImpuesto();
}) 

// Asignar fornmatos al precio final (total)
$("#nuevoTotalVenta").number(true,2);

// Seleccionar forma de Pago. Esta id="nuevoMetodoPago" proviene del archivo "cap-responsiva.php"
// Se lanza este evento cuando se cambia en el "Select" una opcion.
$("#nuevoMetodoPago").change(function(){
	//Obtiene el valor del "select" (NO el Id)
	var metodo = $(this).val();
	if (metodo == "Efectivo")
	{
		// Se sube dos niveles del <DIV>, en el archivo "cap-responsiva.php"
		$(this).parent().parent().removeClass("col-xs-6");
		$(this).parent().parent().addClass("col-xs-6");
		// Hasta llegar al <DIV> "form-group", hasta llegar el <DIV id=cajasMetodoPago>
		// Se agrega una etiqueta desde JavaScript 
		$(this).parent().parent().parent().children(".cajasMetodoPago").html(
			'<div class="col-xs-4">'+
				'<div class="input-group">'+ 
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="text" class="form-control nuevoValorEfectivo" placeholder="0000000" required >'+
				'</div>'+ 
			'</div>'+
			'<div class="col-xs-4 capturarCambioEfectivo" style="padding-left:0px">'+
				'<div class="input-group">'+ 
					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
					'<input type="text" class="form-control nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="0000000" readonly required >'+
				'</div>'+		
			'</div>'

			);
			//Agregar formato al precio
			$('.nuevoValorEfectivo').number(true,2);
			$('.nuevoCambioEfectivo').number(true,2);
	}
	else
	{
		$(this).parent().parent().removeClass('col-xs-4');
		$(this).parent().parent().addClass("col-xs-6");
		// Hasta llegar al <DIV> "form-group", hasta llegar el <DIV id=cajasMetodoPago>
		// Se agrega una etiqueta desde JavaScript 
		$(this).parent().parent().parent().children(".cajasMetodoPago").html(
		'<div class="col-xs-6" style="padding-left:0px">'+
			'<!-- Para crear el metodo de pago. -->'+
			'<div class="input-group">'+
				'<input type="text" classs="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Codigo Transaccion" required >'+
				'<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+

			'</div> <!-- <div class="input-group"> -->'+								
		'</div> <!-- <div class="col-xs-6"> -->')

	}
})

// =======================================================================
// Cambio en Efectivo 
// =======================================================================
// Cuando cambie el "input" de nuevoValorEfectivo
$(".formularioResponsiva").on("change","input.nuevoValorEfectivo",function(){
	// Es el contenido del input "nuevoValorEfectivo, se crea en : "$("#nuevoMetodoPago").change(function(){"

	var efectivo = $(this).val();
	var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

	// Para accesar a "nuevoCambioEfectivo" (Se encuentra en: $("#nuevoMetodoPago")
	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('.capturarCambioEfectivo').children().children('.nuevoCambioEfectivo');

	// Asignar el cambio para el cliente.
	nuevoCambioEfectivo.val(cambio);
	
})

// ====================================================================================
// Listar todos los productos.
// ====================================================================================
function listarProductos()
{
	var listarProductos = [];
	
	// Estos valores se obtienen de la etiqueta:  $(".tablaResponsivasProd tbody").on("click","button.agregarProducto",function()
	//var id =
	// Contine todos los productos de la resposivas
	var descripcion = $(".nuevaDescripcionProducto");
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");
	
	/* Se obtiene el valores del reglon de las Responsivas 

	console.log("IdProducto",$(descripcion[0]).attr("idProducto"));
	// attr("idProducto") = Obtiene el valor de la variable asignado en la ejecucion de la funcion, es decir el Valor del atributo "idProducto"
	console.log("Descripcion",$(descripcion[0]).val());
	console.log("Cantidad",$(cantidad[0]).val());
	console.log("Precio",$(precio[0]).val());
	*/

	for (var i=0; i < descripcion.length; i++)
	{
		// Ingresando en Json el los productos de la responsiva 
		listarProductos.push({"id" : $(descripcion[i]).attr("idProducto"),
													"descripcion" : $(descripcion[i]).val(),
													"cantidad" : $(cantidad[i]).val(),
													"stock" : $(cantidad[i]).attr("nuevoStock"),
													"precio" : $(precio[i]).attr("precioReal"),
													"total" : $(precio[i]).val()});	 
	} // for (var i=0; 1 < descripcion.length; i++)

	// JSON.stringfy = Lo convierte de JSon a Cadena de Textos que se utilizara para grabar en la base de datos.
	// console.log("listarProductos",JSON.stringify(listarProductos));
	$("#listaMetodo").val(JSON.stringify(listaMetodos));



	

}
