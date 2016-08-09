<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/timepicker/bootstrap-timepicker.min.css">
<!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/fullcalendar/fullcalendar.print.css" media="print">
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/datepicker/datepicker3.css">
<div class="row">
<div class="col-md-3">
	<div class="info-box">
	<span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
	<div class="info-box-content">
		<span class="info-box-text">总请求数</span>
		<span class="info-box-number"><?php echo $this->db->count_all('system_log'); ?></span>
	</div><!-- /.info-box-content -->
	</div><!-- /.info-box -->
	<div class="info-box">
	<span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
	<div class="info-box-content">
		<span class="info-box-text">总资料数量</span>
		<span class="info-box-number"><?php echo $this->db->count_all('file'); ?></span>
	</div><!-- /.info-box-content -->
	</div><!-- /.info-box -->
	<div class="info-box">
	<span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
	<div class="info-box-content">
		<span class="info-box-text">今日资料量</span>
		<span class="info-box-number"><?php foreach ($per_day as $a) { echo $a->count; }?></span>
	</div><!-- /.info-box-content -->
	</div><!-- /.info-box -->
  <div class="info-box">
  <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">总例会资料数量</span>
    <span class="info-box-number"><?php echo $this->db->count_all('file_data'); ?></span>
  </div><!-- /.info-box-content -->
  </div><!-- /.info-box -->
  <div class="info-box">
  <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">今日提交例会资料部门</span>
    <span class="info-box-number">
    <?php 
    $count = 0;
    foreach ($department_n as $dep) {
          echo $dep->department_name." "; 
          $count++;
          if($count%2 == 0){
            echo "<br>";
          }
    }?></span>
  </div><!-- /.info-box-content -->
  </div><!-- /.info-box -->
  <?php if($this->session->userdata('isAdmin') == 8){?>
  <div class="info-box">
  <span class="info-box-icon bg-purple"><i class="fa fa-flag-o"></i></span>
  <div class="info-box-content">
    <span class="info-box-text">待批准活动个数</span>
    <span class="info-box-number"><a href="<?php echo site_url('organization/approve_activity');?>/8"><?php foreach ($num as $a) { echo $a->num."个  "."此处为超链接"; }?></a></span>
  </div><!-- /.info-box-content -->
  </div><!-- /.info-box -->
  <?php }?>
</div><!-- /.col -->
<div class="col-md-9">
  <div>
      <div class="box box-primary">
      <div class="box-body no-padding">
        <h4 class="box-title"> 点击查看各部门活动</h4>
        <label></label>
        <table id="choose_all_department" class="table table-bordered text-center">
          <tr>
            <td><button class="btn btn-block btn-default"><span style="font-weight: bold; color: red;"> 点击查看所有部门活动</span></button></td>
          </tr>
        </table>
        <table id="choose_department" class="table table-bordered text-center">
          <tr>
          <?php foreach ($department as $row) 
          {
          ?>
          <td><button id="<?php echo $row->id ?>" class="btn btn-block btn-default"><?php echo $row->department_name ?></button></td>
          <?php 
          }
          ?>            
          </tr>
        </table>
        <!-- THE CALENDAR -->
        <div id="calendar"></div>
      </div><!-- /.box-body -->
      </div><!-- /. box -->
  </div><!-- /.col -->
</div>
</div>

<!-- FLOT CHARTS -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/timepicker/bootstrap-timepicker.min.js"></script>


<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- fullCalendar 2.2.5 -->
<!-- changetodo -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/fullcalendar/lang/zh-cn.js"></script>


<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
<script src="<?php echo base_url() ?>AdminLTE2/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo base_url() ?>AdminLTE2/plugins/flot/jquery.flot.resize.min.js"></script>
<script>
  $("#choose_department").click(function(e) {
      var id = $(e.target).attr('id');
      $.ajax({
        url: "<?php echo site_url("organization/list_information_by_department_name");?>",
        method: "POST", 
        data: {key : id},
      }).done(function(i){
        var events_array = $.parseJSON(i), o = [];
        
        var events = events_array.map(function(i){
          tmp = {start : i.time, title : i.activity_name+'\n'+i.address};
          o.push(tmp);
        })
        
        console.log(o);
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('addEventSource', o);         
        $('#calendar').fullCalendar('rerenderEvents' );
      })
  });

  $("#choose_all_department").click(function(e) {
      $.ajax({
        url: "<?php echo site_url("organization/list_information_all_department");?>",
        method: "POST",
      }).done(function(i){
        var events_array = $.parseJSON(i), o = [];
        
        var events = events_array.map(function(i){
          tmp = {start : i.time, title : i.department_name+'\n'+i.activity_name+'\n'+i.address};
          o.push(tmp);
        })
        
        console.log(o);
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar('addEventSource', o);         
        $('#calendar').fullCalendar('rerenderEvents' );
      })
  });  
  
  $('#calendar').fullCalendar({
    header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
    },
    buttonText: {
    today: '今天',
    month: '月份',
    week: '星期',
    day: '每日'
    },
    //Random default events
    // events: o,
    editable: false, //the block can't move by teek
    droppable: false, // this allows things to be dropped onto the calendar !!!
    lang: 'zh-cn',
    timeFormat: 'H:mm',
    displayEventEnd: {
                    month: true,
                    basicWeek: true,
                    "default": true
        },
  });
</script>