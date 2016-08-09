<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('log_model');
    }
    
    public function _remap($method, $param = array())
    {
        if($this->session->userdata('isLoggedIn'))
        {
                //already login
                //$this->log_model->log_xb();
                call_user_func_array(array($this, $method), $param);
        }
        else
        {
                //not login in
                redirect(site_url('login'));
        }
    }
}