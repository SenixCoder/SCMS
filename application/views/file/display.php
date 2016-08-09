<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
  <div class="box-header">
    <h3 class="box-title"><?php echo $title;?></h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
      <th>上传者</th>
      <th>文件名</th>
      <th>文件大小</th>
      <th>上传时间</th>
      <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($file_data)||is_object($file_data))
      {
          foreach ($file_data as $row)
          {
          ?>
        <tr>
          <td><?php echo $row->user_id ;?></td>
          <td><?php echo $row->name ;?></td>
          <td><?php echo $row->size ;?></td>
          <td><?php echo $row->time ;?></td>
          <td><a href="<?php echo site_url('file/download_file').'/'.$row->id;?>" title="下载" ><span class="glyphicon glyphicon-download-alt"></span></a></td>
        </tr>
      <?php
      }}
      ?>
    </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->

<!-- DataTables -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
$('#example1').DataTable({
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  "order": [[ 1, "desc" ]]
});
</script>