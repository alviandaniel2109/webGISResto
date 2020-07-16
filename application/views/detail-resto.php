<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/normalize.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/template.css?v='.md5(date('YmdHis'))) ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/hover-min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/bootstrap-checkbox/awesome-bootstrap-checkbox.min.css') ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/leaflet/leaflet.css') ?>" rel="stylesheet">

  <script type="text/javascript" src="<?php echo base_url('assets/leaflet/leaflet.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

  <style type="text/css">
    #mapid { height: 250px; }
  </style>
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
            <a href="<?php echo base_url('Welcome') ?>" class="hvr-rotate">
              <i class="fa fa-sign-in"></i> Kembali ke Peta
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php foreach($detail_resto as $data){?>
    <div class="container-fluid">
      <div class="row" style="margin-top: 60px">
        <div class="col-lg-6">
          <div class="panel panel-primary">
            <div class="panel-heading text-center">
              Info Restoran
            </div>
            <div class="panel-body">
              <h3><?php echo $data->NAMA?></h3>
              <table class="table table-bordered">
                <tr>
                  <td><b>Jenis</b></td>
                  <td><?php echo $data->JENIS ?></td>
                </tr>
                <tr>
                  <td><b>Jam Operasional</b></td>
                  <td><?php echo $data->JAM_BUKA." s/d ". $data->JAM_TUTUP." WIB" ?></td>
                </tr>
                <tr>
                  <td><b>Kapasitas</b></td>
                  <td><?php echo $data->KAPASITAS." Orang" ?></td>
                </tr>
                <tr>
                  <td><b>Pengunjung Harian</b></td>
                  <td><?php echo $data->PENGUNJUNG_HARIAN." Orang" ?></td>
                </tr>
                <tr>
                  <td><b>Estimasi Harga</b></td>
                  <td><?php echo "Rp. ".$data->HARGA_MINIMAL." s/d Rp. ". $data->HARGA_MAKSIMAL ?></td>
                </tr>
                <tr>
                  <td><b>Kontak</b></td>
                  <td><?php echo $data->CONTACT_PERSON?></td>
                </tr>

                <tr>
                  <td><b>Alamat</b></td>
                  <td><?php echo $data->ALAMAT?></td>
                </tr>
                <tr>
                  <td><b>Deskripsi</b></td>
                  <td><?php echo $data->DESKRIPSI?></td>
                </tr>                        
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="panel panel-primary">
            <div class="panel-heading text-center">
              Lokasi
            </div>
            <div class="panel-body">
              <div id="mapid"></div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-primary">
                <div class="panel-heading text-center">
                  Foto
                </div>
                <div class="panel-body" style="padding-top: 35px;">
                  <!-- Carousel container -->
                  <div id="my-pics" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#my-pics" data-slide-to="0" class="active"></li>
                      <li data-target="#my-pics" data-slide-to="1"></li>
                      <li data-target="#my-pics" data-slide-to="2"></li>
                      <li data-target="#my-pics" data-slide-to="3"></li>
                    </ol>

                    <!-- Content -->
                    <div class="carousel-inner" role="listbox">

                      <!-- Slide 1 -->
                      <div class="item active">
                        <img src="<?php echo base_url("assets/image/{$data->GAMBAR_DEPAN}") ?>" alt="Sunset over beach">
                        <div class="carousel-caption">
                          <h3>Foto Tampak Depan</h3>
                        </div>
                      </div>

                      <!-- Slide 2 -->
                      <div class="item">
                        <img src="<?php echo base_url("assets/image/{$data->GAMBAR_SAMPING}") ?>" alt="Rob Roy Glacier">
                        <div class="carousel-caption">
                          <h3>Foto Tampak Samping</h3>
                        </div>
                      </div>

                      <!-- Slide 3 -->
                      <div class="item">
                        <img src="<?php echo base_url("assets/image/{$data->GAMBAR_JALAN}") ?>" alt="Longtail boats at Phi Phi">
                        <div class="carousel-caption">
                          <h3>Foto Depan Jalan</h3>
                        </div>
                      </div>


                      <div class="item">
                        <img src="<?php echo base_url("assets/image/{$data->GAMBAR_ATAS}") ?>" alt="Longtail boats at Phi Phi">
                        <div class="carousel-caption">
                          <h3>Foto Tampak Atas</h3>
                        </div>
                      </div>

                    </div>

                    <!-- Previous/Next controls -->
                    <a class="left carousel-control" href="#my-pics" role="button" data-slide="prev">
                      <span class="icon-prev" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#my-pics" role="button" data-slide="next">
                      <span class="icon-next" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php }?>

      <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
      crossorigin=""></script>

      <script style="text/javascript">
        <?php 
        foreach($detail_resto as $data){
          ?>
          var mymap = L.map('mapid').setView([<?php echo $data->LATITUDE?>, <?php echo $data->LONGITUDE?>], 14);
          L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}').addTo(mymap);
          var marker = L.marker([<?php echo $data->LATITUDE?>, <?php echo $data->LONGITUDE?>]).addTo(mymap);
        <?php }?>
      </script>
    </body>
    </html>