<?php
require_once ('tcpdf_include.php');
require_once "../../../controladores/responsivas.controlador.php";
require_once "../../../modelos/responsivas.modelo.php"; 	
require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";
require_once "../../../controladores/empleados.controlador.php";
require_once "../../../modelos/empleados.modelo.php";


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
	
	//$fecha_asig = date("Y-m-d",strtotime($_POST["nuevaFechaAsignado"]));
	$fecha = date("m-d-Y",strtotime($respuestaResponsiva["fecha_asignado"]));

	$productos = json_decode($respuestaResponsiva["productos"]);
	$neto = number_format($respuestaResponsiva["neto"],2);
	$impuesto = number_format($respuestaResponsiva["impuesto"],2);
	$total = number_format($respuestaResponsiva["total"],2);

	// Traer la informacion del Empleado
	$itemEmp = "id_empleado";
	$valorEmp = $respuestaResponsiva["id_empleado"];
	$ordenarEmp = "apellidos";
	$respuestaEmp = ControladorEmpleados::ctrMostrarEmpleados($itemEmp,$valorEmp,$ordenarEmp);
	
	// Traer la informacion del Usuario.
	$itemUsuario = "id_usuario";
	$valorUsuario = $respuestaResponsiva["id_usuario"];
	$respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);



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
				<div style="font-size:9.5px; text-align:right; line-height:15px;">	
					No. Maquila : 411 Baja
					<br>
						Direccion: 
						Blvd. Terarn Teran No. 20662 L-388
						Fracc. Murua Oriente
						Tijuana, B.C. Mexico
				</div>
			</td>
			<td style="background-color:white; width:140px">
				<div style="font-size:9.5px; text-align:right; line-height:15px;">					
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
				<div style="font-size:8.5px; text-align:right; line-height:10px;">	
				</div>
			</td>
		</tr>
		<tr>
			<td style="background-color:white; width:540px">
				<div style="font-size:13.5px; color:blue; text-align:center; line-height:15px;">
					Recibo De Propiedad De La Compañia NPA De Mexico, S. de R.L. De C.V.
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


// Imprimira los datos del Empleado.
$bloque2 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:390px">
				Cliente: $respuestaEmp[nombre]  $respuestaEmp[apellidos]
			</td>
			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
				Fecha: $fecha
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:540px">Usuario :$respuestaUsuario[nombre] </td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');

// Imprimira la Responsivas.
$bloque3 = <<<EOF

EOF;


$pdf->writeHTML($bloque3,false,false,false,false,'');


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