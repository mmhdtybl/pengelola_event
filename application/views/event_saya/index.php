<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Gambar</th>
                            <th>Nama Event</th>
                            <th>Kategori</th>
                            <th>Penyelenggara</th>
                            <th>Tanggal & Waktu</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($events)): ?>
                            <?php $no = 1; foreach ($events as $event): ?>
                                <tr>
                                    <td><?php echo $no++; ?>.</td>
                                    <td>
                                        <?php if ($event['gambar_event']): ?>
                                            <img src="<?php echo base_url('assets/uploads/events/' . $event['gambar_event']); ?>" alt="Gambar Event" style="width: 100px; height: auto; border-radius: 5px;">
                                        <?php else: ?>
                                            <img src="<?php echo base_url('assets/dist/img/default_event.png'); ?>" alt="Tidak Ada Gambar" style="width: 100px; height: auto; border-radius: 5px;">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?php echo $event['nama_event']; ?></strong><br>
                                        <small><?php echo character_limiter($event['deskripsi_event'], 100); ?></small>
                                    </td>
                                    <td><?php echo $event['nama_kategori']; ?></td>
                                    <td><?php echo $event['nama_penyelenggara']; ?></td>
                                    <td>
                                        <?php echo date('d M Y H:i', strtotime($event['tanggal_mulai'])); ?><br>
                                        s/d <?php echo date('d M Y H:i', strtotime($event['tanggal_selesai'])); ?>
                                    </td>
                                    <td><?php echo $event['lokasi']; ?></td>
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
                                        <?php if ($this->auth_lib->has_role('admin') || $this->auth_lib->has_role('event_manager')): ?>
                                            <a href="<?php echo base_url('admin/events/edit/' . $event['id']); ?>" class="btn btn-warning btn-xs" title="Edit Event"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo base_url('admin/events/delete/' . $event['id']); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?');" title="Hapus Event"><i class="fa fa-trash"></i></a>
                                        <?php else: ?>
                                            <a href="#" class="btn btn-info btn-xs" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center">Anda belum membuat event apa pun.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
</div>

<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>