<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">

<!--timepicker-->
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/timepicker/bootstrap-timepicker.min.css">

<!-- 
<div class="box">
	<form role="form" action="<?php echo base_url();?>index.php/permission/search_user_id" method="post">
		<div class="box-body">
			<div class="bootstrap-timepicker">
				<input type="text" name="user_name" class="form-control" value="<?php echo set_value('user_name'); ?>" placeholder="请输入真实姓名查询">
			</div>
		</div>
		
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">提交</button>
		</div>
		
	</form>
</div> -->

<div class="modal" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<!--modal-sm and modal-lg	-->
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
	  <form id="form" role="form" action="#">
		<div class="modal-body">
			<!--dirty-->
			<div id="error"></div>
			<!--dirty-->
			<div class="form-group">
          		<label>部门</label>
		  		<?php echo form_error('depart_ment_id'); ?>
		  		<select id="depart_ment_id" name="depart_ment_id" class="form-control select2" style="width: 100%;">
			  		<?php foreach ($depart as $row) {
			  		?>
			  			<option value="<?php echo $row->id;?>"><?php echo $row->department_name;?>
			  			</option>
		  			<?php }?>
		  		</select>
	    	</div>
		    <div class="form-group">
	          <label>职位</label>
			  <?php echo form_error('user_position'); ?>
          	  <!--<input name="role" type="text" class="form-control" value="<?php echo set_value('role'); ?>" placeholder="Enter ...">-->
			  <select id="user_position" name="user_position" class="form-control select2" style="width: 100%;">
			  		<?php foreach ($position as $row) {
			  		?>
			  			<option value="<?php echo $row->id;?>"><?php echo $row->position_name;?>
			  			</option>
		  			<?php }?>
		  		</select>
		    </div>
		    <div class="form-group">
	          <label>班级</label>
			  <?php echo form_error('user_class'); ?>
			  <select id="user_class" name="user_class" class="form-control select2" style="width: 100%;">
			  		<?php foreach ($class as $row) {
			  		?>
			  			<option value="<?php echo $row->id;?>"><?php echo $row->class_name;?>
			  			</option>
		  			<?php }?>
		  		</select>
		    </div>
			<div class="form-group">
	          <label>学号(用于登录)</label>
			  <?php echo form_error('users_id'); ?>
          	  <input name="users_id" type="text" class="form-control"placeholder="Enter ...">
		    </div>
	        <div class="form-group">
	          <label>密码</label>
			  <?php echo form_error('pswd'); ?>
	          <input name="pswd" type="password" class="form-control" value="<?php echo set_value('pswd'); ?>" placeholder="Enter ...">
	        </div>
	        <div class="form-group">
	          <label>姓名</label>
			  <?php echo form_error('user_name'); ?>
	          <input id="user_name" name="user_name" type="text" class="form-control" placeholder="Enter ...">
	        </div>
	        <div class="form-group">
	          <label>手机号码</label>
			  <?php echo form_error('mobile_phone'); ?>
	          <input id="mobile_phone" name="mobile_phone" type="text" class="form-control" placeholder="Enter ...">
	        </div>
	        <div class="form-group">
	          <label>邮箱</label>
			  <?php echo form_error('user_email'); ?>
	          <input id="user_email" name="user_email" type="text" class="form-control"  placeholder="Enter ...">
	        </div>
		</div>
		<div class="modal-footer">
			<button id="btnSave" type="submit" class="btn btn-primary" onclick="save()">保存</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<div class="box">
	<div class="box-header">
		<h3 class="box-title"></h3>
		<!--<button class="btn btn-success" "type="button" data-toggle="modal" data-target="#modal_add">添加用户</button>-->
		<button class="btn btn-success" title="添加" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i>添加</button>
		<!-- <button id="edit" class="btn btn-primary" title="修改" ><i class="glyphicon glyphicon-pencil"></i> 修改</button>
		<button id="delete" class="btn btn-danger" title="删除" onclick="delete_user()"><i class="glyphicon glyphicon-trash"></i> 删除</button> -->
	</div><!-- /.box-header -->
	<div class="box-body">
		<table id="user" class="table table-bordered table-striped">
		<thead>
			<tr>
			<th>用户名</th>
			<th>真实姓名</th>
			<th>所在班级</th>
			<th>所在部门</th>
			<th>职位</th>
			<th>手机号码</th>
			<th>邮箱</th>
			<th>操作</th>
			<!-- <th>权限</th> -->
			</tr>
		</thead>
		<tfoot>
			<tr>
			<th>用户名</th>
			<th>真实姓名</th>
			<th>所在班级</th>
			<th>所在部门</th>
			<th>职位</th>
			<th>手机号码</th>
			<th>邮箱</th>
			<th>操作</th>
			<!-- <th>权限</th> -->
			</tr>
		</tfoot>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<!-- DataTables -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script>
var save_method;
var table;
$('#user').DataTable({
	processing: true,
	serverSide: true,
	order: [],
	ajax: {
		url: "<?php echo site_url('user/ajax_list_user')?>",
		type: 'POST'
	},
	columnDefs: [
        {
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
    ],
    dom: 'T<"clear">lfrtip',
	tableTools: {
		"aButtons": [ "xls" ],
		"sSwfPath": "<?php echo base_url();?>AdminLTE2/plugins/datatables/extensions/TableTools/swf/copy_csv_xls.swf"
	}
});
function add_user()
{
	save_method = 'add';
	$("#error").html(''); // reset error on modals
	$('#form')[0].reset(); // reset form on modals
	$('#modal_form').modal('show'); // show bootstrap modal
	$('.modal-title').text('添加用户'); // Set Title to Bootstrap modal title
}

function edit_user(id)
{
	save_method = 'update';
	$("#error").html(''); // reset form on modals
	$('#form')[0].reset();
	//Ajax Load data from ajax
	$.ajax({
	url : "<?php echo site_url('user/ajax_edit_user/')?>/" + id,
	type: "GET",
	dataType: "JSON",
	success: function(data)
	{
		$('[name="depart_ment_id"]').val(data.department_id);
		$('[name="user_position"]').val(data.stu_position);
		$('[name="user_class"]').val(data.stu_class);
		$('[name="users_id"]').val(data.stu_id);
		$('[name="pswd"]').val("不需要设置");
		$('[name="user_name"]').val(data.stu_name);
		$('[name="mobile_phone"]').val(data.mobile);
		$('[name="user_email"]').val(data.emails);


		$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
		$('.modal-title').text('修改用户'); // Set title to Bootstrap modal title

	},
	error: function (jqXHR, textStatus, errorThrown)
	{
		alert('Error get data from ajax');
	}
});
}

function delete_user(id)
{
	$.ajax({
	url : "<?php echo site_url('user/ajax_delete_user/')?>/" + id,
	type: "POST",
	dataType: "JSON",
	success: function(data)
	{
		if(data.status){
			location.reload();
		}
		else{
			alert("删除失败");
		}

	},
	error: function (jqXHR, textStatus, errorThrown)
	{
		alert('Error delete data');
	}
});
}

function save() {
	$('#btnSave').text('保存中'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    if(save_method == "add"){
		url = "<?php echo base_url();?>index.php/user/ajax_add_user";
	}
	if(save_method == "update"){
		url = "<?php echo base_url();?>index.php/user/ajax_edit_user_information";
	}
	
	$.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                //$('#add_user').modal('hide');
                // reload_table();
				location.reload();
            }
            else
            {
                // for (var i = 0; i < data.inputerror.length; i++)
                // {
                //     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                //     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                // }
				$("#error").html(data.error);
            }
            $('#btnSave').text('保存'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('保存'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

</script>