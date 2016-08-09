<?php

class Organization_model extends CI_Model 
{
	public function __construct() 
	{
    	// Call the CI_Model constructor
    	parent::__construct();
		$this->load->model('permission_model');
		$this->load->library('email');
    }
	
	function get_department()
	{
		$term = $this->db->select('*')
					   ->from('department')
					   ->get()
					   ->result();
		
		return $term;
	}

	/**
	*@ function:得到部门功能模块
	*@ author:mlcode
	*/
	function get_department_module()
	{
		$term = $this->db->select('*')
					   ->from('department_module')
					   ->get()
					   ->result();
		
		return $term;
	}

	/**
	*@ function:根据模块名获得模块代码
	*@ author:mlcode
	*/
	function get_module_code_by_module_name(){
		$data = $this->db->select('module_code')
						 ->from('organization_module')
						 ->where('module_name',$this->input->post('key'))
						 ->get()
						 ->result();
		return $data;
	}
	
	/**
	*@ function:根据部门名获得模块代码
	*@ author:mlcode
	*/
	function get_module_code_by_depart_id(){
		$id = $this->input->post('group');
		if($id == 8){
			$term = $this->db->select('*')
					   		 ->from('organization_module')
					   		 ->get()
					   	 	 ->result();
		}else{
			$term = $this->db->select('*')
					   		 ->from('organization_module')
					   		 /*此处sf_lishi代表是否是理事会专用，如果不是理事会成员，则其数据库中该字段为NULL*/
					   		 ->where('sf_lishi',NULL)
					   		 ->get()
					   	 	 ->result();
		}
		
		return $term;
	}
	/**
	*@ function:得到组织功能模块
	*@ author:mlcode
	*/
	function get_organization_module()
	{
		$term = $this->db->select('*')
					   	 ->from('organization_module')
					   	 ->get()
					   	 ->result();
		
		return $term;
	}
	
	function get_class()
	{
		$term = $this->db->select('*')
					   ->from('class')
					   ->get()
					   ->result();
		
		return $term;
	}

	function get_position()
	{
		$term = $this->db->select('*')
					   ->from('position')
					   ->get()
					   ->result();
		
		return $term;
	}
	
	function add_file_check($data1){
		$this->form_validation->set_rules('department_id', '部门编号','required');
        if($this->form_validation->run() == false)
        {
            return "上传信息出错";
        }
        $data = array(
        	'department_id' => $this->input->post('department_id'),
        	'name' => $data1['file_name'],
			'size' => $data1['file_size'],
			'path' => $data1['file_path'],
			'time' => date('Y-m-d H:i:s')
        );
        if(!$this->db->insert('file_data',$data)){
        	return "添加失败";
        }
        else{
        	return "添加成功";
        }
	}

	/**
    *@ function:dedao例会文件信息
    *@ author:mlcode
    */
	public function get_file_path_by_id($id)
	{
		$data = (array)$this->db->select('*')
						  ->from('file_data')
						  ->where('id', $id)
						  ->get()
						  ->row();
 		return $data;
	}

	function list_activity(){
		$data = $this->db->select('activity.*,department.department_name')
					   ->from('activity')
					   ->join('department','department.id=activity.department_id')
					   ->where('add_time !=',NULL)
					   ->get()
					   ->result();
		
		return $data;
	}
	/**
    *@ function : 显示所选部门活动信息
    *@ author : mlcode
    */
	function list_information_by_department_name(){
		$data = $this->db->select('activity.*,department.department_name')
					   ->from('activity')
					   ->join('department','department.id=activity.department_id')
					   ->where('add_time !=',NULL)
					   ->where('department.id =', $this->input->post('key'))
					   ->get()
					   ->result();
		
		return json_encode($data);
	}
	/**
    *@ function : 显示所有部门活动信息
    *@ author : mlcode
    */
	function list_information_all_department(){
		$data = $this->db->select('activity.*,department.department_name')
					   ->from('activity')
					   ->join('department','department.id=activity.department_id')
					   ->where('add_time !=',NULL)
					   ->get()
					   ->result();
		
		return json_encode($data);
	}

	function list_activity_by_id($id){
		$data = $this->db->select('activity.*,department.department_name')
					   ->from('activity')
					   ->join('department','department.id=activity.department_id')
					   ->where('activity.id',$id)
					   ->get()
					   ->result();
		
		return $data;
	}

	function add_activity_check(){
		$this->form_validation->set_rules('activity_fp', '活动发布者','required');
		$this->form_validation->set_rules('department_id', '部门编号','required');
		$this->form_validation->set_rules('activity_name', '活动名称','required');
		$this->form_validation->set_rules('activity_gj_money', '活动估计经费');
		$this->form_validation->set_rules('address', '活动地址','required');
        if($this->form_validation->run() == false)
        {
            return "信息出错";
        }
        $time = $this->input->post('activity_time')." ".$this->input->post('time_start');
        $date = date("Y-m-d H:i:s");
        if(strtotime($time)<strtotime($date)){
        	return "活动时间不能小于当前时间";
        }
        $data = array(
        	'department_id' => $this->input->post('department_id'),
        	'stu_name' => $this->input->post('activity_fp'),
        	'activity_name' => $this->input->post('activity_name'),
        	'activity_gj_money' => $this->input->post('activity_gj_money'),
        	'address' => $this->input->post('address'),
        	'time' => $time
        );

        if(!$this->send_lishi_email()){
        	return "邮件发送失败";
        }
        if(!$this->db->insert('activity',$data)){
        	return "添加失败";
        }
        else{
        	return 1;
        }
	}

	function edit_activity_check(){
		$this->form_validation->set_rules('activity_fp', '活动发布者','required');
		$this->form_validation->set_rules('department_id', '部门编号','required');
		$this->form_validation->set_rules('activity_name', '活动名称','required');
		$this->form_validation->set_rules('activity_sj_money', '活动实际经费');
		$this->form_validation->set_rules('address', '活动地址','required');
        if($this->form_validation->run() == false)
        {
            return "信息出错";
        }
        $ids = $this->input->post('hidden_id');
        $data = array(
        	'department_id' => $this->input->post('department_id'),
        	'stu_name' => $this->input->post('activity_fp'),
        	'activity_name' => $this->input->post('activity_name'),
        	'activity_sj_money' => $this->input->post('activity_sj_money'),
        	'address' => $this->input->post('address'),
        	'time' => $this->input->post('activity_time')
        );
        if(!$this->db->update('activity',$data,"id = $ids")){
        	return "更新失败";
        }
        else{
        	return 1;
        }
	}
	function list_activity_time(){
		$data = $this->db->select('activity.*,department.department_name')
					   ->from('activity')
					   ->join('department','department.id=activity.department_id')
					   ->get()
					   ->result();
		
		return $data;
	}

	function approve_activity_time($id){
		$data =array(
			'add_time' => date('Y-m-d H:i:s')
		);
		if($this->db->update('activity',$data,"id = $id")){
			return 1;
		}
		else{
			return "批准失败";
		}
	}
	function add_task_check($emails,$activity_name){
		$this->form_validation->set_rules('activity_id', '活动id','required');
		$this->form_validation->set_rules('department_id', '部门编号','required');
		$this->form_validation->set_rules('task_fp', '任务发布者','required');
		$this->form_validation->set_rules('task_js', '任务接受者','required');
		$this->form_validation->set_rules('task_name', '任务名称','required');
		$this->form_validation->set_rules('task_date', '任务结束日期','required');
        if($this->form_validation->run() == false)
        {
            return "信息出错";
        }
        $time = $this->input->post('task_date')." ".$this->input->post('task_endtime');
        $data = array(
        	'department_id' => $this->input->post('department_id'),
        	'activity_id' => $this->input->post('activity_id'),
        	'task_fp' => $this->input->post('task_fp'),
        	'task_js' => $this->input->post('task_js'),
        	'task_name' => $this->input->post('task_name'),
        	'activity_starttime' => date('Y-m-d H:i:s'),
        	'activity_endtime' => $time
        );
        if(strtotime($data['activity_starttime'])>strtotime($data['activity_endtime']))
        {
        	return "截止时间应该晚于开始时间";
        }
        if(!$this->send_email($emails,$activity_name,$time)){
        	return "邮件发送失败";
        }
        if(!$this->db->insert('task',$data)){
        	return "添加失败";
        }
        else{
        	return 1;
        }
	}
	function list_file_information_by_depart_id($id)
	{
		$data = $this->db->select('department_name,file_data.*')
		    			 ->from('file_data')
		    			 ->join('department','file_data.department_id = department.id')
		    			 ->where('department_id =',$id)
		    			 ->get()
		    			 ->result();
		return $data;
	}

	function list_all_file_information()
	{
		$data = $this->db->select('department_name,file_data.*')
		    			 ->from('file_data')
		    			 ->join('department','file_data.department_id = department.id')
		    			 ->get()
		    			 ->result();
		return $data;
	}

	function list_file_depart_name_by_depart_id($id)
	{
		$data = (array)$this->db->select('department_name')
		    			 ->from('department')
		    			 ->where('id =',$id)
		    			 ->get()
		    			 ->row();
		return $data;
	}

	function list_task($id)
	{
		$data = $this->db->select('task.*,department.department_name,activity.activity_name,user.stu_name,user.stu_id')
		    			 ->from('task')
		    			 ->join('department','task.department_id = department.id')
		    			 ->join('activity','task.activity_id = activity.id')
		    			 ->join('user','task.task_js = user.stu_id')
		    			 ->where('task.department_id = ',$id)
		    			 ->get()
		    			 ->result();
		return $data;
	}

	function list_task_endtime_by_id($id)
	{
		$data = $this->db->select('activity_endtime')
		    			 ->from('task')
		    			 ->where('task.id = ',$id)
		    			 ->get()
		    			 ->row_array();
		return $data;
	}

	function list_all_task($id)
	{
		$data = $this->db->select('task.*,department.department_name,activity.activity_name,user.stu_name,user.stu_id')
		    			 ->from('task')
		    			 ->join('department','task.department_id = department.id')
		    			 ->join('activity','task.activity_id = activity.id')
		    			 ->join('user','task.task_js = user.stu_id')
		    			 ->where('task.id = ',$id)
		    			 ->get()
		    			 ->result();
		return $data;
	}

	function finish_my_task_check($id,$end_time){
		$data = array(
			'time' => date('Y-m-d H:i:s')
		);
		if(strtotime($data['time'])>strtotime($end_time)){
			return "任务超出截止时间";
		}
		if($this->db->update('task',$data,"id = $id")){
			return 1;
		}
		else{
			return "更新失败";
		}
	}

	function list_depart_name_by_id($id){
		$data = (array)$this->db->select('department.department_name')
						 ->from('department')
						 ->join('activity','activity.department_id = department.id')
						 ->where('activity.id',$id)
						 ->get()
						 ->row();
		return $data;
	}

	function list_my_task_by_id($user_id){
		$data = $this->db->select('task.*,department.department_name,activity.activity_name,user.stu_name,user.stu_id')
		    			 ->from('task')
		    			 ->join('department','task.department_id = department.id')
		    			 ->join('activity','task.activity_id = activity.id')
		    			 ->join('user','task.task_js = user.stu_id')
		    			 ->where('task.task_js = ',$user_id)
		    			 ->get()
		    			 ->result();
		return $data;

	}

	function get_organization(){
		$data = $this->db->select('*')
						 ->from('department')
						 ->get()
						 ->result();
		return $data;
	}

	function get_activity($id){
		$data = $this->db->select('activity_name')
						 ->from('activity')
						 ->where('id',$id)
						 ->get()
						 ->row_array();
		return $data;
	}
	function get_topic_by_activity_id($id){
		$data = $this->db->select('*')
						 ->from('topic')
						 ->where('activity_id',$id)
						 ->where('delete_time',NULL)
						 ->get()
						 ->result();
		return $data;
	}
	function get_user_id_by_task_id($id){
		$data = $this->db->select('task_js')
						 ->from('task')
						 ->where('id',$id)
						 ->get()
						 ->row_array();
		return $data;
	}

	function get_email(){
		$user_id = $this->input->post('task_js');
		$result = $this->db->select('emails')
						   ->from('user')
						   ->where('stu_id',$user_id)
						   ->get()
						   ->row_array();
		return $result;
	}

	function send_email($to_email,$activity_name,$end_time)
	{
		$buzhang = $this->input->post('task_fp');
		$renwuxinxi = $this->input->post('task_name');
		$config['protocol']  = 'smtp';
		$config['smtp_host'] = 'smtp.163.com';
		$config['smtp_user'] = 'mlcode_note@163.com';
		$config['smtp_pass'] = 'mlcode9602011';
		$config['smtp_port'] = '25';
		$config['charset'] 	 = 'utf-8';
		$config['wordwrap']  = 'TRUE';
		$config['mailtype']  = 'html';
		$this->email->initialize($config);
		$this->email->from('mlcode_note@163.com', 'mlcode');
		$this->email->to($to_email);
		$this->email->subject($buzhang.'为你新建了任务');
		$this->email->message('活动名称为：'.$activity_name.'<br/>任务为：'.$renwuxinxi.'<br/>任务结束时间为：'.$end_time.'<br>具体任务信息请登录科协管理平台查看');

		return $this->email->send();
	}

	/**
	*@ function:发布活动时发送邮件至理事会
	*@ author:mlcode
	*/
	function send_lishi_email()
	{
		$result = (array)$this->db->select('emails')->from('user')->where('department_id',8)->get()->row(0);
		$to_email = $result['emails'];
		$username = $this->session->userdata('front_name');
		$config['protocol']  = 'smtp';
		$config['smtp_host'] = 'smtp.163.com';
		$config['smtp_user'] = 'mlcode_note@163.com';
		$config['smtp_pass'] = 'mlcode9602011';
		$config['smtp_port'] = '25';
		$config['charset'] 	 = 'utf-8';
		$config['wordwrap']  = 'TRUE';
		$config['mailtype']  = 'html';
		$this->email->initialize($config);
		$this->email->from('mlcode_note@163.com', 'mlcode');
		$this->email->to($to_email);
		$this->email->subject($username.'发布了一个新活动');
		$this->email->message('具体活动信息请登录科协管理平台的科技协会理事会的活动审批查看');

		return $this->email->send();
	}

	function get_department_name($id)
	{
		$term = $this->db->select('department_name')
					   ->from('department')
					   ->where('id',$id)
					   ->get()
					   ->row_array();
		
		return $term;
	}
	function send_my_email($to_email,$department_name)
	{
		$username = $this->session->userdata('front_name');
		$subject = $this->input->post('subject');
		$comment = $this->input->post('editor1');
		$config['protocol']  = 'smtp';
		$config['smtp_host'] = 'smtp.163.com';
		$config['smtp_user'] = 'mlcode_note@163.com';
		$config['smtp_pass'] = 'mlcode9602011';
		$config['smtp_port'] = '25';
		$config['charset'] 	 = 'utf-8';
		$config['wordwrap']  = 'TRUE';
		$config['mailtype']  = 'html';
		$this->email->initialize($config);
		$this->email->from('mlcode_note@163.com', 'mlcode');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($department_name.' '.$username.'发送给你的消息为:'.$comment);

		return $this->email->send();
	}

	function save_comment($id){
		$this->form_validation->set_rules('comments','评论内容','required');
		if($this->form_validation->run() == false){
			return "评论内容出错";
		}
		else{
			$data = array(
				'stu_name' => $this->session->userdata('front_name'),
				'topic' => $this->input->post('comments'),
				'activity_id' => $id
			);
			if($this->db->insert('topic',$data)){
				return 1;
			}
			else{
				return "插入失败";
			}
		}
	}

	function delete_comment($id){
		$data = array(
			'delete_time' => date('Y-m-d H:i:s')
		);
		if($this->db->update('topic',$data,"id = $id")){
			return 1;
		}
		else{
			return 0;
		}
	}

	/**
	*@ function:得到今日资料量
	*@ author:mlcode
	*/

	function get_file_per_day(){
		$data = $this->db->select('count(*) as count')
		      			 ->from('file')
		      			 ->where('time >=',date("Y-m-d 00:00:00"))
		      			 ->where('time <=',date("Y-m-d 23:59:59"))
		      			 ->get()
		      			 ->result();
		return $data;
	}
	/**
	*@ function:得到今日提交例会资料的部门
	*@ author:mlcode
	*/

	function get_name_per_day(){
		$data = $this->db->select('distinct(department_name)')
		      			 ->from('file_data')
		      			 ->join('department','department.id = file_data.department_id')
		      			 ->where('time >=',date("Y-m-d 00:00:00"))
		      			 ->where('time <=',date("Y-m-d 23:59:59"))
		      			 ->get()
		      			 ->result();
		return $data;
	}

	/**
	*@ function:得到待批准活动个数
	*@ author:mlcode
	*/
	function get_num_unapprove_activity(){
		return $this->db->select('count(*) as num')->from('activity')->where('add_time',null)->get()->result();
	}
}