<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3>
                <div class="box-tools">
                    <a href="<?php echo base_url('admin/users/create'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Pengguna Baru</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php $no = 1; foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['nama_lengkap']; ?></td>
                                    <td><span class="label label-<?php echo ($user['role'] == 'admin' ? 'danger' : ($user['role'] == 'event_manager' ? 'warning' : 'info')); ?>"><?php echo ucfirst($user['role']); ?></span></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/users/edit/' . $user['id']); ?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="<?php echo base_url('admin/users/delete/' . $user['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
</div>