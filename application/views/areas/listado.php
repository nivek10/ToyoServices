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
						<div class="card">
							<div class="card-header">
								<strong class="card-title">Listado de Áreas</strong>
								<a href="<?=base_url('areas/nuevo')?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Nueva Área</a>
							</div>
							<div class="card-body">
								<table id="bootstrap-data-table" class="table table-striped table-bordered tabla-datos tabla-areas" data-get="<?=base_url('areas/get_areas')?>" data-edit="<?=base_url('areas/editar')?>" data-remove="<?=base_url('areas/borrar')?>">
									<thead>
										<tr>
											<th>Código</th>
											<th>Área</th>
											<th>Descripción</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div><!-- .animated -->
		</div> <!-- .content -->

<?php $this->load->view('includes/footer'); ?> 

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
		$('table.tabla-areas').DataTable({
			language: {
				processing: "Procesando...",
				lengthMenu: "Mostrar _MENU_ filas por página",
				zeroRecords: "No hay Registros",
				emptyTable:     "Ningún dato disponible en esta tabla",
				info: "Mostrando página _PAGE_ de _PAGES_",
				infoEmpty: "Sin Registros",
				infoFiltered:   "(filtrado de un total de _MAX_ registros)",
				search: "Buscar",
				loadingRecords: "Cargando...",
				paginate: {
					first:    "Primero",
					last:     "Último",
					previous: "Anterior",
					next: "Siguiente"
				}
			},
			// scrollX: true,
			responsive: true,
			paging: true,
			info: true,
			filter: true,
			stateSave: true,

			proccessing: true,
			serverSide: true,

			ajax: {
				url: $("table.tabla-areas").data("get"),
				type: "post",
				dataType: "json"
			},
			columns: [
				{"data": "id"},
				{"data": "area"},
				{"data": "descripcion"},
			],
			columnDefs: [
				{"orderable": false, 
				 "targets": [3],
				 render: function(data, type, row){
					return '<a href="'+ $("table.tabla-areas").data("edit") +'/'+ row.id +'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>' +
							' <button type="button" class="btn btn-sm btn-danger eliminar-item" data-id="'+ row.id +'" data-item="'+ row.area +'"><i class="fa fa-times"></i></button>';
				}
				}
			]
		});
	});
</script>
