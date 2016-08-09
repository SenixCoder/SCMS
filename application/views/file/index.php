<!-- meeting room info-->
<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
		<div class="box-header with-border">
			<i class="fa fa-text-width"></i>
			<h3 class="box-title">文件操作选项</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
			<a href="<?php echo site_url('file/add_file_page')?>">添加资料</a>
		    <div class="form-group">
          		<label>查找科目资料</label>
<!--  		  		<?php echo form_error('course'); ?>
		  		<?php form_open('file/display') ?> -->
			  		<select onchange='window.location=this.value' name="course" class="form-control select2" style="width: 80%;">
				  		<option value=''>请选择课程</option>
				  		<?php foreach ($course_data as $key) { ?>
				  			<option value="<?php echo site_url('file/display_files/'.$key->id);?>">
				  				<?php echo $key->course;?>
				  			</option>
			  			<?php }?>
			  		</select>
<!-- 				<div class="box-footer">
					<input type="submit" value="查找" class="btn btn-info pull-right" />
				</div>
				</form> -->
		    </div>
		</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- ./col -->
</div>
