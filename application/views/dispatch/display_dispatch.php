<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
	</div>
	<div class="box-body">
	<?php foreach ($dispatch as $key) {?>
		<div style="color: #000080; line-height: 150%; padding-right: 15%; padding-left: 10%;text-align: center; font-family: 仿宋_GB2312; font-size: 24pt;">
			<?php echo $key->title;?>
		</div>
		<div class="pageFormContent" style="height: 483px; overflow: auto; padding-right: 10%; padding-left: 5%;" width="100%" layouth="75">
			<span style="color: black; line-height: 150%; font-family: 仿宋_GB2312; font-size: 16pt;">
				<?php echo $key->content;?>
			</span>
		</div>
	<?php };?>
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