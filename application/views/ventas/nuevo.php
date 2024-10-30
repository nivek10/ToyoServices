<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Venta </h1>
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
								<strong>Nueva Venta</strong>
								<a href="<?=base_url('ventas/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form name="form" action="<?=base_url('ventas/agregar')?>" method="post" class="card-body card-block form-datos">
								<div class="form-group">
									<!--<label for="area" class=" form-control-label">Área <span class="text-danger">*</span></label>-->
									<div class="row">
                                    <div class="col-sm-6">
                                    <label for="producto" class=" form-control-label">Producto <span class="text-danger">*</span></label>
                                    <div class=" typeahead__container">
                                    <input type="text" name="producto" id="producto" placeholder="Ingrese el producto que desea vender..." class="js-typeahead form-control" autofocus autocomplete="off">
                                    </div>
                                    </div><div class="col-sm-6">
                                    <label for="cliente" class=" form-control-label">Cliente <span class="text-danger">*</span></label>
                                    <select name="cliente" id="cliente" class="form-control" required>
                                    	<option value="">Seleccione un Cliente</option>
                                        <?php foreach($clientes as $prv): ?>
                                        <option value="<?=$prv->id?>"><?=$prv->nombres." ".$prv->apellidos?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!--<button type="submit" name="agregar" id="agregar" class="btn btn-primary btn-block" onClick="filtrar()"><i class="fa fa-fw fa-save"></i> Registrar Compra</button>-->
                                    </div></div>
								</div>
								<div class="form-group">
									<table class="table table-responsive table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%">#</th>
                                                <th width="17%">Descripción</th>
                                                <th width="15%">Marca</th>
                                                <th width="15%">Procedencia</th>
                                                <th width="8%">Stock</th>
                                                <th width="10%">Unidades</th>
                                                <th width="10%">Precio Bs</th>
                                                <th width="12%">Total Bs</th>
                                                <th width="8%" align="center">Borrar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ventas">
                                        	<tr><td colspan="8" align="center">No se Seleccionaron Productos...</td></tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">TOTAL</th>
                                                <th><input type="text" name="cant" id="cant" value="0" readonly class="form-control"></th>
                                                <th><input type="text" name="venta" id="venta" value="0" readonly class="form-control"></th>
                                                <th><input type="text" name="total" id="total" value="0" readonly class="form-control"></th>
                                                <th><input type="hidden" name="registros" id="registros" value="0" required></th>
                                            </tr>
                                        </tfoot>
                                    </table>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success pull-right"><i class="fa fa-fw fa-save"></i> Guardar</button>
								</div>
							</form>
                             <!--<form>
                                <div class="typeahead__container">
                                    <div class="typeahead__field">
                        
                                    <span class="typeahead__query">
                                        <input class="js-typeahead"
                                               name="q"
                                               type="search"
                                               autofocus
                                               autocomplete="off">
                                    </span>
                                    <span class="typeahead__button">
                                        <button type="submit">
                                            <span class="typeahead__search-icon"></span>
                                        </button>
                                    </span>
                        
                                    </div>
                                </div>
                            </form>-->
						</div>
					</div>

				</div>
			</div><!-- .animated -->
		</div> <!-- .content -->

<?php $this->load->view('includes/footer'); ?> 
<!--<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>-->
<script src="<?=base_url()?>assets/js/jquery.typeahead.js"></script>
<script>
	typeof $.typeahead === 'function' && $.typeahead({
		input: ".js-typeahead",
		minLength: 0,
		maxItem: 10,
		maxItemPerGroup: 0,
		order: "asc",
		hint: true,
		//cache: true,
		blurOnTab: false,
		searchOnFocus: false,
		emptyTemplate: 'No se tiene resultados para: {{query}}',
		display: ["id", "descripcion", "marca"],
		correlativeTemplate: true,
		template: '<span class="name">{{descripcion}} | </span>'+'<span class="text-muted">marca: </span>'+'<span class="name">{{marca}}</span>',
		source: { 'url':'<?=base_url();?>ventas/productos'  },
		callback: {
			onClick: function (node, a, item, event) {
				//var x = JSON.stringify(item);
				if(item.unidades>0){
					filtrar(item.id);
				}
			},
			onClickAfter: function (node, a, item, event) {
				if(item.unidades>0){
					node.val('');
				}else{
					new PNotify({
						title: "Ventapi",
						type: "warning",
						text: "Stock insuficiente, El producto seleccionado no tiene unidades en existencia",
						styling: "bootstrap3",
						addclass: "stack-modal",
					});
				}
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
				url:"<?=base_url();?>ventas/buscar_producto",
				data:{id:id},
				type:"POST",
				success:function(res){ //alert(res);
					if(res!=0){ //$("#compra").show();
						var pr=0;
						var datos=JSON.parse(res);
						console.log(datos); 
						if($("#registros").val()!=1){
							$("#ventas").html('');
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
							var sto = "<td><input name='stock' id='stock"+datos['id']+"' type='text' value='"+datos['unidades']+"' class='form-control' readonly><input name='sta' id='sta"+datos['id']+"' type='hidden' value='"+datos['unidades']+"'></td>"; 
							var can = "<td><input name='cantidad[]' id='cantidad"+datos['id']+"' type='number' value='1' min='1' class='form-control' onChange='totales()' onKeyup='totales()'><input name='caa[]' id='caa"+datos['id']+"' type='hidden' value='1'></td>";
							var com = "<td><input name='precio[]' id='precio"+datos['id']+"' type='number' value='"+datos['precio']+"' class='form-control' onChange='totales()' onKeyup='totales()'></td>";
							var tot = "<td><input name='venta[]' id='venta"+datos['id']+"' type='number' value='"+datos['precio']+"' class='form-control' onChange='total()' onKeyup='total()'><input name='id[]' id='id"+datos['id']+"' type='hidden' value='"+datos['id']+"' class='id' required><input name='idr[]' id='idr"+datos['id']+"' type='hidden' value='0'></td>";
							var opc = "<td><a href='#' class='btn btn-danger' onClick='borrar(this)'><i class='fa fa-trash'></i></a></td>";
							var reg = "<tr id='"+id+"'>"+num+mat+pro+col+sto+can+com+tot+opc+"</tr>"; 
							$("#ventas").append(reg);
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
		$("#ventas tr").each(function(){ //$("tr#"+i+" td:gt(3) input").val();
			var i = $(this).attr("id"); 
			var sto = $("#stock"+i).val();
			var sta = $("#sta"+i).val();
			var caa = $("#caa"+i).val();
			var can = $("#cantidad"+i).val();
			if(can<1){
				new PNotify({
					title: "Toyo Service",
					type: "warning",
					text: "Error, Debe ingresar minimamente 1 unidad a vender",
					styling: "bootstrap3",
					addclass: "stack-modal",
				});
				$("#cantidad"+i).val(1);
				var can = $("#cantidad"+i).val();
			}
			if($("#cantidad"+i).val()>=caa){
				stock = parseInt(sta)-parseInt($("#cantidad"+i).val());
			} else {
				stock = parseInt(sta)+parseInt($("#cantidad"+i).val());
			}
			if((stock)<0){
				//alert("No se tienen unidades disponibles");
				new PNotify({
					title: "Toyo Service",
					type: "warning",
					text: "Error, El valor maximo a vender es de "+(parseInt(sta)),
					styling: "bootstrap3",
					addclass: "stack-modal",
				});
				$("#cantidad"+i).val(parseInt(sta));
				var can = $("#cantidad"+i).val();
				stock = parseInt(sta)-parseInt($("#cantidad"+i).val());
			}
			var pre = $("#precio"+i).val();
			$("#stock"+i).val(stock);
			$("#venta"+i).val(can*pre);
			var tot = $("#venta"+i).val();
			cantidad += parseInt(can);
			precio += parseFloat(pre);
			total += parseFloat(tot);
		});
		$("#cant").val(cantidad);
		$("#venta").val(precio);
		$("#total").val(total);
	}
	/*function totales(){
		var total = 0; var cantidad = 0; var precio = 0; var total = 0;
		$("#ventas tr").each(function(){ 
			var i = $(this).attr("id");
			var can = $("#cantidad"+i).val();
			var pre = $("#precio"+i).val();
			$("#venta"+i).val(can*pre);
			var tot = $("#venta"+i).val();
			cantidad += parseInt(can);
			precio += parseFloat(pre);
			total += parseFloat(tot);
		});
		$("#cant").val(cantidad);
		$("#venta").val(precio);
		$("#total").val(total);
	}*/
	/*function total(){
		var tot = 0;
		$("#ventas tr").each(function(){
			var i = $(this).attr("id");
			var ven = $("#precio"+i).val();
			tot += parseFloat(ven); 
		});
		$("#compra").val(tot);
	}*/
	function borrar(val){
		$($(val).parents().get(1)).remove();
		totales();
		$("#registros").val('');
		$('input.id').each(function() {
			$("#registros").val(1);
		}); 
		if($("#registros").val()!=1){
			$("#ventas").append('<tr><td colspan="7" align="center">No se Seleccionaron Productos...</td></tr>');
		}
	}
</script>