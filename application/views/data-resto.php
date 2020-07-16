<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('headerAdmin', $this->data);
?>
<div class="page-header">
	<h1>Data Restoran</h1>
	<form action="" method="get">
	<div class="col-md-4 pull-right">
       <div class="input-group" style="margin-top: -30px;">
           <input id="input-calendar" type="text" name="q" class="form-control" value="<?php echo $this->input->get('q') ?>" placeholder="Pencarian..">
           <span class="input-group-addon"><i class="fa fa-search"></i></span>
       </div>
	</div>
	</form>
</div>
<table class="table table-striped">
  	<thead>
  		<tr>
  			<th>No.</th>
  			<th class="text-center">Nama</th>
  			<th class="text-center">Jenis</th>
  			<th class="text-center">Jam Operasional</th>
  			<th class="text-center">Kisaran Harga</th>
  			<th class="text-center">Alamat</th>
  			<th class="text-center">Kontak</th>
  			<th class="text-center">Deskripsi</th>
  		</tr>
  	</thead>
  	<tbody>
  	<?php $i = 1; foreach( $resto as $row) : ?>
  		<tr>
  			<td><?php echo $i; ?>.</td>
			<td class="td-action" width="250">
				<?php echo $row->NAMA ?>
				<div class="button-action">
					<a href="<?php echo base_url('admin/updateresto/'.$row->ID_RESTO); ?>">Edit</a> |
					<a href="#" data-id="<?php echo $row->ID_RESTO ?>" class="text-danger delete-resto">Hapus</a>
				</div>	
			</td>
  			<td><?php echo $row->JENIS ?></td>
  			<td><?php echo $row->JAM_BUKA." - ".$row->JAM_TUTUP ?></td>
  			<td><?php echo $row->HARGA_MINIMAL." - ".$row->HARGA_MAKSIMAL ?></td>
  			<td width="200"><small><?php echo $row->ALAMAT ?></small></td>
  			<td width="50" class="text-center"><?php echo $row->CONTACT_PERSON ?></td>
  			<td width="350"><small><?php echo $row->DESKRIPSI ?></small></td>
  		</tr>
  	<?php $i++; endforeach; ?>
  	</tbody>
</table>
<?php if(!$resto) : ?>
<div class="col-md-5 col-md-offset-3">
	<div class="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Maa!</strong> Data yang anda cari tidak ditemukan.
	</div>
</div>
<?php endif; ?>
<div class="text-center" style="margin-bottom: 50px;">
	<?php echo $this->pagination->create_links(); ?>
</div>
<?php
$this->load->view('footerAdmin', $this->data);
?>