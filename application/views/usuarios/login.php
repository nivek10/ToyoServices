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
        <link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/themify-icons.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/flag-icon.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/lib/datatable/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/pnotify.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/daterangepicker.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/select2.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-confirm.min.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
        <link rel="stylesheet" href="<?=base_url()?>assets/css/taller.css">
        <style type="text/css">
            body {
                background: url('../assets/imgs/background.jpg');
                background-repeat: no-repeat;
                background-attachment: fixed;
                /*width: 100%;*/
                background-position: top center;
            }
            .login-content {
                margin-top: 180px;
            }
            .login-form {
                background: rgba(0, 0, 0, 0.70);
                /*background: #fafafa;*/
                width: 380px;
                margin: 0 auto;
                padding: 30px 20px;
                padding-top: 45px;
            }
        </style>
    </head>

    <body>
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="<?=base_url('assets/imgs/toyo-service.png')?>" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form action="<?=base_url()?>usuarios/ingresar" method="post" class="form-login">
                        <div class="form-group">
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="contrasenia" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Ingresar</button>
                    </form>
                    <br>
                    <div class="form-group">
                        <p class="text-center">&copy; <?=date('Y')?> Todos los Derechos Reservados. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('includes/footer'); ?>