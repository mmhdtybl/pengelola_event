<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?> | Event Management</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/Ionicons/css/ionicons.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css'); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .login-logo a {
      color: #3c8dbc;
      font-weight: bold;
      letter-spacing: 1px;
    }
    .login-box {
      margin-top: 40px;
    }
    .login-box-body {
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(60,141,188,0.08);
      padding: 30px 25px 20px 25px;
      background: #fff;
    }
    .btn-primary {
      background-color: #3c8dbc;
      border-color: #367fa9;
    }
    .btn-primary:hover, .btn-primary:focus {
      background-color: #367fa9;
      border-color: #204d74;
    }
    .social-auth-links {
      margin: 20px 0 10px 0;
    }
    .login-box-msg {
      margin-bottom: 20px;
      font-size: 16px;
      color: #555;
    }
    .alert {
      margin-bottom: 15px;
    }
    .icheckbox_square-blue, .iradio_square-blue {
      margin-right: 5px;
    }
    .forgot-link {
      display: block;
      margin-top: 15px;
      text-align: right;
      color: #3c8dbc;
      text-decoration: none;
    }
    .forgot-link:hover {
      text-decoration: underline;
      color: #367fa9;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><b>Event</b>Management</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

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

    <?php echo form_open('auth/login'); ?>
      <div class="form-group has-feedback">
        <input type="text" name="username_or_email" class="form-control" placeholder="Username atau Email" value="<?php echo set_value('username_or_email'); ?>" autocomplete="username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="current-password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck" style="margin-top: 5px; padding-left: 0;">
            <label style="padding-left: 0; font-weight: normal;">
              <input type="checkbox" name="remember" style="margin-right: 5px;"> Ingat Saya
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
      </div>
    <?php echo form_close(); ?>

    <div class="social-auth-links text-center">
      <p>- ATAU -</p>
      <a href="<?php echo base_url('auth/register'); ?>" class="btn btn-block btn-social btn-facebook btn-flat">
        <i class="fa fa-user-plus"></i> Daftar Akun Baru
      </a>
    </div>
    <a href="#" class="forgot-link">Saya Lupa Password</a>
  </div>
</div>
<script src="<?php echo base_url('assets/plugins/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js'); ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>