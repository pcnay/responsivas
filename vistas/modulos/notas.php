<?php
	/*
	// El vendedor no puede entrar a Perifericos
	if ($_SESSION["perfil"] == "Vendedor")
	{
		echo '
			<script>
				window.location = "inicio";
			</script>';
			return;			
	}
	*/
	
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Notas
        <small>Panel De Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Notas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        
        <div class="box-header with-border">
          <!-- Abre una ventana Modal, se define en la parte última del documento.-->

          <button class="btn btn-primary"  data-toggle="modal" data-target="#modalAgregarNotas">
            Agregar Notas
          </button>       
        </div>
 
        <div class="box-body">
          <!-- Cuerpo de la ventana, donde se encuentran los datos, tablas, se utilizara tDAtaTable de Bootstrap esta completa, contiene buscar, paginador, ordenar las columnas  -->
          <!-- Esta clases de "table" son del plugin "bootstrap"-->
          <!-- "tabla" = Es para enlazarlo con DataTable, se utiliza el archivo  /frontend/vistas/js/marcas.js-->
          <table class="table table-bordered table-striped dt-responsive tablaNotas">
            <thead>
              <tr>
                <th style="width:10px">ID Nota</th>
                <th>Usuario</th>
								<th>Nombre Nota</th>															
								<th>Fecha Creacion</th>								
                <th>Acciones </th>
              </tr>
            </thead>

            <!-- Cuerpo de la Tabla, se modifica para agregarlas dinamicamente -->
            <tbody>

            </tbody>

          </table> <!-- <table class="table table-bordered tabe-striped"> -->

					<!-- Se agrega esta modificacion para poder utilizar las variables de sesion en el plugin DataTable el “id” se logra permiter el ingreso  -->
					<input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

        </div> <!-- <div class="box-body"> -->

        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Agregar Categoria" se activa esta ventana.
-->

<!-- Modal -->
<div id="modalAgregarNotas" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Nota</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            
					<!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" maxlength="120" class="form-control input-lg" name="nuevaNota" placeholder = "Nombre Nota" id="nuevaNota" required>
              </div> <!-- <div class = "input-group"> -->           

            </div> <!-- <div class="form-group"> -->

						<!-- Captura la Descripcion Nota -->
						<div class="form-group">						
						  <label for="descripcion_nota">Descripcion Nota:</label>
							<textarea class="form-control" rows="5" cols="30" name="nuevaDescripNota" id="nuevaDescripNota">							       
							</textarea>
						</div>

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Nota</button>
          </div>

					<?php 
						// Para grabar la Notas.
						$crearNota = new ControladorNotas();
						$crearNota->ctrCrearNotas();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalAgregarPeriferico" class="modal fade" role="dialog"> --> 


<!--Este código se tomo desde el bootstrap - > Table 
Cuando el usuario oprima el boton de "Editar Marca" se activa esta ventana.
-->
<!-- ================================================
	 Modal Editar Notas 
	====================================================
-->
<div id="modalEditarNota" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos., se suprime -->
      <form role="form" method="post">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Nota</h4>
        </div>


        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
								<label for="nombre_nota">Nombre Nota:</label>
                <input type="text" maxlength="120" class="form-control input-lg" name="editarNombre_Nota"  id="editarNombre_Nota" required>
								<!-- Se envía como campo oculto para enviar el "id" de la Nota -->
								<input type="hidden"  name="idNota"  id="idNota" required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
								<label for="comentarios">Descripcion Nota:</label>
								<textarea class="form-control input-lg" rows="5" name="editarDescrip_Nota" id="editarDescrip_Nota" placeholder="">
								</textarea>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div> <!-- <div class="modal-body"> -->

					<!-- Pie Del Modal-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          </div>

					<?php 
						// Para grabar la modifiacion de Marca.
						$editarNota = new ControladorNotas();
						$editarNota->ctrEditarNota();
					?>

      </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarPeriferico" class="modal fade" role="dialog"> --> 

<?php 
	// =====================================================
	// Para borrar una Nota.
	// =====================================================
	// Cuando se accese a este archivo, se esta ejecutando permanentemente.
	$borrarNota = new ControladorNotas();
	$borrarNota->ctrBorrarNota();
?>
