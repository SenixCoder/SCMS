<?php

class Talk_model extends CI_Model 
{
	public function __construct() 
	{
    	// Call the CI_Model constructor
    	parent::__construct();
    }
    function get_talk(){
        $result = $this->db->select('following_id')
                           ->from('following')
                           ->where('stu_id',$this->session->userdata('id'))
                           ->get()
                           ->result();
        $str=array();
        foreach ($result as $rs) {
            $str[] = $rs->following_id;
        }
        $str[] = $this->session->userdata('id');
        if($str == NULL){
            $data = "";
        }else{
    	   $data = $this->db->select('talk.*,user.stu_name,user.photo_name')
    					 ->from('talk')
                         ->join('user','user.id = talk.stu_id')
                         ->where_in('talk.stu_id',$str)
    					 ->get()
    					 ->result();
        }
    	return $data;
    }

    function get_follow_id($id){
        $result = $this->db->select('follow_id')
                           ->from('follow')
                           ->where('stu_id',$id)
                           ->get()
                           ->result();
        $str=array();
        foreach ($result as $rs) {
            $str[] = $rs->follow_id;
        }
        if($str == NULL){
            $data = "";
        }else{
           $data = $this->db->select('id')
                         ->from('user')
                         ->where_in('id',$str)
                         ->get()
                         ->result();
        }
        //var_dump($data);die();
        return $data;
    }

    function get_talk_by_stu_id($stu_id){
        $result = $this->db->select('follow_id')
                           ->from('follow')
                           ->where('stu_id',$stu_id)
                           ->get()
                           ->result();
        $str=array();
        foreach ($result as $rs) {
            $str[] = $rs->follow_id;
        }
        $str[] = $stu_id;
        for($i = 0;$i < count($str);$i++){
            if($str[$i] == $this->session->userdata('id'))
            {
                $data = $this->db->select('talk.*,user.stu_name,user.photo_name')
                     ->from('talk')
                     ->join('user','user.id = talk.stu_id')
                     ->where('talk.stu_id',$stu_id)
                     ->get()
                     ->result();
                return $data;
            }
            else{
                $data = "";
            }
        }
        return $data;
    }

    function get_comment(){
        $data = $this->db->select('comment.*,user.stu_name')
                         ->from('comment')
                         ->join('user','user.id = comment.comment_id')
                         ->get()
                         ->result();
        
        return $data;
    }

    function get_response(){
        $data = $this->db->select('response.*,user.stu_name')
                         ->from('response')
                         ->join('user','user.id = response.response_id')
                         ->get()
                         ->result();
        return $data;
    }


    function list_user_name_information_by_id($id) 
    {
        $user_list = (array)$this->db->select('*')
                                ->from('user')
                                ->where('id',$id)
                                ->get()
                                ->row();

        return $user_list;
    }
    function list_user_information_by_id($id) 
    {
        $user_list = $this->db->select('user.*,department.department_name,class.class_name,position.position_name')
                                ->from('user')
                                ->join('position','user.stu_position = position.id')
                                ->join('class','class.id = user.stu_class')
                                ->join('department','department.id = user.department_id')
                                ->where('user.id',$id)
                                ->get()
                                ->result();

        return $user_list;
    }

    function list_big_user_information_by_id($id) 
    {
        $user_list = $this->db->select('user.*,class.class_name,position.position_name')
                                ->from('user')
                                ->join('position','user.stu_position = position.id')
                                ->join('class','class.id = user.stu_class')
                                ->where('user.id',$id)
                                ->get()
                                ->result();

        return $user_list;
    }
    /*
    *function : 获取关注好友列表
    *author:mlcode
    */

    function list_following_user_information_by_id($id) 
    {
        $result = $this->db->select('following_id')
                           ->from('following')
                           ->where('stu_id',$id)
                           ->get()
                           ->result();
        $str=array();
        foreach ($result as $rs) {
            $str[] = $rs->following_id;
        }
        if($str == NULL){
            $data = "";
        }else{
        $data = $this->db->select('user.*,department.department_name,class.class_name,position.position_name')
                                ->from('user')
                                ->join('position','user.stu_position = position.id')
                                ->join('class','class.id = user.stu_class')
                                ->join('department','department.id = user.department_id')
                                ->where_in('user.id',$str)
                                ->get()
                                ->result();
        }
        return $data;
    }
    /*
    *function : 获取点赞好友列表
    *author:mlcode
    */
    function list_like_user_information_by_id($id) 
    {
        $result = $this->db->select('clicker')
                           ->from('click_like')
                           ->where('like_id',$id)
                           ->get()
                           ->result();
        $str=array();
        foreach ($result as $rs) {
            $str[] = $rs->clicker;
        }
        if($str == NULL){
            $data = "";
        }else{
        $data = $this->db->select('user.*,department.department_name,class.class_name,position.position_name')
                                ->from('user')
                                ->join('position','user.stu_position = position.id')
                                ->join('class','class.id = user.stu_class')
                                ->join('department','department.id = user.department_id')
                                ->where_in('user.id',$str)
                                ->get()
                                ->result();
        }
        return $data;
    }

    /*
    *function : 关注
    *author:mlcode
    */

    function check_follow($id){
        $ids = $this->session->userdata('id');
        $result = (array)$this->db->select('count(*) as count')
                           ->from('follow')
                           ->where('stu_id',$id)
                           ->where('follow_id',$ids)
                           ->get()
                           ->row();
        if($ids == $id){
            return 0;
        }

        if($result['count'] == 1){
            return 0;
        }
        else{
            $follow = (array)$this->db->select('follow')
                               ->from('user')
                               ->where('id',$id)
                               ->get()
                               ->row();
            $following = (array)$this->db->select('following')
                               ->from('user')
                               ->where('id',$ids)
                               ->get()
                               ->row();
            $data = array(
                'follow' => $follow['follow']+1
            );
            $data1 = array(
                'stu_id' => $id,
                'follow_id' => $ids
            );
            $data2 = array(
                'following' => $following['following']+1
            );
            $data3 = array(
                'stu_id' => $ids,
                'following_id' => $id
            );
            if(($this->db->update('user',$data,"id = $id"))&&($this->db->insert('follow',$data1))&&($this->db->update('user',$data2,"id = $ids"))&&($this->db->insert('following',$data3))){
                return 1;
            }
            else{
                return 0;
            }
        }
    }

    /*
    *function : 取消关注
    *author:mlcode
    */

    function check_unfollow($id){
        $ids = $this->session->userdata('id');
        if($ids == $id){
            return 0;
        }
        $follow = (array)$this->db->select('follow')
                           ->from('user')
                           ->where('id',$id)
                           ->get()
                           ->row();
        $following = (array)$this->db->select('following')
                           ->from('user')
                           ->where('id',$ids)
                           ->get()
                           ->row();
        $data = array(
            'follow' => $follow['follow']-1
        );
        $data1 = array(
            'following' => $following['following']-1
        );
        if($this->db->delete('follow',"follow_id = $ids and stu_id = $id")&&$this->db->delete('following',"following_id = $id and stu_id = $ids")&&$this->db->update('user',$data,"id = $id")&&$this->db->update('user',$data1,"id = $ids")){
            return 1;
        }
        else{
            return 0;
        }
    }

    function check_comment($id){
        $data = array(
            'comment_id' => $this->session->userdata('id'),
            'comment' => $this->input->post('comment'),
            'comment_time' => date("Y-m-d H:i:s"),
            'id_id' => $id
        );
        $result1 = (array)$this->db->select('comment_num')->from('talk')->where('id',$id)->get()->row();
        $data1 = array(
            'comment_num' => $result1['comment_num']+1
        );
        if($this->db->insert('comment',$data)&&$this->db->update('talk',$data1,"id = $id")){
            return 1;
        }
        else{
            return 0;
        }
    }

    function send_topic(){
        $data = array(
            'stu_id' => $this->session->userdata('id'),
            'topic' => $this->input->post('topic'),
            'time' => date("Y-m-d H:i:s")
        );
        if($this->db->insert('talk',$data)){
            return 1;
        }
        else{
            return 0;
        }
    }

    function check_send_response($id,$comment_id,$commenter_id){
        $data = array(
            'id_num' => $id,
            'comment_id' => $comment_id,
            'commenter_id' => $commenter_id,
            'response_id' => $this->session->userdata('id'),
            'response_topic' => $this->input->post('response'),
            'response_time' => date("Y-m-d H:i:s")
        );
        $result1 = (array)$this->db->select('comment_num')->from('talk')->where('id',$id)->get()->row();
        $data1 = array(
            'comment_num' => $result1['comment_num']+1
        );
        $result = (array)$this->db->select('stu_name')->from('user')->where('id',$data['commenter_id'])->get()->row();
        $data['commenter_name'] = $result['stu_name'];
        if($this->db->insert('response',$data)&&$this->db->update('talk',$data1,"id = $id")){
            return 1;
        }
        else{
            return 0;
        }
    }
    /**
    *function:点赞
    *author:mlcode
    */

    function check_like($id){
        $data = array(
            'like_id' => $id,
            'clicker' => $this->session->userdata('id')
        );
        $result = (array)$this->db->select('like')
                           ->from('talk')
                           ->where('id',$id)
                           ->get()
                           ->row();
        $data1 = array(
            'like' => $result['like'] + 1
        );
        if(($this->db->insert('click_like',$data))&&($this->db->update('talk',$data1,"id = $id"))){
            return 1;
        }
        else{
            return 0;
        }
    }
    /**
    *function:取消赞
    *author:mlcode
    */
    function check_unlike($id){
        $ids = $this->session->userdata('id');
        $result = (array)$this->db->select('like')
                           ->from('talk')
                           ->where('id',$id)
                           ->get()
                           ->row();
        $data1 = array(
            'like' => $result['like'] - 1
        );
        if(($this->db->delete('click_like',"clicker = $ids and like_id = $id"))&&($this->db->update('talk',$data1,"id = $id"))){
            return 1;
        }
        else{
            return 0;
        }
    }

    function get_clicker(){
       $data = $this->db->select('*')
                     ->from('click_like')
                     ->get()
                     ->result();
        return $data;
    }
}