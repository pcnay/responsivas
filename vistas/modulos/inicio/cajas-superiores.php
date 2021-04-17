<?php
	/*
	$ventas = ControladorVentas::ctrSumaTotalVentas();
	$item = null;
	$valor = null;
	$perifericos = ControladorPerifericos::ctrMostrarPerifericos($item,$valor);
	// var_dump($Perifericos);
	$totalPerifericos = count($perifericos);

	$clientes = ControladorClientes::ctrMostrarClientes($item,$valor);
	$totalClientes = count($clientes);

	$orden = "id";
	$productos = ControladorProductos::ctrMostrarProductos($item,$valor,$orden);
	$totalProductos = count($productos);
	*/
	
	$ventas["total"] = 0;
	$perifericos = 0;
	$totalPerifericos = 0;
	$totalClientes = 0;
	$totalProductos = 0;
?>

<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>$<?php echo number_format($ventas["total"],2); ?></h3>

				<p>Laptop Instaladas</p>
			</div>
			<div class="icon">
				<i class="ion ion-social-usd"></i>
			</div>
			<a href="#" class="small-box-footer">Mas Ventas<i class="fa fa-arrow-circle-right"></i></a>
			<!-- <a href="ventas" class="small-box-footer">Mas Ventas<i class="fa fa-arrow-circle-right"></i></a> -->
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?php echo number_format($totalPerifericos); ?></h3>

				<p>Desktop Instaladas</p>
			</div>
			<div class="icon">
				<i class="ion ion-clipboard"></i>
			</div>
			<a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?php echo number_format($totalClientes); ?></h3>
				<p>Monitores Instalados</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->

	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?php echo number_format($totalProductos); ?></h3>
				<p>Laptop Descompuestas</p>
			</div>
			<div class="icon">
				<i class="ion ion-ios-cast"></i>
			</div>
			<a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->
