<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

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
			$this->load->model('reservation_model');
			$this->load->model('log_model');
			$this->load->model('user_model');
			$this->load->model('organization_model');
			$this->load->model('talk_model');
	}

	public function index()
	{
		$data['url'] = 'info_status';
		$data['title'] = '状态概要';
		$data['department'] = $this->organization_model->get_department();
		$data['per_day'] = $this->organization_model->get_file_per_day();
		$data['department_n'] = $this->organization_model->get_name_per_day();
		$data['num'] = $this->organization_model->get_num_unapprove_activity();
		$this->load->view('main', $data);
	}
	public function info_user()
	{
		$data['url'] = 'info_user';
		$data['title'] = '账户信息';
		$data['person'] = $this->log_model->get_person_by_stu_id($this->session->userdata('front_id'));
		$data['file_num'] = $this->log_model->get_file_by_stu_id($this->session->userdata('front_id'));
		$this->load->view('main', $data);
	}
	public function info_organization_information()
	{
		$data['url'] = 'organization/info_organization_information';
		$data['title'] = '科协各部门信息概览';
		$data['organization'] = $this->organization_model->get_organization();
		$data['user'] = $this->user_model->list_user();
		$this->load->view('main', $data);
	}

	public function notice()
	{
		$data['url'] = 'notice';
		$data['title'] = '联系我们';
		$data['error'] = ' ';
		$this->load->view('main', $data);
	}

	public function dispatch()
	{
		$data['url'] = 'dispatch/dispatch';
		$data['title'] = '活动策划';
		$data['error'] = '';
		$data['dispatch'] = $this->reservation_model->get_dispatch();
		$this->load->view('main', $data);
	}

	/**
	*function:显示个人说说信息
	*author:mlcode
	*/
	public function display_person($id)
	{
		$data['url'] = 'dispatch/display_person';
		$result = $this->talk_model->list_user_name_information_by_id($id);
		$data['title'] = $result['stu_name'].'的基本信息';
		$data['username'] = $result['stu_name'];
		if($result['department_id'] != 0){
			$data['person'] = $this->talk_model->list_user_information_by_id($id);
		}
		else{
			$data['person'] = $this->talk_model->list_big_user_information_by_id($id);
		}
		$data['talk'] = $this->talk_model->get_talk_by_stu_id($id);
		$data['comment'] = $this->talk_model->get_comment();
		$data['response'] = $this->talk_model->get_response();
		$data['users_id'] = $this->talk_model->get_follow_id($id);
		$data['click_id'] = $this->talk_model->get_clicker();
		$this->load->view('main', $data);
	}

	/**
	*function：显示所有已关注人的说说信息
	*author:mlcode
	*/
	public function profile()
	{
		$data['url'] = 'dispatch/profile';
		$data['title'] = '说说';
		$result = $this->talk_model->list_user_name_information_by_id($this->session->userdata('id'));
		$data['talk'] = $this->talk_model->get_talk();
		//var_dump($data['talk']);die();
		if($result['department_id'] != 0){
			$data['person'] = $this->talk_model->list_user_information_by_id($this->session->userdata('id'));
		}
		else{
			$data['person'] = $this->talk_model->list_big_user_information_by_id($this->session->userdata('id'));
		}
		$data['comment'] = $this->talk_model->get_comment();
		$data['response'] = $this->talk_model->get_response();
		$data['click_id'] = $this->talk_model->get_clicker();
		$this->load->view('main', $data);
	}


	public function follow($id)
	{
		$rs = $this->talk_model->check_follow($id);
		if($rs === 1){
			redirect('welcome/display_person/'.$id);
		}
		else{
			redirect('welcome/profile');
		}
	}

	public function unfollow($id)
	{
		$rs = $this->talk_model->check_unfollow($id);
		if($rs === 1){
			redirect('welcome/display_person/'.$id);
		}
		else{
			redirect('welcome/profile');
		}
	}


	public function add_dispatch(){
		$data['url'] = 'dispatch/add_dispatch';
		$data['title'] = '添加通知发文';
		$data['error'] = '';
		$this->load->view('main', $data);
	}
	public function edit_dispatch($id){
		$data['url'] = 'dispatch/edit_dispatch';
		$data['title'] = '修改通知发文';
		$data['error'] = '';
		$data['ids'] = $id;
		$data['dispatch'] = $this->reservation_model->get_dispatch_by_id($id);
		$this->load->view('main', $data);
	}
	public function check_dispatch(){
		$rs = $this->reservation_model->check_dispatch();
		if($rs === 1){
			redirect('welcome/dispatch');
		}
		else{
			$data['url'] = 'dispatch/add_dispatch';
			$data['title'] = '添加通知发文';
			$data['error'] = $rs;
			$this->load->view('main', $data);
		}
	}

	public function check_edit_dispatch($id){
		$rs = $this->reservation_model->check_edit_dispatch($id);
		if($rs === 1){
			redirect('welcome/dispatch');
		}
		else{
			$data['url'] = 'dispatch/edit_dispatch';
			$data['title'] = '修改通知发文';
			$data['error'] = $rs;
			$data['ids'] = $id;
			$this->load->view('main', $data);
		}
	}

	public function delete_dispatch($id){
		$rs = $this->reservation_model->delete_dispatch($id);
		if($rs === 1){
			redirect('welcome/dispatch');
		}
		else{
			$data['url'] = 'dispatch/dispatch';
			$data['title'] = '通知发文';
			$data['dispatch'] = $this->reservation_model->get_dispatch();
			$data['error'] = $rs;
			$this->load->view('main', $data);
		}
	}

	public function display_dispatch($id){
		$data['url'] = 'dispatch/display_dispatch';
		$data['title'] = '具体信息';
		$data['dispatch'] = $this->reservation_model->get_dispatch_by_id($id);
		$this->load->view('main',$data);
	}

	public function check_comment($id){
		$rs = $this->talk_model->check_comment($id);
		if($rs === 1){
			redirect('welcome/profile');
		}
		else{
			redirect('welcome/profile');
		}
	}

	public function send_topic(){
		$rs = $this->talk_model->send_topic();
		if($rs === 1){
			redirect('welcome/profile');
		}
		else{
			redirect('welcome/profile');
		}
	}

	public function check_send_response($id,$comment_id,$commenter_id){
		//var_dump($commenter_id);die();
		$rs = $this->talk_model->check_send_response($id,$comment_id,$commenter_id);
		if($rs === 1){
			redirect('welcome/profile');
		}
		else{
			redirect('welcome/profile');
		}
	}

	public function get_name($user_id){
		$result = (array)$this->db->select('stu_name')
						   ->from('user')
						   ->where('id',$user_id)
						   ->get()
						   ->row();
		return $result['stu_name'];
	}

	public function delete_talk($id){
		if(($this->db->delete('talk',"id = $id"))&&($this->db->delete('comment',"id_id = $id"))&&($this->db->delete('response',"id_num = $id"))){
			redirect('welcome/profile');
		}
		else{
			redirect('welcome/profile');
		}
	}

	public function delete_comment($id){
		$ids = (array)$this->db->select('id_id')->from('comment')->where('id',$id)->get()->row();
		$idss = $ids['id_id'];
		$result = (array)$this->db->select('comment_num')->from('talk')->where('id',$idss)->get()->row();
		$num = (array)$this->db->select('count(*) as count')->from('response')->where('comment_id',$id)->get()->row();
		$data = array(
			'comment_num' => $result['comment_num']-1-$num['count']
		);
		if(($this->db->delete('comment',"id = $id"))&&($this->db->delete('response',"comment_id = $id"))&&($this->db->update('talk',$data,"id = $idss"))){
			redirect('welcome/profile');
		}
		else{
			redirect('welcome/profile');
		}
	}

	public function delete_response($id){
		$ids = (array)$this->db->select('id_num')->from('response')->where('id',$id)->get()->row();
		$idss = $ids['id_num'];
		$result = (array)$this->db->select('comment_num')->from('talk')->where('id',$idss)->get()->row();
		
        $data = array(
            'comment_num' => $result['comment_num']-1
        );
		if($this->db->delete('response',"id = $id")&&$this->db->update('talk',$data,"id = $idss")){
			redirect('welcome/profile');
		}
		else{
			redirect('welcome/profile');
		}
	}

	/**
	*function:搜索好友
	*author:mlcode
	*/

	public function search_friends(){
		$username = $this->input->post('username');
		$result = (array)$this->db->select('id,count(id) as ids')
						   ->from('user')
						   ->where('stu_name',$username)
						   ->get()
						   ->row();
		if($result['ids'] > 0){
			redirect('welcome/display_person/'.$result['id']);
		}
		else{
			redirect('welcome/profile');
		}
	}
	/**
	*function:显示已关注的好友列表
	*author:mlcode
	*/
	public function display_num($id){
		$result = $this->talk_model->list_user_name_information_by_id($id);
		$data['title'] = $result['stu_name'].'的好友列表';
		$data['url'] = 'dispatch/display_num';
		$data['user'] = $this->talk_model->list_following_user_information_by_id($id);
		$this->load->view('main', $data);
	}

	/**
	*function:显示点赞的好友列表
	*author:mlcode
	*/
	public function display_like($id,$stu_id){
		$result = $this->talk_model->list_user_name_information_by_id($stu_id);
		$data['title'] = $result['stu_name'].'的点赞好友列表';
		$data['url'] = 'dispatch/display_num';
		$data['user'] = $this->talk_model->list_like_user_information_by_id($id);
		$this->load->view('main', $data);
	}

	/**
	*function:点赞
	*author:mlcode
	*/
	public function like($id){
		$rs = $this->talk_model->check_like($id);
		if($rs === 1){
			redirect('welcome/profile');
		}
		else{
			redirect('welcome/profile');
		}
	}

	/**
	*function:取消赞
	*author:mlcode
	*/
	public function unlike($id){
		$rs = $this->talk_model->check_unlike($id);
		if($rs === 1){
			redirect('welcome/profile');
		}
		else{
			redirect('welcome/profile');
		}
	}

	public function file()
	{
		$data['url'] = 'file/show';
		$data['title'] = '学习资料';
		$this->load->view('main', $data);
	}

	/**
	*function:wechat
	*author:mlcode
	*/
	public function wechat()
	{
		$data['url'] = 'dispatch/wechat';
		$data['title'] = '微信推送';
		$data['wechat'] = $this->reservation_model->get_wechat();
		$this->load->view('main', $data);
	}

	/**
	*function:显示老科协人员信息
	*author:mlcode
	*/
	public function display_old()
	{
		$data['url'] = 'organization/display_old';
		$data['title'] = '老科协人员信息一览';
		$data['old_people'] = $this->user_model->get_old_people();
		$this->load->view('main', $data);
	}
}
