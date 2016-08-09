<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?php echo $title;?></h3><br/>
		<p style="color: red;"><?php echo $error;?></p>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>部门名称</th>
			<th>活动名称</th>
			<th>分配任务者</th>
			<th>执行任务者</th>
			<th>任务名称</th>
			<th>任务开始时间</th>
			<th>任务结束时间</th>
			<th>完成时间</th>
			<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($task)||is_object($task))
      		{
				foreach ($task as $row)
				{
				?>
				<tr>
				<td>
					<?php echo $row->department_name; ?>
				</td>
				<td>
					<?php echo $row->activity_name; ?>
				</td>
				<td><?php echo $row->task_fp ;?></td>
				<td><?php echo $row->stu_name ;?></td>
				<td><?php echo $row->task_name ;?></td>
				<td><?php echo $row->activity_starttime ;?></td>
				<td><?php echo $row->activity_endtime ;?></td>
				<td><?php echo $row->time ;?></td>
				<td><?php
						if($row->time==NULL){
							if($this->session->userdata('front_name') == $row->stu_name){
					?>
						<a href="<?php echo site_url('organization/finish_my_task')?>/<?php echo $row->id;?>">完成任务</a>
						<?php }} else if($row->time!=NULL){?>
							已完成
					<?php }?>
				</td>
				</tr>
			<?php
			} }
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
		"order": [[ 6, "asc" ]]
	});
</script>