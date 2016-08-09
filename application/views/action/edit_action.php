
<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<?php foreach ($list as $row) {
				?>
				<form method="post" action="<?php echo site_url('permission/save_action');?>" class="pageForm required-validate">
					<input type="hidden" name="id" value="<?php echo $row->id;?>" />
					<div class="form-group">
							<label>选择模块：</label>
							<select name="perm_module_id" class="form-control">
								<?php foreach($modules as $module):?>
								<option value="<?php echo $module->id;?>" <?php echo $module->id==$row->perm_module_id?'selected="selected"':'';?>><?php echo $module->title;?>【<?php echo $module->code;?>】</option>
								<?php endforeach;?>
							</select>
					</div>
					<div class="form-group">
							<label>功能：</label>
							<input name="perm_subject" class="form-control" type="text" value="<?php echo $row->perm_subject;?>"/>
					</div>
					<div class="form-group">
							<label>动作：</label>
							<input name="order_no" value="<?php echo $row->order_no?>" type="hidden" />
							<input class="form-control" name="perm_name" type="text" suggestFields="perm_name" value="<?php echo $row->perm_name?>" suggestUrl="<?php echo site_url('permission/hack_perm_action');?>" lookupPk="order_no" />
					</div>
					<div class="form-group">
							<label>代码：</label>
							<input name="perm_key" class="form-control" type="text" value="<?php echo $row->perm_key;?>"/>
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