var perfilOculto = $("#perfilOculto").val();
//console.log ("perfilOculto",perfilOculto);



/* Cargar los datos - Responsivas de forma dinamica */
$.ajax({
	url:"ajax/datatable-responsivas.ajax.php",
	success:function(respuesta)
	{
		console.log("respuesta",respuesta);
	}
})

/* Cargar los datos - Productos de forma dinamica */

// Para hacer que las variables de sesion se puedan usar en Datatable.



// Verificar que los datos Json estan correctos.
// En esta parte se agrega la tabla a la plugin "DataTable" y no quema en el HTML el contenido de los campos.
// Se agregan tres propiedades últimas para mejorar el desempeño en la carga de la páginas.
// defenderRender, retrieve, proccesing
// ?perfilOculto="+perfilOculto = Se manda como variable GET a "datatable-productos.ajax.php"
$('.tablaResponsivas').DataTable({
	"ajax":"ajax/datatable-responsivas.ajax.php?perfilOculto="+perfilOculto,
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

