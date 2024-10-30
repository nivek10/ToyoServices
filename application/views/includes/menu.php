	<!-- Left Panel -->
	<aside id="left-panel" class="left-panel">
		<nav class="navbar navbar-expand-sm navbar-default">

			<div class="navbar-header">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand" href="#"><img src="<?=base_url('assets/imgs/toyo-service.png')?>" alt="Toyo Service"></a>
				<a class="navbar-brand hidden" href="#"><img src="<?=base_url('assets/imgs/t-service.png')?>" alt="Toyo Service"></a>
			</div>

			<div id="main-menu" class="main-menu collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="<?=base_url('inicio')?>"> <i class="menu-icon fa fa-dashboard"></i>Inicio </a>
					</li>

					<h3 class="menu-title">Registros</h3><!-- /.menu-title -->
					<li>
						<a href="<?=base_url('clientes/listado')?>"> <i class="menu-icon fa fa-user"></i>Clientes </a>
					</li>
					<li>
						<a href="<?=base_url('trabajos/listado')?>"> <i class="menu-icon fa fa-cog"></i>Trabajos </a>
					</li>
					<li>
						<a href="<?=base_url('proveedores/listado')?>"> <i class="menu-icon fa fa-users"></i>Proveedores </a>
					</li>
					<li>
						<a href="<?=base_url('usuarios/listado')?>"> <i class="menu-icon fa fa-user-plus"></i>Personal </a>
					</li>
					<li>
						<a href="<?=base_url('areas/listado')?>"> <i class="menu-icon fa fa-clipboard"></i>Areas </a>
					</li>

					<h3 class="menu-title">Insumos</h3><!-- /.menu-title -->
					<li>
						<a href="<?=base_url('productos/listado')?>"> <i class="menu-icon fa fa-wrench"></i>Repuestos </a>
					</li>
					<li>
						<a href="<?=base_url('compras/listado')?>"> <i class="menu-icon fa fa-shopping-cart"></i>Compras </a>
					</li>
					<li>
						<a href="<?=base_url('ventas/listado')?>"> <i class="menu-icon fa fa-money"></i>Ventas </a>
					</li>

					<h3 class="menu-title">Reportes</h3><!-- /.menu-title -->
					<li>
						<a href="<?=base_url('reportes/ver')?>"> <i class="menu-icon fa fa-tasks"></i>Reportes </a>
					</li>
					<!-- <li>
						<a href="#"> <i class="menu-icon fa fa-pie-chart"></i>Estadisticas </a>
					</li> -->
				</ul>
			</div><!-- /.navbar-collapse -->
		</nav>
	</aside><!-- /#left-panel -->




	<!-- Right Panel -->

	<div id="right-panel" class="right-panel">

		<!-- Header-->
		<header id="header" class="header">

			<div class="header-menu">

				<div class="col-sm-7">
					<h4><a href="<?=base_url()?>">Toyo Service</a></h4>
					<a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
					
				</div>

				<div class="col-sm-5">

					<div class="user-area dropdown float-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img class="user-avatar rounded-circle" src="<?=base_url()?>assets/imgs/img_profile.png" alt="User Avatar">
						</a>

						<div class="user-menu dropdown-menu">
								<!-- <a class="nav-link" href="#"><i class="fa fa- user"></i>Mi Perfil</a> -->

								<a class="nav-link" href="<?=base_url('usuarios/logout')?>"><i class="fa fa-power -off"></i>Salir</a>
						</div>

					</div>

				</div>
			</div>

		</header><!-- /header -->
		<!-- Header-->
		