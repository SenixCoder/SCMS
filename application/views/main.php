<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>科协管理平台</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/offline/font-awesome-4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/offline/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <!--dont move to end of file, as it is required-->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>AdminLTE2/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>AdminLTE2/dist/js/app.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">科协管理平台</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">number</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">header</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                            header 4
                            <small><i class="fa fa-clock-o"></i>time</small>
                          </h4>
                          <!-- The message -->
                          <p>main content</p>
                        </a>
                      </li><!-- end message -->
                    </ul><!-- /.menu -->
                  </li>
                  <!--<li class="footer"><a href="#">See All Messages</a></li>-->
                </ul>
              </li><!-- /.messages-menu -->
              
             <!--warning here-->
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo base_url();?>AdminLTE2/dist/img/<?php echo $this->session->userdata('photo_name');?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $this->session->userdata('front_name') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo base_url();?>AdminLTE2/dist/img/<?php echo $this->session->userdata('photo_name');?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $this->session->userdata('front_name') ?>
                      <!--<small>Member since Nov. 2012</small>-->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--<li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url('welcome/info_user') ?>" class="btn btn-default btn-flat">账户信息</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url('login/login_out') ?>" class="btn btn-default btn-flat">退出</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <a class="img-circle" href="<?php echo base_url();?>AdminLTE2/dist/img/<?php echo $this->session->userdata('photo_name');?>" target="_blank"><img width="45px" height="60.75px" src="<?php echo base_url();?>AdminLTE2/dist/img/<?php echo $this->session->userdata('photo_name');?>" class="img-circle" alt="User Image" title="查看头像"></a>
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('front_name') ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <!--
          1.change the <span>name</span>
          2.change the link url！！！
          3.go to controller to add welcome/[function]
          4.if data needed, load model and use
          5.edit $data['url'] var which link to view
          -->
          <ul class="sidebar-menu">
            <li class="header">菜单</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="<?php echo site_url('welcome') ?>"><i class="fa fa-link"></i> <span>状态概要</span></a></li>
            <li><a href="<?php echo site_url('welcome/dispatch') ?>"><i class="fa fa-link"></i> <span>活动策划</span></a></li>
            <li><a href="<?php echo site_url('welcome/wechat') ?>"><i class="fa fa-link"></i> <span>微信推送</span></a></li>
            <li><a href="<?php echo site_url('welcome/info_organization_information') ?>"><i class="fa fa-link"></i> <span>科协各部门信息概览</span></a></li>
            
            <li><a href="<?php echo site_url('welcome/display_old') ?>"><i class="fa fa-link"></i> <span>科协前人信息概览</span></a></li>
            <li><a href="<?php echo site_url('file_display/display_file')?>"><i class="fa fa-link"></i> <span>学习资料</span></a></li>

            <li><a href="<?php echo site_url('organization/display_organization')?>"><i class="fa fa-link"></i> <span>科技协会</span></a></li>
            <!-- Optionally, you can add icons to the links --><!-- 
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>科技协会</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('organization/add_file_link')?>">添加例会资料</a></li>
                    <li><a href="<?php echo site_url('organization/activity_management')?>">活动总览</a></li>
                    <?php if(($this->session->userdata('front_position') == 10)||($this->session->userdata('isAdmin') == 0)||($this->session->userdata('isAdmin') == 8)){?>
                    <li><a href="<?php echo site_url('organization/add_task_link')?>">分配任务</a></li>
                    <?php } ?>
                    <li class="treeview">
                        <a href="#"><span>理事会</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                              <a href="<?php echo site_url('organization/display_depart_user/1')?>">理事会人员信息</a>
                            </li>
                            <?php if(($this->session->userdata('isAdmin') == 0)||($this->session->userdata('isAdmin') == 8)){?>
                            <li>
                              <a href="<?php echo site_url('organization/display_all_lh')?>">科协例会资料</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/approve_activity')?>">活动审批</a>
                            </li>
                            <?php };?>
                          </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><span>办公室</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                              <a href="<?php echo site_url('organization/display_depart_user/1')?>">办公室人员信息</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_lh/1')?>">办公室例会资料</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_task/1')?>">办公室任务分配信息</a>
                            </li>
                          </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><span>外联部</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                              <a href="<?php echo site_url('organization/display_depart_user/2')?>">外联部人员信息</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_lh/2')?>">外联部例会资料</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_task/2')?>">外联部任务分配信息</a>
                            </li>
                          </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><span>活动部</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                              <a href="<?php echo site_url('organization/display_depart_user/3')?>">活动部人员信息</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_lh/3')?>">活动部例会资料</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_task/3')?>">活动部任务分配信息</a>
                            </li>
                          </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><span>图文中心</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                              <a href="<?php echo site_url('organization/display_depart_user/4')?>">图文中心人员信息</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_lh/4')?>">图文中心例会资料</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_task/4')?>">图文中心任务分配信息</a>
                            </li>
                          </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><span>宣传部</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                              <a href="<?php echo site_url('organization/display_depart_user/5')?>">宣传部人员信息</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_lh/5')?>">宣传部例会资料</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_task/5')?>">宣传部任务分配信息</a>
                            </li>
                          </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><span>科研部</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                              <a href="<?php echo site_url('organization/display_depart_user/6')?>">科研部人员信息</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_lh/6')?>">科研部例会资料</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_task/6')?>">科研部任务分配信息</a>
                            </li>
                          </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><span>项目部</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                              <a href="<?php echo site_url('organization/display_depart_user/7')?>">项目部人员信息</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_lh/7')?>">项目部例会资料</a>
                            </li>
                            <li>
                              <a href="<?php echo site_url('organization/display_task/7')?>">项目部任务分配信息</a>
                            </li>
                          </ul>
                    </li>

                 </ul>
              </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>学习资料</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo site_url('upload/add_file_link')?>">添加资料</a></li>
                  <li class="treeview">
                    <a href="#"><span>大一上</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('upload/display/1')?>">高等数学上</a></li>
                      <li><a href="<?php echo site_url('upload/display/2')?>">大学英语一</a></li>
                      <li><a href="<?php echo site_url('upload/display/3')?>">线性代数</a></li>
                      <li><a href="<?php echo site_url('upload/display/4')?>">C语言程序设计</a></li>
                      <li><a href="<?php echo site_url('upload/display/5')?>">计算机导论</a></li>
                    </ul>
                  </li>
                  <li class="treeview">
                    <a href="#"><span>大一下</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('upload/display/6')?>">高等数学下</a></li>
                      <li><a href="<?php echo site_url('upload/display/7')?>">大学英语二</a></li>
                      <li><a href="<?php echo site_url('upload/display/8')?>">概率论</a></li>
                      <li><a href="<?php echo site_url('upload/display/9')?>">C++</a></li>
                    </ul>
                  </li>
                  <li class="treeview">
                    <a href="#"><span>大二上</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('upload/display/10')?>">离散数学</a></li>
                      <li><a href="<?php echo site_url('upload/display/11')?>">软件工程</a></li>
                      <li><a href="<?php echo site_url('upload/display/12')?>">大学英语三</a></li>
                      <li><a href="<?php echo site_url('upload/display/13')?>">Java</a></li>
                      <li><a href="<?php echo site_url('upload/display/14')?>">数据库原理与设计</a></li>
                    </ul>
                  </li>
                  <li class="treeview">
                    <a href="#"><span>大二下</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('upload/display/15')?>">web应用开发</a></li>
                      <li><a href="<?php echo site_url('upload/display/16')?>">数据结构</a></li>
                      <li><a href="<?php echo site_url('upload/display/17')?>">大学英语四</a></li>
                      <li><a href="<?php echo site_url('upload/display/18')?>">计算机通信与网络</a></li>
                      <li><a href="<?php echo site_url('upload/display/19')?>">汇编语言程序设计</a></li>
                    </ul>
                  </li>
                </ul>
              </li> -->
            <li><a href="<?php echo site_url('organization/list_my_task') ?>/<?php echo $this->session->userdata('front_id');?>"><i class="fa fa-link"></i> <span>个人任务汇总</span></a></li>
            <li><a href="<?php echo site_url('welcome/notice') ?>"><i class="fa fa-link"></i> <span>联系我们</span></a></li>
            <li><a href="<?php echo site_url('welcome/info_user') ?>"><i class="fa fa-link"></i> <span>账户管理</span></a></li>
            <li><a href="<?php echo site_url('welcome/profile') ?>"><i class="fa fa-link"></i> <span>说说</span></a></li>
            <!-- <li><a href="<?php echo site_url('welcome/test') ?>"><i class="fa fa-link"></i> <span>测试弹出框</span></a></li> -->
            <!-- <li><a href="<?php echo site_url('welcome/comment') ?>"><i class="fa fa-link"></i> <span>我的讨论</span></a></li> -->
            
            <?php if($this->session->userdata('isAdmin') == 0): ?>
              <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>系统管理</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo site_url('user/user')?>">用户信息管理</a></li>
                  <li><a href="<?php echo site_url('permission/module')?>">Model管理</a></li>
                  <li><a href="<?php echo site_url('permission/action')?>">功能管理</a></li>
                  <li><a href="<?php echo site_url('permission/role')?>">角色管理</a></li>
                  <!-- <li><a href="<?php echo site_url('permission/user')?>">用户管理</a></li>
                  <li><a href="<?php echo site_url('log/list_log')?>">操作日志</a></li> -->
                </ul>
              </li>
            <?php endif; ?>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title ?>
            <small></small>
          </h1>
          <!--<ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>-->
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <?php $this->load->view($url);?>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <a href="<?php echo site_url('welcome/notice');?>">建议反馈</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="https://github.com/orgs/SKLCC-PHP">sklcc341</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
  </body>
</html>
