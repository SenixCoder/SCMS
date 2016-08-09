<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/timepicker/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/fullcalendar/fullcalendar.print.css" media="print">
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/datepicker/datepicker3.css">
<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">分配任务</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" action="<?php echo base_url();?>index.php/organization/add_task" method="post">
					<div class="form-group">
		          		<label>部门</label>
				  		<?php echo form_error('department_id'); ?>
				  		<select name="department_id" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($depart as $row) { 
					  			if($row->id == $this->session->userdata('isAdmin')){
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
				  		<?php echo form_error('activity_id'); ?>
				  		<select name="activity_id" class="form-control select2" style="width: 100%;">
					  		<?php if(is_array($activity)||is_object($activity))
      							{
      								foreach ($activity as $row) {
      									?>
					  			<option value="<?php echo $row->id;?>">【<?php echo $row->department_name;?>】<?php echo $row->activity_name;?>
						  		</option>
				  			<?php }}?>
				  		</select>
				  	</div>
			    	<div class="form-group">
		          		<label>分配任务者</label>
				  		<?php echo form_error('task_fp'); ?>
				  		<input name="task_fp" type="text" class="form-control" value="<?php echo $this->session->userdata('front_name')?>" readonly/>
				  	</div>
			    	<div class="form-group">
		          		<label>执行任务者</label>
				  		<?php echo form_error('task_js'); ?>
				  		<select name="task_js" class="form-control select2" style="width: 100%;">
					  		<?php if(is_array($user)||is_object($user))
      							{
					  			foreach ($user as $row) {?>
					  			<option value="<?php echo $row->stu_id;?>"><?php echo $row->stu_name;?>
						  		</option>
				  			<?php }}?>
				  		</select>
			    	</div>
			    	<div class="form-group">
		                  <label>任务结束日期</label>
		                  <?php echo form_error('task_date'); ?>
		                  <div id='pick_date' class="input-group">
		                  <div class="input-group-addon">
		                    <i class="fa fa-calendar"></i>
		                  </div>
		                  <input id="date" name="task_date" type="text" value="" class="form-control datepicker" required='required'>
		                </div>
                    </div>
                    <div class="bootstrap-timepicker">
	                  <div class="form-group">
						<label>任务结束时间</label>
	                    <?php echo form_error('task_endtime'); ?>
						<input name="task_endtime" type="text" class="form-control timepicker">
					  </div>
				    </div>
			    	<div class="form-group">
		          		<label>任务备注</label>
				  		<?php echo form_error('task_name'); ?>
				  		<input type="text" class="form-control" name="task_name" value="<?php echo set_value('task_name'); ?>">
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

<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url() ?>AdminLTE2/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url() ?>AdminLTE2/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url() ?>AdminLTE2/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>AdminLTE2/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>AdminLTE2/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- Page script -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
<script>
    $(".timepicker").timepicker({
	showMeridian: false,
	showInputs: false,
	showSeconds: false,
	});

//set the time manually
	$('.timepicker').timepicker('setTime', '8:00');
	$("[data-mask]").inputmask();
	$("#date").remove();
  	$('#pick_date').append('<input id="date" name="task_date" type="text" value="" class="form-control datepicker" required=\'required\'>');
    $(".datepicker").datepicker({
      language: "zh-CN",
      format: "yyyy-mm-dd",
      showInputs: false,
      autoclose: true,
      todayHighlight: true,
      weekStart:0,
    });
</script>