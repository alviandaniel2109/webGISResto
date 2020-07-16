<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('headerAdmin', $this->data);
?>
<div class="page-header">
  <h1>Update Resto</h1>
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
    <input type="hidden" name="idne" value="<?php echo $resto->ID_RESTO ?>">
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama :</label>
      <div class="col-sm-8">
          <input type="text" name="name" class="form-control" value="<?php echo $resto->NAMA ?>" placeholder="">
            <p class="help-block"><?php  echo form_error('name', '<small class="text-red">', '</small>'); ?></p>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Kategori :</label>
      <div class="col-sm-9">
        <?php foreach($this->db->get('jenis')->result() as $key => $row) : ?>
      <div class="radio radio-info radio-inline">
          <input type="radio" name="jenis" <?php if($resto->ID_JENIS == $row->ID_JENIS) { echo "checked = 'checked'"; } ?>  value="<?php echo $row->ID_JENIS; ?>">
          <label> <?php echo $row->JENIS; ?></label>
      </div>
    <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Harga :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input  type="text" name="minimal" class="form-control" value="<?php echo $resto->HARGA_MINIMAL ?>" placeholder="Minimal">
                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('minimal', '<small class="text-red">', '</small>'); ?></p>
        </div>
      <div class="col-sm-4">
            <div class="input-group">
                <input type="text" name="maksimal" class="form-control" value="<?php echo $resto->HARGA_MAKSIMAL ?>" placeholder="Maksimal">
                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('maksimal', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Jam Operasional :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="text" name="buka" class="form-control" value="<?php echo $resto->JAM_BUKA ?>" placeholder="Buka">
                <span class="input-group-addon"><i class="fa fa-hourglass-start"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('buka', '<small class="text-red">', '</small>'); ?></p>
        </div>
        <div class="col-sm-4">
            <div class="input-group">
                <input  type="text" name="tutup" class="form-control" value="<?php echo $resto->JAM_TUTUP ?>" placeholder="Tutup">
                <span class="input-group-addon"><i class="fa fa-hourglass-end"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('tutup', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Kapasitas Pengunjung :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="number" name="kapasitas" class="form-control" value="<?php echo $resto->KAPASITAS ?>" placeholder="Kapasitas">
            </div>
            <p class="help-block"><?php echo form_error('kapasitas', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Pengunjung Harian :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="number" name="harian" class="form-control" value="<?php echo $resto->PENGUNJUNG_HARIAN ?>" placeholder="Pengujung">
                <span class="input-group-addon">/ hari</span>
            </div>
            <p class="help-block"><?php echo form_error('harian', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>   
    <div class="form-group">
        <label class="col-sm-2 control-label">Contact Person :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="number" name="cp" class="form-control" value="<?php echo $resto->CONTACT_PERSON ?>" placeholder="Contact Person">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('cp', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Koordinat :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input id="input-calendar" type="text" name="latitude" class="form-control" value="<?php echo $resto->LATITUDE ?>" placeholder="latitude">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('latitude', '<small class="text-red">', '</small>'); ?></p>
        </div>
        <div class="col-sm-4">
            <div class="input-group">
                <input id="input-calendar" type="text" name="longitude" class="form-control" value="<?php echo $resto->LONGITUDE ?>" placeholder="longitude">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            </div>
            <p class="help-block"><?php echo form_error('longitude', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Jarak dari Pusat Kota :</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="number" name="jarak" class="form-control" value="<?php echo $resto->JARAK ?>" placeholder="Jarak">
                <span class="input-group-addon">Km</span>
            </div>
            <p class="help-block"><?php echo form_error('jarak', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Tampak Samping :</label>
        <div class="col-sm-4">
           <input type="file" name="photo1">
           <input type="hidden" name="old1" value="<?php echo $resto->GAMBAR_SAMPING ?>">
        </div>
        <div class="col-md-4">
          <?php if($resto->GAMBAR_SAMPING != '') : ?>
          <img src="<?php echo base_url("assets/image/{$resto->GAMBAR_SAMPING}") ?>" height="150">
        <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Tampak Depan :</label>
        <div class="col-sm-4">
           <input type="file" name="photo2">
           <input type="hidden" name="old2" value="<?php echo $resto->GAMBAR_DEPAN ?>">
        </div>
        <div class="col-md-4">
          <?php if($resto->GAMBAR_SAMPING != '') : ?>
          <img src="<?php echo base_url("assets/image/{$resto->GAMBAR_DEPAN}") ?>" height="150">
        <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Tampak Atas :</label>
        <div class="col-sm-4">
           <input type="file" name="photo3">
           <input type="hidden" name="old3" value="<?php echo $resto->GAMBAR_ATAS ?>">
        </div>
        <div class="col-md-4">
          <?php if($resto->GAMBAR_SAMPING != '') : ?>
          <img src="<?php echo base_url("assets/image/{$resto->GAMBAR_ATAS}") ?>" height="150">
        <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Tampak Jalan :</label>
        <div class="col-sm-4">
           <input type="file" name="photo4">
           <input type="hidden" name="old4" value="<?php echo $resto->GAMBAR_JALAN ?>">
        </div>
        <div class="col-md-4">
          <?php if($resto->GAMBAR_SAMPING != '') : ?>
          <img src="<?php echo base_url("assets/image/{$resto->GAMBAR_JALAN}") ?>" height="150">
        <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Alamat :</label>
        <div class="col-sm-8">
           <textarea name="alamat" class="form-control" rows="3"><?php echo $resto->ALAMAT ?></textarea>
           <p class="help-block"><?php echo form_error('alamat', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Deskripsi :</label>
        <div class="col-sm-8">
           <textarea name="description" class="form-control" rows="8"><?php echo $resto->DESKRIPSI ?></textarea>
           <p class="help-block"><?php echo form_error('description', '<small class="text-red">', '</small>'); ?></p>
        </div>
    </div>
    <div class="form-group" style="margin-bottom: 50px;">
        <div class="col-sm-4 col-md-offset-3">
            <button type="submit" name="submit" class="btn btn-lg btn-primary pull-right"><i class="fa fa-save"></i> Simpan Perubahan</button>
        </div>
    </div>
</form>
<?php
$this->load->view('footerAdmin', $this->data);
?>