<!-- Content Header (Page header) -->
<style type="text/css">
  .connectedSortable{
    display: none;
  }
</style>
<!-- Main content -->
<section class="content">
  <!-- Main row -->
  <div class="row">
    <div class="col-md-4">
      <!-- SELECT2 EXAMPLE -->

      <!-- TO DO List -->
      <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">部门</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <ul class="todo-list">
            <li>
                <dl>
                  <a href="<?php echo site_url('organization/add_file_link')?>"><dt style="color:red;">添加例会资料</dt></a>
                  <a href="<?php echo site_url('organization/activity_management')?>"><dt style="color:red;">活动总览</dt></a>
                  <?php if(($this->session->userdata('front_position') == 10)||($this->session->userdata('isAdmin') == 0)||($this->session->userdata('isAdmin') == 8)){?>
                  <a href="<?php echo site_url('organization/add_task_link')?>"><dt style="color:red;">分配任务</dt></a>
                  <?php } ?>
                </dl>
            </li>
            <?php foreach($organization as $row):?>
            <li>
              <dl>
                <a href="#group" id='<?php echo "group".$row->id;?>' name=""><dt><?php echo $row->department_name;?></dt></a>
                <!-- <div class="tools">
                  <a href=""><i class="fa fa-edit"></i></a>
                  <a href=""><i class="fa fa-trash-o"></i></a>
                </div> -->
              </dl>
            </li>
            <?php endforeach;?>
          </ul>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix no-border">

        <?php if($this->session->userdata('front_position') == 10){?>
          <?php if($this->session->userdata('isAdmin') == 0 || $this->session->userdata('isAdmin') == 8){?>
            <button class="btn btn-default pull-left" title="添加部门" onclick="add_department()"><i class="fa fa-plus"></i>添加部门</button>
          <?php }?>
            <button class="btn btn-default pull-right" title="添加部门模块" onclick="add_module()"><i class="fa fa-plus"></i>添加部门模块</button>
          <?php }?>
        </div>
      </div><!-- /.box -->
    </div><!-- ./col -->

    <?php foreach($organization as $row):?>
    <!-- Left col -->
    <section id="<?php echo $row->id;?>" class="col-md-8 connectedSortable">
      <!-- group box -->
      <div class="box box-solid box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $row->department_name;?></h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!-- <button class="btn btn-box-tool" data-widget="edit"><i class="fa fa-pencil-square-o"></i></button> -->
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="box-group">
            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
            <?php foreach($module as $c){
              if($c->department_id == $row->id){
              ?>
            <div class="panel box box-primary">
              <div class="box-header with-border">
                <a href="<?php echo site_url($c->module_code);?>/<?php echo $row->id;?>">
                  <ul class="products-list product-list-in-box">
                    <li class="item">
                      <div class="product-info">
                        <?php echo $row->department_name;?><?php echo $c->module_name;?>
                      </div>
                    </li><!-- /.item -->
                  </ul>
                </a>
              </div>
            </div>
            <?php }}?>
          </div>
        </div><!-- /.box-body -->
        <div class="box-footer text-right">
          <!-- <button class="btn btn-default pull-right"><i class="fa fa-plus"></i>添加学科</button> -->
        </div><!-- /.box-footer -->
      </div><!-- /. group box -->
    </section><!-- /.Left col -->
    <?php endforeach;?>
  </div><!-- /.row (main row) -->
</section><!-- /.content -->
<div class="modal" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
    <form id="form" role="form" action="#">
    <div class="modal-body">
      <div id="error"></div>
      <div class="form-group">
          <label>部门</label>
          <?php echo form_error('department');?>
          <input name="department" type="text" class="form-control"placeholder="Enter ...">
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
<div class="modal" id="modal_form1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title1" id="exampleModalLabel"></h4>
      </div>
    <form id="form1" role="form" action="#">
    <div class="modal-body">
      <div id="error1" style="color: red;"></div>
      <div class="form-group">
          <label>部门</label>
          <?php echo form_error('department'); ?>
          <select id="department" name="department" class="form-control select2" style="width: 100%;">
          <option value=""></option>
          <?php foreach($organization as $row){?>
            <option value="<?php echo $row->id;?>"><?php echo $row->department_name;?></option>
          <?php }?>
          </select>
      </div>
      <div class="form-group">
          <label>模块</label>
          <?php echo form_error('module'); ?>
          <select id="module" name="module" class="form-control select2" style="width: 100%;">
          </select>
      </div>
      <div class="form-group">
          <label>模块代码</label>
          <?php echo form_error('module_code'); ?>
          <select id="module2" name="module_code" class="form-control select2" style="width: 100%;">
            </select>
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
<!--<script src="<?php echo base_url();?>ALTE/plugins/qrcode/jquery.qrcode.min.js"></script>-->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript">
  $(function(){
    $("[href='#group']").click(function(){
      $("section .connectedSortable").hide();
      var grade_id = $(this).attr('id');
      grade_id = grade_id.replace('group','');
      $("#"+ grade_id).show();
    });
  });
</script>
<script>
var save_method;
function add_department()
{
  save_method = 'add';
  $("#error").html(''); // reset error on modals
  $('#form')[0].reset(); // reset form on modals
  $('#modal_form').modal('show'); // show bootstrap modal
  $('.modal-title').text('添加部门'); // Set Title to Bootstrap modal title
}

function add_module()
{
  save_method = 'add_module';
  $("#error1").html(''); // reset error on modals
  $('#form1')[0].reset(); // reset form on modals
  $('#modal_form1').modal('show'); // show bootstrap modal
  $('.modal-title1').text('添加部门模块'); // Set Title to Bootstrap modal title
}

function save() {
  $('#btnSave').text('保存中'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable
  if(save_method == 'add'){
    url = "<?php echo site_url('organization/ajax_add_department');?>";
    form = $('#form');
  }
  if(save_method == 'add_module'){
    url = "<?php echo site_url('organization/ajax_add_module');?>";
    form = $('#form1');
  }
  
  $.ajax({
        url : url,
        type: "POST",
        data: form.serialize(),
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
              if(save_method == 'add'){
                $("#error").html(data.error);
              }
              if(save_method == 'add_module'){
                $("#error1").html(data.error);
              }
            }
            $('#btnSave').text('保存'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          if(save_method == 'add'){
            alert('Error add_department data');
          }
          if(save_method == 'add_module'){
            alert('Error add_module data');
          }
          $('#btnSave').text('保存'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}

  $("#department").click(function(){
    var depart_id = $("#department").val().trim();
    $.ajax({
      url:"<?php echo site_url('organization/get_module_by_ajax');?>",
      method:"POST",
      data:{group : depart_id},
    }).done(function(i){
      $("#module").empty();
      $("#module").append(i);
    })
  });

/*$('#department').change(function(){
      var id = $('#department').val();

      $.ajax({
        url: '<?php echo site_url("organization/get_module_by_ajax");?>',
        method: "POST",
        data: {group : id},
      }).done(function(i){
         $("#module").html(i);
      })
    });*/
  $("#module").click(function(){
    var module_name = $("#module").val().trim();
    $.ajax({
      url:"<?php echo site_url('organization/is_exist_by_ajax');?>",
      method:"POST",
      data:{key : module_name},
    }).done(function(i){
      $("#module2").empty();
      $("#module2").append(i);
    })
  });

  /*$('#module').change(function(){
      var id = $('#module').val();

      $.ajax({
        url: '<?php echo site_url("organization/is_exist_by_ajax");?>',
        method: "POST",
        data: {key : id},
      }).done(function(i){
         $("#module2").html(i);
      })
    });*/
</script>