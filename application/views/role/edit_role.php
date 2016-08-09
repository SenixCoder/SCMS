
<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<?php foreach ($list as $row) {
				?>
				<form method="post" action="<?php echo site_url('permission/save_role');?>" class="pageForm required-validate">
					<input type="hidden" name="id" value="<?php echo $row->id;?>" />
					<div class="form-group">
						<label>角色名称：</label>
						<input name="role_name" class="form-control" type="text" value="<?php echo $row->role_name;?>"/>
					</div>
					<div class="form-group">
						<label>简单描述：</label>
						<input name="description" class="form-control" type="text" value="<?php echo $row->description;?>"/>
					</div>
					<p style="color: red;"><?php echo $error;?></p>
					<div class="box-footer">
						<button type="submit" class="btn btn-info pull-right">保存</button>
						</form>
					</div>
				<?php };?>
			</div>	
		</div>
	</div>
</div>