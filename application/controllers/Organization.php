<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
			parent::__construct();
            $this->load->helper(array('form','url','download', 'file'));

            $this->load->library('upload');
			$this->load->model('reservation_model');
			$this->load->model('organization_model');
			$this->load->model('user_model');
			$this->load->model('log_model');
	}
    /**
    *@ function : 显示科技协会信息
    *@ author: mlcode
    */
    public function display_organization(){
        $data['url'] = "organization/display_organization";
        $data['title'] = "科技协会";
        $data['organization'] = $this->organization_model->get_department();
        $data['module'] = $this->organization_model->get_department_module();
        $data['oran'] = $this->organization_model->get_organization_module();
        $this->load->view('main',$data);
    }
	public function add_file()
    {
        $rs = $this->organization_model->add_file_check();
        $data['url'] = 'organization/add_file';
        $data['title'] = '添加例会资料';
        $data['error'] = $rs;
        $data['depart'] = $this->organization_model->get_department();
        $this->load->view('main',$data);
    }

	public function add_file_link()
    {
        $data['url'] = 'organization/add_file';
        $data['title'] = '添加例会资料';
        $data['error'] = ' '; 
        $data['depart'] = $this->organization_model->get_department();
        $this->load->view('main', $data);
    }

    public function display_lh($id)
    {
        $course_name = $this->organization_model->list_file_depart_name_by_depart_id($id);
        //var_dump($course_name);die();
        $data['depart'] = $this->organization_model->list_file_information_by_depart_id($id);
        $data['url'] = 'organization/display_lh';
        $data['title'] = $course_name['department_name'].'例会资料一览';
        $this->load->view('main', $data);
    }

    public function display_all_lh()
    {
        $data['depart'] = $this->organization_model->list_all_file_information();
        $data['url'] = 'organization/display_lh';
        $data['title'] = '科协各部门例会资料总览';
        $this->load->view('main', $data);
    }

    public function display_depart_user($id)
    {
        $course_name = $this->organization_model->list_file_depart_name_by_depart_id($id);
        //var_dump($course_name);die();
        $data['user_data'] = $this->user_model->list_user_information_by_department($id);
        $data['url'] = 'organization/display_depart_user';
        $data['title'] = $course_name['department_name'].'人员信息一览';
        $data['ids'] = $id;
        $this->load->view('main', $data);
    }
    public function display_task($id)
    {
        $course_name = $this->organization_model->list_file_depart_name_by_depart_id($id);
        //var_dump($course_name);die();
        $data['url'] = 'organization/display_task';
        $data['title'] = $course_name['department_name'].'人员任务分配信息一览';
        $data['task'] = $this->organization_model->list_task($id);
        $this->load->view('main', $data);
    }

    public function initialize_upload()
    {
        $data['upload_path']    = './lihui';
        $data['allowed_types']  = 'git|jpg|png|doc|docx|zip|rar|xlsx|ppt|xls|pdf';
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
        $error = $this->initialize_upload();
        if ( ! $this->upload->do_upload('userfile'))
        {
            $data['error'] = $this->upload->display_errors();
            $data['url'] = 'organization/add_file';
            $data['title'] = '添加例会资料';
            $data['depart'] = $this->organization_model->get_department();
            $this->load->view('main',$data);
        }
        else
        {
            $file_data = $this->upload->data();
            $rs = $this->organization_model->add_file_check($file_data);
            $data['error'] = $rs;
            $data['url'] = 'organization/display_organization';
            $data['title'] = '科技协会';
            $data['organization'] = $this->organization_model->get_department();
            $data['module'] = $this->organization_model->get_department_module();
            $data['oran'] = $this->organization_model->get_organization_module();
            $this->load->view('main',$data);
        }
    }

    /**
    *@ function:下载例会文件
    *@ author:mlcode
    */
    public function down_lh($id){
        $data = $this->organization_model->get_file_path_by_id($id);

        force_download("./lihui/".$data['name'], NULL);
    }

    /**
    *@ function:删除例会文件
    *@ author:mlcode
    */
    public function delete_lh($id){
        $data = $this->organization_model->get_file_path_by_id($id);
        $filename = './lihui/'.$data['name'];
        unlink($filename);
        $this->db->delete('file_data',"id = $id");
        $detail = json_encode(array('request'=>"delete_lihui",'delete_people'=>$this->session->userdata('front_id')));
        $result = array(
            'level' => 2,
            'time' => date("Y-m-d H:i:s"),
            'detail' => $detail
        );
        $this->db->insert('system_log',$result);
        redirect('organization/display_organization');
    }

    public function add_task(){
        $to_email = $this->organization_model->get_email();
        $id = $this->input->post('activity_id');
        $activity = $this->organization_model->get_activity($id);
        $rs = $this->organization_model->add_task_check($to_email['emails'],$activity['activity_name']);
        if($rs === 1){
            $data['url'] = 'organization/add_task';
            $data['title'] = '分配任务';
            $data['error'] = '分配任务成功';
            $data['depart'] = $this->organization_model->get_department();
            $data['activity'] = $this->organization_model->list_activity();
            if($this->session->userdata('isAdmin')==0||$this->session->userdata('isAdmin')==8)
            {
                $data['user'] = $this->user_model->list_user();
            }
            else
            {
                $data['user'] = $this->user_model->list_user_information_by_department($this->session->userdata('isAdmin'));
            }
            $this->load->view('main', $data);
        }
        else{
            $data['url'] = 'organization/add_task';
            $data['title'] = '分配任务';
            $data['error'] = '分配任务失败,'.$rs;
            $data['activity'] = $this->organization_model->list_activity();
            $data['depart'] = $this->organization_model->get_department();
            if($this->session->userdata('isAdmin')==0||$this->session->userdata('isAdmin')==8)
            {
                $data['user'] = $this->user_model->list_user();
            }
            else
            {
                $data['user'] = $this->user_model->list_user_information_by_department($this->session->userdata('isAdmin'));
            }
            $this->load->view('main', $data);
        }
        
    }

    public function add_task_link(){
        $data['url'] = 'organization/add_task';
        $data['title'] = '分配任务';
        $data['error'] = ' ';
        $data['depart'] = $this->organization_model->get_department();
        $data['activity'] = $this->organization_model->list_activity();
        if($this->session->userdata('isAdmin')==0||$this->session->userdata('isAdmin')==8)
        {
            $data['user'] = $this->user_model->list_user();
        }
        else
        {
            $data['user'] = $this->user_model->list_user_information_by_department($this->session->userdata('isAdmin'));
        }
        $this->load->view('main', $data);
    }

    public function activity_management(){
        $data['activity_data'] = $this->organization_model->list_activity();
        $data['url'] = 'organization/activity_management';
        $data['title'] = '活动列表一览';
        $this->load->view('main', $data);
    }

    public function add_activity(){
        $rs = $this->organization_model->add_activity_check();
        if($rs === 1)
        {
            $data['url'] = 'organization/add_activity';
            $data['title'] = '发布活动';
            $data['error'] = '活动发布成功';
            $data['depart'] = $this->organization_model->get_department();
            $data['query_date'] = date('Y-m-d',time());
            $this->load->view('main', $data);
        }
        else
        {
            $data['url'] = 'organization/add_activity';
            $data['title'] = '发布活动';
            $data['error'] = $rs;
            $data['query_date'] = date('Y-m-d',time());
            $data['depart'] = $this->organization_model->get_department();
            $this->load->view('main', $data);
        }
    }

    public function add_activity_link(){
        $data['url'] = 'organization/add_activity';
        $data['title'] = '发布活动';
        $data['error'] = ' ';
        $data['query_date'] = date('Y-m-d',time());
        $data['depart'] = $this->organization_model->get_department();
        $this->load->view('main', $data);
    }

    public function edit_activity(){
        $rs = $this->organization_model->edit_activity_check();
        if($rs === 1)
        {
            redirect('organization/activity_management');
        }
        else
        {
            $data['url'] = 'organization/edit_activity';
            $data['title'] = '修改活动信息';
            $data['error'] = $rs;
            $data['depart'] = $this->organization_model->get_department();
            $this->load->view('main', $data);
        }
    }
    /**
    *@ function : 显示每个部门活动信息
    *@ author : mlcode
    */
    public function list_information_by_department_name()
    {
        $data = $this->organization_model->list_information_by_department_name();
        echo $data;
    }
    /**
    *@ function : 显示所有活动信息
    *@ author : mlcode
    */
    public function list_information_all_department(){
        $data = $this->organization_model->list_information_all_department();
        echo $data;
    }

    public function edit_activity_link($id){
        $data['url'] = 'organization/edit_activity';
        $data['title'] = '修改活动信息';
        $data['error'] = ' ';
        $data['depart'] = $this->organization_model->get_department();
        $data['activity'] = $this->organization_model->list_activity_by_id($id);
        $this->load->view('main', $data);
    }

    public function approve_activity(){
        $data['url'] = 'organization/approve_activity';
        $data['title'] = '活动审批';
        $data['error'] = '';
        $data['activity_data'] = $this->organization_model->list_activity_time();
        $this->load->view('main', $data);
    }

    public function approve_activity_time($id){
        $rs = $this->organization_model->approve_activity_time($id);
        if($rs === 1){
            redirect('organization/activity_management');
        }
        else{
            $data['url'] = 'organization/approve_activity';
            $data['title'] = '活动审批';
            $data['error'] = $rs;
            $data['activity_data'] = $this->organization_model->list_activity_time();
            $this->load->view('main', $data);
        }
    }
    public function finish_my_task($id){
        $end_time = $this->organization_model->list_task_endtime_by_id($id);
        $rs = $this->organization_model->finish_my_task_check($id,$end_time['activity_endtime']);
        $user = $this->organization_model->get_user_id_by_task_id($id);
        if($rs === 1){
            redirect('organization/list_my_task/'.$user['task_js']);
        }
        else{
            $data['url'] = 'organization/list_my_task';
            $data['title'] = '我的任务列表';
            $data['error'] = $rs;
            $data['task'] = $this->organization_model->list_my_task_by_id($user['task_js']);
            $this->load->view('main', $data);
        }
    }

    public function list_my_task($user_id){
        $data['url'] = 'organization/list_my_task';
        $data['title'] = '我的任务列表';
        $data['error'] = '';
        $data['task'] = $this->organization_model->list_my_task_by_id($user_id);
        $this->load->view('main', $data);
    }

    public function send_email(){
        $department_id = $this->session->userdata('isAdmin');
        if($department_id == 0){
            $depart['department_name'] = '';
        }
        $depart = $this->organization_model->get_department_name($department_id);
        $email = $this->input->post('emails');
        if($this->organization_model->send_my_email($email,$depart['department_name'])){
            $data['url'] = 'notice';
            $data['title'] = '联系我们';
            $data['error'] = '发送成功';
            $this->load->view('main', $data);
        }
        else{
            $data['url'] = 'notice';
            $data['title'] = '联系我们';
            $data['error'] = '发送失败';
            $this->load->view('main', $data);
        }
    }

    public function comment_management($id)
    {
        $result = $this->organization_model->get_activity($id);
        $data['url'] = 'organization/comment_management';
        $data['title'] = $result['activity_name'].'的所有评论';
        $data['list'] = $this->organization_model->get_topic_by_activity_id($id);
        $data['ids'] = $id;
        $this->load->view('main', $data);
    }

    public function add_comment($id)
    {
        $data['url'] = 'organization/comment';
        $data['title'] = '我的评论';
        $data['error'] = '';
        $data['ids'] = $id;
        $this->load->view('main', $data);
    }

    public function save_comment($id)
    {
        $rs = $this->organization_model->save_comment($id);
        if($rs === 1){
            redirect('organization/comment_management/'.$id);
        }
        else{
            $data['url'] = 'organization/comment';
            $data['title'] = '我的评论';
            $data['error'] = $rs;
            $data['ids'] = $id;
            $this->load->view('main', $data);
        }
    }
    public function delete_comment($id,$ids)
    {
        $rs = $this->organization_model->delete_comment($id);
        /*if($rs === 1){*/
            redirect('organization/comment_management/'.$ids);
        /*}*//*
        else{
            echo "<script>alert('删除失败')</script>";
        }*/
    }

    /**
    *@ function :添加部门
    *@ author:mlcode
    */
    public function ajax_add_department(){
        $this->ajax_add_department_check();
        $data = array(
            'department_name' => $this->input->post('department')
        );
        if($this->db->insert('department',$data)){
            echo json_encode(array('status' => TRUE));
        }
        else{
            echo json_encode(array('status' => FALSE));
        }
    }
    public function ajax_add_department_check(){
        $this->form_validation->set_rules('department',"部门",'required|is_unique[department.department_name]');
        if($this->form_validation->run() == false){
            echo json_encode(array("error" => validation_errors()));
            exit();
        }
    }

    /**
    *@ function :添加模块
    *@ author:mlcode
    */
    public function ajax_add_module(){
        $this->ajax_add_module_check();
        $data = array(
            'department_id' => $this->input->post('department'),
            'module_name' => $this->input->post('module'),
            'module_code' => $this->input->post('module_code')
        );
        $result = (array)$this->db->select('count(*) as count')
                                  ->from('department_module')
                                  ->where('department_id',$data['department_id'])
                                  ->where('module_code',$data['module_code'])
                                  ->get()
                                  ->row();
        if($result['count'] == 0){
            if($this->db->insert('department_module',$data)){
                echo json_encode(array('status' => TRUE));
            }
            else{
                echo json_encode(array('status' => FALSE));
            }
        }
        else
            echo json_encode(array("error" => "该部门模块重复"));
            exit();
            
    }
    public function ajax_add_module_check(){
        $this->form_validation->set_rules('module',"模块名",'required');
        $this->form_validation->set_rules('module_code',"模块代码",'required');
        if($this->form_validation->run() == false){
            echo json_encode(array("error" => validation_errors()));
            exit();
        }
    }

    /**
    *@ function :根据模块名获取模块代码
    *@ author:mlcode
    */
    public function is_exist_by_ajax(){
        $data = $this->organization_model->get_module_code_by_module_name();
        $str = '';
        foreach($data as $row) {
          $str = $str . '<option value=' . $row->module_code . '>' . $row->module_code . '</option>';
        }
        
        echo $str;
    }

    /**
    *@ function :根据部门名获取模块代码
    *@ author:mlcode
    */
    public function get_module_by_ajax(){
        $data = $this->organization_model->get_module_code_by_depart_id();
        $str = "<option value=''></option>";
        foreach($data as $row) {
          $str = $str . '<option value=' . $row->module_name . '>' . $row->module_name . '</option>';
        }
        
        echo $str;
    }
}
