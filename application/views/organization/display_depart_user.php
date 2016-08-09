<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">


<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?php echo $title;?></h3><br/>
		<?php if((($this->session->userdata('front_position') == 10)&&($this->session->userdata('isAdmin') == $ids))||($this->session->userdata('isAdmin') == 0)): ?>
		<a href="<?php echo site_url('user/add_my_user_link')?>/<?php echo $ids;?>">添加人员</a>
	<?php endif;?>
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>用户名</th>
			<th>密码</th>
			<th>真实姓名</th>
			<th>所在班级</th>
			<th>所在部门</th>
			<th>职位</th>
			<th>手机号码</th>
			<th>邮箱</th>
			<th>操作</th><!-- 
			<th>分配任务</th> -->
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($user_data)||is_object($user_data))
      		{
				foreach ($user_data as $row)
				{
				?>
				<tr>
				<td><?php echo $row->stu_id ;?></td>
				<td>******</td>
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
				<td>
					<?php if($row->stu_position == 10 && $row->department_id == 8) {echo "理事";}
					else if($row->stu_position == 10){ echo "部长"; }

					else {echo "干事";}?>
				</td>
				<td><?php echo $row->mobile ;?></td>
				<td><?php echo $row->emails ;?></td>
				<td><?php if(($this->session->userdata('front_id') == $row->stu_id)||(($this->session->userdata('front_position') == 10)&&($this->session->userdata('isAdmin') == $row->department_id))||($this->session->userdata('isAdmin') == 0)):?>
					<a href="<?php echo site_url('user/edit_my_user_link');?>/<?php echo $row->department_id;?>/<?php echo $row->id;?>">修改</a>
				<?php endif?></td><!-- 
				<td><?php if(($this->session->userdata('front_id') == $row->stu_id)||(($this->session->userdata('front_position') == 10)&&($this->session->userdata('isAdmin') == $row->department_id))||($this->session->userdata('isAdmin') == 0)):?>
					<a href="<?php echo site_url('organization/add_task_link');?>/<?php echo $row->department_id;?>/<?php echo $row->id;?>">分配任务</a>
				<?php endif?></td>
 -->				</tr>
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
    "dom": 'T<"clear">lfrtip',
	"tableTools": {
		"aButtons": [ "xls" ],
		"sSwfPath": "<?php echo base_url();?>AdminLTE2/plugins/datatables/extensions/TableTools/swf/copy_csv_xls.swf"
	}
});
</script>