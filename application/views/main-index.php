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
	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.sticky.min.js') ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

	<style type="text/css">
		body {overflow-y: hidden; }
		#mapid { height: 600px; }
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
						<?php if($this->session->has_userdata('admin_login') == FALSE) : ?>
							<a data-toggle="modal" href='<?php echo base_url('User/gotoLogin') ?>' class="hvr-rotate">
								<i class="fa fa-sign-in"></i> Login
							</a>
							<?php else : ?>
								<a href="<?php echo base_url('admin') ?>" class="hvr-rotate">
									<i class="fa fa-sign-in"></i> Kembali ke Administrator
								</a>
							<?php endif; ?>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?php echo base_url('Welcome/home') ?>" class="hvr-underline-reveal">Home</a></li>
						<li><a href="<?php echo base_url() ?>" class="hvr-underline-reveal">Map</a></li>
						<li><a  data-toggle="modal" href='#modal-about' class="hvr-underline-reveal">About</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid top20px">
			<div class="row">
				<div class="col-md-2" style="margin-top: 100px; overflow-y: auto; overflow-x: hidden; height: 500px;">
					<?php echo form_open() ?>
					<div class="form-group">
						<label for="">Cari :</label>
						<?php

						$data = array(
							'name'  => 'keyword',
							'id'    => 'keyword',
							'placeholder' => 'Masukkan Kata Kunci',
							'value' => set_value('keyword'),
							'class' => 'form-control text-dark',
							'style' => 'font-size: 14px;'
						);

						echo form_input($data);
						?>
					</div>
					<?php if($this->db->get('jenis')->num_rows()) : ?>
					<div class="form-group">
						<label>Jenis Resto :</label>
						<?php foreach($this->db->get('jenis')->result() as $row) {
							echo "<br>";
							$data = array(
								'name'	=> 'jenis',
								'value'	=> $row->ID_JENIS
							);
							echo form_radio($data);
							echo $row->JENIS;
						}
						?>
					</div>
				<?php endif; ?>
				<div class="form-group">
					<label for="harga">Estimasi Harga :</label>
					<?php
					$harga = array(
						"" => "- Semua Harga -",
						"1" => "<= Rp. 10.000",
						"2" => "Rp. 10.000 s/d Rp. 20.000",
						"3" => "Rp. 20.000 s/d Rp. 50.000",
						"4" => ">= Rp. 50.000"
					);

					echo form_dropdown('harga', $harga, set_value('harga'), 'class="form-control" id="harga" style="font-size:14px;"');
					?>
				</div>
				<div class="form-group">
					<label for="kapasitas">Kapasitas :</label>
					<?php
					$kapasitas = array(
						"" => "- Pilih -",
						"1" => "<= 50 orang",
						"2" => "50 s/d 100 orang",
						"3" => "100 s/d 200 orang",
						"4" => ">= 200 orang"
					);

					echo form_dropdown('kapasitas', $kapasitas, set_value('kapasitas'), 'class="form-control" id="kapasitas" style="font-size:14px;"');
					?>
				</div>
				<div class="form-group">
					<label for="waktu">Jam Buka :</label>
					<?php
					$waktu = array(
						"" => "- Pilih -",
						"1" => "PAGI",
						"2" => "SIANG",
						"3" => "MALAM ",
						"4" => "24 JAM "
					);

					echo form_dropdown('waktu', $waktu, set_value('waktu'), 'class="form-control" id="waktu" style="font-size:14px;"');
					?>
				</div>
				<div class="form-group">
					<label for="jarak">Jarak dari Pusat Kota :</label>
					<?php
					$jarak = array(
						"" => "- Pilih -",
						"1" => "<= 2 Km",
						"2" => "2 s/d 5 Km",
						"3" => "5 s/d 10 Km",
						"4" => ">= 10 Km"
					);

					echo form_dropdown('jarak', $jarak, set_value('jarak'), 'class="form-control" id="jarak" style="font-size:14px;"');
					?>
				</div>
				<div class="form-group col-md-6">
					<button type="submit" name="murah" class="btn btn-success"></i> Termurah </button>
				</div>
				<div class="form-group col-md-6">
					<button type="submit" name="pop" class="btn btn-warning"></i> Terpopuler </button>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Cari Lokasi</button>
				</div>
			</div>
			<div class="col-md-10" style="margin-top: 59px;">
				<div id="mapid"></div>
			</div>
		</div>
	</div>
	<footer class="page-break-top">
		<div class="footer-divider"></div>
		<div class="container">
			<div class="row">
				<div class="clearfix page-break-top"></div>
				<div class="hr5"></div>
				<div class="col-md-12">
					<p class="text-center"><small>Copyrights <strong>s4ishoku</strong> &copy; 2020 <a target="_blank" href="http://s4ishoku.site">[http://s4ishoku.site]</a>. All Right Reserved</small></p>
				</div>
			</div>
		</div>
	</footer>
	<!-- <div class="modal fade" id="modalLogin">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Login</h4>
				</div>
				<form action="<?php echo base_url('user/auth') ?>" method="POST" role="form">
					<div class="modal-body">
						<div class="form-group">
							<label for="">Username / E-Mail :</label>
							<input type="text" class="form-control" name="user" required>
						</div>
						<div class="form-group">
							<label for="">Password :</label>
							<input type="password" class="form-control" name="pass" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div> -->
	<div class="modal fade" id="modal-alert">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><i class="fa fa-warning"></i> Perhatian!</h4>
					<p><?php echo $this->session->flashdata('message') ?></p>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-about" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tentang Aplikasi</h4>
				</div>
				<div class="modal-body">
					<p>Web GIS Restoran adalah GIS yang dibangun dengan PHP (Framework Codeigniter 3), Google Maps V3 API dan Twitter bootstrap, Dibuat untuk memenuhi tugas Mata Kuliah <i>Sistem Informasi Geografis</i> STIKI Malang, Dosen (<i>Subari, S.Kom., M.Kom</i>).</p>
					<table class="table table-striped">
						<tbody>
							<tr>
								<td>Nama Pengembang</td>
								<td width="50" class="text-center">:</td>
								<td>Nanda Bima Mahendra; Muhammad Reyhan Firnas A; Mahsa Savira Berlianti P</td>
							</tr>
							<tr>
								<td>Program Studi</td>
								<td width="50" class="text-center">:</td>
								<td>Teknik Informatika</td>
							</tr>
							<tr>
								<td>Semester</td>
								<td width="50" class="text-center">:</td>
								<td>VI</td>
							</tr>
							<tr>
								<td>NRP</td>
								<td width="50" class="text-center">:</td>
								<td>171111109; 171111079; 171111078</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td width="50" class="text-center">:</td>
								<td><a target="_blank" href="http://maps.google.com/?q=STIKI Malang">Jl. Raya Tidar No.100, Malang, Jawa Timur, Indonesia</a></td>
							</tr>
						</tbody>
					</table>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		function detail_hotel(param) 
		{
			$('div#modal-id').modal('show');
		}
		$(document).ready(function() {
			<?php if($this->session->flashdata('message')) : ?>
				$('div#modal-alert').modal('show');
			<?php endif; ?>
		});
	</script>
	<script>
		var cafe, qsr, bakery, eskrim, pubs, cdr;
		var cafe_layer = new L.layerGroup();
		var qsr_layer = new L.layerGroup();
		var bakery_layer = new L.layerGroup();
		var eskrim_layer = new L.layerGroup();
		var pubs_layer = new L.layerGroup();
		var cdr_layer = new L.layerGroup();
		var all_layer = new L.layerGroup();

		var map;

		var icon_cafe = L.icon({
			iconUrl: '<?php echo base_url() ?>assets/icon/marker-cafe.png',
			iconSize: [35 , 45],
		});

		<?php 
		foreach($peta_cafe as $data){
			?>
			var cafe = L.marker([<?php echo $data->LATITUDE ?>, <?php echo $data->LONGITUDE ?>], {
				icon: icon_cafe
			})
			.bindPopup('<h4><?php echo $data->NAMA ?></h4><img width=200 src="<?php echo base_url() . 'assets/image/' . $data->GAMBAR_DEPAN ?>"/><p>Jam Buka : <?php echo $data->JAM_BUKA." - ".$data->JAM_TUTUP ?></p><p>Alamat : <?php echo $data->ALAMAT ?></p><p>Kontak : <?php echo $data->CONTACT_PERSON ?></p><p><a href="<?php echo base_url('Welcome/detailResto/'.$data->ID_RESTO) ?>" class="btn btn-default text-center">Lihat Detail</a></p>')
			.openPopup();
			cafe_layer.addLayer(cafe);

		<?php } ?>

		var icon_qsr = L.icon({
			iconUrl: '<?php echo base_url() ?>assets/icon/marker-fastfood.png',
			iconSize: [35 , 45],
		});

		<?php 
		foreach($peta_qsr as $data){
			?>
			var qsr = L.marker([<?php echo $data->LATITUDE ?>, <?php echo $data->LONGITUDE ?>], {
				icon: icon_qsr
			})
			.bindPopup('<h4><?php echo $data->NAMA ?></h4><img width=200 src="<?php echo base_url() . 'assets/image/' . $data->GAMBAR_DEPAN ?>"/><p>Jam Buka : <?php echo $data->JAM_BUKA." - ".$data->JAM_TUTUP ?></p><p>Alamat : <?php echo $data->ALAMAT ?></p><p>Kontak : <?php echo $data->CONTACT_PERSON ?></p><p><a href="<?php echo base_url('Welcome/detailResto/'.$data->ID_RESTO) ?>" class="btn btn-default text-center">Lihat Detail</a></p>')
			.openPopup();
			qsr_layer.addLayer(qsr);

		<?php } ?>

		var icon_bakery = L.icon({
			iconUrl: '<?php echo base_url() ?>assets/icon/marker-bakery.png',
			iconSize: [35 , 45],
		});

		<?php 
		foreach($peta_bakery as $data){
			?>
			var bakery = L.marker([<?php echo $data->LATITUDE ?>, <?php echo $data->LONGITUDE ?>], {
				icon: icon_bakery
			})
			.bindPopup('<h4><?php echo $data->NAMA ?></h4><img width=200 src="<?php echo base_url() . 'assets/image/' . $data->GAMBAR_DEPAN ?>"/><p>Jam Buka : <?php echo $data->JAM_BUKA." - ".$data->JAM_TUTUP ?></p><p>Alamat : <?php echo $data->ALAMAT ?></p><p>Kontak : <?php echo $data->CONTACT_PERSON ?></p><p><a href="<?php echo base_url('Welcome/detailResto/'.$data->ID_RESTO) ?>" class="btn btn-default text-center">Lihat Detail</a></p>')
			.openPopup();
			bakery_layer.addLayer(bakery);

		<?php } ?>

		var icon_eskrim = L.icon({
			iconUrl: '<?php echo base_url() ?>assets/icon/marker-icecream.png',
			iconSize: [35 , 45],
		});

		<?php 
		foreach($peta_eskrim as $data){
			?>
			var eskrim = L.marker([<?php echo $data->LATITUDE ?>, <?php echo $data->LONGITUDE ?>], {
				icon: icon_eskrim
			})
			.bindPopup('<h4><?php echo $data->NAMA ?></h4><img width=200 src="<?php echo base_url() . 'assets/image/' . $data->GAMBAR_DEPAN ?>"/><p>Jam Buka : <?php echo $data->JAM_BUKA." - ".$data->JAM_TUTUP ?></p><p>Alamat : <?php echo $data->ALAMAT ?></p><p>Kontak : <?php echo $data->CONTACT_PERSON ?></p><p><a href="<?php echo base_url('Welcome/detailResto/'.$data->ID_RESTO) ?>" class="btn btn-default text-center">Lihat Detail</a></p>')
			.openPopup();
			eskrim_layer.addLayer(eskrim);

		<?php } ?>

		var icon_pubs = L.icon({
			iconUrl: '<?php echo base_url() ?>assets/icon/marker-bar.png',
			iconSize: [35 , 45],
		});

		<?php 
		foreach($peta_pubs as $data){
			?>
			var pubs = L.marker([<?php echo $data->LATITUDE ?>, <?php echo $data->LONGITUDE ?>], {
				icon: icon_pubs
			})
			.bindPopup('<h4><?php echo $data->NAMA ?></h4><img width=200 src="<?php echo base_url() . 'assets/image/' . $data->GAMBAR_DEPAN ?>"/><p>Jam Buka : <?php echo $data->JAM_BUKA." - ".$data->JAM_TUTUP ?></p><p>Alamat : <?php echo $data->ALAMAT ?></p><p>Kontak : <?php echo $data->CONTACT_PERSON ?></p><p><a href="<?php echo base_url('Welcome/detailResto/'.$data->ID_RESTO) ?>" class="btn btn-default text-center">Lihat Detail</a></p>')
			.openPopup();
			pubs_layer.addLayer(pubs);

		<?php } ?>

		var icon_cdr = L.icon({
			iconUrl: '<?php echo base_url() ?>assets/icon/marker-restaurant.png',
			iconSize: [35 , 45],
		});

		<?php 
		foreach($peta_cdr as $data){
			?>
			var cdr = L.marker([<?php echo $data->LATITUDE ?>, <?php echo $data->LONGITUDE ?>], {
				icon: icon_cdr
			})
			.bindPopup('<h4><?php echo $data->NAMA ?></h4><img width=200 src="<?php echo base_url() . 'assets/image/' . $data->GAMBAR_DEPAN ?>"/><p>Jam Buka : <?php echo $data->JAM_BUKA." - ".$data->JAM_TUTUP ?></p><p>Alamat : <?php echo $data->ALAMAT ?></p><p>Kontak : <?php echo $data->CONTACT_PERSON ?></p><p><a href="<?php echo base_url('Welcome/detailResto/'.$data->ID_RESTO) ?>" class="btn btn-default text-center">Lihat Detail</a></p>')
			.openPopup();
			cdr_layer.addLayer(cdr);

		<?php } ?>



		var sattelite = new L.TileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}');
		var roads = new L.TileLayer('https://mt1.google.com/vt/lyrs=h&x={x}&y={y}&z={z}');
		var maps = new L.TileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}');
		var hybrid = new L.TileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}');
		var streetmaps = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		});
		var esri_1 = new L.TileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}');
		var traffic = new L.TileLayer('https://mt0.google.com/vt/lyrs=h@159000000,traffic|seconds_into_week:-1&style=3&x={x}&y={y}&z={z}');
		var traffic2 = new L.TileLayer('https://mt0.google.com/vt?lyrs=m@159000000,traffic|seconds_into_week:-1&style=3&x={x}&y={y}&z={z}');
		var traffic3 = new L.TileLayer('https://mt0.google.com/vt?lyrs=s@159000000,traffic|seconds_into_week:-1&style=3&x={x}&y={y}&z={z}');
		var osm = new L.TileLayer('http://a.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png');
		var waze = new L.TileLayer('https://worldtiles3.waze.com/tiles/{z}/{x}/{y}.png');
		var carto = new L.TileLayer('https://cartodb-basemaps-a.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png');
		var stamen = new L.TileLayer('http://a.tile.stamen.com/terrain/{z}/{x}/{y}.png');
		var esri_topo = new L.TileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}');
		var esri_street = new L.TileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}');
		var osm_cycle = new L.TileLayer('http://tile.thunderforest.com/cycle/{z}/{x}/{y}.png');
		var osm_grey = new L.TileLayer('http://tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png');

		all_layer = L.layerGroup([cafe_layer, qsr_layer, bakery_layer, eskrim_layer, pubs_layer, cdr_layer]);

		map = L.map('mapid', {
			center: [-7.971839, 112.632124],
			zoom: 12,
			layers: [streetmaps, all_layer]
		});

		var baseMaps = {
			"Streets Maps": streetmaps,
			"Google Sattelite": sattelite,
			"Roads": roads,
			"Google Maps": maps,
			"Hybrid": hybrid,
			"ESRI Sattellite": esri_1,
			"Google Traffix": traffic,
			"Google Traffix Road Maps": traffic2,
			"Google Traffix Sattellite": traffic3,
			"OSM": osm,
			"Waze": waze,
			"Carto Positron": carto,
			"Stamen": stamen,
			"ESRI Topo": esri_topo,
			"ESRI Streets": esri_street,
			"OSM Cycle Maps": osm_cycle,
			"OSM Greyscale": osm_grey
		};

		var overlayMaps = {
			"Cafe": cafe_layer,
			"Quick Service": qsr_layer,
			"Bakery": bakery_layer,
			"Ice Cream": eskrim_layer,
			"Pubs n Bar": pubs_layer,
			"Casual Dining": cdr_layer
		};

		L.control.layers(baseMaps, overlayMaps).addTo(map);
	</script>
</body>
</html>