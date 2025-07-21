<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3>
                <div class="box-tools">
                    <a href="<?php echo base_url('admin/kategori/create'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Kategori Baru</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kategori)): ?>
                            <?php $no = 1; foreach ($kategori as $item): ?>
                                <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $item['nama_kategori']; ?></td>
                                    <td><?php echo $item['deskripsi']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('admin/kategori/edit/' . $item['id']); ?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="<?php echo base_url('admin/kategori/delete/' . $item['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data kategori.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
</div>