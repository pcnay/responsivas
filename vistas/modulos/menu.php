<!-- Es el menu general, se encuentra en la parte Izquierda. Las opciones del menu. -->
<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Despliega los iconos del menu laterial -->
    <ul class="sidebar-menu">
			<?php
				if ($_SESSION["perfil"] == "Administrador")
				{
					echo '
						<!-- Manejando los roles de los usuarios. -->
						<li class="active">
							<a href="usuarios">
								<i class="fa fa-user"></i>
								<span>Usuarios</span>           
							</a>
						</li>
						<li class="active">
							<a href="cintas">
								<i class="fa fa-home"></i>
								<span>Cintas</span>           
							</a>
						</li>';
				}	

				if ($_SESSION["perfil"] == "Supervisor" || $_SESSION["perfil"] == "Ingeniero" || $_SESSION["perfil"] == "Soporte" || $_SESSION["perfil"] == "Banca Talento" || $_SESSION["perfil"] == "Administrador")
				{
					echo '
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
										<a href="puestos">
											<i class="fa fa-circle-o"></i>
											<span>Puestos</span>
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
										<a href="centro-costos">
											<i class="fa fa-circle-o"></i>
											<span>Centro De Costos</span>
										</a>
									</li> 
									<li>
										<a href="empleados">
											<i class="fa fa-circle-o"></i>
											<span>Empleados</span>
										</a>
									</li> 

								</ul> <!-- <ul class="treeview-menu"> -->

						</li> <!-- <li class="treeview"> -->';

					echo '
							<li class="treeview">
								<a href="productos">
									<i class="fa fa-list-ul"></i>
									<span>Capturar Productos</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>           
								</a>
								<ul class="treeview-menu">
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
										<a href="perifericos">
											<i class="fa fa-circle-o"></i>
											<span>Perifericos</span>
										</a>
									</li>	
									<li>
										<a href="telefonia">
											<i class="fa fa-circle-o"></i>
											<span>Cia Telefonica</span>
										</a>
									</li>	
									<li>
										<a href="plan-telefonia">
											<i class="fa fa-circle-o"></i>
											<span>Plan Telefonia</span>
										</a>
									</li>	
									<li>								
										<a href="productos">
											<i class="fa fa-circle-o"></i>
											<span>Alta Producto</span>
										</a>
									</li> 

								</ul> <!-- <ul class="treeview-menu"> -->

						</li> <!-- <li class="treeview"> -->';
				
					echo '
						<li class="treeview">
							<a href="responsivas">
								<i class="fa fa-list-ul"></i>
								<span>Capturar Responsivas</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>           
							</a>
							<ul class="treeview-menu">
								<li>
									<a href="almacen">
										<i class="fa fa-circle-o"></i>
										<span>Almacen</span>
									</a>
								</li>
								<li>
									<a href="empleados">
										<i class="fa fa-circle-o"></i>
										<span>Empleados</span>
									</a>
								</li>
								<li>
									<a href="productos">
										<i class="fa fa-circle-o"></i>
										<span>Productos</span>
									</a>
								</li>
								<li>
									<a href="usuarios">
										<i class="fa fa-circle-o"></i>
										<span>Usuarios</span>
									</a>
								</li>
								<li>
									<a href="responsivas">
										<i class="fa fa-circle-o"></i>
										<span>Responsivas</span>
									</a>
								</li>

							</ul> <!-- <ul class="treeview-menu"> -->

						</li> <!-- <li class="treeview"> -->';		
						
				} // if ($_SESSION["perfil"] == "Supervisor" || $_SESSION["perfil"] == "Ingeniero" || $_SESSION["perfil"] == "Soporte" || $_SESSION["perfil"]....

				if ($_SESSION["perfil"] == "Supervisor" || $_SESSION["perfil"] == "Administrador")
				{
					echo '
					<li class="treeview">
						<a href="reportes">
							<i class="fa fa-list-ul"></i>
							<span>Reportes Varios</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>           
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="#">
									<i class="fa fa-circle-o"></i>
									<span>Marcas</span>
								</a>
							</li>
						</ul> <!-- <ul class="treeview-menu"> -->

					</li> <!-- <li class="treeview"> -->';		
				} // if ($_SESSION["perfil"] == "Supervisor" || $_SESSION["perfil"] == "Administrador")

			?>

    </ul> <!-- <ul class="sidebar-menu"> -->

  </section>

</aside>