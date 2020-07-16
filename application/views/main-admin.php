<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('headerAdmin', $this->data);
?>
<div class="page-header">
  <h1>Beranda</h1>
</div>
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
<?php
$this->load->view('footerAdmin', $this->data);
?>