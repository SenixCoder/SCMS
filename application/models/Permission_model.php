<?php

class Permission_model extends CI_Model 
{
	var $details;
	
	public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('log_model');
    }

	public function check_login() {
        $this->form_validation->set_rules('users_id', "用户名", 'required');
        $this->form_validation->set_rules('pswd', "密码", 'required');
        if($this->form_validation->run()==false){
                return "用户名或密码不能为空";
        }
        $data = array(
                'stu_id' => $this->input->post('users_id'),
                'password' => password_hash($this->input->post('pswd'), PASSWORD_BCRYPT),
                'captcha' => $this->input->post('captcha')
        );
        if (strtolower($data['captcha'])!=strtolower($_SESSION['captcha']))
        {

            return '验证码出错';
        }
        $userq = (array)$this->db->select('count(*) as count')->from('user')->where('stu_id', $this->input->post('users_id'))->where('delete_time !=',NULL)->get()->row();
        if($userq['count']!=0)
        {
            return '该账户已经注销';
        }
		$user = $this->db->from('user')->where('stu_id', $this->input->post('users_id'))->where('delete_time',NULL)->get()->result();
        
        if($user) {
            $pswd = $user[0]->password;
		    return $this->validate_usr($user, $pswd);
        }
        
        $this->log_model->log_xa();
        return '用户名或密码出错';
	}
	
	function validate_usr($user, $pswd) {

		if(password_verify($this->input->post('pswd'), $pswd)) {
           
            $this->details = $user[0];
            $this->log_model->log_xaa();
            $this->set_session();
            
            return 1;
        }
        return '用户名或密码出错';
	}
	
	function set_session() {
        // session->set_userdata is a CodeIgniter function that
        // stores data in CodeIgniter's session storage.  Some of the values are built in
        // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
        $this->session->set_userdata( array(
                'front_id' => $this->details->stu_id,
                'id' => $this->details->id,
                'front_name'=>$this->details->stu_name,
                'front_position'=>$this->details->stu_position,
                'isAdmin'=>$this->details->department_id,
                'photo_name' => $this->details->photo_name,
                'isLoggedIn'=>true
            )
        );
    }
    
    function check_owner() {
        $user = $this->db->where('id', $this->session->userdata('id'))->get('user')->result();

        if($user) {
            $pswd = $user[0]->password;
            return password_verify($this->input->post('pswd_origin'), $pswd);
        } else {
            return false;
        }   
    }


     /**
     * 列出模块(分页)
     * 
     * @return array 返回数组array('total'=>表记录总数,'list'=>记录列表)
     */
    function list_module ()
    {
        
        $data=$this->db->select('*')
                       ->from('sl_perm_module')
                       ->get()
                       ->result();
        
        return $data;
    }

    /**
     * 保存模块
     * 
     * @return int|string 成功返回1，否则返回出错信息
     */
    function save_module ()
    {
        $this->form_validation->set_rules('title', '模块名称', 'required');
        $this->form_validation->set_rules('code', '模块代码', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            return 0;
        } else {
            $data = array(
                    'title' => $this->input->post('title', TRUE),
                    'code' => $this->input->post('code', TRUE),
                    'add_time' => date("Y-m-d H:i:s"),
                    'update_time' => date("Y-m-d H:i:s")
            );
            // 检查重复
            $rs_title = (array)$this->db->select('*')->from('sl_perm_module')->where('title',$data['title'])->get()->row();
            $rs_code = (array)$this->db->select('*')->from('sl_perm_module')->where('code',$data['code'])->get()->row();
            if ($this->input->post('id')) { // 更新保存
                $ids = $this->input->post('id');
                unset($data['add_time']);
                
                if ($rs_title && ($rs_title['id'] != $ids))
                    return '模块名已经存在';
                //var_dump($rs_code_id != $ids);die();
                if ($rs_code && ($rs_code['id'] != $ids))
                    return '模块代码已经存在';
                
                if ($this->db->update('sl_perm_module', $data, "id = $ids")) {
                    return 1;
                } else {
                    
                    return '更新失败';
                }
            } else { // 新增保存
                
                if ($rs_title || $rs_code) {
                    return '模块名或模块代码已经存在';
                }
                if ($this->db->insert('sl_perm_module', $data)) {
                    return 1;
                } else {
                    return '插入失败';
                }
            }
        }
    }

    /**
     * 返回一个模块信息数组
     * 
     * @param int $id 模块id    
     * @return array 模块数组信息
     */
    function get_module ($id)
    {
        return $this->db->select('*')->from('sl_perm_module')->where('id',$id)->get()->result();
    }

    /**
     * 删除模块
     * 
     * @param int $id 模块id        
     * @return int|string 成功返回1，否则返回出错信息
     */
    function delete_module ($id)
    {
        // 判断是否有功能在模块下，有则停止删除
        if($this->is_exists($this->tables[1], 'perm_module_id', $id))
            return "在模块下存在功能，请先删除该模块下的功能！";
        if ($this->delete($this->tables[0], $id,false)) {
            return 1;
        } else {
            return $this->db_error;
        }
    }



    /**
     * 列出功能(分页)
     * 
     * @return array 返回数组array('total'=>表记录总数,'list'=>记录列表)
     */
    public function list_action ()
    {
        $data=$this->db->select('*')
                       ->from('sl_perm_data')
                       ->get()
                       ->result();
        
        return $data;
    }

    /**
     * 取得所有功能数据
     * 
     * @return array 返回对象数组
     */
    /*public function list_action_all ()
    {
        $data=$this->db->select('*')
                       ->from('sl_perm_data')
                       ->get()
                       ->result();
        return $data;
    }*/

    /**
     * 取得所有功能主题数据
     * 
     * @return array 返回对象数组
     */
    public function list_subject ()
    {
        $sql = "SELECT distinct perm_subject, perm_module_id FROM (`sl_perm_data`)";
        return $this->db->query($sql)->result();
    }

    /**
     * 保存功能
     * 
     * @return int|string 成功返回1，否则返回出错信息
     */
    public function save_action ()
    {
        $this->form_validation->set_rules('perm_module_id', '所属模块', 'required');
        $this->form_validation->set_rules('perm_subject', '功能', 'required');
        $this->form_validation->set_rules('perm_name', '动作', 'required');
        $this->form_validation->set_rules('perm_key', '代码', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            return validation_errors();
        } else {
            $data = array(
                    'perm_module_id' => $this->input->post('perm_module_id', TRUE),
                    'perm_subject' => $this->input->post('perm_subject', TRUE),
                    'order_no' => $this->input->post('order_no', TRUE),
                    'perm_name' => $this->input->post('perm_name', TRUE),
                    'perm_key' => $this->input->post('perm_key', TRUE),
                    'add_time' => date("Y-m-d H:i:s"),
                    'update_time' => date("Y-m-d H:i:s")
            );
            
            // 检查重复
            $array = array(
                    'perm_subject' => $data['perm_subject'],
                    'perm_name' => $data['perm_name']
            );
            $this->db->from('sl_perm_data');
            $this->db->where($array);
            $query = $this->db->get();
            
            $num_rows = $query->num_rows();
            $row = $query->row();
            
            $rs_perm_key = (array)$this->db->select('*')->from('sl_perm_data')->where('perm_key',$data['perm_key'])->get()->row();
            
            if ($this->input->post('id')) { // 更新保存
                $ids = $this->input->post('id');
                unset($data['add_time']);
                
                /*if ($num_rows > 0) { // 该功能的动作已经已经存在
                    if ($row->perm_module_id == $data['perm_module_id']) { // 同时属于同一个模块
                        if ($this->input->post('id') != $row->id) { // 并且不是本次修改的记录
                            return '该功能的动作在选择模块已经存在';
                        }
                    }
                }*/
                
                if ($rs_perm_key) { // 功能key已经存在
                    if ($rs_perm_key['perm_module_id'] == $data['perm_module_id']) { // 同时属于同一个模块
                        if ($ids != $rs_perm_key['id']) { // 并且不是本次修改的记录
                            return '代码在选择模块中已经存在1';
                        }
                    }
                }
                
                if ($this->db->update('sl_perm_data', $data, "id = $ids")) {
                    return 1;
                } else {
                    
                    return '更新失败';
                }
            } else { // 新增保存
                
                /*if ($num_rows > 0) { // 该功能的动作已经已经存在
                    if ($row->perm_module_id == $data['perm_module_id'])
                        return '该功能的动作在选择模块中已经存在';
                }*/
                
                if ($rs_perm_key) { // 功能key已经存在
                    if ($rs_perm_key['perm_module_id'] == $data['perm_module_id'])
                        return '代码在选择模块中已经存在';
                }
                
                if ($this->db->insert('sl_perm_data', $data)) {
                    return 1;
                } else {
                    return '插入失败';
                }
            }
        }
    }

    /**
     * 返回一个功能信息数组
     * 
     * @param int $id 功能id
     * @return array 功能信息数组
     */
    public function get_action ($id)
    {
        return $this->db->select('*')->from('sl_perm_data')->where('id',$id)->get()->result();
    }

    /**
     * 删除功能
     * 
     * @return int|string 成功返回1，否则返回出错信息       
     */
    public function delete_action ($id)
    {
        $this->db->trans_start();
        
        $this->delete($this->tables[1],$id,false);
        //同步删除已经分配给用户和角色的权限数据，以及用户禁用的数据
        $this->db->delete($this->tables[3], array('perm_id' => $id));
        $this->db->delete($this->tables[4], array('perm_id' => $id));
        $this->db->delete($this->tables[6], array('perm_id' => $id));
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return $this->db_error;
        } else {
            $this->applog->msg('删除功能');
            return 1;
        }
    }

    public function get_all_perms ()
    {
        // 取得模块数据（控制器）
        $modules = $this->list_module();
        // 取得功能数据（控制器里的方法）
        $actions = $this->list_action();
        
        $data['modules'] = $modules;
        $data['actions'] = $actions;
        
        return $data;
    }
    /**
     * 列出角色(分页)
     * 
     * @return array 返回数组array('total'=>表记录总数,'list'=>记录列表)
     */
    public function list_role ()
    {

        $data=$this->db->select('*')
                       ->from('sl_perm_role')
                       ->get()
                       ->result();
        
        return $data;
    }

    /**
     * 保存角色
     * 
     * @return int|string 成功返回1，否则返回出错信息
     */
    public function save_role ()
    {        $this->form_validation->set_rules('role_name', '角色名称', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            return 0;
        } else {
            $data = array(
                    'role_name' => $this->input->post('role_name', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'add_time' => date("Y-m-d H:i:s"),
                    'update_time' => date("Y-m-d H:i:s")
            );
            
            // 检查重复
            $rs_role_name = (array)$this->db->select('*')->from('sl_perm_role')->where('role_name',$data['role_name'])->get()->row();
            
            if ($this->input->post('id')) { // 更新保存
                $ids = $this->input->post('id');
                unset($data['add_time']);
                
                if ($rs_role_name && $rs_role_name['id'] != $ids)
                    return '角色已经存在';
                
                if ($this->db->update('sl_perm_role', $data, "id = $ids")) {
                    return 1;
                } else {
                    return '更新失败';
                }
            } else { // 新增保存
                
                if ($rs_role_name) {
                    return '角色已经存在';
                }
                if ($this->db->insert('sl_perm_role', $data)) {
                    return 1;
                } else {
                    return '插入失败';
                }
            }
        }
    }

    /**
     * 返回一个角色信息数组
     * 
     * @param int $id 角色id
     * @return array 角色信息数组
     */
    public function get_role ($id)
    {
        return $this->db->select('*')->from('sl_perm_role')->where('id',$id)->get()->result();
    }

    /**
     * 删除角色
     * 
     * @param int $id 角色id 
     * @return int|string 成功返回1，否则返回出错信息
     */
    public function delete_role ($id)
    {        
        $this->db->trans_start();
        
        $this->delete($this->tables[2],$id,false);
        //同步删除已经分配给用户角色数据，以及角色权限的数据
        $this->db->delete($this->tables[5], array('role_id' => $id));
        $this->db->delete($this->tables[3], array('role_id' => $id));
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return $this->db_error;
        } else {
            $this->applog->msg('删除角色');
            return 1;
        }
    }

    /**
     * 取得指定角色的权限字串数组
     * 
     * @param int $id 角色id
     * @return array 权限字符串数组
     */
    public function get_role_perm_string ($id)
    {
        $role_perms = $this->db->select('*')
                       ->from('sl_perm_role_perms')
                       ->get()
                       ->result();
        $perms_array = array();
        if ($role_perms) {
            foreach ($role_perms as $role_perm) {
                $this->db->select('code,perm_key');
                $this->db->from('sl_perm_data');
                $this->db->join('sl_perm_module', 'sl_perm_module.id = sl_perm_data.perm_module_id');
                $this->db->where('sl_perm_module.id', $role_perm->perm_id);
                $temp_array = $this->db->get()->result_array();
                foreach ($temp_array as $perm) {
                    $perms_array[] = $perm['code'] . '/' . $perm['perm_key'];
                }
            }
        }
        return $perms_array;
    }

    /**
     * 取得指定角色的权限
     * 
     * @param int $id 角色id
     */
    public function get_role_perm ($id)
    {
        // 取得指定角色的权限
        $role_perms = $this->db->select('*')
                       ->from('sl_perm_role_perms')
                       ->where('role_id',$id)
                       ->get()
                       ->result();
        if(!is_array($role_perms))
        {
            $role_perms = (array)$role_perms;
        }
        if ($role_perms) {
            foreach ($role_perms as $role_perm) {
                $perms[] = $role_perm->perm_id;
            }
        } else {
            $perms = false;
        }
        return $perms;
    }

    /**
     * 保存角色的权限
     * 
     * @return int|string 成功返回1，否则返回出错信息
     */
    public function save_role_perm ()
    {
        $role_id = $this->input->post('role_id');
        $perms = $this->input->post('c1');
        // 删除角色的旧权限
        if(!is_array($perms))
            $perms = (array)$perms;
        //var_dump($perms);die();

        $this->db->delete('sl_perm_role_perms',"role_id = $role_id");
        
        $this->db->trans_start();
        
        if ($perms) {
            foreach ($perms as $k => $v) {
                //var_dump($v);die();
                $data = array(
                        'role_id' => $role_id,
                        'perm_id' => $v
                );
                $this->db->insert('sl_perm_role_perms', $data);
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return '更新权限失败';
        } else {
            return 1;
        }
    }
    /**
     * ********************************角色**********************************
     */
    
    /**
     * ********************************用户**********************************
     */
    
    /**
     * 列出用户(分页)
     * 
     * @return array 返回数组array('total'=>表记录总数,'list'=>记录列表)
     */
    /*public function list_user ()
    {
        $data = $this->db->select('*')
                       ->from('user')
                       ->get()
                       ->result();
        
        return $data;
    }*/
    public function search_data(){
        $sno = $this->input->post('user_name');
        $data = $this->db->select('*')
                         ->from('user')
                         ->where('stu_name',$sno)
                         ->get()
                         ->result();
        return $data;
    }
    /**
     * 保存用户
     * 
     * @return int,string 成功返回1，否则返回出错信息
     */
    public function save_user ()
    {
        $this->form_validation->set_rules('users_id', '用户名', 'required');
        $this->form_validation->set_rules('user_name', '姓名', 'required');
        $this->form_validation->set_rules('user_position', '职位','required');
        $this->form_validation->set_rules('mobile_phone', '手机');
        $this->form_validation->set_rules('user_email', '邮箱');
        $this->form_validation->set_rules('user_class', '班级id', 'required');
        $this->form_validation->set_rules('depart_ment_id', '部门编号', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            return 0;
        } else {
            $data = array(
                    'stu_id' => $this->input->post('users_id'),
                'password' => password_hash($this->input->post('pswd'), PASSWORD_BCRYPT),
                'stu_name' => $this->input->post('user_name'),
                'stu_class' => $this->input->post('user_class'),
                'stu_position' => $this->input->post('user_position'),
                'mobile' => $this->input->post('mobile_phone'),
                'emails' => $this->input->post('user_email'),
                'department_id' => $this->input->post('depart_ment_id'),
                'register_time' => date("Y-m-d H:i:s")
                    
            );
            $data1 = array(
                    'stu_id' => $this->input->post('users_id'),
                'stu_name' => $this->input->post('user_name'),
                'stu_class' => $this->input->post('user_class'),
                'stu_position' => $this->input->post('user_position'),
                'mobile' => $this->input->post('mobile_phone'),
                'emails' => $this->input->post('user_email'),
                'department_id' => $this->input->post('depart_ment_id'),
                'register_time' => date("Y-m-d H:i:s")
                    
            );
            // 检查重复
            $rs_username = (array)$this->db->select('*')->from('user')->where('stu_id',$data['stu_id'])->get()->row();
            
            if ($this->input->post('id')) { // 更新保存
                $ids = $this->input->post('id');
                unset($data['add_time']);
                
                if (! $this->input->post('users_id'))
                    return '用户名不能为空';
                
                if ($rs_username && $rs_username['id'] != $ids)
                    return '用户已经存在';
                
                if ($this->db->update('user', $data1, "id = $ids")) {
                    return 1;
                } else {
                    
                    return '更新失败';
                }
            } else { // 新增保存
                
                if (! $this->input->post('users_id'))
                    return '用户名不能为空';
                
                if ($rs_username) {
                    return '用户已经存在';
                }
                if ($this->db->insert('user', $data)) {
                    return 1;
                } else {
                    return '插入失败';
                }
            }
        }
    }

    /**
     * 返回一个用户信息数组
     * 
     * @param int $id 用户id        
     * @return array 用户信息数组
     */
    public function get_user ($id)
    {
        return $this->db->select('*')->from('user')->where('id', $id)->get()->result();
    }

    public function list_user () 
    {
        $user_list = $this->db->select('*')
                                ->from('user')
                                ->where('department_id < ', 10)
                                ->where('department_id > ',0)
                                ->where('delete_time =', NULL)
                                ->get()
                                ->result();

        return $user_list;
    }
    
    /**
     * 返回一个用户信息数组
     *
     * @param int $id 用户id
     * @return array 用户信息数组
     */
    public function get_user_username ($username)
    {
        $rs=$this->db->select('sl_user.*')
                 ->from('sl_user')
                 ->join('sl_perm_user_roles', 'sl_user.id =sl_perm_user_roles.user_id')
                 ->join('sl_perm_role', 'sl_perm_user_roles.role_id =sl_perm_role.id')
                 ->where('username', $username)
                 ->get();
        if($rs->num_rows() > 0)
        {
            $info = $rs->row_array();
            
            $data['info'] = $info;
            return $data;
        }
        else
        {
            $data['num'] = 0;
            return $data;
        }
    }

    /**
     * 删除用户
     * 
     * @param int $id 用户id
     * @return int|string 成功返回1，否则返回出错信息
     */
    public function delete_user ($id)
    {
        if ($this->delete($this->tables[7], $id,false)) {
            $this->applog->msg('删除用户');
            return 1;
        } else {
            return $this->db_error;
        }
    }

    /**
     * 禁用或启用某个用户
     * 
     * @param int $id 用户id        
     * @param int $flag
     *            1,启用；0，禁用
     */
    public function set_status ($id, $flag)
    {
        $rs = parent::set_status('sl_user', $id, $flag);
        $this->applog->msg('更新用户状态');
        return $rs;
    }

    public function get_user_by_username($username) {

        $info = null;

        $rs=$this->db->select('user.*')
                 ->from('user')
                 ->join('sl_perm_user_roles', 'user.id =sl_perm_user_roles.user_id')
                 ->join('sl_perm_role', 'sl_perm_user_roles.role_id =sl_perm_role.id')
                 ->where('stu_id', $username)
                 ->get();


        if($rs->num_rows() > 0)
        {
            $info = $rs->row_array();
        }

        return $info;
    
    }

    public function get_perm() {
            $user_perm_string = array();
            // 取得自身权限
            $user_perm_string = $this->get_user_perm_string($user_info['id']);

            // 取得禁止权限
            $user_disable_string = $this->get_user_disable_string($user_info['id']);

            // 取得用户的所有角色
            $user_roles = $this->get_user_role($user_info['id']);
            // 用户已经赋予角色数据
            if ($user_roles['user_roles']) {
                foreach ($user_roles['user_roles'] as $role_id) { // 循环抓取角色的权限
                    $role_perm_string = $this->get_role_perm_string($role_id); // 取得角色权限
                    if ($role_perm_string) {
                        foreach ($role_perm_string as $k => $v) { // 循环角色权限，合并到用户权限
                            $user_perm_string[] = $v;
                        }
                    }
                }
            }
            // 去除角色和用户的重叠权限
            $user_perm_string = array_unique($user_perm_string);
            $user_info['perm'] = $user_perm_string;
            $user_info['disable'] = $user_disable_string;

            $this->session->set_userdata($user_info);

    }

    
    /**
     * 取得指定用户的权限字串数组
     * 
     * @param int $id
     *            用户id
     * @return array 权限字串数组
     */
    public function get_user_perm_string ($id)
    {
        $user_perms = $this->list_all_where($this->tables[4], 'user_id', $id);
        $perms_array = array();
        if ($user_perms) {
            foreach ($user_perms as $user_perm) {
                
                $this->db->select('code,perm_key');
                $this->db->from($this->tables[1]);
                $this->db->join($this->tables[0], $this->tables[0] . '.id = ' . $this->tables[1] . '.perm_module_id', 'left');
                $this->db->where($this->tables[1] . '.id', $user_perm->perm_id);
                $temp_array = $this->db->get()->result_array();
                foreach ($temp_array as $perm) {
                    $perms_array[] = $perm['code'] . '/' . $perm['perm_key'];
                }
            }
        }
        return $perms_array;
    }

    /**
     * 取得指定用户的禁用权限字串数组
     * 
     * @param int $id
     *            用户id
     * @return array 权限字串数组
     */
    public function get_user_disable_string ($id)
    {
        $user_perms = $this->list_all_where($this->tables[6], 'user_id', $id);
        $perms_array = array();
        if ($user_perms) {
            foreach ($user_perms as $user_perm) {
                
                $this->db->select('code,perm_key');
                $this->db->from($this->tables[1]);
                $this->db->join($this->tables[0], $this->tables[0] . '.id = ' . $this->tables[1] . '.perm_module_id', 'left');
                $this->db->where($this->tables[1] . '.id', $user_perm->perm_id);
                $temp_array = $this->db->get()->result_array();
                foreach ($temp_array as $perm) {
                    $perms_array[] = $perm['code'] . '/' . $perm['perm_key'];
                }
            }
        }
        return $perms_array;
    }

    /**
     * 取得指定用户的权限
     * 
     * @param int $id
     *            用户id
     */
    public function get_user_perm ($id)
    {
        // 取得指定用户的权限
        $user_perms = $this->db->select('*')->from('sl_perm_user_perms')->where('user_id', $id)->get()->result();
        
        if ($user_perms) {
            foreach ($user_perms as $user_perm) {
                $perms[] = $user_perm->perm_id;
            }
        } else {
            $perms = false;
        }
        
        return $perms;
    }

    /**
     * 取得指定用户被禁用的权限
     * 
     * @param int $id
     *            用户id
     */
    public function get_user_disable ($id)
    {
        $user_perms = $this->db->select('*')->from('sl_perm_user_disable')->where('user_id', $id)->get()->result();
        
        if ($user_perms) {
            foreach ($user_perms as $user_perm) {
                $perms[] = $user_perm->perm_id;
            }
        } else {
            $perms = false;
        }
        
        return $perms;
    }

    /**
     * 保存用户的权限
     * 
     * @return json
     */
    public function save_user_perm ()
    {
        $user_id = $this->input->post('user_id');
        $perms = $this->input->post('c1');
        if(!is_array($perms))
            $perms = (array)$perms;
        // 删除用户的旧权限
        $this->db->delete('sl_perm_user_perms',"user_id = $user_id");
        $this->db->trans_start();
        
        if ($perms) {
            foreach ($perms as $k => $v) {
                $data = array(
                        'user_id' => $user_id,
                        'perm_id' => $v
                );
                $this->db->insert('sl_perm_user_perms', $data);
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === true) {
            return 0;
        } else {
            
            return 1;
        }
    }

    /**
     * 保存用户禁用的权限
     * 
     * @return int|string 成功返回1，否则返回出错信息
     */
    public function save_user_disable ()
    {
        $user_id = $this->input->post('user_id');
        $perms = $this->input->post('c2');
        
        // 删除用户的旧权限
        $this->db->delete($this->tables[6], array(
                'user_id' => $user_id
        ));
        
        $this->db->trans_start();
        
        if ($perms) {
            foreach ($perms as $k => $v) {
                $data = array(
                        'user_id' => $user_id,
                        'perm_id' => $v
                );
                $this->create($this->tables[6], $data);
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return $this->db_error;
        } else {
            $this->applog->msg('更新用户禁用权限');
            return 1;
        }
    }

    /**
     * 取得指定用户的角色
     * 
     * @param int $id
     *            用户id
     */
    public function get_user_role ($id)
    {
        // 取得角色数据
        $all_roles = $this->db->select('*')->from('sl_perm_role')->get()->result();
        // 取得指定用户的角色
        $rs = $this->db->select('*')->from('sl_perm_user_roles')->where('user_id',$id)->get()->result();
        if ($rs) {
            foreach ($rs as $user_role) {
                $user_roles[] = $user_role->role_id;
            }
        } else {
            $user_roles = false;
        }
        
        $data['all_roles'] = $all_roles; // 所有角色
        //var_dump($data['all_roles']);die();
        $data['user_roles'] = $user_roles; // 用户的角色id数组
        
        return $data;
    }

    /**
     * 保存用户的角色
     * 
     * @return int|string 成功返回1，否则返回出错信息
     */
    public function save_user_role ()
    {
        $user_id = $this->input->post('user_id');
        $roles = $this->input->post('c0');
        if(!is_array($roles))
            $roles = (array)$roles;
        // 删除用户的旧角色
        $this->db->delete('sl_perm_user_roles',"user_id = $user_id");
        
        $this->db->trans_start();
        
        if ($roles) {
            foreach ($roles as $k => $v) {
                $data = array(
                        'user_id' => $user_id,
                        'role_id' => $v
                );
                $perms = $this->db->select('perm_id')
                                  ->from('sl_perm_role_perms')
                                  ->where('role_id',$data['role_id'])
                                  ->get()
                                  ->result();
                if(!is_array($perms))
                    $perms = (array)$perms;
                $this->db->delete('sl_perm_user_perms',"user_id = $user_id");
                $this->db->trans_start();
                foreach ($perms as $k) {
                    $data1 = array(
                            'user_id' => $user_id,
                            'perm_id' => $k->perm_id
                    );
                    $this->db->insert('sl_perm_user_perms', $data1);
                }
                $this->db->insert('sl_perm_user_roles', $data);
            }
        }
        
        $this->db->trans_complete();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 0;
        } else {
            return 1;
        }
    }
}