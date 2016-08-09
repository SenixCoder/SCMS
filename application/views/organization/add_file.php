<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">添加例会资料</h3><br>
				<div style="color: red;">如上传失败，请缩短文档名git|jpg|png|doc|docx|zip|rar|xlsx|ppt|xls|pdf</div>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<p style="color: red;"><?php echo $error;?></p>
				<p style="color: red;"><?php echo form_open_multipart('organization/do_upload');?></p>
					<div class="form-group">
		          		<label>部门</label>
				  		<?php echo form_error('department_id'); ?>
				  		<select name="department_id" class="form-control select2" style="width: 100%;">
					  		<?php foreach ($depart as $row) { ?>
					  			<option value="<?php echo $row->id;?>"><?php echo $row->department_name;?>
					  			</option>
				  			<?php }?>
				  		</select>
			    	</div>
				</div><!-- /.box-body -->

				<div class="box-footer">
					<input type="file" name="userfile" size="20" />
					<input type="submit" value="upload" class="btn btn-info pull-right" />
				</form>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>