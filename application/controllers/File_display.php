<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_display extends MY_Controller {

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
			$this->load->model("display_file_model");
	}
	/**
    *@ function:显示年级和班级的信息
    *@ author:mlcode
    */
    public function display_file()
    {
        $data['url'] = "file_display/grade";
        $data['title'] = "学习资料";
        $data['grades'] = $this->display_file_model->get_grade();
        $data['courses'] = $this->display_file_model->get_course();
        $this->load->view('main',$data);
    }
    /**
    *@ function :添加年级
    *@ author:mlcode
    */
    public function ajax_add_grade(){
    	$this->ajax_add_grade_check();
    	$data = array(
    		'name' => $this->input->post('grade')
    	);
    	if($this->db->insert('grade',$data)){
    		echo json_encode(array('status' => TRUE));
    	}
    	else{
    		echo json_encode(array('status' => FALSE));
    	}
    }
    public function ajax_add_grade_check(){
    	$this->form_validation->set_rules('grade',"学期",'required|is_unique[grade.name]');
    	if($this->form_validation->run() == false){
    		echo json_encode(array("error" => validation_errors()));
            exit();
		}
    }

    /**
    *@ function :添加课程
    *@ author:mlcode
    */
    public function ajax_add_course(){
    	$this->ajax_add_course_check();
    	$data = array(
    		'grade_id' => $this->input->post('grade'),
    		'term' => $this->input->post('course')
    	);
    	if($this->db->insert('course',$data)){
    		echo json_encode(array('status' => TRUE));
    	}
    	else{
    		echo json_encode(array('status' => FALSE));
    	}
    }
    public function ajax_add_course_check(){
    	$this->form_validation->set_rules('course',"科目",'required');
    	if($this->form_validation->run() == false){
    		echo json_encode(array("error" => validation_errors()));
            exit();
		}
    }

    /**
    *@ function : 得到科目信息
    *@ author: mlcode
    */
    public function ajax_course($id){
        $data = $this->display_file_model->get_course_by_course_id($id);
        echo json_encode($data);
    }

    /**
    *@ function : 修改科目名称
    *@ author: mlcode
    */
    public function edit_course_link($id){
        $data['url'] = "file_display/edit_course";
        $data['title'] = "修改课程";
        $data['grades'] = $this->display_file_model->get_grade();
        $data['course'] = $this->display_file_model->get_course_by_course_id($id);
        $this->load->view('main',$data);
    }

    public function save_course(){
        $id = $this->input->post('course_id');
        $rs = $this->display_file_model->save_course($id);
        if($rs === 1){
            redirect('file_display/display_file');
        }
        else{
            redirect('file_display/edit_course_link/'.$id);
        }
    }
    /**
    *@ function : ajax修改科目名称
    *@ author: mlcode
    */
    public function ajax_edit_course(){
        $this->ajax_edit_course_check();
        $data = array(
            'grade_id' => $this->input->post('grade'),
            'term' => $this->input->post('course')
        );
        if($this->db->update('course',$data,"id = $course_id")){
            echo json_encode(array('status' => TRUE));
        }
        else{
            echo json_encode(array('status' => FALSE));
        }
    }

    public function ajax_edit_course_check(){
        $this->form_validation->set_rules('course',"科目",'required');
        if($this->form_validation->run() == false){
            echo json_encode(array("error" => validation_errors()));
            exit();
        }
    }
}