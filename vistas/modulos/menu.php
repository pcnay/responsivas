<!-- Es el menu general, se encuentra en la parte Izquierda. Las opciones del menu. -->
<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Despliega los iconos del menu laterial -->
    <ul class="sidebar-menu">
			<?php
				if ($_SESSION["perfil"] == "Administrador")
				{
						echo '
							<li class="active">
								<a href="inicio">
									<i class="fa fa-home"></i>
									<span>Inicio</span>           
								</a>
							</li>

							<li class="active">
								<a href="cintas">
									<i class="fa fa-home"></i>
									<span>Cintas</span>           
								</a>
							</li>

							<!-- Manejando los roles de los usuarios. -->

							<li class="">
								<a href="usuarios">
									<i class="fa fa-user"></i>
									<span>Usuarios</span>           
								</a>
							</li>

							<li class="treeview">
								<a href="empleados">
									<i class="fa fa-list-ul"></i>
									<span>Capturar Empleados</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>           
								</a>						

									<ul class="treeview-menu">
										<li>
											<a href="ubicaciones">
												<i class="fa fa-circle-o"></i>
												<span>Ubicacion</span>
											</a>
										</li>

										<li>
											<a href="supervisores">
												<i class="fa fa-circle-o"></i>
												<span>Supervisor</span>
											</a>
										</li> 

										<li>
											<a href="deptos">
												<i class="fa fa-circle-o"></i>
												<span>Departamentos</span>
											</a>
										</li> 
										<li>
											<a href="puestos">
												<i class="fa fa-circle-o"></i>
												<span>Puestos</span>
											</a>
										</li> 
										<li>
											<a href="empleados">
												<i class="fa fa-circle-o"></i>
												<span>Capturar Empleados</span>
											</a>
										</li> 

									</ul>
							</li>';
				}


				if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial")
				{
					echo '
					<li class="treeview">
						<a href="productos">
							<i class="fa fa-list-ul"></i>
							<span>Productos</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>           
						</a>						

						<ul class="treeview-menu">
							<li>
								<a href="perifericos">
									<i class="fa fa-circle-o"></i>
									<span>Perifericos</span>
								</a>
							</li>

							<li>
								<a href="almacen">
									<i class="fa fa-circle-o"></i>
									<span>Almacen</span>
								</a>
							</li> 

							<li>
								<a href="edo-epo">
									<i class="fa fa-circle-o"></i>
									<span>Estado Equipo</span>
								</a>
							</li> 
							<li>
								<a href="marcas">
									<i class="fa fa-circle-o"></i>
									<span>Marca</span>
								</a>
							</li> 
							<li>
								<a href="Modelos">
									<i class="fa fa-circle-o"></i>
									<span>Modelos</span>
								</a>
							</li> 
							<li>
								<a href="idf">
									<i class="fa fa-circle-o"></i>
									<span>idf</span>
								</a>
							</li> 
							<li>
								<a href="patchpanel">
									<i class="fa fa-circle-o"></i>
									<span>Patch Panel</span>
								</a>
							</li> 
							<li>
								<a href="puerto">
									<i class="fa fa-circle-o"></i>
									<span>Puerto</span>
								</a>
							</li> 
							<li>
								<a href="productos">
									<i class="fa fa-circle-o"></i>
									<span>Alta Producto</span>
								</a>
							</li> 

						</ul>
					</li>	';			
				} 

				
				if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial")
				{
					echo '
					<li class="treeview">
						<a href="#">
							<i class="fa fa-list-ul"></i>
							<span>Responsivas</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>           
						</a>						

						<ul class="treeview-menu">
							<li>
								<a href="cap-responsiva">
									<i class="fa fa-circle-o"></i>
									<span>Capturar Responsivas</span>
								</a>
							</li>

							<li>
								<a href="rep-responsivas">
									<i class="fa fa-circle-o"></i>
									<span>Reportes Responsivas</span>
								</a>
							</li> 

						</ul>
					</li>	';			
				} 


				if ($_SESSION["perfil"] == "Administrador")
				{
					echo '
					<li class="treeview">
						<a href="#">
							<i class="fa fa-list-ul"></i>
							<span>Reportes</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>           
						</a>						

						<ul class="treeview-menu">
							<li>
								<a href="rep-empleados">
									<i class="fa fa-circle-o"></i>
									<span>Empleados</span>
								</a>
							</li>

							<li>
								<a href="rep-usuarios">
									<i class="fa fa-circle-o"></i>
									<span>Usuarios</span>
								</a>
							</li> 

							<li>
								<a href="rep-productos">
									<i class="fa fa-circle-o"></i>
									<span>Productos</span>
								</a>
							</li> 
							<li>
								<a href="rep-responsivas">
									<i class="fa fa-circle-o"></i>
									<span>Responsivas</span>
								</a>
							</li> 

						</ul>
					</li>	';			
				} 


			// echo '</ul> <!-- <ul class="treeview-menu"> --> 

				//<!-- </li> <li class="treeview"> -->  '
			
			?>

    </ul> <!-- <ul class="sidebar-menu"> -->

  </section>

</aside>