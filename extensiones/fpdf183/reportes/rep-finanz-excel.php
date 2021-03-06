
<?php 
	if ($_SESSION["perfil"] == "Operador" )
		{
			echo '
				<script>
					window.location = "inicio";
				</script>';
				return;			
		}
	
  require_once('../fpdf.php');
	require_once('../../../controladores/responsivas.controlador.php');
	require_once('../../../modelos/responsivas.modelo.php');
	require_once('../../../controladores/productos.controlador.php');
	require_once('../../../modelos/productos.modelo.php');
	require_once('../../../controladores/empleados.controlador.php');
	require_once('../../../modelos/empleados.modelo.php');
	require_once('../../../controladores/centro-costos.controlador.php');
	require_once('../../../modelos/centro-costos.modelo.php');
	require_once('../../../controladores/deptos.controlador.php');
	require_once('../../../modelos/deptos.modelo.php');
	require_once('../../../controladores/perifericos.controlador.php');
	require_once('../../../modelos/perifericos.modelo.php');
	require_once('../../../controladores/marcas.controlador.php');
	require_once('../../../modelos/marcas.modelo.php');
	require_once('../../../controladores/modelos.controlador.php');
	require_once('../../../modelos/modelos.modelo.php');
	


class Rep_Finanzas
{
	public $fecha_inic,$fecha_fin;
	public function Obtener_reporte()
	{

		if ($this->fecha_inic > $this->fecha_fin)
		{
			$this->fecha_inic = $this->fecha_fin;
		}
		
		//echo "Fecha Inicio : ".$fecha_inicio;
		//echo "Fecha Final : ".$fecha_final;

		//$datos = array ("fecha_inicial"=>$fecha_inic,
		//								"fecha_final"=>$fecha_fin);
		
		//var_dump($datos);
		$fecha_inic = $this->fecha_inic;
		$fecha_fin = $this->fecha_fin;
		$rangoResponsivas = ControladorResponsivas::ctrMostrarRespRangosFecha($fecha_inic,$fecha_fin);

		//$productosResp = json_decode($rangoResponsivas[1]["productos"],true);
		//var_dump($rangoResponsivas);
		/*
		for ($l=0;$l<count($rangoResponsivas);$l++)
		{
			print_r($rangoResponsivas[$l]["fecha_asignado"].' - ');
			echo "</br>";
		}
		*/

		//print_r(count($rangoResponsivas));

		$total = 0;
		$contador = 0;
		// En este arreglo se agregaran todos los datos del rango de fechas de las responsivas.
		$rep_mensual = array();

		// Ciclo donde se encuentran el rango de las responsivas por Fecha.
		for ($i =0;$i<count($rangoResponsivas);$i++)
		{
			//$fecha_asignadoResp = date("m-d-Y",strtotime($rangoResponsivas[$i]["fecha_asignado"]));	
			$rep_mensual[$contador]["fecha_asignado"] = date("m-d-Y",strtotime($rangoResponsivas[$i]["fecha_asignado"]));
			// Obtener los datos del empleado.			
			$item = "id_empleado";
			$valor = $rangoResponsivas[$i]["id_empleado"];
			$orden = "apellidos";
			$datosEmpleado = ControladorEmpleados::ctrMostrarEmpleados($item,$valor,$orden);

			//Agregando los datos del empleado.
			$rep_mensual[$contador]["ntid"] = $datosEmpleado["ntid"];
			$rep_mensual[$contador]["nombre"] = $datosEmpleado["nombre"];
			$rep_mensual[$contador]["apellidos"] = $datosEmpleado["apellidos"];

			// Obteniendo el centro de Costos.
			$item = "id_centro_costos";
			$valor = $datosEmpleado["id_centro_costos"]; 
			$datosCentroCostos = ControladorCentro_Costos::ctrMostrarCentro_Costos($item,$valor);

			$rep_mensual[$contador]["num_centro_costos"] = $datosCentroCostos["num_centro_costos"];

			//Obteniendo el Depto. del Empleado.
			$item = "id_depto";
			$valor = $datosEmpleado["id_depto"];
			$datosDepto = ControladorDeptos::ctrMostrarDeptos($item,$valor);
			$rep_mensual[$contador]["descrip_depto"] = $datosDepto["descripcion"];

			// pasando de JSon a Arreglos para que PHP los pueda imprimir
			$productosResp = json_decode($rangoResponsivas[$i]["productos"],true);		

			//print_r($productosResp);
			//echo "</br>";
			//print_r(count($productosResp));

			//Se van a revisar cada producto que tiene la responsiva.
			$renglones = 0;
			for ($n =0;$n<count($productosResp);$n++)
			{
				//$cantidad = $productosResp[$n]["cantidad"];
				//$total = $total+$productosResp[$n]["precio"];
			
				//$precio = number_format($productosResp[$n]["precio"],2);
			
				// Obtener los datos del producto
				$item = "id_producto";
				$valor = $productosResp[$n]["id"];
				$producto = ControladorProductos::ctrMostrarProductos($item,$valor);	
				$rep_mensual[$contador]["periferico"] = $producto["Periferico"];
				$rep_mensual[$contador]["marca"] = $producto["Marca"];
				$rep_mensual[$contador]["modelo"] = $producto["Modelo"];
				$rep_mensual[$contador]["num_serie"] = $producto["Serial"];
				$rep_mensual[$contador]["precio_compra"] = $producto["precio_compra"];
				$renglones++;

				if ($renglones < count($productosResp))
				{
					$contador++;
					
					$rep_mensual[$contador]["fecha_asignado"] = $rep_mensual[$contador-1]["fecha_asignado"];
					$rep_mensual[$contador]["ntid"] = $rep_mensual[$contador-1]["ntid"];
					$rep_mensual[$contador]["nombre"] = $rep_mensual[$contador-1]["nombre"];
					$rep_mensual[$contador]["apellidos"] = $rep_mensual[$contador-1]["apellidos"];
					$rep_mensual[$contador]["num_centro_costos"] = $rep_mensual[$contador-1]["num_centro_costos"];
					$rep_mensual[$contador]["descrip_depto"] = $rep_mensual[$contador-1]["descrip_depto"];
					$rep_mensual[$contador]["periferico"] = $rep_mensual[$contador-1]["periferico"];
					$rep_mensual[$contador]["marca"] = $rep_mensual[$contador-1]["marca"];
					$rep_mensual[$contador]["modelo"] = $rep_mensual[$contador-1]["modelo"];
					$rep_mensual[$contador]["num_serie"] = $rep_mensual[$contador-1]["num_serie"];
					$rep_mensual[$contador]["precio_compra"] = $rep_mensual[$contador-1]["precio_compra"];
				}

			} // for ($n =0;$n<count($productosResp);$n++)
			
			$contador++;

		} // for ($i =0;$i<count($rangoResponsiva);$i++)

		
		for ($m=0;$m<count($rep_mensual);$m++)
		{
			print_r($rep_mensual[$m]["ntid"].' - ');			
			print_r($rep_mensual[$m]["fecha_asignado"].' - ');
			print_r($rep_mensual[$m]["nombre"].' - ');
			print_r($rep_mensual[$m]["apellidos"].' - ');			
			print_r($rep_mensual[$m]["num_centro_costos"].' - ');			
			print_r($rep_mensual[$m]["descrip_depto"].' - ');
			print_r($rep_mensual[$m]["periferico"].' - ');
			print_r($rep_mensual[$m]["marca"].' - ');
			print_r($rep_mensual[$m]["modelo"].' - ');
			print_r($rep_mensual[$m]["num_serie"].' - ');
			print_r($rep_mensual[$m]["precio_compra"].' - ');
			echo "</br>";
		}
	

	} // public function Obtener_reporte()


} // class Rep_finanzas

	//$fecha_inic = $_GET["fechaInic"];
	//$fecha_fin = $_GET["fechaFin"];


$Ejecutar_reporte = new Rep_finanzas();
$Ejecutar_reporte->fecha_inic = $_GET["fechaInic"];
$Ejecutar_reporte->fecha_fin = $_GET["fechaFin"];
$Ejecutar_reporte->Obtener_reporte();





?>