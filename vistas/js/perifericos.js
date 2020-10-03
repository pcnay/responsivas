
// =======================================
// Editar Perifericos:
// ======================================
$(".btnEditarPeriferico").click(function(){
	// Se obtiene el valor de "idPeriferico"
	var idPeriferico = $(this).attr("idPeriferico");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idPeriferico",idPeriferico); // Se crea la variable "POST", "idPeriferico"

	$.ajax({
		url:"ajax/perifericos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			// console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarPeriferico" class="modal fade" role="dialog">, "perifericos.php", se le asigna el valor que se retorno el Ajax.
			$("#editarPeriferico").val(respuesta["nombre"]);
			$("#idPeriferico").val(respuesta["id_periferico"]); // viene desde el campo oculto de <input type="hidden"  name="idPeriferico"  id="idPeriferico" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarPeriferico")


// Revisando que la "periferico" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoPeriferico" id="nuevoPeriferico" placeholder = "Ingresar un Periferico" required>
$("#nuevoPeriferico").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoPeriferico.
	var categoria = $(this).val();
	
	//console.log("Ubicacion",periferico);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarPeriferico",periferico);
	$.ajax({
		url:"ajax/periferico.ajax.php",
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
				$("#nuevoPeriferico").parent().after('<div class="alert alert-warning" >Este Periferico Ya Existe </div>');
				$("#nuevoPeriferico").val("");
			}

		}
	})
 
}) // $("#nuevoPeriferico").change(function(){

//=======================================================
// Eliminar Periferico.
//=======================================================
// $(".btnEliminarPeriferico").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarPeriferico", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarPeriferico",function()
	{	

		// Obteniendo los valores de "idPeriferico"
		var idPeriferico = $(this).attr("idPeriferico");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Periferico",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar Periferico'
		}).then(function(result){ 
			if (result.value)
			{
				//window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&foto="+fotoUsuario;
				window.location = "index.php?ruta=perifericos&idPeriferico="+idPeriferico;
			}
		})	

}) // $(".btnEliminarPeriferico").click(function(){

