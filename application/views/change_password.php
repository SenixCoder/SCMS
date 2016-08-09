you can change password now!

<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" action="<?php echo base_url();?>index.php/user/change_password" method="post">
					<div class="form-group">
			          <label>原密码</label>
					  <?php echo form_error('pswd_origin'); ?>
		          	  <input name="pswd_origin" type="password" class="form-control" value="<?php echo set_value('pswd_origin'); ?>" placeholder="Enter ...">
				    </div>
			        <div class="form-group">
			          <label>密码</label>
					  <?php echo form_error('pswd'); ?>
			          <input name="pswd" type="password" class="form-control" value="<?php echo set_value('pswd'); ?>" placeholder="Enter ...">
			        </div>
			        <div class="form-group">
			          <label>确认密码</label>
					  <?php echo form_error('pswd_again'); ?>
			          <input name="pswd_again" type="password" class="form-control" value="<?php echo set_value('pswd_again'); ?>" placeholder="Enter ...">
			        </div>
				</div><!-- /.box-body -->

				<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right">修改</button>
				</form>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>