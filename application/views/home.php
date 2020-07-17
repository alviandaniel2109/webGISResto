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
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

	<style type="text/css">
		body {margin-bottom: 20px;}
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
						<li><a href="<?php echo base_url() ?>" class="hvr-underline-reveal">Home</a></li>
						<li><a href="<?php echo base_url('Welcome') ?>" class="hvr-underline-reveal">Map</a></li>
						<li><a  data-toggle="modal" href='#modal-about' class="hvr-underline-reveal">About</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="row text-center"  style="margin-top: 60px">
				<h2>- Welcome to WEBGIS RESTO MALANG - </h2>
				<br>
				<br>
				<h4 style="margin: 0 150px; text-align: left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sistem Informasi Geografis Berbasis Web (WEBGIS) untuk Pemetaan Restoran di Kota Malang, dapat membantu pemilik restoran untuk menginformasikan kuliner atau makanan kepada masyarakat secara efektif dan efisien. Sistem informasi ini juga dapat menampilkan lokasi restoran yang ada di Kota Malang dengan bedasarkan list dan peta. Tampilan yang sederhana, mempermudah penggunaan aplikasi dalam mengimplementasikannya. Selain itu manfaat yang dapat disimpulkan yaitu, memberi kemudahan dalam melakukan proses pencarian sebuah restoran di wilayah kota Malang dengan konsep pemetaan lokasi, menghemat waktu dan biaya dalam mentukan lokasi restoran.</h4>
				<br>
				<h4 style="margin: 0 150px; text-align: left"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dalam WEBGIS ini memiliki jumlah data spasial yang digunakan kurang lebih sebanyak 60 data, dimana menggunakan 6 sampel tempat makan yang berbeda dengan masing-masing berjumlah 10 data. Dan juga terdapat kurang lebih 17 basemap yang dapat digunakan.</h4>
				<br>
				<hr>
				<br>
			</div>
			<div class="row">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">
						L E G E N D A
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="col-md-2 text-center">
								<img src="<?php echo base_url('assets/icon/marker-bakery.png') ?>" style="width: 75px; height:100px;">
								<p>Bakery</p>
							</div>
							<div class="col-md-2 text-center">
								<img src="<?php echo base_url('assets/icon/marker-bar.png') ?>"  style="width: 75px; height:100px;">
								<p>Pubs and Bar</p>
							</div>
							<div class="col-md-2 text-center">
								<img src="<?php echo base_url('assets/icon/marker-cafe.png') ?>"  style="width: 75px; height:100px;">
								<p>Cafe</p>
							</div>
							<div class="col-md-2 text-center">
								<img src="<?php echo base_url('assets/icon/marker-fastfood.png') ?>"  style="width: 75px; height:100px;">
								<p>Quick Service</p>
							</div>
							<div class="col-md-2 text-center">
								<img src="<?php echo base_url('assets/icon/marker-icecream.png') ?>"  style="width: 75px; height:100px;">
								<p>Ice Cream Parlor</p>
							</div>
							<div class="col-md-2 text-center">
								<img src="<?php echo base_url('assets/icon/marker-restaurant.png') ?>"  style="width: 75px; height:100px;;">
								<p>Casual Dining</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br>
			<hr>
			<br>
			<div class="row">
				<h3>Data Restoran</h3>
				<table id="dataresto" class="table table-striped" style="width: 100%">
					<thead>
						<tr>
							<th>No.</th>
							<th class="text-center">Nama</th>
							<th class="text-center">Jenis</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Kontak</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach( $resto as $row) : ?>
						<tr>
							<td><?php echo $i; ?>.</td>
							<td class="td-action" width="250">
								<?php echo $row->NAMA ?>
							</td>
							<td><?php echo $row->JENIS ?></td>
							<td><?php echo $row->ALAMAT ?></td>
							<td class="text-center"><?php echo $row->CONTACT_PERSON ?></td>
						</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
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
		<script type="text/javascript">
			$(document).ready(function() {
				$('#dataresto').DataTable();
			} );
		</script>
	</body>
	</html>