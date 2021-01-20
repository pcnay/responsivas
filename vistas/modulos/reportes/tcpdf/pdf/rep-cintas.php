<?php

// /pdf/tcpdf/reportes/modulos/vistas/controladores/cintas.controlador.php
//require_once("../../../../../controladores/cintas.controlador.php");
require_once("../../../../../modelos/cintas.modelo.php");

// Include the main TCPDF library (search for installation path).
// Se debe respetar esta alineacion a la izquierda.
require_once('tcpdf_include.php');


class ObtenerCintas
{
	public function ctrMostrarCintas($item,$valor)
		{
			$tabla = "t_Cintas";
			$respuesta = ModeloCintas::mdlMostrarCintas($tabla,$item,$valor);
			return $respuesta;

		} // static public function ctrMostrarCintas()

} // class ObtenerCintas


class imprimirCintas
{

	public $codigo;
	
	public function traerImpresionCintas()
	{
		// Imprimir las cintas.
		$item = null;
		$valor = null;
		$respuestaCintas = ObtenerCintas::ctrMostrarCintas($item,$valor);

		

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// Agrega varias páginas para diferentes maquetaciones.
$pdf->startPageGroup();
$pdf->AddPage();
$num_serial = $respuestaCintas['num_serial'];


// El primer bloque de la maquetacion
// Dentro de esta seccion se pueden utilizar tab sin problemas
// Se recomienda utilizar tablas para trabajar en TCPDF
// Ancho maximo para la hoja carta es de 540 pixeles.
// Se debe revisar la longuitud cuando se colocan los titulos en la hoja.
$bloque1 = <<<EOF
	<table>
		<tr>
			<td style ="width:150px"><img src="images/logo-negro-bloque.png"></td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					$num_serial
					<br>
					Dirección: Calle 44B 92-11
				</div>
			</td>
			<td style="background-color:white; width:140px">
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					<br>
					Telefono: 300 786 62 49
					<br>
					ventas@inventorysystem.com
				</div>
			</td>
			<td style="background-color:white; width:110px; text-align:center; color:red">
				<br>
				<br>FACTURA N.<br>$respuestaCintas[num_serial]</td>

			</td>

		</tr>


	</table>

EOF;
//$pdf->writeHTML($bloque1,false,false,false,false,'');
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $bloque1, 0, 1, 0, true, '', true);

/*
$bloque2 = <<<EOF
	<table>
		<tr>
			<!-- Se coloca una imagen vacia, solo es para ocupar un espacio de 540px -->
			<td style="width:540px"><img src="images/back.jpg"></td>
		</tr>
	</table>

	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<!-- Dibuja un recuadro en el campo de Nombre Cliente -->
			<td style="border:1px solid #666; background-color:white; width:390px">
				Cliente: $respuestaCliente[nombre]
			</td>
	
			<td style="border:1px solid #666; background-color:white; width:150px; text-align:right">
				Fecha: $fecha
			</td>
		</tr>
		<tr>
			<td style="border:1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>
		</tr>
		<tr>
			<!-- Para insertar un renglon en blanco -->
			<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque2,false,false,false,false,'');


$bloque3 = <<<EOF
	<!-- Imprime los encabezados de las ventas -->
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Productos</td>
			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>
		</tr>
	</table>


EOF;

$pdf->writeHTML($bloque3,false,false,false,false,'');


// Se va a imprimir el desglose de las ventas.
foreach ($productos as $key => $item)
{
	$itemProducto = "descripcion";
	$valorProducto = $item["descripcion"];
	$orden = "id";

	$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto,$valorProducto,$orden);

	// Se debe utilizar variable de lo contrario muestra error.
	$valorUnitario = number_format($respuestaProducto["precio_venta"],2);
	$precioTotal = number_format($item["total"],2);


$bloque4 = <<<EOF
		<table style="font-size:10px; padding:5px 10px;">
			<tr>
				<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
					$item[descripcion]
				</td>
				<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; 	text-align:center">
					$item[cantidad]
				</td>

				<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; 	text-align:center">
					$ $valorUnitario
				</td>

				<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; 	text-align:center">
					$ $precioTotal
			</td>

			</tr>
		</table>

EOF;
	
$pdf->writeHTML($bloque4,false,false,false,false,'');

	} // foreach ($productos as $key => $item)


$bloque5 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">
		<tr>
			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; 	text-align:center"></td>
			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; 	text-align:center"></td>
		</tr>
		<tr>
			<!-- Es el espacio que tiene para imprimir el siguiente valor -->
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; 	text-align:center">
				neto
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px;	text-align:center">
				$ $neto
			</td>
		</tr>

		<tr>
			<!-- Es el espacio que tiene para imprimir el siguiente valor -->
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				impuesto
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px;	text-align:center">
				$ $impuesto
			</td>		 
		</tr>
		
		<tr>
			<!-- Es el espacio que tiene para imprimir el siguiente valor -->
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total
			</td>
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px;	text-align:center">
				$ $total
			</td>		 
		</tr>

		</table>

EOF;

$pdf->writeHTML($bloque5,false,false,false,false,'');
*/

	
// Para imprimir la factura.

$pdf->Output('cintas.pdf', 'I');

	} // public function traerImpresionCintas()

} // class imprimirCintas

$cintas = new imprimirCintas();
$cintas->traerImpresionCintas();


