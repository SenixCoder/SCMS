<!-- meeting room info-->
<div class="row">
	<?php foreach ($organization as $row) { ?>
	<div class="col-md-6">
		<div class="box box-solid">
		<div class="box-header with-border">
			<i class="fa fa-text-width"></i>
			<h3 class="box-title"><?php echo $row->department_name?>成员信息概览</h3>
		</div><!-- /.box-header -->
		<div class="box-body">
				<table>
					<tr>
						<th>真实姓名&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>职位&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>手机&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>邮箱</th>
					</tr>
					<?php foreach ($user as $key) {
						if($key->department_id == $row->id){
						?>
						<tr>
							<td><?php echo $key->stu_name?></td>
							<td><?php if($key->stu_position == 10 && $key->department_id == 8){echo "理事";}else if($key->stu_position == 10){echo "部长";} else {echo "干事";}?>
							</td>
							<td><?php echo $key->mobile?></td>
							<td><?php echo $key->emails?></td>
						</tr>
					<?php }}?>
				</table>
		</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div><!-- ./col -->
	<?php } ?>
</div>