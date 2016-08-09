<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">添加资料</h3>
				<div style="color: red;">如上传失败，请缩短文档名，目前支持git|jpg|png|doc|docx|zip|rar|xlsx|ppt|xls|pdf</div>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<p style="color: red;"><?php echo $error;?></p>
				<p style="color: red;"><?php echo form_open_multipart('file/do_upload');?></p>
					<div class="form-group">
			          <label>姓名</label>
					  <?php echo form_error('user_name'); ?>
			          <input name="user_name" type="text" class="form-control" value="<?php echo $this->session->userdata('front_name') ?>" readonly/>
			        </div>
			        <div class="form-group">
		          		<label>学期</label>
				  		<?php echo form_error('grade'); ?>
				  		<select id="grade" name="grade" class="form-control select2" style="width: 100%;">
				  		<option value=""></option>
				  			<?php foreach ($grades as $grade) {?>
					  			<option value="<?php echo $grade->id;?>"><?php echo $grade->name;?>
					  			</option>
				  			<?php } ?>
				  		</select>
			    	</div>
				    <div class="form-group">
		          		<label>科目名称</label>
				  		<?php echo form_error('course'); ?>
				  		<select id="course" name="course" class="form-control select2" style="width: 100%;">
				  		</select>
			          <input name="user_id" type="text" style="display:none;" value="<?php echo $this->session->userdata('front_id') ?>" />
			        </div>
				</div><!-- /.box-body -->

				<div class="box-footer">
					<input type="file" name="userfile" size="20" />
					<input type="submit" value="上传" class="btn btn-info pull-right" />
				</form>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>
<script>
	//change html
	/*$('#grade').change(function(){
      var id = $('#grade').val();

      $.ajax({
        url: '<?php echo site_url("upload/get_course_by_grade");?>',
        method: "POST",
        data: {grade : id},
      }).done(function(i){
         $("#course").html(i);
      })
    });*/

    //ajax
    $("#grade").click(function(){
    	var id = $("#grade").val().trim();
    	$.ajax({
    		url:"<?php echo site_url('upload/get_course_by_grade');?>",
    		method:"POST",
    		data:{key : id}
    	}).done(function(i){
    		$("#course").empty();
    		$("#course").append(i);
    	})
    });
</script>
