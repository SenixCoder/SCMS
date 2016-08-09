<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<!--modal-sm and modal-lg	-->
		<div class="modal-dialog modal-sm" role="document">
		  <div class="modal-content">
		    <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="exampleModalLabel">请确认</h4>
		    </div>
			<div class="modal-body">
				确认删除该记录吗？
			</div>
			<div class="modal-footer">
				<a class="btn btn-danger btn-ok">删除</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			</div>
		</div>
		</div>
	</div>
	<div class="box-header">
		<h3 class="box-title"></h3>
		<?php if(($this->session->userdata('isAdmin') == 8)||($this->session->userdata('isAdmin')==0)||($this->session->userdata('front_position') == 10)){?>
		<a class="add" href="<?php echo site_url('welcome/add_dispatch')?>" title="添加活动策划"><span>添加活动策划</span></a><?php };?><p style="color: red;"><?php echo $error;?></p>
	</div>

	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>标题</th>
				<th>上传时间</th>
				<th>更新时间</th>
				<th>上传者</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($dispatch)||is_object($dispatch))
      	{
			foreach ($dispatch as $module){?>
			<tr>
				<td><a href="<?php echo site_url('welcome/display_dispatch')?>/<?php echo $module->id;?>"><?php echo $module->title;?></a></td>
				<td><?php echo $module->create_time;?></td>
				<td><?php echo $module->update_time;?></td>
				<td><?php echo $module->stuID;?></td>
				<td>
				<?php if(($this->session->userdata('front_name') == $module->stuID)||$this->session->userdata('isAdmin')==0){?>
					<a href="<?php echo site_url('welcome/edit_dispatch')?>/<?php echo $module->id?>">修改</a>||<a href="#" data-href="<?php echo site_url('welcome/delete_dispatch')?>/<?php echo $module->id?>" data-toggle="modal" data-target="#confirm-delete">删除</a></td>
				<?php };?>
			</tr>
			<?php }};?>
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


$('#confirm-delete').on('show.bs.modal', function(e) {
$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>