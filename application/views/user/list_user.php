<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
		<a class="add" href="<?php echo site_url('permission/add_user')?>"><span>添加用户</span></a>
	</div>

	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>用户名</th>
				<th>真实姓名</th>
				<th>email</th>
				<th>建档时间</th>
				<th>更新时间</th>
				<th>修改用户信息</th>
				<th>修改权限</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($list as $module):
					if($module->username == 'root')
						continue;
			?>
			<tr rel="<?php echo $module->id;?>">
				<td><?php echo $module->username;?></td>
				<td><?php echo $module->real_name;?></td>
				<td><?php echo $module->email;?></td>
				<td><?php echo $module->add_time;?></td>
				<td><?php echo $module->update_time;?></td>
				<td><a href="<?php echo site_url('permission/edit_user')?>/<?php echo $module->id?>">修改</a></td>
				<td><a href="<?php echo site_url('permission/user_perm')?>/<?php echo $module->id?>">修改</a></td>
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