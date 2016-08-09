<?php

class File_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_usesname_by_id($id)
	{
		return $this->db->select('stu_name')->from('user')->where('stu_id',$id)->get()->result();
	}

	public function get_terms()
	{
		return $this->db->get('grade')->result();
	}	

	public function get_term_by_id($id)
	{
		return $this->db->select('name')->from('grade')->where('id',$id)->get()->result();
	}

	public function get_courses()
	{
		return $this->db->get('course')->result();
	}

	public function get_term_courses($id)
	{
		return $this->db->select('term')->from('course')->where('grade_id',$id)->get()->result();
	}

	public function list_files_by_course($course_id)
	{
		$this->db->select('*');
		$this->db->where('course_id', $course_id);
		$this->db->from('file');
		$query = $this->db->get()->result();

		return $query;
	}

	public function get_course_name_by_id($course_id)
	{
		$query = $this->db->select('term')
						  ->where('id', $course_id)
						  ->from('course')
						  ->get()
						  ->result();

		return $query;
	}

	public function upload_check()
	{
		$this->form_validation->set_rules('user_name', '上传者');
		$this->form_validation->set_rules('course', '科目id', 'required');
		$this->form_validation->set_rules('user_id', '上传者id');

		if($this->form_validation->run() == false)
		{
			return "表单验证启动失败";
		}
		else
		{
			return 1;
		}
	}

	public function insert_file_data($data)
	{
		if($this->upload_check() == 1)
		{
			$file['name'] = $data['file_name'];
			$file['size'] = $data['file_size'];
			$file['path'] = $data['file_path'];
			$file['user_id'] = $this->input->post('user_id');
			$file['time'] = date('Y-m-d H:i:s');
			$file['course_id'] = $this->input->post('course');

			if( ! $this->db->insert('file', $file))
			{
				return "插入数据库失败";
			}
			else
			{
				return "文件上传成功";
			}
		}
		else
		{
			return $this->upload_check();
		}
	}

	public function get_file_path_by_id($id)
	{
		$query = $this->db->select('*')
						  ->from('file')
						  ->where('id', $id)
						  ->get()
						  ->result();
 		return $query;
	}

	public function delete_file_by_name($name)
	{
		if( ! $this->db->where('name', $name)->delete('file'))
		{
			return "文件数据删除失败";
		}
		else
		{
			return "文件数据删除成功";
		}
	}

}
?>