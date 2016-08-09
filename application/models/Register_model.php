<?php

class Register_model extends CI_Model 
{
	public function __construct() 
	{
    	// Call the CI_Model constructor
    	parent::__construct();
		$this->load->model('permission_model');
		$this->load->library('email');
    }
	
	function add_register_user() 
	{
		$this->form_validation->set_rules('users_id', '用户名', 'required|is_unique[user.stu_id]');
		$this->form_validation->set_rules('pswd', '密码', 'required|min_length[8]');
		$this->form_validation->set_rules('user_name', '姓名', 'required');
		$this->form_validation->set_rules('mobile_phone', '手机','required');
		$this->form_validation->set_rules('user_email', '邮箱','required');
		$this->form_validation->set_rules('user_position', '职位','required');
		$this->form_validation->set_rules('user_class', '班级id', 'required');
		$this->form_validation->set_rules('depart_ment_id', '部门编号', 'required');
		if ($this->form_validation->run() == FALSE)
        {
            return 0;
        }
        else
        {
            $data = array(
				'stu_id' => $this->input->post('users_id'),
				'password' => password_hash($this->input->post('pswd'), PASSWORD_BCRYPT),
				'stu_name' => $this->input->post('user_name'),
				'stu_position' => $this->input->post('user_position'),
				'stu_class' => $this->input->post('user_class'),
				'mobile' => $this->input->post('mobile_phone'),
				'emails' => $this->input->post('user_email'),
				'department_id' => $this->input->post('depart_ment_id'),
				'photo_name' => 'user4-128x128.jpg',
				'register_time' => date("Y-m-d H:i:s")
			);

			$this->db->insert('user', $data);

			return 1;
        }
	}

	function check_email(){
		$this->form_validation->set_rules('users_id','用户名','required');
		$this->form_validation->set_rules('user_email','邮箱','required|valid_email',array('valid_email' => '邮箱格式错误'));

		if($this->form_validation->run() == false){
			return 0;
		}
		else{
			$username = $this->input->post('users_id');
			$data = array(
				'emails' => $this->input->post('user_email')
			);
			$result = $this->db->select('emails')
							   ->from('user')
							   ->where('stu_id',$username)
							   ->get()
							   ->row_array();
			if($result['emails'] == $data['emails']){
				return 1;
			}
			else{
				return 0;
			}
		}
	}

	function check_pswd(){
		$this->form_validation->set_rules('pswd','密码','required|min_length[8]');
		if($this->form_validation->run()==false){
			return false;
		}

		$user_id = $this->input->post('users_id');
		$data = array(
			'captcha' => $this->input->post('captcha')
		);
		$data_a = array(
			'password' => password_hash($this->input->post('pswd'), PASSWORD_BCRYPT)
		);
		if (strtolower($data['captcha'])!=strtolower($_SESSION['captcha']))
        {

            return false;
        }
         $this->db->update('user',$data_a,"stu_id = $user_id");
         return true;

     }

	function send_email($to_email)
	{
		$cap_email = $this->captcha_model->init_pic();
		//var_dump($cap_email['captcha']);die();

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
		$this->email->subject('Email address verification');
		$this->email->message($cap_email['captcha']);

		return $this->email->send();
	}
}