<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
		<a href="<?php echo site_url('organization/add_comment');?>/<?php echo $ids;?>">添加评论</a>
		<!-- <button class="btn btn-primary" data-toggle="modal" data-target="#edit">修改用户</button> -->
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>评论者</th>
			<th>评论内容</th>
			<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if(is_array($list)||is_object($list))
			{
				foreach ($list as $row)
				{
			?>
				<tr>
				<td><?php echo $row->stu_name;?></td>
				<td><?php echo $row->topic;?></td>
				<td>
					<?php if($this->session->userdata('front_name') == $row->stu_name){ ?>
						<a href="<?php echo site_url('organization/delete_comment');?>/<?php echo $row->id;?>/<?php echo $row->activity_id?>" >删除评论</a>
					<?php }?>
				</td>
				</tr>
			<?php
			}}
			?>
		</tbody>
		</table>
	</div><!-- /.box-body -->
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