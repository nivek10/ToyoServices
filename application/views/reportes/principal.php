<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Reportes </h1>
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
						<div class="card">
							<div class="card-header">
								<strong class="card-title">Generar Reportes</strong>
							</div>
							<div class="card-body">
								<form action="<?=base_url('reportes/generar_pdf')?>" method="post" class="row form-reportes">
									<div class="col-sm-8">
										<select name="tipo_reporte" id="tipo_reporte" class="form-control" required>
											<option value="">-- Tipo de Reporte (*) --</option>
											<option value="clientes">Reporte de Clientes</option>
											<option value="proveedores">Reporte de Proveedores</option>
											<option value="personal">Reporte del Personal</option>
										</select>
									</div>
									<div class="col-sm-4">
										<button type="submit" class="btn btn-primary">Generar Reporte</button>
									</div>
								</form>
								<div class="row">
									<div class="col-12" style="margin-top: 15px;">
										<small><em>* Hojas Tamaño Carta</em></small>
										<div class="show-report"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div><!-- .animated -->
		</div> <!-- .content -->

<?php $this->load->view('includes/footer'); ?> 

		<!-- Modal -->
		<div class="modal fade" id="modalEncargados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Encargados del Trabajo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-striped table-bordered tblencargados">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>                               
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

<?php if ($this->session->flashdata('exito')) : ?>
	<script type="text/javascript">
		new PNotify({
			title: "Toyo Service",
			type: "success",
			text: "Datos Correctos, Se actualizó el registro satisfactoriamente",
			styling: "bootstrap3",
			addclass: "stack-modal",
		});
	</script>
<?php endif; ?>

<script type="text/javascript">
	$(function(){
	});
</script>