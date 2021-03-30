/* Cargar los datos - Productos de forma dinamica */

// Para hacer que las variables de sesion se puedan usar en Datatable.
var perfilOculto = $("#perfilOculto").val();
//console.log ("perfilOculto",perfilOculto);



// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
// ?perfilOculto="+perfilOculto = Se manda como variable GET a "datatable-productos.ajax.php"
$('.tablaProductos').DataTable({
	"ajax":"ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
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
$.ajax({		
	url:"ajax/datatable-productos.ajax.php",
	success:function(respuesta){
	console.log("respuesta",respuesta);
		}
})
*/

/*
$('.tabla').DataTable({
	"ajax":"ajax/datatable-productos.ajax.php"
});
*/ 

// Aplicando expresiones regulares para validar campos del formulario
function validarCampo(campoValid,queCampo)
{
	$(".alert").remove();
	
	switch (queCampo)
	{
		case ('Num_Tel'):
			cadenaComparar = "^[0-9]";
			etiqueta = "#nuevoNumTel";			
			break;
		case ('Num_Serial'):
			cadenaComparar = "^[A-Z0-9]";
			etiqueta = "#nuevoSerial";
			break;
		case ('Num_Cta'):
			cadenaComparar = "^[0-9]";
			etiqueta = "#nuevaCuenta";
		break;
		case ('DireccMac'):
			cadenaComparar = "^[0-9A-Z:]";
			etiqueta = "#nuevaDireccMac";
		break;
		case ('Nomenclatura'):
			cadenaComparar = "^[0-9A-Z]";
			etiqueta = "#nuevaNomenclatura";
		break;
	
	}

	let expresionreg = new RegExp(cadenaComparar);
	if (!expresionreg.test(campoValid))
	{
		//console.log("Valor ",expreg.test(campoValid));
		$(etiqueta).parent().after('<div class="alert alert-warning" >NO Cumple la condicion</div>');
		//$("#nuevoSerial").val("");		
	}
}

// Revisando que el "Serial" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoSerial" id="nuevoSerial" placeholder = "Ingresar el Serial" required>
$("#nuevoSerial").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();	

	// Obtienedo el valor del id=nuevoSerial.
	var serial = $(this).val();
	validarCampo(serial,'Num_Serial');

	//console.log("Serial",serial);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarSerial",serial);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			//console.log("encontro",respuesta);
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevoSerial").parent().after('<div class="alert alert-warning" >Este Serial Existe </div>');
				$("#nuevoSerial").val("");
			}

		}
	})

}) // $("#nuevoSerial").change(function(){

// Revisando que el "Numero de Telefono" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoNumTel" id="nuevoNumTel" placeholder = "Ingresar el Numero de Telefono" required>
$("#nuevoNumTel").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoNumTel.
	var num_tel = $(this).val();
	validarCampo(num_tel,'Num_Tel');

	//console.log("Serial",serial);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarNumTel",num_tel);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			//console.log("encontro",respuesta);
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevoNumTel").parent().after('<div class="alert alert-warning" >Ya existe el numero de Telefono </div>');
				$("#nuevoNumTel").val("");
			}

		}
	})
 
}) // $("#nuevoNumTel").change(function(){

// Revisando que la Cuenta no este repetida
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaCuenta" id="nuevaCuenta" placeholder = "Ingresar el Numero de Cuenta" >
$("#nuevaCuenta").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaCeunta.
	var num_cta = $(this).val();
	validarCampo(num_cta,'Num_Cta');

	//console.log("Serial",serial);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarNumCta",num_cta);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			//console.log("encontro",respuesta);
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevaCuenta").parent().after('<div class="alert alert-warning" >Ya existe el numero de Cuenta </div>');
				$("#nuevaCuenta").val("");
			}

		}
	})
 
}) // $("#nuevaCuenta").change(function(){

// Revisando que la MAC Address del Telefono no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaDireccMac" id="nuevaDireccMac" placeholder = "Ingresar la Direccion Mac del Telefono" required>
$("#nuevaDireccMac").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaDireccMac.
	var direcc_mac = $(this).val();
	
	validarCampo(direcc_mac,'DireccMac');

	//console.log("Direccion Mac",direcc_mac);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarDireccMac",direcc_mac);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			//console.log("encontro",respuesta);
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevaDireccMac").parent().after('<div class="alert alert-warning" >Ya existe la Direccion MAC del Telefono </div>');
				$("#nuevaDireccMac").val("");
			}

		}
	})
 
}) // $("#nuevaDireccMac").change(function(){

// Revisando que la IMEI del Telefono no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaImei" id="nuevoImei" placeholder = "Ingresar el IMEMEI del Telefono" required>
$("#nuevoImei").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaDireccMac.
	var Imei = $(this).val();
	
	//console.log("Imei",Imei);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarImei",Imei);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			//console.log("encontro",respuesta);
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevoImei").parent().after('<div class="alert alert-warning" >Ya existe el IMEI del Telefono </div>');
				$("#nuevoImei").val("");
			}

		}
	})
 
}) // $("#nuevaImei").change(function(){

// Revisando que la "Nomenclatura" no este repetida
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaNomenclatura" id="nuevaNomenclatura" placeholder = "Ingresar la Nomenclatura" >
$("#nuevaNomenclatura").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaNomenclatura.
	var nomenclatura = $(this).val();
	validarCampo(nomenclatura,'Nomenclatura');

	//console.log("Serial",serial);
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarNomenclatura",nomenclatura);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			//console.log("encontro",respuesta);
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevaNomenclatura").parent().after('<div class="alert alert-warning" >Ya existe la Nomenclatura </div>');
				$("#nuevaNomenclatura").val("");
			}
		}
	})
 
}) // $("#nuevaNomenclatura").change(function(){

/*
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
*/

// Agregando Precio de Venta.
// Se esta agregando otra clase, para cuando se edite un producto.
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){
	
	if ($(".porcentaje").prop("checked"))
	{			
		// Viene de la la etiqueta : <!-- Entrada para el porcentaje(producto.php) -->
		var valorPorcentaje = $(".nuevoPorcentaje").val();
		//console.log ("valorPorcentaje",valorPorcentaje);
		var precioVentaConIva = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje)/100)+Number($("#nuevoPrecioCompra").val());

		var precioVentaConIvaEditado = Number(($("#editarPrecioCompra").val()*valorPorcentaje)/100)+Number($("#editarPrecioCompra").val());

		//console.log ("valorPorcentaje",precioVentaConIva);
		//$("#nuevoPrecioVenta").val(precioVentaConIva);
		//$("#nuevoPrecioVenta").prop("readonly",true); 
		// Para que no se pueda modificar.
		//$("#editarPrecioVenta").val(precioVentaConIvaEditado);
		//$("#editarPrecioVenta").prop("readonly",true); 


	}
})

// Cuando se cambia el valor del porcentaje.
$(".nuevoPorcentaje").change(function(){

	if ($(".porcentaje").prop("checked"))
	{			
		// Viene de la la etiqueta : <!-- Entrada para el porcentaje(producto.php) -->
		//var valorPorcentaje = $(".nuevoPorcentaje").val();
		// Se modifica para utilizarlo en la captura y edicion del producto
		var valorPorcentaje = $(this).val();

		//console.log ("valorPorcentaje",valorPorcentaje);
		var precioVentaConIva = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje)/100)+Number($("#nuevoPrecioCompra").val());

		var precioVentaConIvaEditado = Number(($("#editarPrecioCompra").val()*valorPorcentaje)/100)+Number($("#editarPrecioCompra").val());

		//console.log ("valorPorcentaje",precioVentaConIva);
		//$("#nuevoPrecioVenta").val(precioVentaConIva);
		//$("#nuevoPrecioVenta").prop("readonly",true); 
		// Para que no se pueda modificar.

		//$("#editarPrecioVenta").val(precioVentaConIvaEditado);
		//$("#editarPrecioVenta").prop("readonly",true); 

	}

})

// Se utiliza este comando ya que la etiqueta check se esta utilizando con un componente "ickecked"
$(".porcentaje").on("ifUnchecked",function(){
	// Para activarlo nuevamente el "checkbox"
	//$("#nuevoPrecioVenta").prop("readonly",false); 
	// Se modifica para cuando se esta editando y se activa el CheckBox
	//$("#editarPrecioVenta").prop("readonly",false); 
})
$(".porcentaje").on("ifChecked",function(){
	// Para Desactivarlo nuevamente el "checkbox"
	//$("#nuevoPrecioVenta").prop("readonly",true); 
	// Se modifica para cuando se esta editando y se desactiva el CheckBox
	//$("#editarPrecioVenta").prop("readonly",true); 
})

// Se agrega la foto del articulo, viene desde el formulario de captura (vistas/modulos/productos.php)
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

// Editar Producto
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar
$(".tablaProductos tbody").on("click","button.btnEditarProducto",function(){
	var id_Producto = $(this).attr("idProducto");
	//console.log("idProducto",id_Producto);
	// Se esta agregando un dato al Ajax.
	
	
	var datos = new FormData();
	datos.append("idProducto",id_Producto);
	
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
			console.log("respuesta",respuesta["id_periferico"]);
			// Obtener el periferico.
			var datosPerifericos = new FormData();
			datosPerifericos.append("idPeriferico",respuesta["id_periferico"]);
			$.ajax
			({
				url:"ajax/perifericos.ajax.php",
				method:"POST",
				data:datosPerifericos,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(periferico)
				{
					console.log("periferico",periferico);					
					$("#editarPeriferico").val(periferico["id_periferico"]);
					$("#editarPeriferico").html(periferico["nombre"]);		
				}		
			})		
			/*
			// Obtener el Marca.
			var datosMarcas = new FormData();
			datosMarcas.append("idMarca",respuesta["id_marca"]);
			$.ajax
			({
				url:"ajax/marcas.ajax.php",
				method:"POST",
				data:datosMarcas,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(marcas)
				{					
					$("#editarMarca").val(marcas["id_marca"]);
					$("#editarMarca").html(marcas["descripcion"]);		
				}		
			})		
			// Obtener el Modelo.
			var datosModelos = new FormData();
			datosModelos.append("idModelo",respuesta["id_modelo"]);
			$.ajax
			({
				url:"ajax/modelos.ajax.php",
				method:"POST",
				data:datosModelos,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(modelos)
				{					
					$("#editarModelo").val(modelos["id_modelo"]);
					$("#editarModelo").html(modelos["descripcion"]);		
				}		
			})		
			// Obtener el Almacen.
			var datosAlmacen = new FormData();
			datosAlmacen.append("idAlmacen",respuesta["id_almacen"]);
			$.ajax
			({
				url:"ajax/almacen.ajax.php",
				method:"POST",
				data:datosAlmacen,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(almacen)
				{					
					$("#editarAlmacen").val(almacen["id_almacen"]);
					$("#editarAlmacen").html(almacen["nombre"]);		
				}		
			})		

			// Obtener el Edo del Epo.
			var datosEdoEpo = new FormData();
			datosEdoEpo.append("idEdoEpo",respuesta["id_edo_epo"]);
			$.ajax
			({
				url:"ajax/edo-epo-ajax.php",
				method:"POST",
				data:datosEdoEpo,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(edo_epo)
				{					
					$("#editarEdoEpo").val(almacen["id_edo_epo"]);
					$("#editarEdoEpo").html(almacen["descripcion"]);		
				}		
			})		


			// SE van asignar los valores a las editas del producto a Editar.
			$("#editarSerial").val(respuesta["num_serie"]);
			$("#editarNomenclatura").val(respuesta["nomenclatura"]);
			$("#editarStock").val(respuesta["stock"]);
			$("#editarPrecioCompra").val(respuesta["precio_compra"]);
			$("#editarPrecioVenta").val(respuesta["precio_venta"]);
			if (respuesta["imagen"] != "")
			{
				$("#imagenActual").val(respuesta["imagen"]);
				//console.log("imagen",respuesta["imagen"]);
				
				$(".previsualizar").attr("src",respuesta["imagen"]);
			}

			*/

		}

	})	

})


// Borrar Producto
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar
$(".tablaProductos tbody").on("click","button.btnEliminarProducto",function(){
	var idProducto = $(this).attr("idProducto");
	// console.log("idProducto",idProducto);
	// Obtener el codigo del producto y la ruta de la imagen que esta grabada en la Tabla.
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");

	
	Swal.fire ({
		type: "success",
		title: "La categoria ha sido borrada correctamente ",
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
				window.location="index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;
			}

			});	

})
