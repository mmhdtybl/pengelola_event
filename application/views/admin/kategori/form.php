<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <?php echo form_open(); ?>
                <div class="box-body">
                    <div class="form-group <?php echo (form_error('nama_kategori')) ? 'has-error' : ''; ?>">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" placeholder="Masukkan nama kategori" value="<?php echo set_value('nama_kategori', (isset($kategori_item['nama_kategori']) ? $kategori_item['nama_kategori'] : '')); ?>">
                        <?php echo form_error('nama_kategori', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('deskripsi')) ? 'has-error' : ''; ?>">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi kategori"><?php echo set_value('deskripsi', (isset($kategori_item['deskripsi']) ? $kategori_item['deskripsi'] : '')); ?></textarea>
                        <?php echo form_error('deskripsi', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo base_url('admin/kategori'); ?>" class="btn btn-default">Batal</a>
                </div>
            <?php echo form_close(); ?>
        </div>
        </div>
</div>