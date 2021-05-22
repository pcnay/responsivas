
// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevaMarca").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarMarca").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Za-z- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// =======================================
// Editar Marcas:
// ======================================
$(".btnEditarMarca").click(function(){
	// Se obtiene el valor de "idMarca"
	var idMarca = $(this).attr("idMarca");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idMarca",idMarca); // Se crea la variable "POST", "idMarca"

	$.ajax({
		url:"ajax/marcas.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarMarca" class="modal fade" role="dialog">, "marcas.php", se le asigna el valor que se retorno el Ajax.
			$("#editarMarca").val(respuesta["descripcion"]);
			$("#idMarca").val(respuesta["id_marca"]); // viene desde el campo oculto de <input type="hidden"  name="idMarca"  id="idMarca" required>
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
// Eliminar Marca.
//=======================================================
// $(".btnEliminarMarca").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarMarca", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarMarca",function()
	{	

		// Obteniendo los valores de "idMarca"
		var idMarca = $(this).attr("idMarca");

		Swal.fire ({
			title: "Esta Seguro De Borrar La Marca",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar La Marca'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=marcas&idMarca="+idMarca;
			}
		})	

}) // $(".btnEliminarMarca").click(function(){

