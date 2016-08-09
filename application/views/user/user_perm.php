<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

<div class="box">
    <div class="box-header">
        <h3 class="box-title">用户权限设定</h3>
    </div>
    <div class="box-body">
                <form method="post" action="<?php echo site_url('permission/save_user_role');?>" class="pageForm required-validate">
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>" />
                    <div class="form-group" layoutH="135">
                        <fieldset>
                            <legend>勾选角色</legend>
                            <?php 
                            // 循环角色
                            foreach($roles['all_roles'] as $role):
                                //如果已经设定过角色，下面判断这个角色是否在过去设定过
                                if($roles['user_roles']):
                            ?>
                            <label><input type="checkbox" name="c0[]" value="<?php echo $role->id;?>" <?php echo in_array($role->id,$roles['user_roles'])?'checked="checked"':'';?> /><?php echo $role->role_name;?></label>
                            <?php 
                                else:
                            ?>
                            <label><input type="checkbox" name="c0[]" value="<?php echo $role->id;?>" /><?php echo $role->role_name;?></label>
                            <?php 
                                endif;
                            endforeach;
                            ?>

                        </fieldset>
                    </div>
                    <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">提交</button>
                    </div>
                </form>
            </div>
        <div class="tabsFooter">
            <div class="tabsFooterContent"></div>
        </div>
    </div>