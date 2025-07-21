<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3>
                <div class="box-tools">
                    <a href="<?php echo base_url('admin/events/create'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Event Baru</a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nama Event</th>
                            <th>Kategori</th>
                            <th>Penyelenggara</th>
                            <th>Tanggal & Waktu</th>
                            <th>Lokasi</th>
                            <th>Kuota</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($events)): ?>
                            <?php $no = 1; foreach ($events as $event): ?>
                                <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td><?php echo $event['nama_event']; ?></td>
                                    <td><?php echo $event['nama_kategori']; ?></td>
                                    <td><?php echo $event['nama_penyelenggara']; ?></td>
                                    <td>
                                        <?php echo date('d M Y H:i', strtotime($event['tanggal_mulai'])); ?><br>
                                        s/d <?php echo date('d M Y H:i', strtotime($event['tanggal_selesai'])); ?>
                                    </td>
                                    <td><?php echo $event['lokasi']; ?></td>
                                    <td><?php echo ($event['kuota'] === null ? 'Tidak Terbatas' : $event['kuota']); ?></td>
                                    <td>Rp <?php echo number_format($event['harga'], 0, ',', '.'); ?></td>
                                    <td>
                                        <?php
                                        $status_class = '';
                                        switch ($event['status_event']) {
                                            case 'upcoming': $status_class = 'label-info'; break;
                                            case 'active': $status_class = 'label-success'; break;
                                            case 'finished': $status_class = 'label-default'; break;
                                            case 'cancelled': $status_class = 'label-danger'; break;
                                        }
                                        ?>
                                        <span class="label <?php echo $status_class; ?>"><?php echo ucfirst($event['status_event']); ?></span>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/events/edit/' . $event['id']); ?>" class="btn btn-warning btn-xs">Edit</a>
                                        <a href="<?php echo base_url('admin/events/delete/' . $event['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data event.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
</div>