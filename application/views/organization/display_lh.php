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
      <th>部门</th>
      <th>文件名</th>
      <th>文件大小</th>
      <th>上传时间</th>
      <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(is_array($depart)||is_object($depart))
      {
          foreach ($depart as $row)
          {
          ?>
        <tr>
          <td>
            <?php echo $row->department_name; ?></td>
          <td><?php echo $row->name; ?></td>
          <td><?php echo $row->size; ?></td>
          <td><?php echo $row->time; ?></td>
          <td><a href="<?php echo site_url('organization/down_lh');?>/<?php echo $row->id?>" title="下载"><span class="glyphicon glyphicon-download-alt"></span></a>
          <?php if($this->session->userdata('isAdmin') == $row->department_id){?>
          |<a href="<?php echo site_url('organization/delete_lh');?>/<?php echo $row->id?>" title="delete"><span class="glyphicon glyphicon-trash"></span></a>
          <?php }?>
          </td>
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