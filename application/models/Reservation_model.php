<?php

class Reservation_model extends CI_Model 
{
	public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('user_card_model');
		$this->load->model('meetingroom_model');
    }
	
	public function add_reservation() {
		
    	$date = $this->input->post('date');
		$stime = $this->input->post('stime');
		$etime = $this->input->post('etime');
    	
    	$data = array(
			'room_id' => $this->input->post('room'),
			'time_start' => $date .' '. $stime,
			'time_end' => $date .' '. $etime,
			'purpose' => $this->input->post('reason'),
			'person_name' => $this->input->post('person'),
			'card_id' => $this->input->post('card_id'),
			'phone' => $this->input->post('phone'),
			'mail' => $this->input->post('email'),
			'create_time' => date('Y-m-d H:i:s'),
			'user_id' => $this->session->userdata('id')	
		);
		$this->db->insert('reservation', $data);
	    
		return;
		//return date('Y-m-d H:i:s') < "2015-02-01 16:00:00";	
	}
	
	public function delete_my_reservation($id) {
		
		$data = array(
			'delete_time' => date('Y-m-d H:i:s'),
		);

		$this->db->update('reservation', $data, "id = $id");
		
		return 1;
	}
	
	//预约协调，不显示删除项，不显示历史记录，正在进行的能显示
	public function list_reservation() {
		
		$reservation_record = $this->db->select('reservation.*, 
												 meeting_room.name, user.user_id')
										->from('reservation')
										//此条件加入会导致删除后没有了,后期有撤销功能也方便
										->where('reservation.delete_time = ', NULL) 
										->join('user', 'user.id = reservation.user_id')
										->join('meeting_room', 'meeting_room.id = reservation.room_id')
										->where('time_end > ', date('Y-m-d H:i:s'))
										->get()
										->result();
		
		// var_dump($reservation_record);
		// die();
		
		return $reservation_record;
	}
	
	public function list_deleted_reservation() {
		
		$reservation_record = $this->db->select('reservation.*, 
												 meeting_room.name, user.user_id')
										->from('reservation')
										//此条件加入会导致删除后没有了,后期有撤销功能也方便
										->where('reservation.delete_time != ', NULL) 
										->join('user', 'user.id = reservation.user_id')
										->join('meeting_room', 'meeting_room.id = reservation.room_id')
										//->where('time_end > ', date('Y-m-d H:i:s'))
										->order_by('reservation.delete_time', 'DESC')
										->get()
										->result();
		
		// var_dump($reservation_record);
		// die();
		
		return $reservation_record;
	}
	
	
	public function list_my_reservation() {
		
		$reservation_record = $this->db->select('reservation.*,
												 meeting_room.name')
										->from('reservation')
										->join('meeting_room', 'meeting_room.id = reservation.room_id')
										->where('delete_time = ', NULL)
										->where('user_id = ', $this->session->userdata('id'))
										->get()
										->result();

		return $reservation_record;
	}
	
	public function list_reservation_by_room() {
		
		$reservation_record = $this->db->select('time_start, time_end, person_name')
									   ->from('reservation')
									   ->where('delete_time =', NULL)
									   ->where('room_id =', $this->input->post('key'))
									   //->where('time_end > ', date('Y-m-d H:i:s'))
									   ->get()
									   ->result();
									   
		return json_encode($reservation_record);
	}
	
	//------help function (double check whether user can delete reservations he created)
	
	//rewrite
	public function find_user_by_id($id) {

        $user = $this->db->select('user_id')
						 ->from('reservation')
						 ->where('id = ', $id)
						 ->get()
						 ->result();

        return $user[0]->user_id;
    }
	
	//------help function (form validation)
	public function isConflict() {
		
		$date = $this->input->post('date');
		$stime = $this->input->post('stime');
		$etime = $this->input->post('etime');
		$time_start = $date .' '. $stime;
		$time_end = $date .' '. $etime;
		
		$date_related = $this->db->select('time_start, time_end')
								 ->from('reservation')
								 ->where('room_id =', $this->input->post('room'))
								 ->where('delete_time =', NULL)
								 ->like('time_start', $date)
								 ->get()->result();
		
		foreach($date_related as $s) {
			if(strtotime($s->time_end) > strtotime($time_start) && strtotime($time_end) > strtotime($s->time_start)) {
				return true;
				var_dump("fuck");
				die();
			}
		}
		
		return false;
	}
	public function get_dispatch() {

        $data = $this->db->select('id,title,create_time,update_time,stuID')
						 ->from('pro_notice')
						 ->get()
						 ->result();

        return $data;
    }

    public function get_dispatch_by_id($id) {

        $data = $this->db->select('title,content')
						 ->from('pro_notice')
						 ->where('id',$id)
						 ->get()
						 ->result();

        return $data;
    }

    public function check_dispatch(){
    	$this->form_validation->set_rules('subject', '通知发文标题','required');
		$this->form_validation->set_rules('editor1', '内容','required');
		if($this->form_validation->run() == false){
			return "信息填充错误";
		}
		else{
			$data = array(
				'title' => $this->input->post('subject'),
	        	'content' => $this->input->post('editor1'),
	        	'stuID' => $this->session->userdata('front_name'),
	        	'create_time' => date('Y-m-d H:i:s')
			);
			if($this->db->insert('pro_notice',$data)){
				return 1;
			}
			else{
				return "插入失败";
			}
		}
    }

    public function check_edit_dispatch($id){
    	$this->form_validation->set_rules('subject', '通知发文标题','required');
		$this->form_validation->set_rules('editor1', '内容','required');
		if($this->form_validation->run() == false){
			return "信息填充错误";
		}
		else{
			$data = array(
				'title' => $this->input->post('subject'),
	        	'content' => $this->input->post('editor1'),
	        	'update_time' => date('Y-m-d H:i:s')
			);
			if($this->db->update('pro_notice',$data,"id = $id")){
				return 1;
			}
			else{
				return "更新失败";
			}
		}
    }

    public function delete_dispatch($id){
    	if($this->db->delete('pro_notice',"id = $id")){
    		return 1;
    	}
    	else{
    		return "删除失败";
    	}
    }

    public function get_wechat() {

        $data = $this->db->select('*')
						 ->from('wx')
						 ->get()
						 ->result();

        return $data;
    }
}