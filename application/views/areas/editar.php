<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Área </h1>
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
								<strong>Editar Área</strong>
								<a href="<?=base_url('areas/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form action="<?=base_url('areas/actualizar')?>" method="post"  class="card-body card-block form-datos">
								<input type="hidden" name="id" value="<?=$area->id?>">
								<div class="form-group">
									<label for="area" class=" form-control-label">Área <span class="text-danger">*</span></label>
									<input type="text" name="area" id="area" placeholder="Nombre de Área" class="form-control" value="<?=$area->area?>" required>
								</div>
								<div class="form-group">
									<label for="descripcion" class="form-control-label">Descripción </label>
									<textarea name="descripcion" id="descripcion" rows="7" placeholder="Descripción de Área" class="form-control"><?=$area->descripcion?></textarea>
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
