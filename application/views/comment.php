<div class="row">
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"></h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<div class="box-body">
				<form role="form" action="<?php echo base_url();?>index.php/organization/save_comment" method="post">
			        <div class="form-group">
			          <label>评论内容</label>
					  <?php echo form_error('comments'); ?>
					  <textarea name="comments" class="form-control" value="<?php echo set_value('comments'); ?>" rows="5" cols="80" >
			           </textarea>
			        </div>
					
				</div><!-- /.box-body -->
				<p style="color: red;"><?php echo $error;?></p>
				<div class="box-footer">
				<button type="submit" class="btn btn-info pull-right">提交</button>
				</form>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->
	</div>
</div>