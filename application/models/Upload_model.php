<?php

class Upload_model extends CI_Model 
{
	public function __construct() 
	{
    	// Call the CI_Model constructor
    	parent::__construct();
		$this->load->model('permission_model');
    }
	
	function get_terms()
	{
		$term = $this->db->select('*')
					   ->from('course')
					   ->get()
					   ->result();
		
		return $term;
	}
	
	function add_file_check(){
		$this->form_validation->set_rules('user_name', '上传者');
		$this->form_validation->set_rules('course', '科目id', 'required');
        if($this->form_validation->run() == false)
        {
            return "上传信息出错";
        }
        $data = array(
        	'user_name' => $this->input->post('user_name'),
        	'course_id' => $this->input->post('course'),
        );
        if(!$this->db->insert('file_upload',$data)){
        	return "添加失败";
        }
        else{
        	return 1;
        }
	}

	function list_file_information_by_course_id($id)
	{
		$data = $this->db->select('*')
		    			 ->from('file_upload')
		    			 ->where('course_id =',$id)
		    			 ->get()
		    			 ->result();
		return $data;
	}

	function list_file_course_name_by_course_id($id)
	{
		$data = (array)$this->db->select('term')
		    			 ->from('course')
		    			 ->where('id =',$id)
		    			 ->get()
		    			 ->row();
		return $data;
	}
}