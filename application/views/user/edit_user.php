<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" action="<?php echo base_url();?>index.php/permission/save_user" method="post">
				<?php foreach ($list as $row) {?>
					<div class="form-group">
					  <?php echo form_error('id'); ?>
			          <input name="id" type="hidden" class="form-control" value="<?php echo $row->id; ?>">
			        </div>
					
					<div class="form-group">
					  <?php echo form_error('users_id'); ?>
			          <input name="users_id" type="hidden" class="form-control" value="<?php echo $row->stu_id; ?>">
			        </div>
					<div class="form-group">
		          		<label>部门</label>
				  		<?php echo form_error('depart_ment_id'); ?>
				  		<select id="depart_ment_id" name="depart_ment_id" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($depart as $key) { ?>
					  		<?php if($key->id == $row->department_id){?>
					  			<option value="<?php echo $key->id;?>" selected="selected">
					  			<?php echo $key->department_name;?>
					  			</option>
					  		<?php } else {?>
					  			<option value="<?php echo $key->id;?>">
					  			<?php echo $key->department_name;?>
					  			</option>
				  			<?php }?>
				  		<?php }?>
				  		</select>
			    	</div>
			        <div class="form-group">
			          <label>职位</label>
					  <?php echo form_error('user_position'); ?>
		          	  <!--<input name="role" type="text" class="form-control" value="<?php echo set_value('role'); ?>" placeholder="Enter ...">-->
					  <select name="user_position" class="form-control">
                        <option value="9" <?php echo $row->stu_position == 9? 'selected' : '' ?>>干事</option>
                        <option value="10" <?php echo $row->stu_position == 10? 'selected' : '' ?>>部长</option>
                      </select>
				    </div>
				    <div class="form-group">
			          <label>姓名</label>
					  <?php echo form_error('user_name'); ?>
			          <input name="user_name" type="text" class="form-control" value="<?php echo $row->stu_name; ?>">
			        </div>
			        <div class="form-group">
			          <label>班级</label>
					  <?php echo form_error('user_class'); ?>
					  <select name="user_class" class="form-control">
                        <option value="30" <?php echo $row->stu_class == 30? 'selected' : '' ?>>软件工程嵌入式</option>
                        <option value="40" <?php echo $row->stu_class == 40? 'selected' : ''  ?>>网络工程班</option>
                        <option value="50" <?php echo $row->stu_class == 50? 'selected' : ''  ?>>计算机班</option>
                        <option value="60" <?php echo $row->stu_class == 60? 'selected' : ''  ?>>软件工程班</option>
                        <option value="70" <?php echo $row->stu_class == 70? 'selected' : ''  ?>>物联网班</option>
                        <option value="80" <?php echo $row->stu_class == 80? 'selected' : ''  ?>>信息管理班</option>
                      </select>
				    </div>
			        <div class="form-group">
			          <label>手机号码</label>
					  <?php echo form_error('mobile_phone'); ?>
			          <input name="mobile_phone" type="text" class="form-control" value="<?php echo $row->mobile; ?>">
			        </div>
			        <div class="form-group">
			          <label>邮箱</label>
					  <?php echo form_error('user_email'); ?>
			          <input name="user_email" type="text" class="form-control" value="<?php echo $row->emails; ?>">
			        </div>
					<?php }?>
				</div><!-- /.box-body -->
				<p style="color: red;"><?php echo $error;?></p>
				<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right">修改</button>
				</form>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>