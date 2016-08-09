
<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<form method="post" action="<?php echo site_url('permission/save_action');?>" class="pageForm required-validate">
					<div class="form-group">
							<label>选择模块：</label>
							<select name="perm_module_id" class="form-control">
								<?php foreach($modules as $module):?>
								<option value="<?php echo $module->id;?>"><?php echo $module->title;?>【<?php echo $module->code;?>】</option>
								<?php endforeach;?>
							</select>
					</div>
					<div class="form-group">
							<label>功能：</label>
							<input name="perm_subject" class="form-control" type="text" value="<?php echo set_value('perm_subject');?>" placeholder="范例：用户设置"/>
					</div>
					<div class="form-group">
							<label>动作：</label>
							<input name="order_no" value="<?php echo set_value('order_no');?>" type="hidden" />
							<input class="form-control" name="perm_name" type="text" suggestFields="perm_name" suggestUrl="<?php echo site_url('permission/hack_perm_action');?>" lookupPk="order_no" />
					</div>
					<div class="form-group">
							<label>代码：</label>
							<input name="perm_key" class="form-control" type="text" value="<?php echo set_value('perm_key');?>" placeholder="范例：add_user"/>
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