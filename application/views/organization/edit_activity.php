<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo $title;?></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" action="<?php echo base_url();?>index.php/organization/edit_activity" method="post">
				<?php foreach ($activity as $act) {?>
					<div class="form-group">
				  		<?php echo form_error('hidden_id'); ?>
				  		<input name="hidden_id" type="hidden" class="form-control" value="<?php echo $act->id?>"/>
				  	</div>
			    	<div class="form-group">
		          		<label>发布活动者</label>
				  		<?php echo form_error('activity_fp'); ?>
				  		<input name="activity_fp" type="text" class="form-control" value="<?php echo $act->stu_name?>" readonly/>
				  	</div>
					<div class="form-group">
		          		<label>活动所属部门</label>
				  		<?php echo form_error('department_id'); ?>
				  		<select name="department_id" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($depart as $row) { 
					  			if($row->id == $act->department_id){
						  	?>
						  		<option value="<?php echo $row->id;?>" selected="selected"><?php echo $row->department_name;?>
						  		</option>
						  		<?php } if(0 == $this->session->userdata('isAdmin')){?>
						  		<option value="<?php echo $row->id;?>"><?php echo $row->department_name;?>
						  		</option>
				  			<?php } }?>
				  		</select>
			    	</div>
			    	<div class="form-group">
		          		<label>活动名称</label>
				  		<?php echo form_error('activity_name'); ?>
				  		<input name="activity_name" type="text" class="form-control" value="<?php echo $act->activity_name; ?>"/>
				  	</div>
				  	<div class="form-group">
	                    <label>活动时间:</label>
	                    <?php echo form_error('activity_time'); ?>
	                    <div class="input-group">
	                      <div class="input-group-addon">
	                        <i class="fa fa-calendar"></i>
	                      </div>
	                      <input type="text" name="activity_time" class="form-control pull-right" id="reservation" value="<?php echo $act->time;?>" />
	                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
                  <div class="form-group">
		          		<label>活动地点</label>
				  		<?php echo form_error('address'); ?>
				  		<input name="address" type="text" class="form-control" value="<?php echo $act->address;?>" />
				  	</div>
                  <div class="form-group">
		          		<label>活动实际经费</label>
				  		<?php echo form_error('activity_sj_money'); ?>
				  		<input name="activity_sj_money" type="text" class="form-control" value="<?php echo $act->activity_sj_money; ?>"/>
				  	</div>
                  <?php };?>
				</div><!-- /.box-body -->
				<p style="color: red;"><?php echo $error;?></p>
				<div class="box-footer">
					<button type="submit" class="btn btn-info pull-right">修改</button>
				</form>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>
<script src="<?php echo base_url();?>AdminLTE2/plugins/daterangepicker/daterangepicker.js"></script>
<script>
      $(function () {
      	$(".select2").select2();
        //Date range picker
        $('#reservation').daterangepicker();
      });
</script>