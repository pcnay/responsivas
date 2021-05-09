
// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevaLinea").bind('keypress', function(event) {
	//var regex = new RegExp("^[A-Z0-9- ]+$");
  let regex = new RegExp("^[A-Z0-9 ]+$");
  let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarLinea").bind('keypress', function(event) {
  let regex = new RegExp("^[A-Z0-9 ]+$");
  let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});

// =======================================
// Editar Linea:
// ======================================
$(".btnEditarLinea").click(function(){
	// Se obtiene el valor de "idLinea"
	var id_Linea = $(this).attr("idLinea");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idLinea",id_Linea); // Se crea la variable "POST", "idLinea"

	$.ajax({
		url:"ajax/lineas.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarMarca" class="modal fade" role="dialog">, "linea.php", se le asigna el valor que se retorno el Ajax.
			$("#editarLinea").val(respuesta["descripcion"]);
			$("#idLinea").val(respuesta["id_linea"]); // viene desde el campo oculto de <input type="hidden"  name="idLinea"  id="idLinea" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarLinea")


// Revisando que la "Linea" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaLinea id="nuevaLinea" placeholder = "Ingresar una Linea" required>
$("#nuevaLinea").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaLinea.
	var linea = $(this).val();
	
	//console.log("Linea",linea);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarLinea",linea);
	$.ajax({
		url:"ajax/lineas.ajax.php",
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
				console.log ("Se encuentra Linea ",respuesta["descripcion"]);
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevaLinea").parent().after('<div class="alert alert-warning" >Esta Linea Existe </div>');
				$("#nuevaLinea").val("");
			}

		}
	})
 
}) // $("#nuevaLinea").change(function(){

// Revisando que la "Linea" no este repetido, cuando se edite.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevaLinea" id="nuevaLinea" placeholder = "Ingresar una Linea" required>
$("#editarLinea").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevaLinea.
	var linea = $(this).val();
	
	console.log("Linea",linea);

	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarLinea",linea);
	$.ajax({
		url:"ajax/lineas.ajax.php",
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
				console.log ("Se encuentra Linea ",respuesta["descripcion"]);
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#editarLinea").parent().after('<div class="alert alert-warning" >Esta Linea Existe </div>');
				$("#editarLinea").val("");
			}

		}
	})
 
}) // $("#editarLinea").change(function(){

//=======================================================
// Eliminar Linea.
//=======================================================
// $(".btnEliminarLinea").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarLinea", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarLinea",function()
	{	
		// Obteniendo los valores de "idLinea"
		var idLinea = $(this).attr("idLinea");

		Swal.fire ({
			title: "Esta Seguro De Borrar La Linea",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar La Linea'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=linea&idLinea="+idLinea;
			}
		})	

}) // $(".btnEliminarLinea").click(function(){

