<div class="row">
  <div class="col-md-4">
  <?php foreach ($person as $key) {?>
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url();?>AdminLTE2/dist/img/<?php echo $key->photo_name;?>" alt="User profile picture">
          <h3 class="profile-username text-center"><?php echo $key->stu_name;?></h3>
          <?php if($key->department_id != 0){?>
          <p class="text-muted text-center"><?php echo $key->department_name;?></p>
          <?php } else {?>
          <p class="text-muted text-center">我是最大的</p>
          <?php }?>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Followers</b> <a class="pull-right"><?php echo $key->follow;?>人</a>
            </li>
            <li class="list-group-item">
              <b>Following</b> <a class="pull-right" href="<?php echo site_url('welcome/display_num');?>/<?php echo $key->id;?>"><?php echo $key->following;?>人</a>
            </li>
          </ul>
          <?php 
          $count = 0;
          if(is_array($users_id)||is_object($users_id)){
          foreach ($users_id as $ui) {
            if($this->session->userdata('id') == $ui->id){
              $count++;
            }
          }}
          if($count == 0){
          ?>
          <a href="<?php echo site_url('welcome/follow')?>/<?php echo $key->id;?>" class="btn btn-primary btn-block"><b>Follow</b></a>
          <?php } else { ?>
          <a href="<?php echo site_url('welcome/unfollow')?>/<?php echo $key->id;?>" class="btn btn-primary btn-block"><b>UnFollow</b></a>
          <?php } ?>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">关于<?php echo $key->stu_name;?></h3>
        </div>
        <div class="box-body">
          <strong><i class="fa fa-book margin-r-5"></i>职位</strong>
          <p class="text-muted">
          <?php 
            if($key->department_id != 8){
              echo $key->position_name;
            }
            else{
              echo "理事";
            }
          ?>
          </p>

          <hr>

          <strong><i class="fa fa-map-marker margin-r-5"></i>班级</strong>
          <p class="text-muted"><?php echo $key->class_name;?></p>

          <hr>

          <strong><i class="fa fa-pencil margin-r-5"></i>技能</strong>
          <p>
            <span class="label label-danger">UI Design</span>
            <span class="label label-success">Coding</span>
            <span class="label label-info">Javascript</span>
            <span class="label label-warning">PHP</span>
            <span class="label label-primary">Node.js</span>
          </p>

          <hr>

          <strong><i class="fa fa-file-text-o margin-r-5"></i>邮箱和号码</strong>
          <p><?php echo $key->emails;?><br/>
          <?php echo $key->mobile;?></p>
        </div>
      </div>
    </div>
    <?php }?>
    <div class="col-md-8">
      <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab"><?php echo $username;?>的说说</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="activity">
          <!-- Post -->
          <?php if(is_array($talk)||is_object($talk)){
              foreach ($talk as $row){?>
          <div class="post">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="<?php echo base_url();?>AdminLTE2/dist/img/<?php echo $row->photo_name;?>" alt="user image">
              <span class='username'>
                <a href="<?php echo site_url('welcome/display_person');?>/<?php echo $row->stu_id;?>"><?php echo $row->stu_name;?></a>
                <?php if($this->session->userdata('front_name') == $row->stu_name){?>
                <a href='<?php echo site_url('welcome/delete_talk');?>/<?php echo $row->id;?>' title="删除" class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                <?php }?>
              </span>
              <span class='description'>发表于：<?php echo $row->time;?></span>
            </div><!-- /.user-block -->
            <p>
              <?php echo $row->topic;?>
            </p>
            <ul class="list-inline">
              <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
              <?php
                $count = 0; 
                if(is_array($click_id)||is_object($click_id)){
                foreach($click_id as $ci) {
                  if(($this->session->userdata('id') == $ci->clicker)&&($row->id == $ci->like_id)){
                    $count++;
                  }
                }}
                if($count == 0){
                  ?>
              <li><a href="<?php echo site_url('welcome/like');?>/<?php echo $row->id;?>" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
              <?php } else {?>
              <li><a href="<?php echo site_url('welcome/unlike');?>/<?php echo $row->id;?>" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> UnLike</a></li>
              <?php } ?>
              <li class="pull-right"><a href="<?php echo site_url('welcome/display_like');?>/<?php echo $row->id;?>/<?php echo $row->stu_id;?>" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i>Like:<?php echo $row->like;?></a></li>
              <li class="pull-right"><a data-toggle="collapse" href="#collapse<?php echo $row->id;?>" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> comments:<?php echo $row->comment_num;?></a></li>
            </ul>
            <form role="form" action="<?php echo base_url();?>index.php/welcome/check_comment/<?php echo $row->id;?>" method="post">
              <div class="col-md-10">
                <input class="form-control input-sm" name="comment" type="text" placeholder="Type a comment">
              </div>
              <div class="col-md-2">
                <button type="submit" class="btn btn-info pull-right btn-block btn-sm">评论</button><br/><br/><br/>
              </div>
            </form>
          <div id="collapse<?php echo $row->id;?>" class="panel-collapse collapse">
          <?php if(is_array($comment)||is_object($comment))
            { 
              foreach ($comment as $value) {
                if($value->id_id == $row->id) {
          ?>
          <div class="post clearfix">
            <div class='user-block'>
              <a href="<?php echo site_url('welcome/display_person');?>/<?php echo $value->comment_id;?>"><span style="color: red;font-weight: bold;">&nbsp;&nbsp;<?php echo $value->stu_name;?></span></a>
              <?php if($this->session->userdata('id') == $value->comment_id){?>
              <a href="<?php echo site_url('welcome/delete_comment');?>/<?php echo $value->id;?>" title="删除" class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
              <?php }?>
              <span class='description'><span style="color:blue;"> 评论于:</span><?php echo $value->comment_time;?></span>
            </div><!-- /.user-block -->
            <p>
              &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $value->comment;?>
            </p>

            <form role="form" action="<?php echo base_url();?>index.php/welcome/check_send_response/<?php echo $row->id;?>/<?php echo $value->id;?>/<?php echo $value->comment_id;?>" method="post">
                <div class='col-md-10'>
                  <input class="form-control input-sm" name="response" placeholder="Response">
                </div>                          
                <div class='col-md-2'>
                  <button class='btn btn-danger pull-right btn-block btn-sm'>回复</button><br/><br/>
                </div>         
            </form>
            <?php if(is_array($response)||is_object($response))
            { 
              foreach ($response as $v) {
              if(($v->id_num == $row->id)&&($value->id == $v->comment_id)) {
            ?>
            <div class="post clearfix">
              <div class='user-block'>
                <a href="<?php echo site_url('welcome/display_person');?>/<?php echo $v->response_id;?>"><span style="color:red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v->stu_name;?></span></a>
                <?php if($this->session->userdata('id') == $v->response_id){?>
                <a href="<?php echo site_url('welcome/delete_response');?>/<?php echo $v->id;?>" title="删除" class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                <?php }?>
                <span class='description'><span style="color:blue;">&nbsp;&nbsp;&nbsp;&nbsp; 回复<span style="font-weight: bold;"><?php echo $v->commenter_name;?></span>于:</span><?php echo $v->response_time;?></span>
              </div><!-- /.user-block -->
              <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v->response_topic;?>
              </p>

              <form role="form" action="<?php echo base_url();?>index.php/welcome/check_send_response/<?php echo $row->id;?>/<?php echo $value->id;?>/<?php echo $v->response_id;?>" method="post">
                  <div class='col-md-10'>
                    <input class="form-control input-sm" name="response" placeholder="Response">
                  </div>                          
                  <div class='col-md-2'>
                    <button class='btn btn-danger pull-right btn-block btn-sm'>回复</button>
                  </div>         
              </form>
            </div><!-- /.post -->
            <?php } } }?>
          </div><!-- /.post -->
          <?php } } }?>
          </div><!-- /.post -->
        <?php } }?>
        </div><!-- /.tab-pane -->
    </div>
</div>