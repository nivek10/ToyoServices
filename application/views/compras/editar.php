<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Compra </h1>
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
								<strong>Editar Compra</strong>
								<a href="<?=base_url('compras/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form action="<?=base_url('compras/actualizar')?>" method="post" class="card-body card-block form-datos">
                            <input type="hidden" name="idc" value="<?=$compra->id?>">
								<div class="form-group">
									<div class="row">
                                    <div class="col-sm-6">
                                    <label for="producto" class=" form-control-label">Producto <span class="text-danger">*</span></label>
                                    <div class=" typeahead__container">
                                    <input type="text" name="producto" id="producto" placeholder="Ingrese el producto que desea comprar..." class="form-control js-typeahead" autofocus autocomplete="off">
                                    </div>
                                    </div><div class="col-sm-6">
                                    <label for="proveedor" class=" form-control-label">Proveedor <span class="text-danger">*</span></label>
                                    <select name="proveedor" id="proveedor" class="form-control">
                                        <?php foreach($proveedores as $prv): ?>
                                        <option value="<?=$prv->id?>" <?php if($prv->id==$compra->proveedor){ ?>selected<?php } ?>><?=$prv->nombre?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!--<button type="submit" name="agregar" id="agregar" class="btn btn-primary btn-block" onClick="filtrar()"><i class="fa fa-fw fa-save"></i> Modificar Compra</button>-->
                                    </div></div>
								</div>
                                <!--<div class="form-group">
									<label for="area" class=" form-control-label">Fecha <span class="text-danger">*</span></label>
									<input type="text" name="fecha" id="fecha" placeholder="Fecha de Compra" class="form-control" value="<?=$compra->fecha?>" required>
								</div>-->
								<div class="form-group">
									<table class="table table-responsive table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="25%">Descripción</th>
                                                <th width="20%">Marca</th>
                                                <th width="20%">Procedencia</th>
                                                <!--<th>Precio Bs</th>-->
                                                <th width="10%">Unidades</th>
                                                <th width="12%">Costo Bs</th>
                                                <th width="8%" align="center">Borrar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="compras">
                                        <?php $c=1;foreach($compras as $registro):?>
                                        	<tr id='<?=$registro->id?>'>
                                            <td><?=$c?></td>
                                            <td><?=$registro->descripcion?></td>
                                            <td><?=$registro->marca?></td>
                                            <td><?=$registro->procedencia?></td>
                                            <td class='form-inline'><input name='cantidad[]' id='cantidad<?=$registro->id?>' type='number' min="1" value='<?=$registro->cantidad?>' class='form-control' onChange='totales()' onKeyup='totales()'><input name='caa[]' id='caa<?=$registro->id?>' type='hidden' value='<?=$registro->cantidad?>'></td>
                                            <td><input name='precio[]' id='precio<?=$registro->id?>' type='number' value='<?=$registro->total_compra?>' class='form-control' onChange='total()' onKeyup='total()'><input name='id[]' id='id<?=$registro->id?>' type='hidden' value='<?=$registro->id?>' class='id'><input name='idr[]' id='idr<?=$registro->cid?>' type='hidden' value='<?=$registro->cid?>'></td>
                                            <td><a href='#' class='btn btn-danger' onClick='borrar_registro(this,<?=$registro->cid?>)'><i class='fa fa-trash'></i></a></td>
                            				</tr>
                                        <?php $c++;endforeach;?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">TOTAL</th>
                                                <th><input type="text" name="cant" id="cant" value="0" readonly class="form-control"></th>
                                                <th><input type="text" name="compra" id="compra" value="0" readonly class="form-control"></th>
                                                <th><input type="hidden" name="registros" id="registros" value="1" required></th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
<!--<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>-->
<script src="<?=base_url()?>assets/js/jquery.typeahead.js"></script>
<script>
	totales();
	typeof $.typeahead === 'function' && $.typeahead({
		input: ".js-typeahead",
		minLength: 0,
		maxItem: 10,
		maxItemPerGroup: 0,
		order: "asc",
		hint: true,
		//cache: true,
		blurOnTab: false,
		searchOnFocus: true,
		emptyTemplate: 'No se tiene resultados para: {{query}}',
		display: ["id", "descripcion", "marca"],
		correlativeTemplate: true,
		template: '<span class="name">{{descripcion}} | </span>'+'<span class="text-muted">marca: </span>'+'<span class="name">{{marca}}</span>',
		source: { 'url':'<?=base_url();?>compras/productos'  },
		callback: {
			onClick: function (node, a, item, event) {
				//var x = JSON.stringify(item);
				filtrar(item.id);
				//$("#producto").val('');
			},
			onClickAfter: function (node, a, item, event) {
				node.val('');
			}/*,
			onSubmit: function (node, form, items, event) {
				event.preventDefault();
				alert(JSON.stringify(items))
			}*/
		},
		debug: true
	});
	var can = $(".can").length;
	function filtrar(id){ //alert("");
		//if(e.keyCode == 13) {
			/*var id = $("#material").val();
			var c = $("#num").val();*/
			var c = 0;
			$.ajax({
				url:"<?=base_url();?>compras/buscar_producto",
				data:{id:id},
				type:"POST",
				success:function(res){ //alert(res);
					if(res!=0){ //$("#compra").show();
						var pr=0;
						var datos=JSON.parse(res);
						console.log(datos); 
						if($("#registros").val()!=1){
							$("#compras").html('');
						}
						$("#registros").val(1);
						$('input.id').each(function() {
							if($(this).val()==datos['id']){ 
								pr=1;
							}
						}); 
						if(pr==0){
							c++; var num = $('input.id').length+1;
							var id = datos['id']; 
							var num = "<td>"+num+"</td>";
							var mat = "<td>"+datos['descripcion']+"</td>";
							var pro = "<td>"+datos['marca']+"</td>";
							var col = "<td>"+datos['procedencia']+"</td>"; 
							var can = "<td class='form-inline'><input name='cantidad[]' id='cantidad"+datos['id']+"' min='1' type='number' value='1' class='form-control' onChange='totales()' onKeyup='totales()'></td>";
							var com = "<td><input name='precio[]' id='precio"+datos['id']+"' type='number' value='0' class='form-control' onChange='total()' onKeyup='total()'><input name='id[]' id='id"+datos['id']+"' type='hidden' value='"+datos['id']+"' class='id'><input name='idr[]' id='idr"+datos['id']+"' type='hidden' value='0'></td>";
							var opc = "<td><a href='#' class='btn btn-danger' onClick='borrar(this)'><i class='fa fa-trash'></i></a></td>";
							var reg = "<tr id='"+id+"'>"+num+mat+pro+col+can+com+opc+"</tr>"; 
							$("#compras").append(reg);
							$("#num").val(c); 
						} else {
							var can = parseInt($("#cantidad"+datos['id']).val());
							$("#cantidad"+datos['id']).val(can+1);
						}
						totales();
					}
				}
			});
		//}
	}
	function precio(c,pre,prm){
		var tip = $("#tipo"+c).val();
		if(tip==1){
			$("#precio"+c).val(pre); 
		} else {
			$("#precio"+c).val(prm); 
		}
		totales();
	}
	function totales(){
		var total = 0; var cantidad = 0; var precio = 0;
		$("#compras tr").each(function(){ //$("tr#"+i+" td:gt(3) input").val();
			var i = $(this).attr("id");
			var can = $("#cantidad"+i).val();
			if(can<1){
				new PNotify({
					title: "Toyo Service",
					type: "warning",
					text: "Error, Debe ingresar minimamente 1 unidad a comprar",
					styling: "bootstrap3",
					addclass: "stack-modal",
				});
				$("#cantidad"+i).val(1);
				var can = $("#cantidad"+i).val();
			}
			var pre = $("#precio"+i).val();
			cantidad += parseInt(can);
			precio += parseFloat(pre);
			//var total = total + (can*pre);
			$("#venta"+i).val(can*pre);
		});
		$("#cant").val(cantidad);
		$("#compra").val(precio);
	}
	function total(){
		var tot = 0;
		$("#compras tr").each(function(){
			var i = $(this).attr("id");
			var ven = $("#precio"+i).val();
			tot += parseFloat(ven); 
		});
		$("#compra").val(tot);
	}
	function borrar(val){
		$($(val).parents().get(1)).remove();
		totales();
		if($("#registros").val()!=1){
			$("#compras").append('<tr><td colspan="7" align="center">No se Seleccionaron Productos...</td></tr>');
		}
	}
	function borrar_registro(val,id){
		$.confirm({
			icon: 'fa fa-question',
			title: 'Borrar',
			content: 'Esta seguro de borrar el registro de <b><br>' + $(val).parent().parents("tr").find("td").eq(0).html()+' - '+$(val).parent().parents("tr").find("td").eq(1).html() + '</b>',
			theme: 'modern',
			closeIcon: true,
			animation: 'scale',
			type: 'red',
			draggable: false,
			buttons: {
				remove: {
					text: 'Borrar',
					btnClass: 'btn-danger',
					action: function() {
						$.ajax({
							url: '<?=base_url();?>compras/borrar_compra',
							type: 'post',
							data: {id:id},
							success: function (data) {
								if (data.res == 'ok') {
									$($(val).parents().get(1)).remove();
				                    totales();
									new PNotify({
										title: "Toyo Service",
										type: "success",
										text: "Operación exitosa, Se borró el registro satisfactoriamente",
										styling: "bootstrap3",
										addclass: "stack-modal",
									});
								} else {
									new PNotify({
										title: "Toyo Service",
										type: "error",
										text: "Error, No se logro borrar el registro satisfactoriamente",
										styling: "bootstrap3",
										addclass: "stack-modal",
									});
								}
							},
							error: function(jqXHR, status, error) {
								new PNotify({
									title: "Toyo Service",
									type: "error",
									text: "Error, No se logro borrar el registro satisfactoriamente",
									styling: "bootstrap3",
									addclass: "stack-modal",
								});
							}
						});
					}
				},
				cancel: {
					text: 'Cancelar',
					btnClass: 'btn-default',
					action: function() {
						console.log('cancelado...');
					}
				}
			}
		});
	}
</script>