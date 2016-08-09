<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
		<a class="add" href="<?php echo site_url('permission/add_action')?>" title="添加模块"><span>添加功能</span></a>
	</div>
	<!-- <div class="box-body">
		<ul class="toolBar">
			<li><a class="add" href="<?php echo site_url('permission/add_module')?>" target="dialog" rel="add_module" title="添加模块"><span>添加</span></a></li>
			<li><a class="edit" href="<?php echo site_url('permission/edit_module')?>/{module_id}" target="dialog" warn="请选择一个模块" title="修改模块"><span>修改</span></a></li>
			<li><a class="delete" href="<?php echo site_url('permission/delete_module')?>/{module_id}" target="ajaxTodo" title="确定要删除吗？" warn="请选择一个模块"><span>删除</span></a></li>
		</ul>
	</div> -->

	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>所属模块</th>
				<th>功能</th>
				<th>动作</th>
				<th>代码</th>
				<th>建档时间</th>
				<th>更新时间</th>
				<th>修改</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($list as $module):?>
			<tr>
				<td><?php echo $module->perm_module_id;?></td>
				<td><?php echo $module->perm_subject;?></td>
				<td><?php echo $module->perm_name;?></td>
				<td><?php echo $module->perm_key;?></td>
				<td><?php echo $module->add_time;?></td>
				<td><?php echo $module->update_time;?></td>
				<td><a href="<?php echo site_url('permission/edit_action')?>/<?php echo $module->id?>">修改</a></td>
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