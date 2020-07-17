<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/hover-min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/normalize.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/template.css?v='.md5(date('YmdHis'))) ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-checkbox/awesome-bootstrap-checkbox.min.css') ?>" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="z-index: 100">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url() ?>">WEBGIS RESTO MALANG</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-button navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo base_url('Welcome/home') ?>" class="hvr-rotate">
                            <i class="fa fa-sign-in"></i> Kembali ke Home
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="text-center py-0" style="transform: translateY(10%);">
        <div class="container">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <!-- <img class="d-block img-fluid mx-auto" src="<?= base_url('assets/images/icon.png') ?>" width="150"> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-12 col-md-4">
                    <h1 class="mb-1 text-white">WEBGIS</h1>
                    <p class="text-white">Restoran dan Wisata Kuliner Kota Malang</p>
                    <?php if ($this->session->flashdata('message')){ ?>
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p class="mb-0"><?= $this->session->flashdata('message') ?></p>
                        </div>
                    <?php } ?>
                    <form action="<?php echo site_url('User/auth') ?>" method="post">
                        <div class="form-group"> 
                            <input type="text" name="user" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="pass" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-block text-white">LOGIN</button>
                    </form>
                    <p class="pt-3 text-white">All Rights Reserved © STIKI 2020</p>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>

</html>