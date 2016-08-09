<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">


<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?php echo $title;?></h3>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>用户名</th>
			<th>真实姓名</th>
			<th>所在班级</th>
			<th>所在部门</th>
			<th>手机号码</th>
			<th>邮箱</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($old_people)||is_object($old_people))
      		{
				foreach ($old_people as $row)
				{
				?>
				<tr>
				<td><?php echo $row->stu_id ;?></td>
				<td><?php echo $row->stu_name ;?></td>
				<td>
					<?php if($row->stu_class == 30) echo "软件工程嵌入式"; ?>
					<?php if($row->stu_class == 40) echo "网络工程班"; ?>
					<?php if($row->stu_class == 50) echo "计算机班"; ?>
					<?php if($row->stu_class == 60) echo "软件工程班"; ?>
					<?php if($row->stu_class == 70) echo "物联网班"; ?>
					<?php if($row->stu_class == 80) echo "信息管理班"; ?></td>
				<td>
					<?php echo $row->department_name; ?>
				</td>
				<td><?php echo $row->mobile ;?></td>
				<td><?php echo $row->emails ;?></td>
				</tr>
			<?php
			} }
			?>
		</tbody>
		<!--<tfoot>
			<tr>
			<th>Rendering engine</th>
			<th>Browser</th>
			<th>Platform(s)</th>
			<th>Engine version</th>
			<th>CSS grade</th>
			</tr>
		</tfoot>-->
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<!-- DataTables -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script>
$('#example1').DataTable({
	"paging": true,
	"lengthChange": true,
	"searching": true,
	"ordering": true,
	"info": true,
	"autoWidth": false,
	"select": true,
	"order": [[ 3, "asc" ]]
});
</script>