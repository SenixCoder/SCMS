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
					<div class="form-group">
		          		<label>部门</label>
				  		<?php echo form_error('depart_ment_id'); ?>
				  		<select name="depart_ment_id" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($depart as $row) { 
					  			if($this->session->userdata('isAdmin') == $row->id){
					  		?>
					  			<option value="<?php echo $row->id;?>" selected="selected"><?php echo $row->department_name;?>
					  			</option>
					  		<?php }else{;?>
					  			<option value="<?php echo $row->id;?>"><?php echo $row->department_name;?>
				  			<?php } }?>
				  		</select>
			    	</div>
				    <div class="form-group">
			          <label>职位</label>
					  <?php echo form_error('user_position'); ?>
		          	  <!--<input name="role" type="text" class="form-control" value="<?php echo set_value('role'); ?>" placeholder="Enter ...">-->
					  <select name="user_position" class="form-control">
                        <option value="10" <?php echo set_select('user_position', '10'); ?>>部长</option>
                        <option value="9" <?php echo set_select('user_position', '9', TRUE); ?>>干事</option>
                      </select>
				    </div>
				    <div class="form-group">
			          <label>班级</label>
					  <?php echo form_error('user_class'); ?>
		          	  <!--<input name="role" type="text" class="form-control" value="<?php echo set_value('role'); ?>" placeholder="Enter ...">-->
					  <select name="user_class" class="form-control">
                        <option value="30" <?php echo set_select('user_class', '30', TRUE); ?>>软件工程嵌入式</option>
                        <option value="40" <?php echo set_select('user_class', '40'); ?>>网络工程班</option>
                        <option value="50" <?php echo set_select('user_class', '50'); ?>>计算机班</option>
                        <option value="60" <?php echo set_select('user_class', '60'); ?>>软件工程班</option>
                        <option value="70" <?php echo set_select('user_class', '70'); ?>>物联网班</option>
                        <option value="80" <?php echo set_select('user_class', '80'); ?>>信息管理班</option>
                      </select>
				    </div>
					<div class="form-group">
			          <label>学号(用于登录)</label>
					  <?php echo form_error('users_id'); ?>
		          	  <input name="users_id" type="text" class="form-control" value="<?php echo set_value('users_id'); ?>" placeholder="Enter ...">
				    </div>
			        <div class="form-group">
			          <label>密码</label>
					  <?php echo form_error('pswd'); ?>
			          <input name="pswd" type="password" class="form-control" value="<?php echo set_value('pswd'); ?>" placeholder="Enter ...">
			        </div>
			        <div class="form-group">
			          <label>姓名</label>
					  <?php echo form_error('user_name'); ?>
			          <input name="user_name" type="text" class="form-control" value="<?php echo set_value('user_name'); ?>" placeholder="Enter ...">
			        </div>
			        <div class="form-group">
			          <label>手机号码</label>
					  <?php echo form_error('mobile_phone'); ?>
			          <input name="mobile_phone" type="text" class="form-control" value="<?php echo set_value('mobile_phone'); ?>" placeholder="Enter ...">
			        </div>
			        <div class="form-group">
			          <label>邮箱</label>
					  <?php echo form_error('user_email'); ?>
			          <input name="user_email" type="text" class="form-control" value="<?php echo set_value('user_email'); ?>" placeholder="Enter ...">
			        </div>
					
				</div><!-- /.box-body -->
				<p style="color: red;"><?php echo $error;?></p>
				<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right">添加</button>
				</form>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>