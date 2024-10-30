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
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Listado de Trabajos</strong>
                                <a href="<?=base_url('trabajos/nuevo')?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Comenzar Trabajo</a>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered tabla-datos tabla-trabajo" data-url="<?=base_url()?>trabajos/finalizarTrabajo/" data-get="<?=base_url('trabajos/get_trabajos')?>" data-edit="<?=base_url('trabajos/editar')?>" data-remove="<?=base_url('trabajos/borrar')?>" data-encargados="<?=base_url('trabajos/getEncargados')?>">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Automóvil</th>
                                            <th>Detalle</th>
                                            <th>Progreso</th>                                 
                                            <th>Acciones</th>                                 
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
        $('table.tabla-trabajo').DataTable({
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
                url: $("table.tabla-trabajo").data("get"),
                type: "post",
                dataType: "json"
            },
            columns: [
                {"data": "id"},
                {"data": "idauto"},
                {"data": "detalle"},
                {render: function(data, type, row){
                    var fertig = '';
                    if (row.listo != 0) {
                        fertig = '<span class="badge badge-success">Terminado</span>';
                    } else {
                        fertig = '<span class="badge badge-warning">En Progreso</span>';
                    }
                    return fertig;
                }}
            ],
            "columnDefs": [ 
                {
                    "orderable": false, 
                    "targets": [4],
                    render: function(data, type, row){
                        if (row.listo != 0) {
                            return '';
                        } else {
                            return '<a href="'+ $("table.tabla-trabajo").data("finaliza") +'/'+ row.id +'" data-item="'+ row.detalle +'" data-id="' + row.id +'" class="btn btn-sm btn-success btn-finalizar"><i class="fa fa-steam-square"></i></a> ' + '<a href="'+ $("table.tabla-trabajo").data("edit") +'/'+ row.id +'" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>' + ' <button data-url="<?=base_url()?>trabajos/getEncargados/' + row.id +'" type="button" class="btn btn-sm btn-primary btn-encargados" data-toggle="modal" data-target="#modalEncargados"><i class="fa fa-users"></i></button>' + ' <button type="button" class="btn btn-sm btn-danger eliminar-item" data-item="'+ row.detalle +'"  data-id="'+ row.id +'" data-url="<?=base_url()?>trabajos/borrar/'+ row.id +'"><i class="fa fa-times-circle"></i></button>';
                        }
                    }
                }
            ]
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('table.tabla-trabajo tbody').on('click', 'button.btn-encargados', function(){
            var $this = $(this);
            $.ajax({
                url: $(this).data('url'),
                type: 'get',
                success: function(result){    
                    $('table.tblencargados tbody').html("");     
                    result.forEach(function(e,i){
                        var enc = '<tr>';
                        enc += '<td>'+e.id+'</td><td>'+e.persona+'</td>';
                        enc += '</tr>';
                        $('table.tblencargados tbody').append(enc);
                    })                    
                    //console.log(enc, $this);                    
                }
            });
        });
    })

    // Acción Finalizar Trabajo
    $('table.tabla-datos tbody').on('click', 'a.btn-finalizar', function(e){
        e.preventDefault();
        var fila = $(this).parent().parent();
        // console.log(fila.index());
        var url = $('table.tabla-datos').data('url') + $(this).data('id');
        var item = $(this).data('item');
        var datos = {
            "id": $(this).data('id')
        };
        $.confirm({
            icon: 'fa fa-warning',
            title: 'Finalizar',
            content: 'Esta seguro que quiere finalizar el trabajo <b>' + item + '</b>',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            draggable: false,
            buttons: {
                remove: {
                    text: 'Finalizar',
                    btnClass: 'btn-success',
                    action: function() {
                        $.ajax({
                            url: url,
                            type: 'post',
                            data: datos,
                            success: function (data) {
                                if (data.res == 'ok') {
                                    fila.remove();
                                    new PNotify({
                                        title: "Toyo Service",
                                        type: "success",
                                        text: "Operación exitosa, Se finalizó el trabajo satisfactoriamente",
                                        styling: "bootstrap3",
                                        addclass: "stack-modal",
                                    });
                                } else {
                                    new PNotify({
                                        title: "Toyo Service",
                                        type: "error",
                                        text: "Error, No se logro finalizar el trabajo",
                                        styling: "bootstrap3",
                                        addclass: "stack-modal",
                                    });
                                }
                            },
                            error: function(jqXHR, status, error) {
                                new PNotify({
                                    title: "Toyo Service",
                                    type: "error",
                                    text: "Error, No se logro finalizar el trabajo",
                                    styling: "bootstrap3",
                                    addclass: "stack-modal",
                                });
                            }
                        });
                    }
                },
                cancel: {
                    text: 'Cancelar',
                    btnClass: 'btn-danger',
                    action: function() {
                        console.log('cancelado...');
                    }
                }
            }
        });
    }); // Fin de Eliminar
</script>