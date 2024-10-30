<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Trabajo </h1>
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
								<strong>Editar Trabajo no Finalizado</strong>
								<a href="<?=base_url('trabajos/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>							
							<form action="<?=base_url('trabajos/actualizar')?>" method="post" class="card-body card-block form-datos">
								<input type="hidden" name="trabajo_id" id="trabajo_id" value="<?=$trabajo->id?>">

								<div class="form-group">
									<label for="autos" class=" form-control-label">Automóvil <span class="text-danger">*</span></label>
									<select name="automobil" id="automobil" class="form-control" required>
										<option value="">--Seleccionar--</option>
										<?php foreach ($autos as $auto) : ?>
											<option value="<?=$auto->id?>"><?=$auto->auto?> --> <?=$auto->cliente?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="detalle" class="form-control-label">Detalle </label>
									<textarea name="detalle" id="detalle" rows="7" placeholder="Detalle" class="form-control"><?=$trabajo->detalle?></textarea>
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
