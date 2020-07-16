<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('headerAdmin', $this->data);
?>
<div class="page-header">
  <h1>Tambah Restoran</h1>
</div>
<form class="form-horizontal" action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <?php if($this->session->flashdata('message')) : ?>
            <div class="col-sm-8 col-md-offset-2">
                <div class="form-group">
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
  	<div class="form-group">
    	<label class="col-sm-2 control-label">Nama :</label>
    	<div class="col-sm-8">
      		<input type="text" name="name" class="form-control" value="<?php echo set_value('name') ?>" placeholder="">
            <p class="help-block"><?php  echo form_error('name', '<small class="text-red">', '</small>'); ?></p>
    	</div>
  	</div>
  	<div class="form-group">
    	<label class="col-sm-2 control-label">Jenis :</label>
    	<div class="col-sm-9">
		<?php foreach($this->db->get('jenis')->result() as $key => $row) : ?>
			<div class="radio radio-info radio-inline">
		    	<input type="radio" value="<?php echo $row->ID_JENIS; ?>" name="jenis">
		    	<label> <?php echo $row->JENIS; ?></label>
			</div>
		<?php endforeach; ?>
    	</div>
  	</div>
  	<div class="form-group">
    	<label class="col-sm-2 control-label">Harga :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input  type="text" name="minimal" class="form-control" value="<?php echo set_value('minimal') ?>" placeholder="Minimal">
                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('minimal', '<small class="text-red">', '</small>'); ?></p>
        </div>
    	<div class="col-sm-4">
            <div class="input-group">
                <input type="text" name="maksimal" class="form-control" value="<?php echo set_value('maksimal') ?>" placeholder="Maksimal">
                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('maksimal', '<small class="text-red">', '</small>'); ?></p>
        </div>
  	</div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Jam Operasional :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="text" name="buka" class="form-control" value="<?php echo set_value('buka') ?>" placeholder="Buka (00:00:00)">
                <span class="input-group-addon"><i class="fa fa-hourglass-start"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('buka', '<small class="text-red">', '</small>'); ?></p>
        </div>
        <div class="col-sm-4">
            <div class="input-group">
                <input  type="text" name="tutup" class="form-control" value="<?php echo set_value('tutup') ?>" placeholder="Tutup (00:00:00)">
                <span class="input-group-addon"><i class="fa fa-hourglass-end"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('tutup', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>  	
    <div class="form-group">
        <label class="col-sm-2 control-label">Kapasitas Pengunjung :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="number" name="kapasitas" class="form-control" value="<?php echo set_value('kapasitas') ?>" placeholder="Kapasitas">
            </div>
            <p class="help-block"><?php echo form_error('kapasitas', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Pengunjung Harian :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="number" name="harian" class="form-control" value="<?php echo set_value('harian') ?>" placeholder="Pengunjung">
                <span class="input-group-addon">/ hari</span>
            </div>
            <p class="help-block"><?php echo form_error('harian', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>   
    <div class="form-group">
        <label class="col-sm-2 control-label">Contact Person :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="number" name="cp" class="form-control" value="<?php echo set_value('cp') ?>" placeholder="Contact Person">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('cp', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>      
    <div class="form-group">
        <label class="col-sm-2 control-label">Koordinat :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input id="input-calendar" type="text" name="latitude" class="form-control" value="<?php echo set_value('latitude') ?>" placeholder="Latitude">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('latitude', '<small class="text-red">', '</small>'); ?></p>
        </div>
        <div class="col-sm-4">
            <div class="input-group">
                <input id="input-calendar" type="text" name="longitude" class="form-control" value="<?php echo set_value('longitude') ?>" placeholder="Longitude">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('longitude', '<small class="text-red">', '</small>'); ?></p>
        </div>
        <!-- <div class="col-sm-8 col-md-offset-2">
			<?php echo $map['html'] ?>
        </div> -->
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Jarak dari Pusat Kota :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="number" name="jarak" class="form-control" value="<?php echo set_value('jarak') ?>" placeholder="Jarak">
                <span class="input-group-addon">Km</span>
            </div>
            <p class="help-block"><?php echo form_error('jarak', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Tampak Samping :</label>
        <div class="col-sm-5">
           <input type="file" name="photo1">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Tampak Depan :</label>
        <div class="col-sm-5">
           <input type="file" name="photo2">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Tampak Atas :</label>
        <div class="col-sm-5">
           <input type="file" name="photo3">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Tampak Jalan :</label>
        <div class="col-sm-5">
           <input type="file" name="photo4">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Alamat :</label>
        <div class="col-sm-8">
           <textarea name="alamat" class="form-control" rows="3"><?php echo set_value('alamat') ?></textarea>
           <p class="help-block"><?php echo form_error('alamat', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Deskripsi :</label>
        <div class="col-sm-8">
           <textarea name="description" class="form-control" rows="8"><?php echo set_value('description') ?></textarea>
           <p class="help-block"><?php echo form_error('description', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group" style="margin-bottom: 50px;">
        <div class="col-sm-4 col-md-offset-3">
            <button type="submit" class="btn btn-lg btn-primary pull-right"><i class="fa fa-save"></i> Tambahkan</button>
        </div>
    </div>
</form>
<?php
$this->load->view('footerAdmin', $this->data);
?>