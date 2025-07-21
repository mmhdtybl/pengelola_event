<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <?php echo form_open(); ?>
                <div class="box-body">
                    <div class="form-group <?php echo (form_error('nama_penyelenggara')) ? 'has-error' : ''; ?>">
                        <label for="nama_penyelenggara">Nama Penyelenggara</label>
                        <input type="text" name="nama_penyelenggara" class="form-control" id="nama_penyelenggara" placeholder="Masukkan nama penyelenggara" value="<?php echo set_value('nama_penyelenggara', (isset($penyelenggara_item['nama_penyelenggara']) ? $penyelenggara_item['nama_penyelenggara'] : '')); ?>">
                        <?php echo form_error('nama_penyelenggara', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('email_penyelenggara')) ? 'has-error' : ''; ?>">
                        <label for="email_penyelenggara">Email Penyelenggara</label>
                        <input type="email" name="email_penyelenggara" class="form-control" id="email_penyelenggara" placeholder="Masukkan email penyelenggara" value="<?php echo set_value('email_penyelenggara', (isset($penyelenggara_item['email_penyelenggara']) ? $penyelenggara_item['email_penyelenggara'] : '')); ?>">
                        <?php echo form_error('email_penyelenggara', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('telepon_penyelenggara')) ? 'has-error' : ''; ?>">
                        <label for="telepon_penyelenggara">Telepon Penyelenggara</label>
                        <input type="text" name="telepon_penyelenggara" class="form-control" id="telepon_penyelenggara" placeholder="Masukkan nomor telepon penyelenggara" value="<?php echo set_value('telepon_penyelenggara', (isset($penyelenggara_item['telepon_penyelenggara']) ? $penyelenggara_item['telepon_penyelenggara'] : '')); ?>">
                        <?php echo form_error('telepon_penyelenggara', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('alamat_penyelenggara')) ? 'has-error' : ''; ?>">
                        <label for="alamat_penyelenggara">Alamat Penyelenggara</label>
                        <textarea name="alamat_penyelenggara" class="form-control" id="alamat_penyelenggara" rows="3" placeholder="Masukkan alamat penyelenggara"><?php echo set_value('alamat_penyelenggara', (isset($penyelenggara_item['alamat_penyelenggara']) ? $penyelenggara_item['alamat_penyelenggara'] : '')); ?></textarea>
                        <?php echo form_error('alamat_penyelenggara', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo base_url('admin/penyelenggara'); ?>" class="btn btn-default">Batal</a>
                </div>
            <?php echo form_close(); ?>
        </div>
        </div>
</div>