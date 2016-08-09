<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title">角色权限设定</h3>
	</div>
	<div class="box-body">
		<form method="post" action="<?php echo site_url('permission/save_role_perm');?>" class="pageForm required-validate">
		    <input type="hidden" name="role_id" value="<?php echo $role_id;?>" />
		    <div class="form-group">
		    <?php 
		        // 循环模块
		        foreach($modules as $module):
		    ?>
				<fieldset>
			        <legend><?php echo $module->title;?></legend>
			        <?php 
			        //循环主题
			        foreach ($subjects as $subject):
			            //如果主题是该模块下的，则循环功能
			            if($subject->perm_module_id == $module->id):
			                //输出主题
			                echo '<label>' . $subject->perm_subject . ":</label>";
		        	        // 循环功能
		        	        foreach($actions as $action):
		            	        //判断是否是本主题的功能，仅输出本主题的功能
		            	        if($subject->perm_subject == $action->perm_subject):
		                	        //如果已经设定过权限，下面判断这个功能是否在过去设定过
		                	        if($perms):
			        ?>
			        <label><input type="checkbox" name="c1[]" value="<?php echo $action->id;?>" <?php echo in_array($action->id,$perms)?'checked="checked"':'';?> /><?php echo $action->perm_name;?></label>
			        <?php 
			                        else:
			        ?>
			        <label><input type="checkbox" name="c1[]" value="<?php echo $action->id;?>" /><?php echo $action->perm_name;?></label>
			        <?php 
			                        endif;
			                    endif;
			               // 循环功能结束 
			               endforeach;
			               echo '<div class="form-group"></div>';
			            endif;
			        // 循环主题结束
			        endforeach;
			        ?>
				</fieldset>
			<?php endforeach;?>
			</div>
			<div class="box-footer">
				<!-- <label style="float:left"><input type="checkbox" class="btn btn-info pull-right" group="c1[]" />全选 </label> -->
				<button type="submit" class="btn btn-info pull-right">提交</button>
			</div>
		</form>
	</div>
</div>