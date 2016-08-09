<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" action="<?php echo base_url();?>index.php/user/edit_my_user/<?php echo $ids;?>" method="post">
				<?php foreach ($user as $row) {?>
					<div class="form-group">
					  <?php echo form_error('hidden_id'); ?>
			          <input name="hidden_id" type="hidden" class="form-control" value="<?php echo $row->id; ?>">
			        </div>
					
			        <?php if(($this->session->userdata('front_position') == 10)||($this->session->userdata('isAdmin') == 0)){ ?>
					<div class="form-group">
		          		<label>部门</label>
				  		<?php echo form_error('depart_ment_id'); ?>
				  		<select id="depart_ment_id" name="depart_ment_id" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($depart as $key) { ?>
					  		<?php if($key->id == $row->department_id){?>
					  			<option value="<?php echo $key->id;?>" selected="selected">
					  			<?php echo $key->department_name;?>
					  			</option>
					  		<?php }else{?>
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
					  <select id="user_position" name="user_position" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($position as $k) { ?>
					  		<?php if($k->id == $row->stu_position){?>
					  			<option value="<?php echo $k->id;?>" selected="selected">
					  			<?php echo $k->position_name;?>
					  			</option>
					  		<?php }else{?>
					  			<option value="<?php echo $k->id;?>">
					  			<?php echo $k->position_name;?>
					  			</option>
				  			<?php }?>
				  		<?php }?>
				  		</select>
				    </div>
					<?php } else {?>
					<div class="form-group">
		          		<label>部门</label>
				  		<?php echo form_error('depart_ment_id'); ?>
				  		<select id="depart_ment_id" name="depart_ment_id" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($depart as $key) { ?>
					  		<?php if($key->id == $row->department_id){?>
					  			<option value="<?php echo $key->id;?>" selected="selected">
					  			<?php echo $key->department_name;?>
					  			</option>
					  		<?php }?>
				  		<?php }?>
				  		</select>
			    	</div>
			        <div class="form-group">
			          <label>职位</label>
					  <?php echo form_error('user_position'); ?>
					  <select id="user_position" name="user_position" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($position as $k) { ?>
					  		<?php if($k->id == $row->stu_position){?>
					  			<option value="<?php echo $k->id;?>" selected="selected">
					  			<?php echo $k->position_name;?>
					  			</option>
				  			<?php }?>
				  		<?php }?>
				  		</select>
				    </div>
					<?php };?>
					<div class="form-group">
			          <label>姓名</label>
					  <?php echo form_error('user_name'); ?>
			          <input name="user_name" type="text" class="form-control" value="<?php echo $row->stu_name; ?>">
			        </div>
			        <div class="form-group">
			          <label>班级</label>
					  <?php echo form_error('user_class'); ?>
					  <select id="user_class" name="user_class" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($class as $classes) { ?>
					  		<?php if($classes->id == $row->stu_class){?>
					  			<option value="<?php echo $classes->id;?>" selected="selected">
					  			<?php echo $classes->class_name;?>
					  			</option>
					  		<?php }else{?>
					  			<option value="<?php echo $classes->id;?>">
					  			<?php echo $classes->class_name;?>
					  			</option>
				  			<?php }?>
				  		<?php }?>
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