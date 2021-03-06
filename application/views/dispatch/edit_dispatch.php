
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title?></h3>
        
        <div class="pull-right box-tools">
          <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
      <form role="form" action="<?php echo base_url();?>index.php/welcome/check_edit_dispatch/<?php echo $ids;?>" method="post">
      <?php foreach ($dispatch as $row) {?>
        <div class="form-group">
          <input type="text" class="form-control" name="subject" value="<?php echo $row->title;?>">
        </div>
        <div class="form-group">
            <textarea id="editor1" name="editor1" rows="10" cols="80">
            <?php echo $row->content;?>
            </textarea>
        </div>
      </div><!-- /.box-body -->
      <?php } ?>
      <p style="color: red;"><?php echo $error;?></p>
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right"><i class="fa fa-envelope-o"></i>提交</button>
        </form>
      </div><!-- /.box-footer -->
    </div><!-- /. box -->
  </div><!-- /.col -->
</div><!-- /.row -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>AdminLTE2/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
    $("#compose-textarea").wysihtml5();
  });
</script>
