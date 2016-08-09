<?php

class User_model extends CI_Model 
{
	var $column = array('id','stu_id', 'stu_name','stu_class', 'department_id','stu_position','mobile','emails','department_name');
	public function __construct() 
	{
    	// Call the CI_Model constructor
    	parent::__construct();
		$this->load->model('permission_model');
    }

    
    function add_my_user() 
	{
		$this->form_validation->set_rules('users_id', '用户名', 'required|is_unique[user.stu_id]');
		$this->form_validation->set_rules('pswd', '密码', 'required|min_length[8]');
		$this->form_validation->set_rules('user_name', '姓名', 'required');
		$this->form_validation->set_rules('user_position', '职位','required');
		$this->form_validation->set_rules('mobile_phone', '手机');
		$this->form_validation->set_rules('user_email', '邮箱');
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
				'stu_class' => $this->input->post('user_class'),
				'stu_position' => $this->input->post('user_position'),
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


    private function _get_datatables_query() //for search and order
    {
        
        $this->db->select('user.*,department.department_name,class.class_name,position.position_name')
        		 ->from('user')
        		 ->join('department','department.id = user.department_id')
        		 ->join('class','class.id = user.stu_class')
        		 ->join('position','position.id = user.stu_position')
        		 ->where('user.department_id >', 0)//can change other's role in same level
       			 ->where('user.department_id <',9)
       			 ->where('delete_time =',NULL);
        $i = 0;
        foreach ($this->column as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
    }
	
	function get_datatables()
    {
        $this->_get_datatables_query();
        
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	function count_all()
    {
        $this->db->from('user');
        return $this->db->count_all_results();
    }
	
	//notice that user shouldnt delete as it related too much infomation
	function list_user_information_by_department($id) 
	{
		$user_list = $this->db->select('user.*,department.department_name')
								->from('user')
								->join('department','department.id = user.department_id')
								->where('user.department_id = ', $id)
								->where('delete_time =', NULL)
								->get()
								->result();

		return $user_list;
	}

	function list_user() 
	{
        $user_list = $this->db->select('*')
								->from('user')
								->where('department_id < ', 10)
								->where('department_id > ',0)
								->where('delete_time =', NULL)
								->get()
								->result();

		return $user_list;
    }


    /**
    *@ function:得到老科协人员信息
    *@ author:mlcode
    */
    function get_old_people() 
	{
        $user_list = $this->db->select('user.*,department.department_name')
								->from('user')
								->join('department','department.id = user.department_id')
								->where('department_id < ', 10)
								->where('department_id > ',0)
								->where('delete_time !=', NULL)
								->get()
								->result();

		return $user_list;
    }

	function get_user_by_id($id)
	{
		$user = $this->db->select('*')
					   ->from('user')
					   ->where('id' , $id)
					   ->get()
					   ->row();
		return $user;
	}

	function get_depart_user_by_id($id)
	{
		$user = $this->db->select('*')
					   ->from('user')
					   ->where('id' , $id)
					   ->get()
					   ->result();
		return $user;
	}
	
	function change_password($id)
	{	
		if($this->permission_model->check_owner()) {
			$data = array(
				'password' => password_hash($this->input->post('pswd'), PASSWORD_BCRYPT),
			);
	
			$this->db->update('user', $data, "id = $id");
			
			return 1;
		}
		return 0;
	} 
	
	function change_user_info($id)
	{	
		$this->form_validation->set_rules('depart_ment_id', '部门', 'required');
		$this->form_validation->set_rules('user_position', '职位', 'required');
		$this->form_validation->set_rules('mobile_phone', '手机', 'required');
		$this->form_validation->set_rules('user_name', '姓名', 'required');
		$this->form_validation->set_rules('user_email', '邮箱', 'required');
		$this->form_validation->set_rules('user_class', '班级id', 'required');
		if ($this->form_validation->run() == FALSE)
        {
            return "信息有误";
        }
        else
        {
			$data = array(
				'stu_class' => $this->input->post('user_class'),
				'mobile' => $this->input->post('mobile_phone'),
				'stu_name' => $this->input->post('user_name'),
				'emails' => $this->input->post('user_email'),
				'stu_position' => $this->input->post('user_position'),
				'department_id' => $this->input->post('depart_ment_id')
			);

			if($this->db->update('user', $data, "id = $id")){
				return 1;
			}else{
				return "更新失败";
			}
		}
	}
	/**
	*@ function：修改头像
	*@ author:mlcode
	*/
	function check_protrait($data){
        $data = array(
        	'photo_name' => $data['file_name']
        );

        $user_id = $this->input->post('user_id');
        $result = (array)$this->db->select('photo_name')->from('user')->where('id',$user_id)->get()->row();
        $file_path = './AdminLTE2/dist/img/'.$result['photo_name'];
        //var_dump($file_path);die();
        if($this->db->update('user',$data,"id = $user_id")&&unlink($file_path)){
        	return "修改成功";
        }
        else{
        	return "修改失败";
        }
	}
}