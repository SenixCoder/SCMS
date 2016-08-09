<?php

class User_card_model extends CI_Model 
{
	public function __construct() {
	    // Call the CI_Model constructor
	    parent::__construct();
    }
    
    public function list_user_card() {
        
    }

    public function isExistPerson() {

    	$person_name = $this->input->post('person');
    	
        $array = $this->db->from('user_card')
                 ->where('name =', $person_name)
                 ->get()
                 ->result();
                 
        if(sizeof($array) >= 1) return true;
        
        return false;
    }
    
    public function queryCardByPerson() {
        
        return $array = $this->db->from('user_card')
                                 ->where('name =', $this->input->post('key'))
                                 ->get()
                                 ->result();
    }
}