<?php
	// Manejando Notas.
  class ControladorNotas
  {

		// ==================================================================
		// Extrae los datos desde la base de datos, mostrar las Notas
		// ==================================================================
		static public function ctrMostrarNotas($item,$valor)
		{
			$tabla = "t_Notas";
			$respuesta = ModeloNotas::mdlMostrarNotas($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarMarcas()


		// Crear Nota.
		static public function ctrCrearNotas()
    {
			if (isset($_POST["nuevaNota"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaMarca"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Notas";

					$datos=array();									
					$datos = array("nuevaNota"=>$_POST["nuevaNota"],
												"id_usuario"=>$_SESSION["id"],
												"nuevaDescripNota"=>$_POST["nuevaDescripNota"]);
					
					// Revisando el contenido del arreglo "$datos"
					//var_dump($datos);
					//die();
					//exit;

					$respuesta = ModeloNotas::mdlIngresarNota($tabla,$datos);

					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Marca ha sido guardada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									//window.location="notas";
								}
	
								});
			
							</script>';          
	
					}
				//}
				//else
				/*
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "La Marca no puede ir vacia o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="marcas";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaMarca"]))
				*/

			}

    } // static public function ctrCrearMarca()


		// ==============================================
		// Editar Nota
		// ==============================================
		static public function ctrEditarNota()
		{
			if (isset($_POST["editarNombre_Nota"]))
			{
				//if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarMarca"]))
				//{
					// Enviar la información al Modelo.
					$tabla = "t_Notas";
					// Se pasan los valores para  la consulta en la base de datos.
					$datos = array("nombre_nota"=>$_POST["editarNombre_Nota"],
												"descripcion_nota"=>$_POST["editarDescrip_Nota"],
													"id_nota"=>$_POST["idNota"]);

					$respuesta = ModeloNotas::mdlEditarNota($tabla,$datos);
					if ($respuesta == "ok")
					{
						echo '<script>           
						Swal.fire ({
							type: "success",
							title: "La Nota ha sido cambiada correctamente ",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							}).then(function(result){
								if (result.value)
								{
									// window.location="notas"; */
								}
	
								});
			
							</script>';          
	
					}
				//}
				/*
				else
				{
					echo '<script>           
					Swal.fire ({
						type: "error",
						title: "La Marca no puede ir vacio o llevar caracteres especiales ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								window.location="marcas";
							}

							});
		
						</script>';          

				} // if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaMarca"]))
				*/
				
			}

		} // static public function ctrCrearMarcas()

		// =========================================
		// Borrar Marca
		// =========================================
		static public function ctrBorrarNota()
		{
			// "idMarca" = se origina 
			/*
			//$(document).on("click",".btnEliminarMarca",function()
		//	{	
		
				// Obteniendo los valores de "idMarca"
				var idMarca = $(this).attr("idMarca");
		*/

			if (isset($_GET["idNota"]))
			{
				$tabla = "t_Notas";
				$datos = $_GET["idNota"]; // Obtiene el valor.
				$respuesta = ModeloNotas::mdlBorrarNota($tabla,$datos);
				if ($respuesta = "ok")
				{
					echo '<script>           
					Swal.fire ({
						type: "success",
						title: "La Nota ha sido borrado correctamente ",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
						}).then(function(result){
							if (result.value)
							{
								//window.location="notas";
							}

							});
		
						</script>';          

				} // if ($respuesta = "ok")

			} // if (isset($_GET["idNota"]))

		} // static public function ctrBorrarNota()

  } // class ControladorNotas

?> 
  