<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3><br/>
		<p style="color: red;">超级管理员不显示</p>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>用户名</th>
			<th>真实姓名</th>
			<th>所在班级</th>
			<th>所在部门</th>
			<th>职位</th>
			<th>手机号码</th>
			<th>邮箱</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($user)||is_object($user))
      		{
				foreach ($user as $row)
				{
				?>
				<tr>
				<td><?php echo $row->stu_id;?></td>
				<td><a href="<?php echo site_url('welcome/display_person');?>/<?php echo $row->id;?>"><?php echo $row->stu_name;?></a></td>
				<td><?php echo $row->class_name;?></td>
				<td><?php echo $row->department_name;?></td>
				<td><?php echo $row->position_name;?></td>
				<td><?php echo $row->mobile;?></td>
				<td><?php echo $row->emails;?></td>
				</tr>
		<?php }}?>
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