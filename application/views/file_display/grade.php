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
          <h3 class="box-title">年级</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <ul class="todo-list">
            <li>
                <dl>
                  <a href="<?php echo site_url('file/add_file_page')?>"><dt style="color:red;">添加资料</dt></a>
                </dl>
            </li>
            <?php foreach($grades as $grade):?>
            <li>
              <dl>
                <a href="#group" id='<?php echo "group".$grade->id;?>' name=""><dt><?php echo $grade->name;?></dt></a>
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
            <button class="btn btn-default pull-left" title="添加学期" onclick="add_grade()"><i class="fa fa-plus"></i>添加学期</button>
          <?php }?>
            <button class="btn btn-default pull-right" title="添加学科" onclick="add_course()"><i class="fa fa-plus"></i>添加学科</button>
          <?php }?>
        </div>
      </div><!-- /.box -->
    </div><!-- ./col -->

    <?php foreach($grades as $grade):?>
    <!-- Left col -->
    <section id="<?php echo $grade->id;?>" class="col-md-8 connectedSortable">
      <!-- group box -->
      <div class="box box-solid box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $grade->name;?></h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!-- <button class="btn btn-box-tool" data-widget="edit"><i class="fa fa-pencil-square-o"></i></button> -->
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="box-group">
            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
            <?php foreach($courses as $course){
              if($course->grade_id == $grade->id){
              ?>
            <div class="panel box box-primary">
              <div class="box-header with-border">
                
                  <ul class="products-list product-list-in-box">
                    <li class="item">
                      <div class="product-info">
                        <a href="<?php echo site_url('upload/display');?>/<?php echo $course->id;?>"><?php echo $course->term;?>
                        </a>
                      </div>
                      <div class="tools">
                       <a href="<?php echo site_url('file_display/edit_course_link');?>/<?php echo $course->id;?>" title="修改科目"><i class="fa fa-edit pull-right"></i></a>
                        <!-- <button class="btn btn-default pull-right" title="修改科目" onclick="edit_course(<?php echo $course->id;?>)"><i class="fa fa-edit pull-right"></i></button> -->
                        <!--<a href=""><i class="fa fa-trash-o pull-right"></i></a>-->
                      </div>
                    </li><!-- /.item -->
                  </ul>
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
<!--modal-sm and modal-lg -->
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
      <div class="form-group">
          <label>学期</label>
          <?php echo form_error('grade'); ?>
          <select name="grade" class="form-control select2" style="width: 100%;">
            <option value="大一上">大一上</option>
            <option value="大一下">大一下</option>
            <option value="大二上">大二上</option>
            <option value="大二下">大二下</option>
            <option value="大三上">大三上</option>
            <option value="大三下">大三下</option>
            <option value="大四上">大四上</option>
            <option value="大四下">大四下</option>
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
<div class="modal" id="modal_form1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<!--modal-sm and modal-lg -->
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title1" id="exampleModalLabel"></h4>
      </div>
    <form id="form1" role="form" action="#">
    <div class="modal-body">
      <!--dirty-->
      <div id="error1"></div>
      <div class="form-group">
          <label>学期</label>
          <?php echo form_error('grade'); ?>
          <select name="grade" class="form-control select2" style="width: 100%;">
          <?php foreach($grades as $grade){?>
            <option value="<?php echo $grade->id;?>"><?php echo $grade->name;?></option>
          <?php }?>
          </select>
      </div>
      <div class="form-group">
          <label>科目</label>
          <?php echo form_error('course'); ?>
          <input name="course" type="text" class="form-control"placeholder="Enter ...">
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
function add_grade()
{
  save_method = 'add';
  $("#error").html(''); // reset error on modals
  $('#form')[0].reset(); // reset form on modals
  $('#modal_form').modal('show'); // show bootstrap modal
  $('.modal-title').text('添加学期'); // Set Title to Bootstrap modal title
}

function add_course()
{
  save_method = 'add_course';
  $("#error1").html(''); // reset error on modals
  $('#form1')[0].reset(); // reset form on modals
  $('#modal_form1').modal('show'); // show bootstrap modal
  $('.modal-title1').text('添加科目'); // Set Title to Bootstrap modal title
}

function edit_course(id){
  save_method = 'edit_course';
  $("#error1").html(''); // reset form on modals
  $('#form1')[0].reset();
  //Ajax Load data from ajax
  $.ajax({
  url : "<?php echo site_url('file_display/ajax_course')?>/" + id,
  type: "GET",
  dataType: "JSON",
  success: function(data)
  {
    $('[name="grade"]').val(data.grade_id);
    $('[name="course"]').val(data.term);


    $('#modal_form1').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title1').text('修改课程'); // Set title to Bootstrap modal title

  },
  error: function (jqXHR, textStatus, errorThrown)
  {
    alert('Error get data from ajax');
  }
});
}

function save() {
  $('#btnSave').text('保存中'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable
  if(save_method == 'add'){
    url = "<?php echo base_url();?>index.php/file_display/ajax_add_grade";
    $form = $('#form');
  }
  if(save_method == 'add_course'){
    url = "<?php echo base_url();?>index.php/file_display/ajax_add_course";
    $form = $('#form1');
  }

  if(save_method == 'edit_course'){
    url = "<?php echo base_url();?>index.php/file_display/ajax_edit_course";
    $form = $('#form1');
  }
  
  $.ajax({
        url : url,
        type: "POST",
        data: $form.serialize(),
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
              if(save_method == 'add_course' || save_method == 'edit_course'){
                $("#error1").html(data.error);
              }
            }
            $('#btnSave').text('保存'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          if(save_method == 'add'){
            alert('Error add_grade data');
          }
          if(save_method == 'add_course'){
            alert('Error add_course data');
          }

          if(save_method == 'edit_course'){
            alert('Error edit_course data');
          }
          $('#btnSave').text('保存'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable
        }
    });
}
</script>