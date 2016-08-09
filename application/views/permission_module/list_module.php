<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
		<a class="add" href="<?php echo site_url('permission/add_module')?>" title="添加模块"><span>添加模块</span></a>
	</div>

	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>模块名称</th>
				<th>模块代码</th>
				<th>建档时间</th>
				<th>更新时间</th>
				<th>修改</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list as $module):?>
			<tr>
				<td><?php echo $module->title;?></td>
				<td><?php echo $module->code;?></td>
				<td><?php echo $module->add_time;?></td>
				<td><?php echo $module->update_time;?></td>
				<td><a href="<?php echo site_url('permission/edit_module')?>/<?php echo $module->id?>">修改</a></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	</div>
</div>
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