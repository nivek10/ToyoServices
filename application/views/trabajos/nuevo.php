<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Trabajos </h1>
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
								<strong>Nuevo Trabajo</strong>
								<a href="<?=base_url('trabajos/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form action="<?=base_url('trabajos/agregar')?>" method="post" class="card-body card-block form-datos">
								<!--<div class="form-group">
									<label for="automobil" class=" form-control-label">Área <span class="text-danger">*</span></label>
									<select name="area" id="area" class="form-control" required>
										<option value="">--Seleccionar--</option>
										<?php foreach ($areas as $area) : ?>
											<option value="<?=$area->id?>"><?=$area->area?></option>
										<?php endforeach; ?>
									</select>
								</div>-->								
								<div class="form-group">
									<label for="automobil" class=" form-control-label">Automovil <span class="text-danger">*</span></label>
									<select name="automovil" id="automovil" class="form-control" required>
										<option value="">--Seleccionar--</option>
										<?php foreach ($automobiles as $automobil) : ?>
											<option value="<?=$automobil->id?>"><?=$automobil->auto?> --> <?=$automobil->cliente?></option>
										<?php endforeach; ?>
									</select>
								</div>	
								<div class="form-group">
									<label for="encargados" class=" form-control-label">Encargado(s) <span class="text-danger">*</span></label>
									<select name="encargados[]" id="encargados" class="form-control" multiple="true" required>										
										<?php foreach ($encargados as $encargado) : ?>
											<option value="<?=$encargado->id?>"><?=$encargado->encargado?> --> <?=$encargado->area?></option>
										<?php endforeach; ?>
									</select>
								</div>							
								<div class="form-group">
									<label for="detalle" class="form-control-label">Detalle <span class="text-danger">*</span></label>
									<textarea name="detalle" id="detalle" rows="5" placeholder="Detalle" class="form-control"></textarea>
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
    $("#encargados").select2({
	    placeholder: "Elija los encargados:",
	    allowClear: true,
	    maximumSelectionSize: 3,
	    minimunSelectionSize: 1,
	    theme: "classic",
	    language: "es"
	});

	$("#automovil").select2({
	    placeholder: "Elija Vehiculo:",
	    theme: "classic",
	    language: "es"
	});
</script>