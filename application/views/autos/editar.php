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
									<button type="submit" class="btn btn-success pull-right"><i class="fa fa-fw fa-save"></i> Guardar</button>
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