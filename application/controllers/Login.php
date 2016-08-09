<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('permission_model');
                $this->load->model('captcha_model');
        }

        public function index()
        {
                if($this->session->userdata('isLoggedIn'))
                {
                        redirect('welcome');
                }
                else 
                {
                        $data['error'] = '';
                        //$data['pic'] = $this->captcha_model->init_pic();
                        $this->load->view('login', $data);
                }
        }

        public function captcha(){

                $image = $this->captcha_model->init_pic();
                header('content-type:image/png');
                imagepng($image['image']);

                //end
                imagedestroy($image['image']); 

                $this->load->view('captcha');
        
        }
        public function check_login()
        {
        	$check = $this->permission_model->check_login();
                if($check === 1) {
                        redirect('welcome');
                } else {
                        $result['pic'] = $this->captcha_model->init_pic();
                        $result['error'] = $check;
                        $this->load->view('login',$result);
                }
        }
        
        public function login_out() 
        {
                $this->session->sess_destroy();
                $this->index();
        }
        
}