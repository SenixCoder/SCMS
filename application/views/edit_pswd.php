<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>科协&&学习资料分享| Registration Page</title>
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
          <a>修改密码</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">[重要!]请不要使用IE8浏览器及以下，如果没有请下载<b>谷歌浏览器</b></p>
        <form action="<?php echo base_url();?>index.php/register/check_pswd" method="post">
            <div class="form-group has-feedback">
              <input type="text" class="form-control" name="captcha" placeholder="输入您在邮箱中收到的验证码" required="required" />
            </div>
          <div class="form-group has-feedback">
            <?php echo form_error('users_id'); ?>
            <input name="users_id" type="text" class="form-control" value="<?php echo $username;?>" placeholder="用户名(学号)" readonly>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback">
              <input type="password" name="pswd"class="form-control" placeholder="新的密码" required="required"/>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <p style="color: red;"><?php echo $error;?></p>
          <div class="row">
            <div class="col-xs-8">
              <!-- <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> I agree to the <a href="#">terms</a>
                </label>
              </div> -->
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">修改</button>
            </div><!-- /.col -->
          </div>
        </form>
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
