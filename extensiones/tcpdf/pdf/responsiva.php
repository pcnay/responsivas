<?php

require_once "../../../controladores/responsivas.controlador.php";
require_once "../../../modelos/responsivas.modelo.php";
require_once ('tcpdf_include.php'); 	

// No se debe tabular las lineas de codigo.


class imprimirResponsiva
{
// Se utiliza para obtener el valor de la variable Global $_GET["idResponsiva"] que se pasa en la URL de "responsivas.js" (window.open("extensiones/tcpdf/pdf/responsiva.php?idResponsiva="+id_Responsiva,"_blank"))
public $id_Responsiva;
public function traerImpresionResponsiva()
{

	// Traer la informacion de la Responsiva.
	// $respuesta = ModeloResponsivas::mdlMostrarResponsivas($tabla,$item,$valor,$ordenar);
	$tabla = "t_Responsivas";
	$item = "id_responsiva";
	$valor_responsiva = $this->id_Responsiva;
	$ordenar = "ConsultaSencilla";

	
	$respuestaResponsiva = ControladorResponsivas::ctrMostrarResponsivas($item,$valor_responsiva,$ordenar);
	// Funciona este "var_dump" en TCPDF, solo que no despliega el PDF
	//var_dump($respuestaResponsiva["fecha_asignado"]);
	
	$fecha = $respuestaResponsiva["fecha_asignado"];
	$productos = json_decode($respuestaResponsiva["productos"]);
	$neto = number_format($respuestaResponsiva["neto"],2);
	$impuesto = number_format($respuestaResponsiva["impuesto"],2);
	$total = number_format($respuestaResponsiva["total"],2);

	// Traer la informacion del Empleado

	// Traer la informacion del Usuario.
	

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Para que permita varias paginas
$pdf->startPageGroup();
$pdf->AddPage();

// Crear un primer bloque de maquetacion.
// En esta parte se puede utiizar las tabulaciones.
// Los estilos se colocan en linea, es decir en esta parte.

$bloque1 = <<<EOF
	<table>
		<tr>
			<td style="width:150px"><img src="images/logo_jabil1.png"></td>
			<td style="background-color:white; width:90px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">	
					No. Maquila : 411 Baja
					<br>
						Direccion: 
						Blvd. Terarn Teran No. 20662 L-388
						Fracc. Murua Oriente
						Tijuana, B.C. Mexico
				</div>
			</td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">					
					Telefono : 999-999-99-99
					<br>
					info@jabil.com
				</div>
			</td>
			<td style="background-color:white; width:160px; text-align:right; color:red">				
				<div style="font-size:12.5px; text-align:right; line-height:15px;">				
						Responsiva No. $valor_responsiva
				</div>
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:14.5px; color:blue; text-align:center; line-height:15px;">
					Recibo De Propiedad De La Compañia NPA De Mexico, S. de R.L. De C.V.
				</div>
			</td>
		</tr>

	</table>
EOF;

$pdf->writeHTML($bloque1,false,false,false,false,'');
// Salida del Archivo.
$pdf->Output ('Responsiva.pdf');

}

} // class imprimirResponsiva

$responsiva = new imprimirResponsiva();
$responsiva->id_Responsiva = $_GET["idResponsiva"];
$responsiva->traerImpresionResponsiva();


/*

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print

$html = <<<EOF

<img src="images/image_demo.jpg" style="width:300px">

EOF;

$pdf->writeHTML($html, false, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('pdf.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
  ?>
 */

 ?>