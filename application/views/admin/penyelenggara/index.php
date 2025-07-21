<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3>
                <div class="box-tools">
                    <a href="<?php echo base_url('admin/penyelenggara/create'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Penyelenggara Baru</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Penyelenggara</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($penyelenggara)): ?>
                            <?php $no = 1; foreach ($penyelenggara as $item): ?>
                                <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $item['nama_penyelenggara']; ?></td>
                                    <td><?php echo $item['email_penyelenggara']; ?></td>
                                    <td><?php echo $item['telepon_penyelenggara']; ?></td>
                                    <td><?php echo $item['alamat_penyelenggara']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/penyelenggara/edit/' . $item['id']); ?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="<?php echo base_url('admin/penyelenggara/delete/' . $item['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus penyelenggara ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data penyelenggara.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
</div>