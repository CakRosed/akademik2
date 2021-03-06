<html><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nurus Sa'adah | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href= <?php  echo base_url('asset/bower_components/bootstrap/dist/css/bootstrap.min.css');?>>
  <!-- Font Awesome -->
  <link rel="stylesheet" href= <?php echo base_url('asset/bower_components/font-awesome/css/font-awesome.min.css'); ?>>
  <!-- Ionicons -->
  <link rel="stylesheet" href= <?php echo base_url('asset/bower_components/Ionicons/css/ionicons.min.css');?>>
  <!-- Theme style -->
  <link rel="stylesheet" href= <?php echo base_url('asset/dist/css/AdminLTE.min.css'); ?>>  
  <!-- iCheck -->
<script src=<?php echo base_url('asset/plugins/iCheck/icheck.min.js'); ?>></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- jQuery 3 -->
  <script src=<?php echo base_url('asset/bower_components/datatables/js/jquery-3.3.1.js') ?>></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p href="../../index2.html"><b>LOGIN</b> | Sa'adah</p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?php echo form_open('autentifikasi/check_login'); ?>

      <div class="form-group has-feedback">
        <?php echo cmb_dinamis('level', 'tbl_level_user', 'nama_level', 'id_level_user',null, 'class="form-control"');?>
      </div>
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label class="">
              <div class="icheckbox_square-blue checked" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- Bootstrap 3.3.7 -->
<script src= <?php echo base_url('asset/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>></script>
<!-- iCheck -->
<script src= <?php echo base_url('asset/plugins/iCheck/icheck.min.js'); ?>></script>
</body>
</html>