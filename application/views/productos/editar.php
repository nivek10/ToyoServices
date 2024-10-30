<?php $this->load->view('includes/header'); ?>   
<?php $this->load->view('includes/menu'); ?>  

		<div class="breadcrumbs">
			<div class="col-sm-4">
				<div class="page-header float-left">
					<div class="page-title">
						<h1>Repuestos </h1>
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
								<strong>Editar Repuesto</strong>
								<a href="<?=base_url('productos/listado')?>" class="btn btn-warning btn-sm pull-right"><i class="fa fa-fw fa-list"></i> Volver al Listado</a>
							</div>
							<form action="<?=base_url('productos/actualizar')?>" method="post" class="card-body card-block form-datos">
								<input type="hidden" name="id" value="<?=$producto->id?>">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="nombre" class="form-control-label">Producto <span class="text-danger">*</span></label>
											<input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto" class="form-control" value="<?=$producto->nombre?>" required>
										</div>
										<div class="form-group">
											<label for="cod_ticket" class="form-control-label">Código de Ticket </label>
											<input type="text" name="cod_ticket" id="cod_ticket" placeholder="Código de Ticket" class="form-control" value="<?=$producto->cod_ticket?>">
										</div>
										<div class="form-group">
											<label for="marca" class="form-control-label">Marca <span class="text-danger">*</span></label>
											<input type="text" name="marca" id="marca" placeholder="Marca del Producto" class="form-control" required value="<?=$producto->marca?>">
										</div>
										<div class="form-group">
											<label for="tipo" class="form-control-label">Tipo </label>
											<input type="text" name="tipo" id="tipo" placeholder="Tipo de Producto" class="form-control" value="<?=$producto->tipo?>">
										</div>
										<div class="form-group">
											<label for="familia" class="form-control-label">Familia </label>
											<input type="text" name="familia" id="familia" placeholder="Familia del Producto" class="form-control" value="<?=$producto->familia?>">
										</div>
										<div class="form-group">
											<label for="procedencia" class="form-control-label">Procedencia </label>
											<input type="text" name="procedencia" id="procedencia" placeholder="Procendecia del Producto" class="form-control" value="<?=$producto->procedencia?>">
										</div>
										<div class="form-group">
											<label for="precio" class="form-control-label">Precio </label>
											<input type="text" name="precio" id="precio" placeholder="Precio del Producto" class="form-control" value="<?=$producto->precio?>">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Imagen</label><br>
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 285px; height: 235px; border: 1px solid #CCC;">
													<img src="<?=base_url('assets/images/repuestos/' . $producto->foto_producto)?>">
												</div>
												<div>
													<span class="btn btn-secondary btn-file">
														<span class="fileinput-new">Seleccionar Imagen</span>
														<span class="fileinput-exists">Cambiar</span>
														<input type="file" name="imagen" value="" data-url-upload="<?=base_url('productos/upload_imagen')?>">
														<input type="hidden" name="imagen_producto" value="<?=$producto->foto_producto?>">
													</span>
													<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Borrar</a>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="descripcion_breve" class="form-control-label">Descripción Breve </label>
											<textarea name="descripcion_breve" id="descripcion_breve" rows="3" placeholder="Descripción Breve" class="form-control"><?=$producto->descripcion_breve?></textarea>
										</div>
										<div class="form-group">
											<label for="descripcion_extensa" class="form-control-label">Descripción Extensa </label>
											<textarea name="descripcion_extensa" id="descripcion_extensa" rows="5" placeholder="Descripción Extensa" class="form-control"><?=$producto->descripcion_extensa?></textarea>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="tipo_vehiculo" class="form-control-label">Tipo de Vehículo </label>
											<input type="text" name="tipo_vehiculo" id="tipo_vehiculo" placeholder="Tipo de Vehículo" class="form-control" value="<?=$producto->tipo_vehiculo?>">
										</div>
										<div class="form-group">
											<label for="marca_vehiculo" class="form-control-label">Marca de Vehículo </label>
											<input type="text" name="marca_vehiculo" id="marca_vehiculo" placeholder="Marca de Vehículo" class="form-control" value="<?=$producto->marca_vehiculo?>">
										</div>
										<div class="form-group">
											<label for="modelo_vehiculo" class="form-control-label">Modelo del Vehículo </label>
											<input type="text" name="modelo_vehiculo" id="modelo_vehiculo" placeholder="Modelo del Vehículo" class="form-control" value="<?=$producto->modelo_vehiculo?>">
										</div>
										<div class="form-group">
											<label for="motor_vehiculo" class="form-control-label">Motor del Vehículo </label>
											<input type="text" name="motor_vehiculo" id="motor_vehiculo" placeholder="Motor del Vehículo" class="form-control" value="<?=$producto->motor_vehiculo?>">
										</div>
										<div class="form-group">
											<label for="color_vehiculo" class="form-control-label">Color del Vehículo </label>
											<input type="text" name="color_vehiculo" id="color_vehiculo" placeholder="Color del Vehículo" class="form-control" value="<?=$producto->color_vehiculo?>">
										</div>
										<div class="form-group">
											<label for="kms" class="form-control-label">KMS </label>
											<input type="text" name="kms" id="kms" placeholder="KMS" class="form-control" value="<?=$producto->kms?>">
										</div>
										<div class="form-group">
											<label for="proveedor" class="form-control-label">Proveedor </label>
											<select name="proveedor" id="proveedor" class="form-control">
												<option value="">--Seleccionar--</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<button type="submit" class="btn btn-success pull-right"><i class="fa fa-fw fa-save"></i> Guardar</button>
										</div>
									</div>
								</div>
								<!-- <div class="form-group">
									<label for="nombre" class="form-control-label">Producto <span class="text-danger">*</span></label>
									<input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto" class="form-control" value="<?=$producto->nombre?>" required>
								</div>
								<div class="form-group">
									<label for="marca" class="form-control-label">Marca <span class="text-danger">*</span></label>
									<input type="text" name="marca" id="marca" placeholder="Marca del Producto" class="form-control" value="<?=$producto->marca?>" required>
								</div>
								<div class="form-group">
									<label for="procedencia" class="form-control-label">Procedencia </label>
									<input type="text" name="procedencia" id="procedencia" placeholder="Procendecia del Producto" class="form-control" value="<?=$producto->procedencia?>">
								</div>
								<div class="form-group">
									<label for="precio" class="form-control-label">Precio </label>
									<input type="text" name="precio" id="precio" placeholder="Precio del Producto" class="form-control" value="<?=$producto->precio?>">
								</div>
								<div class="form-group">
									<label for="tipo" class="form-control-label">Tipo </label>
									<input type="text" name="tipo" id="tipo" placeholder="Tipo de Producto" class="form-control" value="<?=$producto->tipo?>">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success pull-right"><i class="fa fa-fw fa-save"></i> Guardar</button>
								</div> -->
							</form>
						</div>
					</div>

				</div>
			</div><!-- .animated -->
		</div> <!-- .content -->

<?php $this->load->view('includes/footer'); ?> 
