//! name: Taller JS
//! author: Apisoft
//! version: 1.1.0.
//! apisoftware.org

$(function(){

	// AJAX de Formularios (Agregar, Actualizar)
	$('form.form-datos').validator().on('submit', function(e){
		$('button[type="submit"]').prop('disabled', true);
		var form = $(this);
		if (e.isDefaultPrevented()) {
			// Form Invalido
			new PNotify({
				title: "Toyo Service",
				type: "warning",
				text: "Datos Incompletos, revise los campos obligatorios (*)",
				styling: "bootstrap3",
				addclass: "stack-modal",
			});
			$('button[type="submit"]').prop('disabled', false);
		} else {
			// Form Valido
			e.preventDefault();
			
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serializeArray(),
				success: function(data) {
					// console.log(data);
					$('button[type="submit"]').prop('disabled', true);
					if (data.res == 'ok') {
						// agregado exitoso
						form.clearForm();                        
						new PNotify({
							title: "Toyo Service",
							type: "success",
							text: "Datos Correctos, Se guardó el registro satisfactoriamente",
							styling: "bootstrap3",
							addclass: "stack-modal",
						});

					} else if(data.res == 'ok_listar') {
						window.location.href = data.listar;
					} else if(data.res == 'error') {
						// error
						new PNotify({
							title: "Toyo Service",
							type: "error",
							text: "Datos Erroneos, No se guardó el registro satisfactoriamente",
							styling: "bootstrap3",
							addclass: "stack-modal",
						});
					}
					$('button[type="submit"]').prop('disabled', false);
					$('button[type="submit"]').removeAttr('disabled');
				},
				error: function(jqXHR, status, error) {
					var data = jqXHR.responseJSON;
					var res_html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + 
										'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
											'<span aria-hidden="true">&times;</span>' +
										'</button>' +
										data.errors +
									'</div>';
					$('div.error-messages').html(res_html);
					setTimeout(function(){
						$('div.error-messages').html('');
					}, 15000);

					new PNotify({
						title: "Toyo Service",
						type: "error",
						text: "Datos Erroneos, No se guardó el registro satisfactoriamente",
						styling: "bootstrap3",
						addclass: "stack-modal",
					});
				},
				complete: function(){
					// $this.on('click');
					// $this.data('requestRunning', false);
					$('button[type="submit"]').prop('disabled', false);
				}
			});

			return 0;
		}

	}); // Fin de AJAX (Agregar, Actualizar)

	// Acción de Eliminar Items
	$('table.tabla-datos tbody').on('click', 'button.eliminar-item', function(){
		var fila = $(this).parent().parent();
		// console.log(fila.index());
		var url = $('table.tabla-datos').data('remove');
		var item = $(this).data('item');
		var datos = {
			"id"    : $(this).data('id')
		};
		$.confirm({
			icon: 'fa fa-question',
			title: 'Borrar',
			content: 'Esta seguro de borrar el registro de <b>' + item + '</b>',
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
							url: url,
							type: 'post',
							data: datos,
							success: function (data) {
								if (data.res == 'ok') {
									fila.remove();
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
	}); // Fin de Eliminar

	
	// Login
	$('form.form-login').validator().on('submit', function(e){
		$('button[type="submit"]').attr('disabled', 'disabled');
		//var fila = $(this).parent().parent();
		var $this = $(this);
		if(e.isDefaultPrevented()){
			// Form Invalido
			new PNotify({
				title: "Toyo Service",
				type: "warning",
				text: "Datos Incompletos",
				styling: "bootstrap3",
				addclass: "stack-modal",
			});
		}else{
			// Form Valido
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				type: $(this).attr('method'),
				data: $(this).serializeArray(),
				success: function(data) {
					console.log(data);
					if (data.resp == 'login') {
						// agregado exitoso
						$this.clearForm();                        
						window.location.href = data.url;
						// new PNotify({
						// 	title: "Ventapi",
						// 	type: "success",
						// 	text: "Datos Correctos, Se guardó el registro satisfactoriamente",
						// 	styling: 'bootstrap3'
						// });
					} else if(data.resp == 'error') {
						// error
						new PNotify({
							title: "Toyo Service",
							type: "error",
							text: "Datos Erroneos",
							styling: "bootstrap3",
							addclass: "stack-modal",
						});
					}
				},
				error: function(jqXHR, status, error) {
					var data = jqXHR.responseJSON;
					var res_html = '<div class="alert alert-danger alert-dismissible fade in" role="alert">' + 
										'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
											'<span aria-hidden="true">&times;</span>' +
										'</button>' +
										data.errors +
									'</div>';
					$('div.error-messages').html(res_html);

					new PNotify({
						title: "Toyo Service",
						type: "error",
						text: "Datos Erroneos, No se guardó el registro satisfactoriamente",
						styling: "bootstrap3",
						addclass: "stack-modal",
					});
				}
			});
			$('button[type="submit"]').removeAttr('disabled');
			return 0;
		}
		$('button[type="submit"]').removeAttr('disabled');
	}); 

	


    // upload de imagenes
    $('input.upload-imagen').on('change', function(){
        var img = new FormData($('form.form-datos')[0]);
        var url = $('form.form-datos').data('upload');

        $.ajax({
            url: url,
            type: 'post',
            data: img,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data.foto);

                if (data.res == 'ok') {
                	var foto = data.foto;
                    $('input[name="imagen"]').val(foto.file_name);
                } else {
                    $('input[name="imagen"]').val('');
                }
            },
            error: function (jqXHR, status, error){
                //console.log(jqXHR);
            }
        });
    });

    // reportes
    $('form.form-reportes').validator().on('submit', function(e){
		$('button[type="submit"]').prop('disabled', true);
		var form = $(this);
		if (e.isDefaultPrevented()) {
			// Form Invalido
			new PNotify({
				title: "Toyo Service",
				type: "warning",
				text: "Datos Incompletos, revise los campos obligatorios (*)",
				styling: "bootstrap3",
				addclass: "stack-modal",
			});
			$('button[type="submit"]').prop('disabled', false);
		} else {
			// Form Valido
			e.preventDefault();
			
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serializeArray(),
				success: function(data) {
					// console.log(data);
					$('div.show-report').html(data);
				},
				error: function(jqXHR, status, error) {
					var data = jqXHR.responseJSON;
					var res_html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' + 
										'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
											'<span aria-hidden="true">&times;</span>' +
										'</button>' +
										data.errors +
									'</div>';
					$('div.error-messages').html(res_html);
					setTimeout(function(){
						$('div.error-messages').html('');
					}, 15000);

					new PNotify({
						title: "Toyo Service",
						type: "error",
						text: "Datos Erroneos, No se guardó el registro satisfactoriamente",
						styling: "bootstrap3",
						addclass: "stack-modal",
					});
				},
				complete: function(){
					// $this.on('click');
					// $this.data('requestRunning', false);
					$('button[type="submit"]').prop('disabled', false);
				}
			});

			return 0;
		}

	}); // Fin de Reportes

    // Select 2
	$('select.select2').select2();

	$('[data-toggle="tooltip"]').tooltip();

});



$.fn.clearForm = function() {
	return this.each(function() {
		var type = this.type, tag = this.tagName.toLowerCase();
		if (tag == 'form')
			return $(':input',this).clearForm();
		if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'number' || type == 'email' || type == 'tel')
			this.value = '';
		else if (type == 'checkbox' || type == 'radio')
			this.checked = false;
		else if (tag == 'select')
			this.selectedIndex = -1;
	});
};