<div class="row">
    <?php if ($user_role === 'admin' || $user_role === 'event_manager'): ?>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo (isset($total_events) ? $total_events : '0'); ?></h3>
                    <p>Total Event Terdaftar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calendar"></i>
                </div>
                <a href="<?php echo base_url('admin/events'); ?>" class="small-box-footer">Lihat Semua Event <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo (isset($upcoming_events_count) ? $upcoming_events_count : '0'); ?></h3>
                    <p>Event Mendatang</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo base_url('admin/events'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo (isset($total_users) ? $total_users : '0'); ?></h3>
                    <p>User Terdaftar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?php echo base_url('admin/users'); ?>" class="small-box-footer">Manajemen Pengguna <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo (isset($cancelled_events_count) ? $cancelled_events_count : '0'); ?></h3>
                    <p>Event yang Dibatalkan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-close-circled"></i>
                </div>
                <a href="<?php echo base_url('admin/events'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php else: // Untuk peserta, tampilkan info yang relevan ?>
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Selamat Datang, <?php echo $this->session->userdata('nama_lengkap'); ?>!</h3>
                </div>
                <div class="box-body">
                    <p>Selamat datang di Sistem Pengelolaan Event. Jelajahi event-event menarik yang akan datang.</p>
                    <a href="<?php echo base_url('event_saya'); ?>" class="btn btn-primary btn-flat">Lihat Semua Event</a>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Event Mendatang</h3>
                </div>
                <div class="box-body">
                    <?php if (!empty($upcoming_events_for_user)): ?>
                        <ul class="list-group">
                            <?php foreach ($upcoming_events_for_user as $event): ?>
                                <li class="list-group-item">
                                    <h4><a href="<?php echo base_url('events/detail/' . $event['id']); ?>"><?php echo $event['nama_event']; ?></a></h4>
                                    <p><i class="fa fa-calendar"></i> <?php echo date('d M Y H:i', strtotime($event['tanggal_mulai'])); ?> - <?php echo date('d M Y H:i', strtotime($event['tanggal_selesai'])); ?></p>
                                    <p><i class="fa fa-map-marker"></i> <?php echo $event['lokasi']; ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Belum ada event mendatang.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>