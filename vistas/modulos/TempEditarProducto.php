<div id="modalEditarProducto" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <!-- enctype= "multipart/form-data = Para subir archivos. -->
      <form role="form" method="post" enctype= "multipart/form-data">
    
        <!-- La franja azul de la ventana modal -->
        <div class="modal-header" style= "background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>

				<!-- Se deja vacio el atributo "value" este se llenara con JavaScript-->
        <div class="modal-body">
          <div class="box-body">
            <!-- Clases de BootStrap para las formularios-->
            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
								<!-- id="editarNombre : Para asignarle valor de la base de datos desde JavaScript.-->
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value = " " required>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
								<!-- Se coloca "readonly" porque no se podrá modificar, solo es mostrado -->
                <input type="text" class="form-control input-lg" id = "editarUsuario" name ="editarUsuario" value = " " readonly>
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder = "Escriba una nueva contraseña" >
								<!-- Se coloca este tipo de "input", ya que para relizar la accion de UPDATE, se tiene que agregar todos los campos., por si la clave no se modifica se manda como tipo "hidden"-->
								<input type="hidden" id="passwordActual" name="passwordActual" >

              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class = "input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarPerfil">
									<!-- id= "editarPerfil" para que desde JavaScript se modifique el que tiene el usuario .-->
                  <option value=""  id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>                
              </div> <!-- <div class = "input-group"> -->           
            </div> <!-- <div class="form-group"> -->

            <div class="form-group">
              <div class="panel text-up">SUBIR FOTO</div> 
							<!-- class = "nuevaFoto" : Es un codigo de JavaScript para subir las fotos al sistema.-->
              <input type="file" class="nuevaFoto" name="editarFoto" id="editarFoto">
              <p class="help-block">Peso Máximo de la foto 2 Mb</p>
              <!-- previsualizar = para reemplazar la foto que se va a subir-->
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width = "100px">
							<!-- Se utiliza este tipo de "input" para dejar el valor si el usuario no modifica la foto -->
							<input type="hidden" name="fotoActual" id="fotoActual">

            </div> <!-- <div class="form-group"> -->

          </div> <!-- <div class="box-body"> -->

        </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Actualizar Usuarios</button>
          </div>
					
           <?php 
              $editarUsuario = new ControladorUsuarios();
              $editarUsuario->ctrEditarUsuario();
            ?> 

        </form>

    </div> <!-- <div class="modal-content"> -->

  </div> <!-- <div class="modal-dialog"> -->

</div> <!-- <div id="modalEditarUsuario" class="modal fade" role="dialog"> -->

<?php
	// Este método se esta ejecutando siempre, pero se realiza el borrado cuando se origina la variable global "$_GET["idUsuario"] en Usuarios.controlador.php -> ctrBorrarUsuario()
	$borrarUsuario = new ControladorUsuarios();
	$borrarUsuario->ctrBorrarUsuario();
?>