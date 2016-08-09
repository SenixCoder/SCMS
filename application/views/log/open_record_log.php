<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>日志时间</th>
			<th>卡号</th>
			<th>卡名</th>
			<th>会议室名称</th>
			<th>理由</th>
			<th>信息</th>
			<th>是否有权限</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($log_data as $row)
			{
			?>
			<tr>
			<td><?php echo $row->time?></td>
			<td><?php echo $row->card_identity ?></td>
			<td><?php echo $row->card_name ?></td>
			<td><?php echo $row->name ?></td>
			<td><?php echo $row->reason_no ?></td>
			<td><?php echo $row->info ?></td>
			<td><?php echo $row->has_permission ?></td>
			
			</tr>
			<?php
			}
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
	"ordering": false,
	"info": true,
	"autoWidth": false,
	"select": true
});
</script>


<!--http://datatables.net/extensions/tabletools/-->