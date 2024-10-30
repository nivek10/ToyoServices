<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Clientes </h1>
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
								<strong>Editar Cliente</strong>
								<a href="<?=base_url('clientes/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form action="<?=base_url('clientes/actualizar')?>" method="post" class="card-body card-block form-datos">
								<input type="hidden" name="id" value="<?=$cliente->id?>">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nombres" class=" form-control-label">Nombre del Cliente <span class="text-danger">*</span></label>
											<input type="text" name="nombres" id="nombres" placeholder="Nombre del Cliente" class="form-control" value="<?=$cliente->nombres?>" required>
										</div>
										<div class="form-group">
											<label for="apellidos" class=" form-control-label">Apellidos del Cliente <span class="text-danger">*</span></label>
											<input type="text" name="apellidos" id="apellidos" placeholder="Apellidos del Cliente" class="form-control" value="<?=$cliente->apellidos?>" required>
										</div>
										<div class="form-group">
											<label for="ci" class=" form-control-label">Nro de Cédula <span class="text-danger">*</span></label>
											<input type="text" name="ci" id="ci" placeholder="Nro de Cédula" class="form-control" value="<?=$cliente->ci?>" data-url-verifica="<?=base_url('clientes/verifica_ci')?>" autocomplete="off" required>
											<div id="resultado-verifica-ci"></div>
										</div>
										<div class="form-group">
											<label for="telefono" class=" form-control-label">Teléfono </label>
											<input type="text" name="telefono" id="telefono" placeholder="Teléfono" class="form-control" value="<?=$cliente->telefono?>">
										</div>
										<div class="form-group">
											<label for="direccion" class=" form-control-label">Dirección </label>
											<input type="text" name="direccion" id="direccion" placeholder="Dirección" class="form-control" value="<?=$cliente->direccion?>">
										</div>
										<div class="form-group">
											<label for="email" class=" form-control-label">Email </label>
											<input type="text" name="email" id="email" placeholder="Email" class="form-control" value="<?=$cliente->email?>">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="nombre_comercial" class=" form-control-label">Nombre Comercial</label>
											<input type="text" name="nombre_comercial" id="nombre_comercial" placeholder="Nombre Comercial" class="form-control" value="<?=$cliente->nom_comercial?>" >
										</div>
										<div class="form-group">
											<label for="nombre_fiscal" class=" form-control-label">Nombre Fiscal </label>
											<input type="text" name="nombre_fiscal" id="nombre_fiscal" placeholder="Nombre Fiscal" class="form-control" value="<?=$cliente->nom_fiscal?>" >
										</div>
										<div class="form-group">
											<label for="codigo_postal" class=" form-control-label">Código Postal </label>
											<input type="text" name="codigo_postal" id="codigo_postal" placeholder="Código Postal" class="form-control" value="<?=$cliente->cod_postal?>" data-url-verifica="<?=base_url('clientes/verifica_ci')?>" autocomplete="off" >
											<div id="resultado-verifica-ci"></div>
										</div>
										<div class="form-group">
											<label for="poblacion" class=" form-control-label">Población </label>
											<input type="text" name="poblacion" id="poblacion" placeholder="Población" class="form-control" value="<?=$cliente->poblacion?>">
										</div>
										<div class="form-group">
											<label for="provincia" class=" form-control-label">Provincia </label>
											<input type="text" name="provincia" id="provincia" placeholder="Provincia" class="form-control" value="<?=$cliente->provincia?>">
										</div>
										<div class="form-group">
											<label for="pais" class=" form-control-label">País </label>
											<input type="text" name="pais" id="pais" placeholder="País" class="form-control" value="<?=$cliente->pais?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label for="web" class=" form-control-label">Web </label>
											<input type="text" name="web" id="web" placeholder="Web" class="form-control" value="<?=$cliente->web?>">
										</div>
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

<script type="text/javascript">
	$(function(){
		$('input[name="ci"]').on('keyup', function(e){
			e.preventDefault();
			var url = $(this).data('url-verifica');
			var dato = $(this).val();
			var $this = $(this);
			$.ajax({
				url: url,
				type: 'post',
				data: {ci: dato},
				success: function(data) {
					if (data.res > 0) {
						$('#resultado-verifica-ci').html('<span class="badge badge-pill badge-danger">Nro de CI ya Registrado</span>');
						setTimeout(function(){							
							$this.val('');
							$('#resultado-verifica-ci').html('');
						}, 3000);
					} else {
						$('#resultado-verifica-ci').html('<span class="badge badge-pill badge-success">Nro de CI Permitido</span>');
					}
				}
			});
		});
	});
</script>