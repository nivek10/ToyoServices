<?php 
	if($this->session->userdata('login_taller') != true) {
		redirect( base_url() . 'usuarios/login' );
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>TOYO Service</title>

		<link rel="shortcut icon" href="<?=base_url()?>assets/imgs/favicon.ico">

		<link rel="stylesheet" href="<?=base_url()?>assets/css/normalize.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/jasny-bootstrap.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/cs-skin-elastic.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/lib/datatable/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/pnotify.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/daterangepicker.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/select2.min.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-confirm.min.css">
		<!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-select.less"> -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.typeahead.css">
		<link rel="stylesheet" href="<?=base_url()?>assets/css/taller.css">

	</head>

	<body>