<?php
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
require_once ('tcpdf_include.php');
require_once "../../../controladores/responsivas.controlador.php";
require_once "../../../modelos/responsivas.modelo.php"; 	
require_once "../../../controladores/empleados.controlador.php";
require_once "../../../modelos/empleados.modelo.php";
require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class Epos_Prestados
{

public $id_NumSerie;
public function ObtenerEposPrestados()	
{

	date_default_timezone_set('America/Tijuana');
	$fecha_actual = date("m-d-Y");
	
	
// Traer la informacion del Periferico en Productos
	// $respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
	
	// Obtiene el "id_producto" del serial a Buscar.
	$respuestaResponsivas = ControladorResponsivas::ctrMostrarRespEposPrestados();
	//var_dump($respuestaResponsivas);
 
	for ($i=0;$i<count($respuestaResponsivas);$i++)
	{
		$productos = json_decode($respuestaResponsivas[$i]["productos"],true);
				
		// Obtener el contenido de la responsiva.
		for ($n=0;$n<count($productos);$n++)
		{			
			//print_r ($id_ProductoResp);
			//echo "<br>";

			// Obtener los datos del periferico como : Nombre, Serial, Modelo
			$item = "id_producto";
			$valor = $productos[$n]["id"];
			$periferico = ControladorProductos::ctrMostrarProductos($item,$valor);

			// Calculando la diferencias de dias 
			//echo "Diferencias de dias ";

			$f_devolucion = new DateTime($respuestaResponsivas[$i]["fecha_asignado"]);

			$fecha_actual = date('Y-m-d');

			$fecha_hoy = date_create($fecha_actual);
			//$date2 = date('Y-m-d');

			$interval = date_diff($f_devolucion,$fecha_hoy);

			print_r($periferico["Periferico"].' '.$periferico["Serial"].' '.$periferico["Modelo"].' Dias '.$interval->format('%a'));
			echo "<br>";

			//echo "Dias ".$interval->format('%a');

		} // for ($n=0;$n<count($productos);$n++)

	} // for ($i=0;$i<count($respuestaResponsivas);$i++)

		

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Para que permita varias paginas
$pdf->startPageGroup();
$pdf->AddPage();
$pdf->SetLeftMargin(0);

// Crear un primer bloque de maquetacion.
// En esta parte se puede utiizar las tabulaciones.
// Los estilos se colocan en linea, es decir en esta parte.

$bloque1 = <<<EOF
		<table>
			<tr>
				<td style="width:160px;"><img src="images/logo_jabil1.png"></td>
				<td style="background-color:white; width:255px">
					<div style="font-size:9.0px; text-align:left; line-height:15px;">	
									 No. Maquila : 411 Baja	
						<br>
											Blvd. Terarn Teran No. 20662 L-388 Fracc. 
									 Murua Oriente,      Tel.: 999-999-99-99, email:info@jabil.com
						<br>
									 Tijuana, B.C. Mexico
									 
					</div>
				</td>
				<td style="background-color:white; width:120px; text-align:right; color:red">				
					<div style="font-size:12.5px; text-align:right; line-height:15px;">				
							Fecha : $fecha_actual
					</div>
				</td>
			</tr>
			<tr>
				<td style="background-color:white; width:540px">
					<div style="font-size:8.5px; text-align:right; line-height:10px;">	
					</div>
				</td>
			</tr>
			<tr>
				<td style="background-color:white; width:540px">
					<div style="font-size:13.5px; color:blue; text-align:center; line-height:15px;">
						HISTORIAL DE PERIFERICO :  $nombre_periferico - $valor_serie 
					</div>
				</td>
			</tr>
			<tr>
				<td style="background-color:white; width:540px">
					<div style="font-size:8.5px; text-align:right; line-height:10px;">	
					</div>
				</td>
			</tr>
		</table>
	
	EOF;
	$pdf->writeHTML($bloque1,false,false,false,false,'');
	/*
		Para insertar un espacio en la hoja 
		 <table>
			<tr>
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>	
	*/

// Salida del Archivo.
$pdf->Output ('EposPrestados-'.'pdf');

	} // public function ObtenerEposPrestados())		

} // class Epos_Prestados()

$obtiene_perif = new Epos_Prestados();
$obtiene_perif->ObtenerEposPrestados();

?>

