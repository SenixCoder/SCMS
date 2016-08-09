<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('permission_model');
                $this->load->model('captcha_model');
                $this->load->model('register_model');
        }

        /*public function index()
        {
                if($this->session->userdata('isLoggedIn'))
                {
                        redirect('welcome');
                }
                else 
                {
                        $data['pic'] = $this->captcha_model->init_pic();
                        $this->load->view('login', $data);
                }
        }*/

        public function add_register_user()
        {
                if($this->register_model->add_register_user() == 0){
                                //fail
                        $this->load->view('register');
                } else {
                        redirect('login/index');
                }
        }
        
        public function register()
        {
                $this->load->view('register');
        }
        
        public function forget_ps(){
                $data['error'] = '';
                $this->load->view('check_email',$data);
        }

        public function check_email(){
               /* 邮箱验证，用于密码修改 */
               /*var_dump($this->register_model->check_email());die();*/
               if($this->register_model->check_email() == 1){
                        $email = $this->input->post('user_email');
                        if($this->register_model->send_email($email)){
                                $result['username'] = $this->input->post('users_id');
                                $result['error'] = '';
                                $this->load->view('edit_pswd',$result);
                        }
                        else{
                                $result['error'] = "邮件发送失败";
                                $this->load->view('check_email',$result);
                        }
               }
               else{
                        $result['error'] = "邮箱或用户名出错";
                        $this->load->view('check_email',$result);
               }
        }

        public function check_pswd(){
                if($this->register_model->check_pswd()){
                        redirect('login/index');
                }
                else{
                        $result['username'] = $this->input->post('users_id');
                        $result['error'] = "验证码出错";
                        $this->load->view('edit_pswd',$result);
                }
        }
}