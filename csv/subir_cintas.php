<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System | Blank Page</title>

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	<div class="panel panel-default">
	<div class="panel-body">
	<br>
	<div class="row">
	<form action="importar_cintas.php" method="post" enctype="multipart/form-data" id="import_form_cinta">
	<div class="col-md-3">
	<input type="file" name="file" />
	</div>
	<div class="col-md-5">
	<input type="submit" class="btn btn-primary" name="import_data_cintas" value="IMPORT">
	</div>
	</form>
	</div>
	<br>
	<div class="row">
	<table class="table table-bordered">
	<thead>
	<tr>
	<th>Id</th>
	<th>Id_categoria</th>
	<th>codigo</th>
	<th>descripcion</th>
	<th>imagen</th>
	<th>stock</th>
	<th>precio_compra</th>
	<th>precio_venta</th>
	<th>venta</th>
	<th>fecha</th>
	</tr>
	</thead>
	<tbody>
		</tbody>

	</table>

	</div>
	</div>
	</div>
	</div>
</body>
