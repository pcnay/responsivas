// =======================================
// Editar Modelos:
// ======================================
$(".btnEditarModelo").click(function(){
	// Se obtiene el valor de "idModelo"
	var idModelo = $(this).attr("idModelo");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idModelo",idModelo); // Se crea la variable "POST", "idModelo"

	// Asigna los valores a la pantalla, para cuando se edita el modelo
	$.ajax({
		url:"ajax/modelos.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarModelo" class="modal fade" role="dialog">, "modelos.php", se le asigna el valor que se retorno el Ajax.
			$("#editarModelo").val(respuesta["descripcion"]);
			$("#idModelo").val(respuesta["id_modelo"]); // viene desde el campo oculto de <input type="hidden"  name="idModelo"  id="idModelo" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarModelo")


// Revisando que la "modelo" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoModelo" id="nuevoModelo" placeholder = "Ingresar un Modelo" required>
$("#nuevoModelo").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoModelo.
	var modelo = $(this).val();
	
	//console.log("descripcion",modelo);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarModelo",modelo);
	$.ajax({
		url:"ajax/modelos.ajax.php",
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
				$("#nuevoModelo").parent().after('<div class="alert alert-warning" >Esta Modelo Existe </div>');
				$("#nuevoModelo").val("");
			}

		}
	})
 
}) // $("#nuevoModelo").change(function(){

//=======================================================
// Eliminar Modelo.
//=======================================================
// $(".btnEliminarModelo").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarModelo", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarModelo",function()
	{	
		// Obteniendo los valores de "idModelo"
		var idModelo = $(this).attr("idModelo");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Modelo",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Modelo'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=Modelos&idModelo="+idModelo;
			}
		})	

}) // $(".btnEliminarModelo").click(function(){

