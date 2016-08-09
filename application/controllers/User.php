<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('user_model');
        $this->load->model('log_model');
        $this->load->model('talk_model');
        $this->load->model('permission_model');
        $this->load->model('organization_model');
    }
    public function user ()
    {
        $data['list'] = $this->user_model->list_user();
        $data['url'] = 'user/user_management';
        $data['title'] = '用户列表';
        $data['depart'] = $this->organization_model->get_department();
        $data['position'] = $this->organization_model->get_position();
        $data['class'] = $this->organization_model->get_class();
        $this->load->view('main', $data);
    }
    public function ajax_list_user()
    {
        $list = $this->user_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
            $no++;
            $row = array();
            $row[] = $person->stu_id;
            $row[] = $person->stu_name;
            $row[] = $person->class_name;
            $row[] = $person->department_name;
            $row[] = $person->position_name;
            $row[] = $person->mobile;
            $row[] = $person->emails;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="修改" onclick="edit_user('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> 修改</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="删除" onclick="delete_user('."'".$person->id."'".')"><i class="glyphicon glyphicon-trash"></i> 删除</a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->user_model->count_all(),
                        "recordsFiltered" => $this->user_model->count_filtered(),
                        "data" => $data,
                );
        
        echo json_encode($output);
    }

    public function ajax_add_user()
    {
        $this->_ajax_add_user_validate();
        $data = array(
            'stu_id' => $this->input->post('users_id'),
            'password' => password_hash($this->input->post('pswd'), PASSWORD_BCRYPT),
            'stu_name' => $this->input->post('user_name'),
            'stu_class' => $this->input->post('user_class'),
            'stu_position' => $this->input->post('user_position'),
            'mobile' => $this->input->post('mobile_phone'),
            'emails' => $this->input->post('user_email'),
            'department_id' => $this->input->post('depart_ment_id'),
            'photo_name' => 'user4-128x128.jpg',
            'register_time' => date("Y-m-d H:i:s")
                
        );
        $this->db->insert('user', $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit_user_information()
    {
        $this->_ajax_edit_user_validate();
        $data = array(
            'stu_id' => $this->input->post('users_id'),
            'stu_name' => $this->input->post('user_name'),
            'stu_class' => $this->input->post('user_class'),
            'stu_position' => $this->input->post('user_position'),
            'mobile' => $this->input->post('mobile_phone'),
            'emails' => $this->input->post('user_email'),
            'department_id' => $this->input->post('depart_ment_id'),
            'register_time' => date("Y-m-d H:i:s")
                
        );
        $user_id = $data['stu_id'];
        $this->db->update('user', $data,"stu_id = $user_id");
        echo json_encode(array("status" => TRUE));
    }

    private function _ajax_add_user_validate()
    {
        $this->form_validation->set_rules('users_id', '用户名', 'required|is_unique[user.stu_id]');
        $this->form_validation->set_rules('user_name', '姓名', 'required');
        $this->form_validation->set_rules('user_position', '职位','required');
        $this->form_validation->set_rules('mobile_phone', '手机','required');
        $this->form_validation->set_rules('user_email', '邮箱','required');
        $this->form_validation->set_rules('user_class', '班级id', 'required');
        $this->form_validation->set_rules('depart_ment_id', '部门编号', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode(array("error" => validation_errors()));
            exit();
        }
    }

    private function _ajax_edit_user_validate()
    {
        $this->form_validation->set_rules('users_id', '用户名', 'required');
        $this->form_validation->set_rules('user_name', '姓名', 'required');
        $this->form_validation->set_rules('user_position', '职位','required');
        $this->form_validation->set_rules('mobile_phone', '手机','required');
        $this->form_validation->set_rules('user_email', '邮箱','required');
        $this->form_validation->set_rules('user_class', '班级id', 'required');
        $this->form_validation->set_rules('depart_ment_id', '部门编号', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            echo json_encode(array("error" => validation_errors()));
            exit();
        }
    }

    public function ajax_edit_user($id)
    {
        $data = $this->user_model->get_user_by_id($id);
        echo json_encode($data);
    }

    public function ajax_delete_user($id)
    {
        $data = array(
            'delete_time' => date('Y-m-d H:i:s')
        );
        if($this->db->update('user',$data,"id = $id")){
            echo json_encode(array("status" => TRUE));
        }
        else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function add_my_user_link($id)
    {
        $data['url'] = 'user/add_my_user';
        $data['title'] = '添加人员';
        $data['ids'] = $id;
        $data['error'] = '';
        $data['position'] = $this->organization_model->get_position();
        $data['class'] = $this->organization_model->get_class();
        $data['depart'] = $this->organization_model->get_department();
        $this->load->view('main', $data);
    }

    public function add_my_user($id)
    {
        if($this->user_model->add_my_user() == 0){
            //fail
            $data['url'] = 'user/add_my_user';
            $data['title'] = '添加人员';
            $data['ids'] = $id;
            $data['depart'] = $this->organization_model->get_department();
            $data['position'] = $this->organization_model->get_position();
            $data['class'] = $this->organization_model->get_class();
            $this->load->view('main', $data);   
        } else {
            redirect('organization/display_depart_user/'.$id);
        }
    }
    
    public function change_password_link()
    {
        $data['url'] = 'change_password';
        $data['title'] = '修改密码';
        $this->load->view('main', $data);
    }
    
    public function change_password() 
    {     
        $this->form_validation->set_rules('pswd_origin', '原密码', 'required|callback_is_original_password', 
            array('required' => '%s是必填项目',
                  'is_original_password' => '原密码错误'));
            
        $this->form_validation->set_rules('pswd', '新密码', 'required|min_length[8]');
        $this->form_validation->set_rules('pswd_again', '确认密码', 'required|min_length[8]|matches[pswd]');
        
        if($this->form_validation->run() == FALSE) {
            $this->change_password_link();
        } else {
            if($this->user_model->change_password($this->session->userdata('id')))
                redirect('welcome/info_user');
            else
                redirect('user/change_password_link');
        }
    }

    public function edit_my_user_link($id,$id_1)
    {
        $data['url'] = 'user/edit_my_user';
        $data['title'] = '修改个人信息';
        $data['ids'] = $id;
        $data['error'] = '';
        $data['depart'] = $this->organization_model->get_department();
        $data['position'] = $this->organization_model->get_position();
        $data['class'] = $this->organization_model->get_class();
        $data['user'] = $this->user_model->get_depart_user_by_id($id_1);
        //var_dump($data['user']);
         //die();
        $this->load->view('main', $data);
    }
    public function edit_my_user($id)
    {
        if($this->user_model->change_user_info($this->input->post('hidden_id'))==1)
            redirect('organization/display_depart_user/'.$id);
        else
            $data['url'] = 'user/edit_my_user';
            $data['title'] = '修改个人信息';
            $data['ids'] = $id;
            $data['error'] = $this->user_model->change_user_info($this->input->post('hidden_id'));
            $data['depart'] = $this->organization_model->get_department();
            $data['position'] = $this->organization_model->get_position();
            $data['class'] = $this->organization_model->get_class();
            $data['user'] = $this->user_model->get_depart_user_by_id($this->input->post('hidden_id'));
            $this->load->view('main', $data);
    }
    //helper function 
    public function is_original_password()
    {
        if($this->permission_model->check_owner()){
            return true;
        } else {
            return false;
        }
    }
    /**
    *@ function:修改头像
    *@ author:mlcode
    */
    public function edit_portrait($id){
        $data['url'] = 'dispatch/edit_portrait';
        $data['title'] = "修改头像";
        $data['ids'] = $id;
        $data['error'] = "";
        $this->load->view('main',$data);
    }

    public function initialize_upload()
    {
        $data['upload_path']    = './AdminLTE2/dist/img';
        $data['allowed_types']  = 'jpg';
        $data['max_size']       = 0;
        $data['max_width']      = 0;
        $data['max_height']     = 0;
        $data['max_filename']   = 50;

        if( ! $this->upload->initialize($data))
        {
            return "fail to initialize upload library";
        }
        else
        {
            return "";
        }
    }

    public function do_upload()
    {
        $id = $this->input->post('user_id');
        $error = $this->initialize_upload();
        if ( ! $this->upload->do_upload('userfile'))
        {
            $data['error'] = $this->upload->display_errors();
            $data['url'] = 'dispatch/edit_portrait';
            $data['title'] = '修改头像';
            $data['ids'] = $id;
            $this->load->view('main',$data);
        }
        else
        {
            $file_data = $this->upload->data();
            $rs = $this->user_model->check_protrait($file_data);
            $data['url'] = 'dispatch/profile';
            $data['title'] = '说说';
            $result = $this->talk_model->list_user_name_information_by_id($id);
            $data['talk'] = $this->talk_model->get_talk();
            //var_dump($data['talk']);die();
            if($result['department_id'] != 0){
                $data['person'] = $this->talk_model->list_user_information_by_id($id);
            }
            else{
                $data['person'] = $this->talk_model->list_big_user_information_by_id($id);
            }
            $data['comment'] = $this->talk_model->get_comment();
            $data['response'] = $this->talk_model->get_response();
            $data['click_id'] = $this->talk_model->get_clicker();
            $this->load->view('main',$data);
        }
    }
}