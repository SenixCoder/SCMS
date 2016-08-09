<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>科协管理平台| Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
    <div class="register-logo">
        <img src="<?php echo base_url();?>AdminLTE2/dist/img/suda.png" alt="User Image">
       </div><!-- /.login-logo -->
      <div class="register-logo">
          <a>科协管理平台</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">[重要!]请不要使用IE8浏览器及以下，如果没有请下载<b>谷歌浏览器</b></p>
        <form action="<?php echo base_url();?>index.php/register/add_register_user" method="post">
          <div class="form-group has-feedback">
            <?php echo form_error('users_id'); ?>
            <input name="users_id" type="text" class="form-control" placeholder="用户名(学号)">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_error('pswd'); ?>
            <input type="password" name="pswd" class="form-control" placeholder="密码(长度最少为8位)">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <!-- <div class="form-group has-feedback">
            <input type="pswd" class="form-control" placeholder="再次输入密码">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div> -->
          <div class="form-group has-feedback">
            <?php echo form_error('user_email'); ?>
            <input type="email" name="user_email" class="form-control" placeholder="(请填写正确的邮箱，方便找回密码)">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_error('user_name'); ?>
            <input type="text" name="user_name" class="form-control" placeholder="真实姓名">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_error('mobile_phone'); ?>
            <input type="text" name="mobile_phone" class="form-control" placeholder="手机号">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_error('depart_ment_id'); ?>
            <select name="depart_ment_id" class="form-control">
              <option value="1" <?php echo set_select('depart_ment_id', '1', TRUE); ?>>办公室</option>
              <option value="2" <?php echo set_select('depart_ment_id', '2'); ?>>外联部</option>
              <option value="3" <?php echo set_select('depart_ment_id', '3'); ?>>活动部</option>
              <option value="4" <?php echo set_select('depart_ment_id', '4'); ?>>图文中心</option>
              <option value="5" <?php echo set_select('depart_ment_id', '5'); ?>>宣传部</option>
              <option value="6" <?php echo set_select('depart_ment_id', '6'); ?>>科研部</option>
              <option value="7" <?php echo set_select('depart_ment_id', '7'); ?>>项目部</option>
            </select>
            <span class="glyphicon form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_error('user_position'); ?>
            <select name="user_position" class="form-control">
              <option value="9" <?php echo set_select('user_position', '9', TRUE); ?>>干事</option>
              <option value="10" <?php echo set_select('user_position', '10'); ?>>部长</option>
            </select>
            <span class="glyphicon form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <?php echo form_error('user_class'); ?>
            <select name="user_class" class="form-control">
              <option value="30" <?php echo set_select('user_class', '30', TRUE); ?>>软件工程嵌入式</option>
              <option value="40" <?php echo set_select('user_class', '40'); ?>>网络工程班</option>
              <option value="50" <?php echo set_select('user_class', '50'); ?>>计算机班</option>
              <option value="60" <?php echo set_select('user_class', '60'); ?>>软件工程班</option>
              <option value="70" <?php echo set_select('user_class', '70'); ?>>物联网班</option>
              <option value="80" <?php echo set_select('user_class', '80'); ?>>信息管理班</option>
            </select>
            <span class="glyphicon form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div> -->
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">注册</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="<?php echo site_url('login/index');?>" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>AdminLTE2/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
