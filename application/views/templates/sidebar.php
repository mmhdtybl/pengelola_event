<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('nama_lengkap'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php if ($this->auth_lib->has_role('admin') || $this->auth_lib->has_role('event_manager')): ?>
                <li class="treeview <?php echo (in_array($this->uri->segment(2), ['users', 'events', 'kategori', 'penyelenggara'])) ? 'active menu-open' : ''; ?>">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>Manajemen Data</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <?php if ($this->auth_lib->has_role('admin')): ?>
                            <li class="<?php echo ($this->uri->segment(2) == 'users') ? 'active' : ''; ?>">
                                <a href="<?php echo base_url('admin/users'); ?>"><i class="fa fa-circle-o"></i> Pengguna</a>
                            </li>
                        <?php endif; ?>
                        <li class="<?php echo ($this->uri->segment(2) == 'events') ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/events'); ?>"><i class="fa fa-circle-o"></i> Event</a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(2) == 'kategori') ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/kategori'); ?>"><i class="fa fa-circle-o"></i> Kategori</a>
                        </li>
                        <li class="<?php echo ($this->uri->segment(2) == 'penyelenggara') ? 'active' : ''; ?>">
                            <a href="<?php echo base_url('admin/penyelenggara'); ?>"><i class="fa fa-circle-o"></i> Penyelenggara</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <li class="<?php echo ($this->uri->segment(1) == 'events' && $this->uri->segment(2) != 'admin') ? 'active' : ''; ?>">
                <a href="<?php echo base_url('event_saya'); ?>">
                    <i class="fa fa-calendar"></i> <span>Event Saya</span>
                </a>
            </li>

            <li>
                <a href="<?php echo base_url('auth/logout'); ?>">
                    <i class="fa fa-sign-out"></i> <span>Logout</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo isset($title) ? $title : 'Dashboard'; ?>
            <small><?php echo isset($subtitle) ? $subtitle : 'Control panel'; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo isset($title) ? $title : 'Dashboard'; ?></li>
        </ol>
    </section>

    <section class="content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Gagal!</h4>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Error!</h4>', '</div>'); ?>