var perfilOculto = $("#perfilOculto").val();

$('.tablaNotas').DataTable({
	"ajax":"ajax/datatable-notas.ajax.php?perfilOculto="+perfilOculto,
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

// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevaNota").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z-0-9/,.- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarNota").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z-0-9/,.- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// =======================================
// Editar Notas:
// ======================================
// Se va a realizar un cambio, ya que se debe ejecutar el código cuando se termina de cargar el cuerpo de la tabla. Se realiza un click en el Boton Editar

// Esperar que HTML cargue toda la pagina para que JavaScript active los eventos.
// Cuando se haya cargado ().tablaMarcas tbody).on se asigna el evento "on("click") a la clase "btnEditarMarca" la siguiente "function"

$(".tablaNotas tbody").on("click","button.btnEditarNota",function(){
	// Se obtiene el valor de "idNota"
	var idNota = $(this).attr("idNota");
	console.log ("valor ",idNota);

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idNota",idNota); // Se crea la variable "POST", "idNota"

	$.ajax({
		url:"ajax/notas.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarNota" class="modal fade" role="dialog">, "notas.php", se le asigna el valor que se retorno el Ajax.
			$("#editarNombre_Nota").val(respuesta["nombre_nota"]);
			$("#editarDescrip_Nota").val(respuesta["descripcion_nota"]);
			$("#idNota").val(respuesta["id_nota"]); // viene desde el campo oculto de <input type="hidden"  name="idMarca"  id="idMarca" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarMarca")


// Revisando que la "marca" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaMarca" id="nuevaMarca" placeholder = "Ingresar una Marca" required>
$("#nuevaMarca").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaMarca.
	var marca = $(this).val();
	
	//console.log("Ubicacion",periferico);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarMarca",marca);
	$.ajax({
		url:"ajax/marcas.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevaMarca").parent().after('<div class="alert alert-warning" >Esta Marca Existe </div>');
				$("#nuevaMarca").val("");
			}

		}
	})
 
}) // $("#nuevaMarca").change(function(){

// Revisando que la "marca" no este repetido, cuando se edite.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaMarca" id="nuevaMarca" placeholder = "Ingresar una Marca" required>
$("#editarMarca").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaMarca.
	var marca = $(this).val();
	
	//console.log("Ubicacion",periferico);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarMarca",marca);
	$.ajax({
		url:"ajax/marcas.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#editarMarca").parent().after('<div class="alert alert-warning" >Esta Marca Existe </div>');
				$("#editarMarca").val("");
			}

		}
	})
 
}) // $("#nuevaMarca").change(function(){

//=======================================================
// Eliminar Nota.
//=======================================================
// $(".btnEliminarNota").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarMarca", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarNota",function()
	{	

		// Obteniendo los valores de "idNota"
		var idNota = $(this).attr("idNota");

		Swal.fire ({
			title: "Esta Seguro De Borrar La Nota",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar La Nota'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=notas&idNota="+idNota;
			}
		})	

}) // $(".btnEliminarNotaMarca").click(function(){

