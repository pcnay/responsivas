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
function validarCampo(campoValid,queCampo,Editar)
{
	$(".alert").remove();
	
	switch (queCampo)
	{
		case ('Num_Tel'):
			cadenaComparar = "^[0-9]";
			Editar == 'S'?etiqueta = "#editarNumTel":etiqueta = "#nuevoNumTel";
			break;
		case ('Num_Serial'):
			cadenaComparar = "^[A-Z0-9-]";
			Editar == 'S'?etiqueta = "#editarSerial":etiqueta = "#nuevoSerial";
			break;
		case ('Num_Cta'):
			cadenaComparar = "^[0-9]";
			Editar == 'S'?etiqueta = "#editarCuenta":etiqueta = "#nuevaCuenta"; 
		break;
		case ('DireccMac'):
			cadenaComparar = "^[0-9A-Z:]";
			Editar == 'S'?etiqueta = "#editarDireccMac":etiqueta = "#nuevaDireccMac"; 
		break;
		case ('Nomenclatura'):
			cadenaComparar = "^[0-9A-Z]";
			Editar == 'S'?etiqueta = "#editarNomenclatura":etiqueta = "#nuevaNomenclatura";
		break;
		case ('Imei'):
			cadenaComparar = "^[0-9]";
			Editar == 'S'?etiqueta = "#editarImei":etiqueta = "#nuevoImei";
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

	let serial = $(this).val();
	let Editar = 'N';
	validarCampo(serial,'Num_Serial',Editar);
	
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
	let Editar = 'N';
	validarCampo(num_tel,'Num_Tel',Editar);

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

// Revisando que el "Numero de Telefono" no este repetido, cuando se edite
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarNumTel" id="editarNumTel" required>
$("#editarNumTel").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=editarNumTel.
	let num_tel = $(this).val();
	let Editar = 'S';
	validarCampo(num_tel,'Num_Tel',Editar);

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
				$("#editarNumTel").parent().after('<div class="alert alert-warning" >Ya existe el numero de Telefono </div>');
				// $("#editarNumTel").val("");
			}
		}
	})
 
}) // $("#editarNumTel").change(function(){

// Revisando que la Cuenta no este repetida
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaCuenta" id="nuevaCuenta" placeholder = "Ingresar el Numero de Cuenta" >
$("#nuevaCuenta").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaCeunta.
	let num_cta = $(this).val();
	let Editar = 'N';

	validarCampo(num_cta,'Num_Cta',Editar);

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
				//$("#nuevaCuenta").val("");
			}

		}
	})
 
}) // $("#nuevaCuenta").change(function(){

// Revisando que la Cuenta no este repetida, cuando se edite.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarCuenta" id="editarCuenta">
$("#editarCuenta").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaCuenta.
	let num_cta = $(this).val();
	let Editar = 'S';

	validarCampo(num_cta,'Num_Cta',Editar);

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
				$("#editarCuenta").parent().after('<div class="alert alert-warning" >Ya existe el numero de Cuenta </div>');
				$("#editarCuenta").val("");
			}

		}
	})
 
}) // $("#editarCuenta").change(function(){


// Revisando que la MAC Address del Telefono no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaDireccMac" id="nuevaDireccMac" placeholder = "Ingresar la Direccion Mac del Telefono" required>
$("#nuevaDireccMac").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaDireccMac.
	var direcc_mac = $(this).val();
	let Editar = 'N';

	validarCampo(direcc_mac,'DireccMac',Editar);

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

// Revisando que la MAC Address del Telefono no este repetido. Cuando se edite.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarDireccMac" id="editarDireccMac" >
$("#editarDireccMac").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=editarDireccMac.
	let direcc_mac = $(this).val();
	let Editar = 'S';
	
	validarCampo(direcc_mac,'DireccMac',Editar);

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
 
}) // $("#editarDireccMac").change(function(){

// Revisando que la IMEI del Telefono no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaImei" id="nuevoImei" placeholder = "Ingresar el IMEMEI del Telefono" required>
$("#nuevoImei").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoImei
	let Imei = $(this).val();	
	let Editar = 'N';
		
		validarCampo(Imei,'Imei',Editar);
	
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
 
}) // $("#editarImei").change(function(){


// Revisando que la IMEI del Telefono no este repetido. Cuando no se edite
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarImei" id="editarImei" required>
$("#editarImei").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=editarImei
	let Imei = $(this).val();	
	let Editar = 'S';
		
		validarCampo(Imei,'Imei',Editar);
	
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
				$("#editarImei").parent().after('<div class="alert alert-warning" >Ya existe el IMEI del Telefono </div>');
				$("#editarImei").val("");
			}

		}
	})
 
}) // $("#editarImei").change(function()


// Revisando que la "Nomenclatura" no este repetida
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaNomenclatura" id="nuevaNomenclatura" placeholder = "Ingresar la Nomenclatura" >
$("#nuevaNomenclatura").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaNomenclatura.
	let nomenclatura = $(this).val();
	let Editar = 'N';
	validarCampo(nomenclatura,'Nomenclatura',Editar);

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

// Revisando que la "Nomenclatura" no este repetida. Cuando se edita el Producto
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="editarNomenclatura" id="editarNomenclatura">
$("#editarNomenclatura").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=editarNomenclatura.
	let nomenclatura = $(this).val();
	let Editar = 'S';
	validarCampo(nomenclatura,'Nomenclatura',Editar);

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
				$("#editarNomenclatura").parent().after('<div class="alert alert-warning" >Ya existe la Nomenclatura </div>');
				$("#editarNomenclatura").val("");
			}
		}
	})
 
}) // $("#editarNomenclatura").change(function(){

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
// Como Javascript ejecuta en tiempo real, no encuentra "btnEditarProducto", muestra error. Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar, por esta razon se agrega "tbody"
$(".tablaProductos tbody").on("click","button.btnEditarProducto",function(){
	var id_Producto = $(this).attr("idProducto");
	//console.log("idProducto",id_Producto);
	// Se esta agregando un dato al Ajax.
	
	// Se va obtener informacion del Producto desde la base de datos utilizando Ajax.
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
		success:function(producto)
		{
			console.log("respuesta",producto);
			// Asignando el valor al $_POST["IdProducto"] generado en "productos.php" en el Input "Hidden"
			$("#IdProducto").val(id_Producto);

			// Obtener el periferico, desde la tabla.
			var datosPerifericos = new FormData();
			datosPerifericos.append("idPeriferico",producto["id_periferico"]);

			// Obteniendo la descripcion del periferico.
			$.ajax
			({
				url:"ajax/perifericos.ajax.php",
				method:"POST",
				data:datosPerifericos,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(perifericos)
				{
					//console.log("periferico",perifericos);					
					$("#editarPeriferico").val(perifericos["id_periferico"]); //Id
					$("#editarPeriferico").html(perifericos["nombre"]);		// Html (de la etiqueta Select)
				}		
			})// $.ajax

			$("#editarSerial").val(producto["Serial"]);

			// Obteniendo la telefonia.
			var datosTelefonia = new FormData();
			datosTelefonia.append("idTelefonia",producto["id_telefonia"]);
			
			$.ajax
			({
				url:"ajax/telefonia.ajax.php",
				method:"POST",
				data:datosTelefonia,
				cache:false,
				contentType:false,
				processData:false,
				dataType:"json",
				success:function(telefonia)
				{
					//console.log("Telefonia",telefonia);					
					$("#editarTelefonia").val(telefonia["id_telefonia"]); //Id
					$("#editarTelefonia").html(telefonia["nombre"]);		// Html (de la etiqueta Select)
				}		
			})// $.ajax

		// Obteniendo el plan de telefonia.
		var datosPlanTelefonia = new FormData();
		datosPlanTelefonia.append("idPlanTelefonia",producto["id_plan_tel"]);
		//console.log ("Id_Plan Tel",producto["id_plan_tel"]);

		$.ajax
		({
			url:"ajax/plan-telefonia.ajax.php",
			method:"POST",
			data:datosPlanTelefonia,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(PlanTelefonia)
			{
				//console.log("PlanTelefonia",PlanTelefonia);					
				$("#editarPlanTelefonia").val(PlanTelefonia["id_plan_tel"]); //Id
				$("#editarPlanTelefonia").html(PlanTelefonia["nombre"]);		// Html (de la etiqueta Select)
			}		
		})// $.ajax

		$("#editarNumTel").val(producto["num_tel"]);
		$("#editarCuenta").val(producto["cuenta"]);
		$("#editarDireccMac").val(producto["direcc_mac_tel"]);
		$("#editarImei").val(producto["imei_tel"]);

		// Obtener la Marca					
		var datosMarca = new FormData();

		// respuesta["id_marca"] = Viene del Ajax Anterior, ya que retorna un arreglo.
		// "datosMarcas" = es una variable POST que se envia a "marcas.ajax.php".
		datosMarca.append("idMarca",producto["id_marca"]);
		$.ajax
		({
			url:"ajax/marcas.ajax.php",
			method:"POST",
			data:datosMarca,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(Marca)
			{
				//console.log("respuesta",Marcas);		
				// Asignando el valor recuperado a la etiqueta de SELECT de "productos.php"		
				$("#editarMarca").val(Marca["id_marca"]);
				$("#editarMarca").html(Marca["descripcion"]);		
			}
	
		})
		
		// Obtener la Modelo					
		var datosModelo = new FormData();

		// respuesta["id_modelo"] = Viene del Ajax Anterior, ya que retorna un arreglo.
		// "datosModelo" = es una variable POST que se envia a "modelo.ajax.php".
		datosModelo.append("idModelo",producto["id_modelo"]);
		$.ajax
		({
			url:"ajax/modelos.ajax.php",
			method:"POST",
			data:datosModelo,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(Modelo)
			{
				//console.log("respuesta",Modelo);		
				// Asignando el valor recuperado a la etiqueta de SELECT de "productos.php"		
				$("#editarModelo").val(Modelo["id_modelo"]);
				$("#editarModelo").html(Modelo["descripcion"]);		
			}
	
		})

		// Obtener el Almacen					
		var datosAlmacen = new FormData();

		// respuesta["id_almacen"] = Viene del Ajax Anterior, ya que retorna un arreglo.
		// "datosAlmacen" = es una variable POST que se envia a "modelo.ajax.php".
		datosAlmacen.append("idAlmacen",producto["id_almacen"]);
		$.ajax
		({
			url:"ajax/almacen.ajax.php",
			method:"POST",
			data:datosAlmacen,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(Almacen)
			{
				//console.log("respuesta",Almacen);		
				// Asignando el valor recuperado a la etiqueta de SELECT de "productos.php"		
				$("#editarAlmacen").val(Almacen["id_almacen"]);
				$("#editarAlmacen").html(Almacen["nombre"]);		
			}

		})

		// Obtener Estado Del Equipo					
		var datosEdoEpo = new FormData();

		// respuesta["id_edo_epo"] = Viene del Ajax Anterior, ya que retorna un arreglo.
		// "datosEdoEpo" = es una variable POST que se envia a "edo_epo.ajax.php".
		datosEdoEpo.append("idEdo_Epo",producto["id_edo_epo"]);
		$.ajax
		({
			url:"ajax/edo-epo-ajax.php",
			method:"POST",
			data:datosEdoEpo,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(EdoEpo)
			{
				//console.log("respuesta",EdoEpo);		
				// Asignando el valor recuperado a la etiqueta de SELECT de "productos.php"		
				$("#editarEdoEpo").val(EdoEpo["id_edo_epo"]);
				$("#editarEdoEpo").html(EdoEpo["descripcion"]);		
			}

		});

		//console.log ("Nomenclatura",producto["nomenclatura"]);
		$("#editarNomenclatura").val(producto["nomenclatura"]);
		$("#editarStock").val(producto["Stock"]);
		$("#editarPrecioCompra").val(producto["precio_compra"]);
		$("#editarPrecioVenta").val(producto["Precio_Venta"]);

		// Obtener El empleado que tiene asignado el periferico					
		var datosNumEmp = new FormData();

		// respuesta["id_empleado"] = Viene del Ajax Anterior, ya que retorna un arreglo.
		// "datosNumEmp" = es una variable POST que se envia a "empleados.ajax.php".
		datosNumEmp.append("idEmpleado",producto["id_empleado"]);
		$.ajax
		({
			url:"ajax/empleados.ajax.php",
			method:"POST",
			data:datosNumEmp,
			cache:false,
			contentType:false,
			processData:false,
			dataType:"json",
			success:function(NumEmp)
			{
				//console.log("respuesta",NumEmp);		
				// Asignando el valor recuperado a la etiqueta de SELECT de "productos.php"		
				$("#editarNombreEmpleado_E").val(NumEmp["nombre"]+' '+NumEmp["apellidos"]);
				//$("#editarEdoEpo").html(EdoEpo["descripcion"]);		
			}

		});
		
		$("#editarComent").val(producto["comentarios"]);

		// Para cuando la imagen 
		if (producto["Imagen"] != "")
		{
			$("#imagenActual").val(producto["Imagen"]);
			$(".previsualizar").attr("src",producto["Imagen"]);
		}
		
	} // success:function(producto)


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

		}
*/
	})	// $.ajax({		

}) // $(".tablaProductos tbody").on("click", ...


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
