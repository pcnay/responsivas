// Validar los caracteres permitidos 
// Validar la entrada.
$("#nuevoPlanTelefonia").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Z0-9- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});
// Validar los caracteres permitidos 
// Validar la entrada.
$("#editarPlanTelefonia").bind('keypress', function(event) {
  var regex = new RegExp("^[A-Z0-9- ]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});


// =======================================
// Editar Plan De Telefonicas:
// ======================================
$(".btnEditarPlanTelefonia").click(function(){
	// Se obtiene el valor de "idPlanTelefonia"
	var idPlanTelefonia = $(this).attr("idPlanTelefonia");

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idPlanTelefonia",idPlanTelefonia); // Se crea la variable "POST", "idTelefonia"

	$.ajax({
		url:"ajax/plan-telefonia.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarPlanTelefonia" class="modal fade" role="dialog">, "plan-telefonia.php", se le asigna el valor que se retorno el Ajax.
			$("#editarPlanTelefonia").val(respuesta["nombre"]);
			$("#idPlanTelefonia").val(respuesta["id_plan_tel"]); // viene desde el campo oculto de <input type="hidden"  name="idPlanTelefonia"  id="idPlanTelefonia" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarPlanTelefonia")


// Revisando que el "Plan de Telefonia" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoPlanTelefonia" id="nuevoPlanTelefonia" placeholder = "Ingresar un Plan de Telefonia" required>
$("#nuevoPlanTelefonia").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoPlanTelefonia.
	var planTelefonia = $(this).val();
	
	//console.log("Plan De Telefonia",plan_telefonia);

	var datos = new FormData();
	// Genera 
	datos.append("validarPlanTelefonia",planTelefonia);
	$.ajax({
		url:"ajax/plan-telefonia.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			//console.log("Respuesta",respuesta);
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#nuevoPlanTelefonia").parent().after('<div class="alert alert-warning" >Ya existe el Plan De Telefonia</div>');
				$("#nuevoPlanTelefonia").val("");
			}

		}
	})
 
}) // $("#nuevoPlanTelefonia").change(function(){

// Revisando que el "Plan de Telefonia" no este repetido. Cuando se edite.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoPlanTelefonia" id="nuevoPlanTelefonia" placeholder = "Ingresar un Plan de Telefonia" required>
$("#editarPlanTelefonia").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoPlanTelefonia.
	var planTelefonia = $(this).val();
	
	//console.log("Plan De Telefonia",plan_telefonia);

	var datos = new FormData();
	// Genera 
	datos.append("validarPlanTelefonia",planTelefonia);
	$.ajax({
		url:"ajax/plan-telefonia.ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){			
			//console.log("Respuesta",respuesta);
			// Si "respuesta = Valor, Verdadero "
			if (respuesta)
			{
				// Coloca una barra con mensaje de advertencia  en la etiqueta.
				$("#editarPlanTelefonia").parent().after('<div class="alert alert-warning" >Ya existe el Plan De Telefonia</div>');
				$("#editarPlanTelefonia").val("");
			}

		}
	})
 
}) // $("#editarPlanTelefonia").change(function(){

//=======================================================
// Eliminar Plan De Telefonia.
//=======================================================
// $(".btnEliminarPlanTelefonia").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarPlanTelefonia", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarPlanTelefonia",function()
	{	
		// Obteniendo los valores de "idPlanTelefonia"
		var idPlanTelefonia = $(this).attr("idPlanTelefonia");

		Swal.fire ({
			title: "Esta Seguro(a) De Borrar El Plan De Telefonia",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Plan De Telefonia'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=plan-telefonia&idPlanTelefonia="+idPlanTelefonia;
			}
		})	

}) // $(".btnEliminarPlanTelefonia").click(function(){

