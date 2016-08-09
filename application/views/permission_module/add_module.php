
<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form method="post" action="<?php echo site_url('permission/save_module');?>" class="pageForm required-validate">
					<div class="form-group">
						<label>模块名称：</label>
						<input name="title" class="form-control" type="text" value="<?php echo set_value('title');?>" placeholder="请输入模块名称"/>
					</div>
					<div class="form-group">
						<label>模块代码：</label>
						<input name="code" class="form-control" type="text" value="<?php echo set_value('code');?>" placeholder="请输入模块代码"/>
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