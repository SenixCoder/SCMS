<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/timepicker/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/fullcalendar/fullcalendar.print.css" media="print">
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/datepicker/datepicker3.css">
<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">发布活动</h3>
				<div>
					<p style="color: red;">活动发布成功后，请等待理事会审核才能生效</p>
				</div>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" action="<?php echo base_url();?>index.php/organization/add_activity" method="post">
			    	<div class="form-group">
		          		<label>发布活动者</label>
				  		<?php echo form_error('activity_fp'); ?>
				  		<input name="activity_fp" type="text" class="form-control" value="<?php echo $this->session->userdata('front_name')?>" readonly/>
				  	</div>
					<div class="form-group">
		          		<label>活动所属部门</label>
				  		<?php echo form_error('department_id'); ?>
				  		<select name="department_id" class="form-control" style="width: 100%;">
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
				  		<?php echo form_error('activity_name'); ?>
				  		<input name="activity_name" type="text" class="form-control" value="<?php echo set_value('activity_name'); ?>"/>
				  	</div>
                  <div class="form-group">
                    <label>活动日期</label>
                    <?php echo form_error('activity_time'); ?>
                    <div id='pick_date' class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="date" name="activity_time" type="text" value="<?php var_dump($query_date);?>" class="form-control datepicker" required='required'>
                </div>
                  </div>
                  <div class="bootstrap-timepicker">
	                  <div class="form-group">
						<?php echo form_error('time_start'); ?>
						<label>活动开始时间</label>
						<input name="time_start" type="text" class="form-control timepicker">
					  </div>
				  </div>
                  <div class="form-group">
		          		<label>活动地点</label>
				  		<?php echo form_error('address'); ?>
				  		<input name="address" type="text" class="form-control" value="<?php echo set_value('address'); ?>"/>
				  	</div>
                  <div class="form-group">
		          		<label>活动预计经费</label>
				  		<?php echo form_error('activity_gj_money'); ?>
				  		<input name="activity_gj_money" type="text" class="form-control" value="<?php echo set_value('activity_gj_money'); ?>"/>
				  	</div>
				</div><!-- /.box-body -->
				<p style="color: red;"><?php echo $error;?></p>
				<div class="box-footer">
					<button type="submit" class="btn btn-info pull-right">申请活动</button>
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
  	$('#pick_date').append('<input id="date" name="activity_time" type="text" value="<?php echo $query_date;?>" class="form-control datepicker" required=\'required\'>');
    $(".datepicker").datepicker({
      language: "zh-CN",
      format: "yyyy-mm-dd",
      showInputs: false,
      autoclose: true,
      todayHighlight: true,
      weekStart:0,
    });
</script>