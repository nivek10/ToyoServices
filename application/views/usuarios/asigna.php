<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Usuario </h1>
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
								<strong>Asignar Usuario a Personal: <?=$personal->nombres?> <?=$personal->apellidos?></strong>
								<a href="<?=base_url('usuarios/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<?php //var_dump($usuario) ?>
							<form action="<?=base_url('usuarios/')?><?=(isset($usuario)) ? "actualizar_usr" : "asignar"?>" method="post" class="card-body card-block form-datos">
								<input type="hidden" name="idpersonal" id="idpersonal" value="<?=$personal->id?>">
								<div class="form-group">
									<label for="usuario" class=" form-control-label">Usuario <span class="text-danger">*</span></label>
									<input type="text" name="usuario" id="usuario" placeholder="Usuario" class="form-control" value="<?=(isset($usuario)) ? "$usuario->usuario" : ""?>" required>
								</div>
								<div class="form-group">
									<label for="contrasenia" class=" form-control-label">Contraseña <span class="text-danger">*</span></label>
									<input type="password" name="contrasenia" id="contrasenia" placeholder="Password" class="form-control" value="<?=(isset($usuario)) ? "$usuario->contrasenia" : ""?>" required>
								</div>
								<div class="form-group">
									<label for="privilegios" class=" form-control-label">Privilegios <span class="text-danger">*</span></label>
									<select name="privilegios" id="privilegios" class="form-control" required>
										<option value="">--Seleccionar--</option>
										<option value="1" <?=(isset($usuario) && $usuario->privilegios == 1) ? "selected" : ""?>>Super Usuario</option>
										<option value="2" <?=(isset($usuario) && $usuario->privilegios == 2) ? "selected" : ""?>>Administrador</option>
										<option value="3" <?=(isset($usuario) && $usuario->privilegios == 3) ? "selected" : ""?>>Encargado</option>
									</select>
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
	$("#privilegios").select2({
	    placeholder: "Elija Privilegio:",
	    theme: "classic",
	    language: "es"
	});
</script>