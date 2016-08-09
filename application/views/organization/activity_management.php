<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?php echo $title?></h3><br/>
		<a href="<?php echo site_url('organization/add_activity_link')?>">发布活动</a>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>发布活动者</th>
			<th>活动所属部门</th>
			<th>活动名称</th>
			<th>活动地点</th>
			<th>活动预计经费</th>
			<th>活动实际经费</th>
			<th>活动时间</th>
			<th>操作</th>
			<th>评论</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($activity_data)||is_object($activity_data))
	      		{ 
				foreach ($activity_data as $row)
				{
			?>
				<tr>
				<td><?php echo $row->stu_name ;?></td>
				<td>
					<?php echo $row->department_name; ?>
				</td>
				<td>
					<?php echo $row->activity_name; ?>
				</td>
				<td>
					<?php echo $row->address; ?>
				</td>
				<td>
					<?php echo $row->activity_gj_money; ?>
				</td>
				<td>
					<?php echo $row->activity_sj_money; ?>
				</td>
				<td>
					<?php echo $row->time; ?>
				</td>
				<td><?php if((($this->session->userdata('front_name') == $row->stu_name))||($this->session->userdata('isAdmin') == 0)||($this->session->userdata('isAdmin') == 8)){?><a href="<?php echo site_url('organization/edit_activity_link');?>/<?php echo $row->id;?>" >修改</a>
				<?php }?>
				</td>
				<td>
					<a href="<?php echo site_url('organization/comment_management');?>/<?php echo $row->id;?>">查看评论详情</a>
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