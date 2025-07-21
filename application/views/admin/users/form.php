<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <?php echo form_open(); ?>
                <div class="box-body">
                    <div class="form-group <?php echo (form_error('nama_lengkap')) ? 'has-error' : ''; ?>">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?php echo set_value('nama_lengkap', (isset($user['nama_lengkap']) ? $user['nama_lengkap'] : '')); ?>">
                        <?php echo form_error('nama_lengkap', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('username')) ? 'has-error' : ''; ?>">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" value="<?php echo set_value('username', (isset($user['username']) ? $user['username'] : '')); ?>" <?php echo (isset($user['id']) ? 'readonly' : ''); ?>>
                        <?php echo form_error('username', '<span class="help-block">', '</span>'); ?>
                        <?php if (isset($user['id'])): ?><span class="help-block">Username tidak bisa diubah.</span><?php endif; ?>
                    </div>
                    <div class="form-group <?php echo (form_error('email')) ? 'has-error' : ''; ?>">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" value="<?php echo set_value('email', (isset($user['email']) ? $user['email'] : '')); ?>">
                        <?php echo form_error('email', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('password')) ? 'has-error' : ''; ?>">
                        <label for="password">Password <?php echo (isset($user['id']) ? ' (Kosongkan jika tidak ingin mengubah)' : ''); ?></label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password">
                        <?php echo form_error('password', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('passconf')) ? 'has-error' : ''; ?>">
                        <label for="passconf">Konfirmasi Password</label>
                        <input type="password" name="passconf" class="form-control" id="passconf" placeholder="Ulangi password">
                        <?php echo form_error('passconf', '<span class="help-block">', '</span>'); ?>
                    </div>
                    <div class="form-group <?php echo (form_error('role')) ? 'has-error' : ''; ?>">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" <?php echo set_select('role', 'admin', (isset($user['role']) && $user['role'] == 'admin')); ?>>Admin</option>
                            <option value="event_manager" <?php echo set_select('role', 'event_manager', (isset($user['role']) && $user['role'] == 'event_manager')); ?>>Event Manager</option>
                            <option value="peserta" <?php echo set_select('role', 'peserta', (isset($user['role']) && $user['role'] == 'peserta')); ?>>Peserta</option>
                        </select>
                        <?php echo form_error('role', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-default">Batal</a>
                </div>
            <?php echo form_close(); ?>
        </div>
        </div>
</div>