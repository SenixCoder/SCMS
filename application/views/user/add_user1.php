
<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form method="post" action="<?php echo site_url('permission/save_user');?>" class="pageForm required-validate">
					<div class="form-group">
							<label>角色名称：</label>
							<input name="role_name" class="form-control" type="text" value="<?php echo set_value('role_name');?>" placeholder="角色名称"/>
					</div>
					<div class="form-group">
							<label>角色名称：</label>
							<input name="role_name" class="form-control" type="text" value="<?php echo set_value('role_name');?>" placeholder="角色名称"/>
					</div>
					<div class="form-group">
							<label>角色名称：</label>
							<input name="role_name" class="form-control" type="text" value="<?php echo set_value('role_name');?>" placeholder="角色名称"/>
					</div>
					<div class="form-group">
							<label>角色名称：</label>
							<input name="role_name" class="form-control" type="text" value="<?php echo set_value('role_name');?>" placeholder="角色名称"/>
					</div>
					<div class="form-group">
							<label>简单描述：</label>
							<input class="form-control" name="description" value="<?php echo set_value('description');?>" placeholder="角色的用途等备注" />
					</div>
					<p style="color: red;"><?php echo $error;?></p>
					<div class="box-footer">
						<button type="submit" class="btn btn-info pull-right">保存</button>
						</form>
					</div>

			</div>	
		</div>
	</div>
</div>