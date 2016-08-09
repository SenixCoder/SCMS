<?php

class Display_file_model extends CI_Model 
{
	public function __construct() {
    	// Call the CI_Model constructor
    	parent::__construct();
  }

  /**
  *@ function:得到所有年级
  *@ author:mlcode
  */

  public function get_grade() {

  	$grades = $this->db->select('*')
                                ->from('grade')
                                ->get()
                                ->result();
  	return $grades;
  }

  /**
  *@ function:得到所有课程
  *@ author:mlcode
  */

  public function get_course() {

    $courses = $this->db->select('*')
                                ->from('course')
                                ->get()
                                ->result();
    return $courses;
  }

  public function get_course_by_grade($grade_id) {

    $courses = $this->db->select('*')
                                ->from('course')
                                ->where('grade_id',$grade_id)
                                ->get()
                                ->result();
    return $courses;
  }

  /**
    *@ function : 割据课程id得到科目信息
    *@ author: mlcode
    */
  public function get_course_by_course_id($course_id) {

    $courses = $this->db->select('*')
                                ->from('course')
                                ->where('id',$course_id)
                                ->get()
                                ->result();
    return $courses;
  }

  public function save_course($id){
    $this->form_validation->set_rules('course',"科目",'required');
    if($this->form_validation->run() == false){
      return 0;
    }
    else{
      $data = array(
            'grade_id' => $this->input->post('grade'),
            'term' => $this->input->post('course')
      );
      if($this->db->update('course',$data,"id = $id")){
        return 1;
      }
      else{
        return 0;
      }
    }
  }
}