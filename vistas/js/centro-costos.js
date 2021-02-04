// =======================================
// Editar Centro De Costos:
// ======================================
$(".btnEditarCentro_Costos").click(function(){
	// Se obtiene el valor de "idCentro_Costos"
	var idCtro_Costos = $(this).attr("idCentro_Costos");

	//console.log("idEdo_Epo",idEdo_Epo);

	// Para agregar datos 
	var datos = new FormData();
	datos.append("idCentro_Costos",idCtro_Costos); // Se crea la variable "POST", "idCentro_Costos"

	$.ajax({
		url:"ajax/centro-costos-ajax.php",
		method:"POST",
		data:datos,
		cache:false,
		contentType:false,	
		processData:false,
		dataType:"json",
		success:function(respuesta){
			//console.log("respuesta",respuesta);
			// Viene desde : <div id="modalEditarCentro_Costos" class="modal fade" role="dialog">, "centro-costos.php", se le asigna el valor que se retorno el Ajax.
			$("#editarCentro_Costos").val(respuesta["num_centro_costo"]);
			$("#editarDesc_cc").val(respuesta["descripcion"]);
			$("#idCentro_Costos").val(respuesta["id_centro_costos"]); // viene desde el campo oculto de <input type="hidden"  name="idCentro_Costos"  id="idCentro_Costos" required>
		}

	}); // $.ajax({ ......


})  // $(":btnEditarCentro_Costos")


// Revisando que el "Centro De Costos" no este repetido.
// Cuando se escriba en el input : <input type="text" class="form-control input-lg" name="nuevoCentro_Costos" id="nuevoCentro_Costos" placeholder = "Ingresar un Centro de Costos" required>
$("#nuevoCentro_Costos").change(function(){
	// Remueve los mensajes de alerta. 
	$(".alert").remove();
				
	// Obtienedo el valor del id=nuevoCentro_Costos.
	var centro_costos = $(this).val();
	
	// Obtener datos de la base de datos
	var datos = new FormData();
	// Genera 
	datos.append("validarCentro_Costos",centro_costos);
	$.ajax({
		url:"ajax/centro-costos-ajax.php",
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
				$("#nuevoCentro_Costos").parent().after('<div class="alert alert-warning" >Centro de Costos Existe </div>');
				$("#nuevoCentro_Costos").val("");
			}

		}
	})
 
}) // $("#nuevoCentro_Costos").change(function(){

//=======================================================
// Eliminar Centro De Costos.
//=======================================================
// $(".btnEliminarCentro_Costos").click(function (){
	// Cuando el documento ya este cargado, busque en cualquier momento la clase ".btnEditarCentro_Costos", por lo que no importa si al cargar la primera vez no se haya creado esta clase, pero al hacer click en la clase se ejecutara esta funcion.  
	$(document).on("click",".btnEliminarCentro_Costos",function()
	{	

		// Obteniendo los valores de "idCentro_Costos"
		var idCentro_Costos = $(this).attr("idCentro_Costos");

		Swal.fire ({
			title: "Esta Seguro De Borrar El Centro De Costos",
			text: "Puedes Cancelar La Accion",
			type: 'warning',
			showCancelButton: true,
			confirmButtonText: "#3085d6",
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, Borrar El Centro De Costos'
		}).then(function(result){ 
			if (result.value)
			{
				window.location = "index.php?ruta=centro-costos&idCentro_Costos="+idCentro_Costos;
			}
		})	

}) // $(".btnEliminarCentro_Costos").click(function(){

