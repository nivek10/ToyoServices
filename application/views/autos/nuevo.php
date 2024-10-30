<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Automoviles </h1>
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
								<strong>Registro de Automovil: <?=$cliente->nombres . ' ' . $cliente->apellidos?></strong>
								<a href="<?=base_url('clientes/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form action="<?=base_url('automoviles/agregar')?>" method="post" class="card-body card-block form-datos">
								<input type="hidden" name="cliente_id" value="<?=$cliente->id?>">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="marca" class=" form-control-label">Marca <span class="text-danger">*</span></label>
											<input type="text" name="marca" id="marca" placeholder="Marca" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="modelo" class=" form-control-label">Modelo <span class="text-danger">*</span></label>
											<input type="text" name="modelo" id="modelo" placeholder="Modelo" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="placa" class=" form-control-label">Placa <span class="text-danger">*</span></label>
											<input type="text" name="placa" id="placa" placeholder="Placa" class="form-control" data-url-verifica="<?=base_url('clientes/verifica_ci')?>" autocomplete="off" required>
											<div id="resultado-verifica-placa"></div>
										</div>
										<div class="form-group">
											<label for="color" class=" form-control-label">Color </label>
											<input type="text" name="color" id="color" placeholder="Color" class="form-control" >
										</div>
										<div class="form-group">
											<label for="anio" class=" form-control-label">Año </label>
											<input type="text" name="anio" id="anio" placeholder="Año" class="form-control" >
										</div>
										<div class="form-group">
											<label for="observaciones" class=" form-control-label">Observaciones </label>
											<textarea name="observaciones" id="observaciones" rows="5" class="form-control" placeholder="Observaciones"></textarea>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="tipo" class=" form-control-label">Tipo </label>
											<input type="text" name="tipo" id="tipo" placeholder="Tipo" class="form-control" >
										</div>
										<div class="form-group">
											<label for="kms" class=" form-control-label">Kms </label>
											<input type="text" name="kms" id="kms" placeholder="Kms" class="form-control" >
										</div>
										<div class="form-group">
											<label for="bastidor" class=" form-control-label">Bastidor </label>
											<input type="text" name="bastidor" id="bastidor" placeholder="Bastidor" class="form-control" >
										</div>
										<div class="form-group">
											<label for="motor" class=" form-control-label">Motor </label>
											<input type="text" name="motor" id="motor" placeholder="Motor" class="form-control" >
										</div>
										<div class="form-group">
											<label for="fecha_compra" class=" form-control-label">Fecha de Compra </label>
											<input type="text" name="fecha_compra" id="fecha_compra" placeholder="Fecha de Compra" class="form-control fecha" >
										</div>
										<div class="form-group">
											<label for="localizacion" class=" form-control-label">Localización </label>
											<input type="text" name="localizacion" id="localizacion" placeholder="Localización" class="form-control" >
										</div>
										<div class="form-group">
											<label for="procedencia" class=" form-control-label">Procedencia </label>
											<input type="text" name="procedencia" id="procedencia" placeholder="Procedencia" class="form-control" >
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

<script type="text/javascript">
	$(function(){
		var timeout;
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
						timeout = setTimeout(function(){							
							$this.val('');
							$('#resultado-verifica-ci').html('');
						}, 3000);
					} else {
						$('#resultado-verifica-ci').html('<span class="badge badge-pill badge-success">Nro de CI Permitido</span>');
						clearTimeout(timeout);
					}
				}
			});
		});
	});
</script>
