<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?php echo $title;?></h3>
	</div>

	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>标题</th>
					<th>文章发送时间</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($wechat)||is_object($wechat))
	      	{
				foreach ($wechat as $module){?>
				<tr>
					<td><a href="<?php echo $module->url;?>"><?php echo $module->title;?></a></td>
					<td><?php echo $module->postdate;?></td>
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

</script>