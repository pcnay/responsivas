<?php
/*
	// Solo el administrador puede entrar a Reportes
	// Se realiza para que no entren desde la URL de la barra de direcciones
	if ($_SESSION["perfil"] == "Operador" || $_SESSION["perfil"] == "Supervisor")
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
*/


require_once "../controladores/cintas.controlador.php";
require_once "../modelos/cintas.modelo.php"; 	

// No se debe tabular las lineas de codigo.


class subirCintas
{
	public function GrabarCintasTabla()
	{
		echo "Entro";
		
		
	} // public function traerImpresionResponsiva()

} // class imprimirResponsiva

$subir_Cintas = new subirCintas();
$subir_Cintas->GrabarCintasTabla();
?>
