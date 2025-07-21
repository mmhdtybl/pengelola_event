<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <?php echo form_open_multipart(); ?> <div class="box-body">
                    <div class="form-group <?php echo (form_error('nama_event')) ? 'has-error' : ''; ?>">
                        <label for="nama_event">Nama Event</label>
                        <input type="text" name="nama_event" class="form-control" id="nama_event" placeholder="Masukkan nama event" value="<?php echo set_value('nama_event', (isset($event_item['nama_event']) ? $event_item['nama_event'] : '')); ?>">
                        <?php echo form_error('nama_event', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('deskripsi_event')) ? 'has-error' : ''; ?>">
                        <label for="deskripsi_event">Deskripsi Event</label>
                        <textarea name="deskripsi_event" class="form-control" id="deskripsi_event" rows="5" placeholder="Masukkan deskripsi event"><?php echo set_value('deskripsi_event', (isset($event_item['deskripsi_event']) ? $event_item['deskripsi_event'] : '')); ?></textarea>
                        <?php echo form_error('deskripsi_event', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo (form_error('tanggal_mulai')) ? 'has-error' : ''; ?>">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="datetime-local" name="tanggal_mulai" class="form-control" id="tanggal_mulai" value="<?php echo set_value('tanggal_mulai', (isset($event_item['tanggal_mulai']) ? date('Y-m-d\TH:i', strtotime($event_item['tanggal_mulai'])) : '')); ?>">
                                <?php echo form_error('tanggal_mulai', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo (form_error('tanggal_selesai')) ? 'has-error' : ''; ?>">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="datetime-local" name="tanggal_selesai" class="form-control" id="tanggal_selesai" value="<?php echo set_value('tanggal_selesai', (isset($event_item['tanggal_selesai']) ? date('Y-m-d\TH:i', strtotime($event_item['tanggal_selesai'])) : '')); ?>">
                                <?php echo form_error('tanggal_selesai', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group <?php echo (form_error('lokasi')) ? 'has-error' : ''; ?>">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan lokasi event" value="<?php echo set_value('lokasi', (isset($event_item['lokasi']) ? $event_item['lokasi'] : '')); ?>">
                        <?php echo form_error('lokasi', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo (form_error('kuota')) ? 'has-error' : ''; ?>">
                                <label for="kuota">Kuota (kosongkan jika tidak terbatas)</label>
                                <input type="number" name="kuota" class="form-control" id="kuota" placeholder="Masukkan kuota peserta" value="<?php echo set_value('kuota', (isset($event_item['kuota']) ? $event_item['kuota'] : '')); ?>">
                                <?php echo form_error('kuota', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo (form_error('harga')) ? 'has-error' : ''; ?>">
                                <label for="harga">Harga Tiket</label>
                                <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukkan harga tiket" value="<?php echo set_value('harga', (isset($event_item['harga']) ? $event_item['harga'] : '0')); ?>" step="0.01">
                                <?php echo form_error('harga', '<span class="help-block">', '</span>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group <?php echo (form_error('id_kategori')) ? 'has-error' : ''; ?>">
                        <label for="id_kategori">Kategori</label>
                        <select name="id_kategori" id="id_kategori" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategori_list as $kategori): ?>
                                <option value="<?php echo $kategori['id']; ?>" <?php echo set_select('id_kategori', $kategori['id'], (isset($event_item['id_kategori']) && $event_item['id_kategori'] == $kategori['id'])); ?>>
                                    <?php echo $kategori['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('id_kategori', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('id_penyelenggara')) ? 'has-error' : ''; ?>">
                        <label for="id_penyelenggara">Penyelenggara</label>
                        <select name="id_penyelenggara" id="id_penyelenggara" class="form-control">
                            <option value="">-- Pilih Penyelenggara --</option>
                            <?php foreach ($penyelenggara_list as $penyelenggara): ?>
                                <option value="<?php echo $penyelenggara['id']; ?>" <?php echo set_select('id_penyelenggara', $penyelenggara['id'], (isset($event_item['id_penyelenggara']) && $event_item['id_penyelenggara'] == $penyelenggara['id'])); ?>>
                                    <?php echo $penyelenggara['nama_penyelenggara']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo form_error('id_penyelenggara', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="gambar_event">Gambar Event</label>
                        <input type="file" name="gambar_event" id="gambar_event">
                        <p class="help-block">Ukuran maksimal 2MB (jpg, jpeg, png, gif)</p>
                        <?php if (isset($event_item['gambar_event']) && $event_item['gambar_event']): ?>
                            <img src="<?php echo base_url('assets/uploads/events/' . $event_item['gambar_event']); ?>" alt="Gambar Event" style="max-width: 200px; margin-top: 10px;">
                            <p class="help-block">Gambar saat ini.</p>
                        <?php endif; ?>
                        <?php if (isset($error_upload)): ?><span class="help-block text-danger"><?php echo $error_upload; ?></span><?php endif; ?>
                    </div>
                    <div class="form-group <?php echo (form_error('status_event')) ? 'has-error' : ''; ?>">
                        <label for="status_event">Status Event</label>
                        <select name="status_event" id="status_event" class="form-control">
                            <option value="upcoming" <?php echo set_select('status_event', 'upcoming', (isset($event_item['status_event']) && $event_item['status_event'] == 'upcoming')); ?>>Akan Datang</option>
                            <option value="active" <?php echo set_select('status_event', 'active', (isset($event_item['status_event']) && $event_item['status_event'] == 'active')); ?>>Aktif</option>
                            <option value="finished" <?php echo set_select('status_event', 'finished', (isset($event_item['status_event']) && $event_item['status_event'] == 'finished')); ?>>Selesai</option>
                            <option value="cancelled" <?php echo set_select('status_event', 'cancelled', (isset($event_item['status_event']) && $event_item['status_event'] == 'cancelled')); ?>>Dibatalkan</option>
                        </select>
                        <?php echo form_error('status_event', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo base_url('admin/events'); ?>" class="btn btn-default">Batal</a>
                </div>
            <?php echo form_close(); ?>
        </div>
        </div>
</div>