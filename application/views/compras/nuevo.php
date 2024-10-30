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
								<strong>Nueva Compra</strong>
								<a href="<?=base_url('compras/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form name="form" action="<?=base_url('compras/agregar')?>" method="post" class="card-body card-block form-datos">
								<div class="form-group">
									<!--<label for="area" class=" form-control-label">Área <span class="text-danger">*</span></label>-->
									<div class="row">
                                    <div class="col-sm-6">
                                    <label for="producto" class=" form-control-label">Producto <span class="text-danger">*</span></label>
                                    <div class=" typeahead__container">
                                    <input type="text" name="producto" id="producto" placeholder="Ingrese el producto que desea comprar..." class="js-typeahead form-control" autofocus autocomplete="off">
                                    </div>
                                    </div><div class="col-sm-6">
                                    <label for="proveedor" class=" form-control-label">Proveedor <span class="text-danger">*</span></label>
                                    <select name="proveedor" id="proveedor" class="form-control" required>
                                    	<option value="">Seleccione un Proveedor</option>
                                        <?php foreach($proveedores as $prv): ?>
                                        <option value="<?=$prv->id?>"><?=$prv->nombre?></option>
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
                                        	<tr><td colspan="7" align="center">No se Seleccionaron Productos...</td></tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">TOTAL</th>
                                                <th><input type="text" name="cant" id="cant" value="0" readonly class="form-control"></th>
                                                <th><input type="text" name="compra" id="compra" value="0" readonly class="form-control"></th>
                                                <th><input type="hidden" name="registros" id="registros" required><input type="hidden" name="cliente" id="cliente"><input type="hidden" name="obs" id="obs"></th>
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
		maxItem: 8,
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
		source: { 'url':'<?=base_url();?>compras/productos'  },
		callback: {
			onClick: function (node, a, item, event) {
				//var x = JSON.stringify(item);
				filtrar(item.id);
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
							var can = "<td class='form-inline'><input name='cantidad[]' id='cantidad"+datos['id']+"' type='number' min='1' value='1' class='form-control' onChange='totales()' onKeyup='totales()' required></td>";
							var com = "<td><input name='precio[]' id='precio"+datos['id']+"' type='number' value='0' class='form-control' onChange='total()' onKeyup='total()'><input name='id[]' id='id"+datos['id']+"' type='hidden' value='"+datos['id']+"' class='id' required></td>";
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
		$("#registros").val('');
		$('input.id').each(function() {
			$("#registros").val(1);
		}); 
		if($("#registros").val()!=1){
			$("#compras").append('<tr><td colspan="7" align="center">No se Seleccionaron Productos...</td></tr>');
		}
	}
</script>