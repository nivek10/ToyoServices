<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Proveedores </h1>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="page-header float-right">
					<div class="page-title">
						<ol class="breadcrumb text-right">
							<li class="active">Servicio de Automecánica</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<!-- main content -->
		<div class="content mt-3">
			<div class="animated fadeIn">
				<div class="row">

					<div class="col-md-12">
						<div class="error-messages"></div>
					</div>

					<div class="col-md-12">
						<div class="card form-datos">
							<div class="card-header">
								<strong>Nuevo Proveedor</strong>
								<a href="<?=base_url('proveedores/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form action="<?=base_url('proveedores/agregar')?>" method="post" class="card-body card-block form-datos">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nombre" class=" form-control-label">Nombre del Proveedor <span class="text-danger">*</span></label>
											<input type="text" name="nombre" id="nombre" placeholder="Nombre del Proveedor" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="direccion" class=" form-control-label">Dirección </label>
											<input type="text" name="direccion" id="direccion" placeholder="Dirección" class="form-control">
										</div>
										<div class="form-group">
											<label for="email" class=" form-control-label">Correo Electrónico </label>
											<input type="text" name="email" id="email" placeholder="Correo Electrónico" class="form-control">
										</div>
										<div class="form-group">
											<label for="telefono" class=" form-control-label">Teléfono </label>
											<input type="text" name="telefono" id="telefono" placeholder="Teléfono" class="form-control">
										</div>
										<div class="form-group">
											<label for="descripcion" class="form-control-label">Descripción </label>
											<textarea name="descripcion" id="descripcion" rows="8" placeholder="Descripción" class="form-control"></textarea>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nom_comercial" class=" form-control-label">Nombre Comercial </label>
											<input type="text" name="nom_comercial" id="nom_comercial" placeholder="Nombre Comercial" class="form-control" >
										</div>
										<div class="form-group">
											<label for="nom_fiscal" class=" form-control-label">Nombre Fiscal </label>
											<input type="text" name="nom_fiscal" id="nom_fiscal" placeholder="Nombre Fiscal" class="form-control">
										</div>
										<div class="form-group">
											<label for="poblacion" class=" form-control-label">Población </label>
											<input type="text" name="poblacion" id="poblacion" placeholder="Población" class="form-control">
										</div>
										<div class="form-group">
											<label for="provincia" class=" form-control-label">Provincia </label>
											<input type="text" name="provincia" id="provincia" placeholder="Provincia" class="form-control">
										</div>
										<div class="form-group">
											<label for="cod_postal" class=" form-control-label">Código Postal </label>
											<input type="text" name="cod_postal" id="cod_postal" placeholder="Código Postal" class="form-control">
										</div>
										<div class="form-group">
											<label for="pais" class=" form-control-label">País </label>
											<input type="text" name="pais" id="pais" placeholder="País" class="form-control">
										</div>
										<div class="form-group">
											<label for="web" class=" form-control-label">Web </label>
											<input type="text" name="web" id="web" placeholder="Web" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<button type="submit" class="btn btn-success pull-right"><i class="fa fa-fw fa-save"></i> Guardar</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div><!-- .animated -->
		</div> <!-- .content -->

<?php $this->load->view('includes/footer'); ?> 
