<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller {

	public function __construct()
	{
			parent::__construct(); 
			$this->load->model('log_model');
	}
	 
	public function _remap($origin_uri)
    {
    	if($this->session->userdata('isLoggedIn'))
    	{
    		//already login
			$this->log_model->log_xb();
    		$this->$origin_uri();
    	}
    	else
    	{
    		//not login in
    	    redirect(site_url('login'));
    	}
    }


	public function index()
	{
		$data['url'] = 'log/open_record_log';
		$data['title'] = '开门日志';
		
		$data['log_data'] = $this->log_model->get_open_record_log();
		$this->load->view('main', $data);
	}
	
	public function open_record()
	{
		$data['url'] = 'log/open_record_log';
		$data['title'] = '开门日志';
		
		$data['log_data'] = $this->log_model->get_open_record_log();
		$this->load->view('main', $data);
	}
}
