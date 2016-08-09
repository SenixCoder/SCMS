<?php

class Upload extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url','download', 'file'));
        //$this->load->helper(array('form', 'url', 'upload')); 
        $this->load->model('user_model');
        $this->load->model('upload_model');
        $this->load->model('file_model');
        $this->load->model('display_file_model');
    }

    public function add_file()
    {
        //跳转函数所用数据，ajax用不到 
        /*$grade_id = $this->input->post('grade');
        $course_id = $this->input->post('course');
        $data['grade_id'] = isset($grade_id) ? $grade_id :"";
        $data['course_id'] = isset($course_id) ? $course_id : "";*/
        $rs = $this->upload_model->add_file_check();
        if($rs === 1){
            redirect('file_display/grade');
        }
        else{
            $data['url'] = 'file/add_file';
            $data['title'] = '添加资料';
            $data['error'] = $rs;
            $data['grades'] = $this->display_file_model->get_grade();
            $data['courses'] = $this->upload_model->get_terms();
            $this->load->view('main',$data);
        }
    }

    public function add_file_link()
    {
        $data['url'] = 'file/add_file';
        $data['title'] = '添加资料';
        $data['error'] = ' ';
        //跳转函数所用数据，ajax用不到 
        /*$grade_id = $this->input->post('grade');
        $course_id = $this->input->post('course');
        $data['grade_id'] = isset($grade_id) ? $grade_id :"";
        $data['course_id'] = isset($course_id) ? $course_id : "";*/
        $data['grades'] = $this->display_file_model->get_grade();
        $data['courses'] = $this->upload_model->get_terms();
        $this->load->view('main', $data);
    }
    /**
    *@ function : 用函数或者用ajax得到对应学期的科目
    *@ author: mlcode
    */
    public function get_course_by_grade($grade_id = null)
    {   
        $grade_id = $this->input->post('key');
        $course = $this->display_file_model->get_course_by_grade($grade_id);
        $options = '';
        foreach ($course as $c) {
            $options .= '<option value="' . $c->id . '">' . $c->term . '</option>';
        }

        echo $options;
    }

    public function display($id)
    {
        $course_name = $this->upload_model->list_file_course_name_by_course_id($id);
        //var_dump($course_name);die();
        $data['file_data'] = $this->file_model->list_files_by_course($id);
        $data['url'] = 'file/display';
        $data['title'] = $course_name['term'].'资料一览';
        $this->load->view('main', $data);
    }
    public function do_upload()
    {
        $config['upload_path']      = './jike';
        $config['allowed_types']    = 'gif|jpg|png|docx|ppt';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $data['error'] = $this->upload->display_errors();
            $data['url'] = 'file/add_file';
            $data['title'] = '添加资料';
            $data['courses'] = $this->upload_model->get_terms();
            $this->load->view('main',$data);
        }
        else
        {
            $rs = $this->upload_model->add_file_check();
            $data['error'] = $rs;
            $data['url'] = 'file/add_file';
            $data['title'] = '添加资料';
            $data['courses'] = $this->upload_model->get_terms();
            $this->load->view('main',$data);
        }
    }

    public function web_upload()  
    {  
        multifile_array();  
        foreach ($_FILES as $file => $file_data){  
            $this->do_upload_rg($file);  
        }  
    }
}
?>
