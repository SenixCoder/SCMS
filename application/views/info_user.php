<section class="content">
	<div class="row">
	<div class="col-md-12">
	
		<!-- Profile Image -->
		<div class="box box-primary">
		<div class="box-body box-profile">
			<img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>AdminLTE2/dist/img/<?php echo $this->session->userdata('photo_name') ?>" alt="User profile picture">
			<h3 class="profile-username text-center"><?php echo $this->session->userdata('front_name') ?></h3>
			<!--<p class="text-muted text-center">Software Engineer</p>-->
			<a href="<?php echo site_url('user/change_password_link')?>">修改密码</a>
			<?php foreach ($person as $key) {?>
			<ul class="list-group list-group-unbordered">
			<li class="list-group-item">
				<b>登陆次数</b> <span class="pull-right"><?php echo $key->count;?> </span>
			</li>
			<li class="list-group-item">
				<b>最后登录时间</b> <span class="pull-right"><?php echo $key->time;?> </span>
			</li>
			<?php }?>
			<?php foreach ($file_num as $row) {?>
			<li class="list-group-item">
				<b>下载资料次数</b> <span class="pull-right"><?php echo $row->count;?></span>
			</li>
			<li class="list-group-item">
				<b>最后下载资料时间</b> <span class="pull-right"><?php echo $row->time;?></span>
			</li>
			<?php }?>
			<!-- <li class="list-group-item">
				<b>Friends</b> <a class="pull-right">13,287</a>
			</li> -->
			</ul>
	
			<!--<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>-->
		</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->