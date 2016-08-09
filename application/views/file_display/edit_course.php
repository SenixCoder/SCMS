<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" action="<?php echo base_url();?>index.php/file_display/save_course" method="post">
				<?php foreach ($course as $row) {?>
					<div class="form-group">
			          <input name="course_id" type="hidden" class="form-control" value="<?php echo $row->id;?>">
			      	</div>
					<div class="form-group">
			          <label>学期</label>
			          <?php echo form_error('grade'); ?>
			          <select name="grade" class="form-control select2" style="width: 100%;">
			          <?php foreach($grades as $grade){
			          		if($grade->id == $row->grade_id){?>
			            		<option value="<?php echo $grade->id;?>" selected="selected"><?php echo $grade->name;?></option>
			            	<?php } else { ?>
			            	<option value="<?php echo $grade->id;?>"><?php echo $grade->name;?></option>
			          <?php }}?>
			          </select>
			      </div>
			      <div class="form-group">
			          <label>科目</label>
			          <?php echo form_error('course'); ?>
			          <input name="course" type="text" class="form-control" value="<?php echo $row->term;?>">
			      </div>
			     <?php }?>
				<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right">修改</button>
				</form>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>