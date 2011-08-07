<?php

class Errorlog_model extends CI_Model {
	
	public $userID;
	public $typeID; 
	public $description;
	public $priotiy;
	public $userIP;
	public $stamp;
	
    public function __construct()
    {
        parent::__construct();
    }
    public function submitError($typeID = NULL, $description, $priority)
    {
    	$data = array(
		   'user_id' => $this->session->userdata('user_id'),
		   'type_id' => $typeID ,
		   'description' => $description,
		   'priority' => $priority,
		   'user_ip' => $this->session->userdata('ip_address'),
		   'user_agent' => $this->session->userdata('user_agent'),
		);
		
		$this->db->insert('error_log', $data);
		
		return "Sorry there has been an error, or staff is currently looking into this issue";
    }
}    