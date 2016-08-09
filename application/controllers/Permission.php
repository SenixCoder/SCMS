<?php

if (! defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 权限及用户处理控制器
 *
 * 权限的添加和编辑以及用户控制操作都在本控制器
 * 
 * @package		app
 * @subpackage	core
 * @category	controller
 * @author		bruce.yang<kissjava@vip.qq.com>
 *        
 */
class Permission extends MY_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('permission_model');
        $this->load->model('organization_model');
    }
    
    /**
     * 输出建设中...字符串
     */
    public function building()
    {
    	echo '<center><BR /><BR /><BR />建设中...<BR /><BR /></center>';
    }

    /**
     * ********************************模块**********************************
     */
    /**
     * 模块列表
     */
    public function module ()
    {
        $data['list'] = $this->permission_model->list_module();
        $data['title'] = "模块列表";
        $data['url'] = "permission_module/list_module";
        $this->load->view('main', $data);
    }

    /**
     * 删除模块
     * 
     * @param int $id
     *            模块id
     */
    public function delete_module ($id)
    {
        $rs = $this->permission_model->delete_module($id);
        if ($rs === 1) {
            form_submit_json("200", "操作成功", "module", "", "");
        } else {
            form_submit_json("300", $rs);
        }
    }

    /**
     * 添加模块界面
     */
    public function add_module ()
    {
        $data['url'] = 'permission_module/add_module';
        $data['title'] ='添加模块';
        $data['error'] = '';
        $this->load->view('main',$data);
    }
    /**
     * 修改模块界面
     * 
     * @param int $id
     *            模块id
     */
    public function edit_module ($id)
    {
        $data['url'] = 'permission_module/edit_module';
        $data['title'] = '修改模块';
        $data['list'] = $this->permission_model->get_module($id);
        $data['error'] = '';
        $this->load->view('main',$data);
    }

    /**
     * 保存模块到数据库
     */
    public function save_module ()
    {
        $rs = $this->permission_model->save_module();
        if ($rs === 1) {
            redirect('permission/module');
        } else {
            if($this->input->post('id'))
            {
                $data['url'] = 'permission_module/edit_module';
                $data['title'] ='修改模块';
                $data['list'] = $this->permission_model->get_module($this->input->post('id'));
                $data['error'] = $rs;
                $this->load->view('main',$data);
            }
            else{
                $data['url'] = 'permission_module/add_module';
                $data['title'] ='添加模块';
                $data['error'] = $rs;
                $this->load->view('main',$data);
            }
        }
    }

    /**
     * ********************************模块**********************************
     */
    
    /**
     * ********************************功能**********************************
     */
    /**
     * 功能列表
     */
    public function action ()
    {
        $data['list'] = $this->permission_model->list_action();
        $data['title'] = "功能列表";
        $data['url'] = "action/list_action";
        $this->load->view('main', $data);
    }

    /**
     * 删除功能
     * 
     * @param int $id
     *            功能id
     */
    public function delete_action ($id)
    {
        $rs = $this->permission_model->delete_action($id);
        if ($rs === 1) {
            form_submit_json("200", "操作成功", "action", "", "");
        } else {
            form_submit_json("300", $rs);
        }
    }

    /**
     * 添加功能界面
     */
    public function add_action ()
    {
        $data['url'] = 'action/add_action';
        $data['title'] ='添加功能';
        $data['modules'] = $this->permission_model->list_module();
        $data['error'] = '';
        $this->load->view('main',$data);
    }

    /**
     * 保存功能到数据库
     */
    public function save_action ()
    {
        $rs = $this->permission_model->save_action();
        if ($rs === 1) {
            redirect('permission/action');
        } else {
            if($this->input->post('id'))
            {
                $data['url'] = 'action/edit_action';
                $data['title'] ='修改功能';
                $data['modules'] = $this->permission_model->list_module();
                $data['list'] = $this->permission_model->get_action($this->input->post('id'));
                $data['error'] = $rs;
                $this->load->view('main',$data);
            }
            else{
                $data['url'] = 'action/add_action';
                $data['title'] ='添加功能';
                $data['modules'] = $this->permission_model->list_module();
                $data['error'] = $rs;
                $this->load->view('main',$data);
            }
        }
    }

    /**
     * 修改功能界面
     * 
     * @param int $id
     *            功能id
     */
    public function edit_action ($id)
    {
        $data['url'] = 'action/edit_action';
        $data['title'] = '修改功能';
        $data['modules'] = $this->permission_model->list_module();
        $data['list'] = $this->permission_model->get_action($id);
        $data['error'] = '';
        $this->load->view('main',$data);
    }

    /**
     * 输出权限的默认动作列表
     */
    public function hack_perm_action ()
    {
        echo '[
            	{"order_no":"5","perm_name":"列表"},
            	{"order_no":"4","perm_name":"新建"},
            	{"order_no":"3","perm_name":"修改"},
            	{"order_no":"2","perm_name":"删除"}
            ]';
    }

    /**
     * ********************************功能**********************************
     */
    
    /**
     * ********************************角色**********************************
     */
    /**
     * 角色列表
     */
    public function role ()
    {
        $data['list'] = $this->permission_model->list_role();
        $data['url'] = 'role/list_role';
        $data['title'] = '角色列表';
        $this->load->view('main', $data);
    }

    /**
     * 删除角色
     * 
     * @param int $id
     *            角色id
     */
    public function delete_role ($id)
    {
        $rs = $this->permission_model->delete_role($id);
        if ($rs === 1) {
            form_submit_json("200", "操作成功", "role", "", "");
        } else {
            form_submit_json("300", $rs);
        }
    }

    /**
     * 添加角色界面
     */
    public function add_role ()
    {
        $data['url'] = 'role/add_role';
        $data['title'] ='添加角色';
        $data['error'] = '';
        $this->load->view('main',$data);
    }

    /**
     * 保存角色到数据库
     */
    public function save_role ()
    {
        $rs = $this->permission_model->save_role();
        if ($rs === 1) {
            redirect('permission/role');
        } else {
            if($this->input->post('id'))
            {
                $id=$this->input->post('id');
                $data['url'] = 'role/edit_role';
                $data['title'] = '修改角色';
                $data['list'] = $this->permission_model->get_role($id);
                $data['error'] = $rs;
                $this->load->view('main',$data);
            }
            else{
                $data['url'] = 'role/add_role';
                $data['title'] ='添加角色';
                $data['error'] = $rs;
                $this->load->view('main',$data);
            }
        }
    }

    /**
     * 修改角色界面
     * 
     * @param int $id
     *            角色id
     */
    public function edit_role ($id)
    {
        $data['url'] = 'role/edit_role';
        $data['title'] = '修改角色';
        $data['list'] = $this->permission_model->get_role($id);
        $data['error'] = '';
        $this->load->view('main',$data);
    }

    /**
     * 编辑角色权限界面
     * 
     * @param int $id
     *            角色id
     */
    public function role_perm ($id)
    {
        $data['actions'] = $this->permission_model->list_action();
        $data['modules'] = $this->permission_model->list_module();
        $data['perms'] = $this->permission_model->get_role_perm($id);
        $data['role_id'] = $id;
        // 权限主题
        $data['subjects'] = $this->permission_model->list_subject();
        $data['url'] = 'role/role_perm';
        $data['title'] = '编辑角色权限';
        $this->load->view('main', $data);
    }

    /**
     * 保存角色权限
     * 
     * @param int $id
     *            角色id
     */
    public function save_role_perm ()
    {
        $rs = $this->permission_model->save_role_perm();
        if ($rs === 1) {
            redirect('permission/role');
        } else {
            $data['url'] = 'role/role_perm';
            $data['title'] ='编辑角色权限';
            $this->load->view('main',$data);
        }
    }

    /**
     * ********************************角色**********************************
     */
    
    /**
     * ********************************用户**********************************
     */
    
    /**
     * 用户列表
     */
    public function user ()
    {
        $data['list'] = $this->permission_model->list_user();
        $data['url'] = 'user/user_management';
        $data['title'] = '用户列表';
        $data['depart'] = $this->organization_model->get_department();
        $data['position'] = $this->organization_model->get_position();
        $data['class'] = $this->organization_model->get_class();
        $this->load->view('main', $data);
    }

    /**
     * 删除用户
     * 
     * @param int $id
     *            用户id
     */
    public function delete_user ($id)
    {
        $rs = $this->permission_model->delete_user($id);
        if ($rs === 1) {
            form_submit_json("200", "操作成功", "user", "", "");
        } else {
            form_submit_json("300", $rs);
        }
    }

    /**
     * 添加用户界面
     */
    public function add_user ()
    {
        $data['url'] = 'user/add_user';
        $data['title'] = '添加用户';
        $data['error'] = '';
        $data['depart'] = $this->organization_model->get_department();
        $this->load->view('main', $data);
    }

    public function search_user_id(){
        $data['url'] = 'user/user_management';
        $data['title'] = '卡号信息管理';
        $data['list'] = $this->permission_model->search_data();
        $this->load->view('main',$data);
    }
    /**
     * 保存用户到数据库
     */
    public function save_user ()
    {
        $rs = $this->permission_model->save_user();
        if ($rs === 1) {
            redirect('permission/user');
        } else {
            if($this->input->post('id'))
            {
                $id = $this->input->post('id');
                $data['url'] = 'user/edit_user';
                $data['title'] = '修改用户';
                $data['depart'] = $this->organization_model->get_department();
                $data['list'] = $this->permission_model->get_user($id);
                $data['error'] = $rs;
                $this->load->view('main',$data);
            }
            else{
                $data['url'] = 'user/add_user';
                $data['title'] ='添加用户';
                $data['error'] = $rs;
                $data['depart'] = $this->organization_model->get_department();
                $this->load->view('main',$data);
            }
        }
    }

    /**
     * 修改用户界面
     * 
     * @param int $id            
     */
    public function edit_user ($id)
    {
        $data['list'] = $this->permission_model->get_user($id);
        $data['url'] = 'user/edit_user';
        $data['title'] = '修改用户';
        $data['error'] = '';
        $data['depart'] = $this->organization_model->get_department();
        $this->load->view('main', $data);
    }

    /**
     * 设置用户是否禁用
     * 
     * @param int $id            
     * @param int $flag            
     */
    /*public function set_status ($id, $flag)
    {
        $rs = $this->permission_model->set_status($id, $flag);
        if ($rs) {
            form_submit_json("200", "操作成功", "user", "", "");
        } else {
            form_submit_json("300", $rs);
        }
    }*/

    /**
     * 保存用户权限
     * 
     * @param int $id
     *            用户id
     */
    public function save_user_perm ()
    {
        $rs = $this->permission_model->save_user_perm();
        if ($rs === 1) {
            redirect('permission/user');
        } else {
            $ids = $this->input->post('user_id');
            $this->user_perm($ids);
        }
    }

    /**
     * 保存用户禁用权限
     * 
     * @param int $id
     *            用户id
     */
    /*public function save_user_disable ()
    {
        $rs = $this->permission_model->save_user_disable();
        if ($rs === 1) {
            form_submit_json('200', '操作成功', 'user_perm', '', '');
        } else {
            form_submit_json('300', $rs);
        }
    }*/

    /**
     * 编辑用户权限界面
     *
     * 包含了设置用户角色，设置用户权限，排除角色权限
     * 
     * @param int $id
     *            用户id
     */
    public function user_perm ($id)
    {
        $data = $this->permission_model->get_user_role($id);
        echo json_encode($data);
    }

    /**
     * 保存用户角色
     * 
     * @param int $id
     *            用户id
     */
    public function save_user_role ()
    {
        $rs = $this->permission_model->save_user_role();
        if ($rs === 1) {
            echo json_encode(array('status' => TRUE));
        }
        else {
            echo json_encode(array('status' => FALSE));
        }
    }

/**
 * ********************************用户**********************************
 */
}

/* End of file permission.php */
/* Location: ./application/controllers/permission.php */