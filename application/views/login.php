<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>科协管理平台| Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/offline/font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/offline/ionicons-2.0.1/css/ionicons.min.css">
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
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="<?php echo base_url();?>AdminLTE2/dist/img/suda.png" alt="User Image">
       </div><!-- /.login-logo -->
      <div class="login-logo">
        <a>科协管理平台</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">[重要!]请不要使用IE8浏览器及以下，如果没有请下载<b>谷歌浏览器</b></p>
        <form action="<?php echo base_url();?>index.php/login/check_login" method="post">
          <div class="form-group has-feedback">
            <!--<input type="email" name="user" class="form-control" placeholder="Email">-->
            <input name="users_id" class="form-control" placeholder="用户名(学号)">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="pswd" class="form-control" placeholder="密码">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-7">
              <div class="form-group has-feedback">
                <input name="captcha" class="form-control" placeholder="验证码">
              </div>
            </div>
            <div class="col-xs-5">
                <a href=""><img id="captcha_img" border="0px" src="<?php echo site_url('login/captcha')?>?r=<?php echo (int)rand()*10000;?>" width="115px" height="35px" />
                <!-- <a href=""><?php echo $pic;?></a> -->
                </a>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <!-- <input type="checkbox"> Remember Me -->
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
            </div><!-- /.col -->
          </div>
        </form>
        <p style="color: red;"><?php echo $error;?></p>
        <a href="<?php echo site_url('register/register');?>" class="text-center">Register a new membership</a><br/>
        <a href="<?php echo site_url('register/forget_ps');?>" class="text-center">Forgot password</a><br/>
        <a href="<?php echo site_url('select');?>" class="text-center">Choose the way to log in</a>
        <div class="social-auth-links text-center">
          <strong>Copyright &copy; 2016 <a href="http://scst.suda.edu.cn" target="_blank">计算机科学与技术学院</a>.</strong> All rights reserved.
        </div>
        <!-- <p><?php echo $error;?></p> -->
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <footer>
      <!-- To the right -->
      
    </footer>
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
