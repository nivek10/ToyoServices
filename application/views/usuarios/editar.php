<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Personal </h1>
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
								<strong>Nuevo Personal</strong>
								<a href="<?=base_url('usuarios/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>							
							<form action="<?=base_url('usuarios/actualizar')?>" method="post" class="card-body card-block form-datos">
								<input type="hidden" name="id" id="id" value="<?=$usuario->id?>">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="areas" class=" form-control-label">Área <span class="text-danger">*</span></label>
											<select name="area" id="area" class="form-control" required>
												<option value="">--Seleccionar--</option>
												<?php foreach ($areas as $area) : ?>
													<option value="<?=$area->id?>" <?=($area->id == $usuario->area) ? 'selected' : '' ?> ><?=$area->area?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<label for="nombres" class=" form-control-label">Nombres <span class="text-danger">*</span></label>
											<input type="text" name="nombres" id="nombres" placeholder="Nombres" class="form-control" value="<?=$usuario->nombres?>" required>
										</div>
										<div class="form-group">
											<label for="apellidos" class=" form-control-label">Apellidos <span class="text-danger">*</span></label>
											<input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" class="form-control" value="<?=$usuario->apellidos?>" required>
										</div>
										<div class="form-group">
											<label for="telefono" class=" form-control-label">Telefono </label>
											<input type="text" name="telefono" id="telefono" placeholder="Telefono" class="form-control" value="<?=$usuario->telefono?>">
										</div>
										<div class="form-group">
											<label for="ci" class=" form-control-label">Cedula de identidad </label>
											<input type="text" name="ci" id="ci" placeholder="Cedula de identidad" class="form-control" value="<?=$usuario->ci?>">
										</div>
										<div class="form-group">
											<label for="referencias" class="form-control-label">Referencias </label>
											<textarea name="referencias" id="referencias" rows="5" placeholder="Referencias" class="form-control"><?=$usuario->referencias?></textarea>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="direccion" class=" form-control-label">Domicilio </label>
											<input type="text" name="direccion" id="direccion" placeholder="Domicilio" class="form-control" value="<?=$usuario->direccion?>">
										</div>
										<div class="form-group">
											<label for="cod_postal" class=" form-control-label">Código Postal </label>
											<input type="text" name="cod_postal" id="cod_postal" placeholder="Código Postal" class="form-control" value="<?=$usuario->cod_postal?>">
										</div>
										<div class="form-group">
											<label for="poblacion" class=" form-control-label">Población </label>
											<input type="text" name="poblacion" id="poblacion" placeholder="Población" class="form-control" value="<?=$usuario->poblacion?>">
										</div>
										<div class="form-group">
											<label for="provincia" class=" form-control-label">Provincia </label>
											<input type="text" name="provincia" id="provincia" placeholder="Provincia" class="form-control" value="<?=$usuario->provincia?>">
										</div>
										<div class="form-group">
											<label for="pais" class=" form-control-label">País </label>
											<input type="text" name="pais" id="pais" placeholder="País" class="form-control" value="<?=$usuario->pais?>">
										</div>
										<div class="form-group">
											<label for="email" class=" form-control-label">Correo Electrónico </label>
											<input type="text" name="email" id="email" placeholder="Correo Electrónico" class="form-control" value="<?=$usuario->email?>">
										</div>
										<div class="form-group">
											<label for="web" class=" form-control-label">Web </label>
											<input type="text" name="web" id="web" placeholder="Web" class="form-control" value="<?=$usuario->web?>">
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
	$("#area").select2({
	    placeholder: "Elija Área:",
	    theme: "classic",
	    language: "es"
	});

	$(function () {
		$('input[name="ci"]').on('keyup', function(e) {
			e.preventDefault();
			var url = $(this).data('url-verifica');
			var data = $(this).val();
			var $this = $(this);
			$.ajax({
				url: url,
				type: 'post',
				data: {ci: data},
				success: function(data) {
					//console.log(res);
					if (data.res == 1) {
						$('#resultado_ci').html('<span class="badge badge-danger">CI ya registrado</span>');
						setTimeout(function(){
							$this.val('');
							$('#resultado_ci').html('');
						}, 3000);
					} else {
						$('#resultado_ci').html('<span class="badge badge-success">CI válido</span>');
					}
				}
			})
		})
	})
</script>