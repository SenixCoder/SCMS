<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $title;?></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<p style="color: red;"><?php echo $error;?></p>
				<p style="color: red;"><?php echo form_open_multipart('user/do_upload');?></p>
					<div class="form-group">
						<p style="color:red">图片仅为jpg格式</p>
		          		<input type="hidden" name="user_id" value="<?php echo $ids;?>"/>
			    	</div>
				</div><!-- /.box-body -->

				<div class="box-footer">
					<input type="file" name="userfile" size="20" />
					<input type="submit" value="上传头像" class="btn btn-info pull-right" />
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>