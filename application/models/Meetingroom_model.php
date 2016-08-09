<?php

class Meetingroom_model extends CI_Model 
{
	public function __construct() {
    	// Call the CI_Model constructor
    	parent::__construct();
    }

    public function get_meetingrooms() {

    	$meeting_rooms = $this->db->select('*')
                                  ->from('meeting_room')
                                  ->order_by('name', 'ASC')
                                  ->get()
                                  ->result();
                                  
    	
    	return $meeting_rooms;

    }
    
    public function get_level_meetingrooms($level) {
        $meeting_rooms = $this->db->select('*')
                                  ->from('meeting_room')
                                  ->where('meeting_room_level <=', $level)
                                  ->order_by('name', 'ASC')
                                  ->get()
                                  ->result();
                                  
        return $meeting_rooms;
    }
    
    public function get_room_name_by_id() {
        ;
    }

    public function add_meetingroom() 
	{
		$this->form_validation->set_rules('sysmc', '实验室名称', 'required|is_unique[meeting_room.name]');
		$this->form_validation->set_rules('hyszws', '会议室座位数', 'required|numeric');
        $this->form_validation->set_rules('sfty', '是否停用', 'required');
        $this->form_validation->set_rules('des_cribe', '描述');
        $this->form_validation->set_rules('i_p', 'ip地址', 'required');
        $this->form_validation->set_rules('room_s_n', '序列号');
		if ($this->form_validation->run() == FALSE)
        {
            return 0;
        }
        else
        {
            $data = array(
				'name' => $this->input->post('sysmc'),
				'desk_num' => $this->input->post('hyszws'),
                'stop_reservation' => $this->input->post('sfty'),
                'describe' => $this->input->post('des_cribe'),
                'ip' => $this->input->post('i_p'),
                'room_sn' => $this->input->post('room_s_n'),
                'meeting_room_level' => $this->input->post('can_borrow')
			);

			$this->db->insert('meeting_room', $data);

			return 1;
        }
	}
    
    public function get_meeting_room($id) {

    	$meeting_rooms = $this->db->select('*')
                                  ->from('meeting_room')
                                  ->where('id',$id)
                                  ->get()
                                  ->result();
    	return $meeting_rooms;

    }
    
    public function edit_meetingroom() 
	{
		$this->form_validation->set_rules('sysmc', '实验室名称', 'required');
		$this->form_validation->set_rules('hyszws', '会议室座位数', 'required|numeric');
        $this->form_validation->set_rules('sfty', '是否停用', 'required');
        $this->form_validation->set_rules('des_cribe', '描述');
        $this->form_validation->set_rules('i_p', 'ip地址', 'required');
        $this->form_validation->set_rules('room_s_n', '序列号');
        
		if ($this->form_validation->run() == FALSE)
        {
            return 0;
        }
        else
        {
            $data = array(
                'name' => $this->input->post('sysmc'),
				'desk_num' => $this->input->post('hyszws'),
                'stop_reservation' => $this->input->post('sfty'),
                'describe' => $this->input->post('des_cribe'),
                'ip' => $this->input->post('i_p'),
                'room_sn' => $this->input->post('room_s_n'),
                'meeting_room_level' => $this->input->post('can_borrow')
			);
            $id = $this->input->post('sysid');
			$this->db->update('meeting_room',$data,'id='.$id);

			return 1;
        }
    }
}