<?php
	//https://www.php.net/manual/es/function.getdate.php
	//$hoy = getdate();
	//print_r($hoy);

	//print_r(gettimeofday());
	// strtotime , REvisar
	date_default_timezone_set('America/Tijuana');

	/*
	echo "Fecha ".date("d.m.y");
	echo "<br/>";
	echo "Hora Actual ".date('H:i:s');
	echo "<br/>";
	$valorActual = gettimeofday(true); 
	echo 'Hora actual expresado en segundos '.$valorActual;
	echo "<br/>";
	$horas = $valorActual/3600;
	echo "Expresado en Hrs ".$horas;
	$dias = $horas/24;
	echo "<br/>";
	echo "Expresado en Dias ".$dias;
	echo "<br/>";
	$semana =  $dias/8;
	echo "Expresado en Semanas ".$semana;
	echo "<br/>";
	$mes =  $semana/30;
	echo "Expresado en Meses ".$mes;
*/
$mifecha= date('Y-m-d H:i:s'); 
$NuevaFecha = strtotime ( '+5 hour' , strtotime ($mifecha) ) ; 
$NuevaFecha = strtotime ( '+18 minute' , $NuevaFecha ) ; 
$NuevaFecha = strtotime ( '+30 second' , $NuevaFecha ) ; 
$NuevaFecha = date ( 'Y-m-d H:i:s' , $NuevaFecha); 
echo $NuevaFecha;
echo "<br/>";
echo "<br/>";

echo "Diferencias de dias ";

$date1 = new DateTime("2020-01-02");

$fecha_actual = date('Y-m-d');
$date2 = date_create($fecha_actual);
//$date2 = date('Y-m-d');

$interval = date_diff($date1,$date2);
echo "Dias ".$interval->format('%a');


?>