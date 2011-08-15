<?php

class Userach_model extends Achievement_model {

    public function __construct()
    {
        parent::__construct();
    }
    public $userAch_id;
    public $achievement_id;
    public $user_id;
    public $user_name;
    public $user_description;
    public $user_picture;
    public $date_completed;
    public $location;
    
    /*
	***********************************************************************************
	SECTION: BUILD_USER
	***********************************************************************************
	*/
	public function Select()
	{
		 $this->db->select('users.user_id AS user_id, achievements.achievement_id AS achievement_id, achievements_users.picture, 
		 					achievements_users.date_completed,achievements_users.description AS user_description, 
		 					achievements.name AS name, achievements.description AS ach_description, achievements.description, 
		 					achievements.badge_picture, achievements.point, achievements.category_id, 
		 					achievement_categories.name as category, userAch_id, achievements_users.location, achievements_users.name as user_name '
		 					);
	}
	public function from()
	{
	    $this->db->from('achievements_users');
	    $this->db->join('achievements', 'achievements.achievement_id = achievements_users.achievement_id');
	    $this->db->join('achievement_categories', 'achievements.category_id = achievement_categories.category_id');
	    $this->db->join('users', 'achievements_users.user_id = users.user_id');
	}
	public function byUserID($user_id, $limit = 100, $offset = 0)
	{
	    $this->Userach_model->Select();
	    $this->Userach_model->from();
	    $this->db->where('users.user_id', $user_id);
	    $this->db->limit($limit, $offset); 
	    $query = $this->db->get();
	    return $this->Userach_model->getNew($query,true);		
	}
	public function byAchievement($userAchID)
	{
		$this->Userach_model->select();
		$this->Userach_model->from();
		$this->db->where('userAch_id', $userAchID);
		$this->db->limit(1);
		$query = $this->db->get();
				
		return $this->Userach_model->getNew($query,false);
	}
	private function getNew($query, $array = false)
	{
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$tempUserach = new Userach_model();
				$tempUserach->setUserAchID($row->userAch_id);
				$tempUserach->setAchievementID($row->achievement_id);
				$tempUserach->setUserID($row->user_id);
				$tempUserach->setUserName($row->user_name);
				$tempUserach->setUserDescription($row->user_description);
				$tempUserach->setDateCompleted($row->date_completed);
				$tempUserach->setLocation($row->location);
				
				// set achievement specific things
				$tempUserach->setName($row->name);
				$tempUserach->setDescription($row->ach_description);
				$tempUserach->setPoint($row->point);
				$tempUserach->setCategoryID($row->category_id);
				$tempUserach->setCategory($row->category);
				
				// Determines array of users or single user
				if ($array == false)
					$userAch = $tempUserach;
				else
					$userAch[] = $tempUserach;
			}
				return $userAch;
		}
		else
				return false;
	}
	public function userAchievementParams(){ // used to prep the achievement table for modification
	    return  array(
	    				'user_id' => $this->session->userdata('user_id'),
	    				'achievement_id' => $this->getAchievementID(),
	    				'name' => $this->getUserName(),
	    				'location' => $this->getLocation(),
	    				'date_completed' => $this->getDate(),
	    				'description'=>$this->getUserDescription(), 
	    				);
	}
	// update the user achievement 
	public function update($params = array()) { 
		if ($params['achievement'])
			$this->setAchievementID($params['achievement']);
		if ($params['name'])
			$this->setUserName($params['name']);		
		if ($params['description'])
			$this->setUserDescription($params['description']);
		if ($params['date_completed'])
			$this->setDateCompleted($params['date_completed']);
		if ($params['location'])
			$this->setLocation($params['location']);
		
		$updateParams = $this->userAchievementParams();
	    $this->db->update('achievements_users', $updateParams, "userAch_id = ".$this->getUserAchID());
	    
		$user = User_model::byID($this->session->userdata('user_id'));
		$user->updatePoints();	    
	}
	// insert a new user achievement
	public function insert($params = array()) {
		if ($params['achievement'])
			$this->setAchievementID($params['achievement']);
		if ($params['name'])
			$this->setUserName($params['name']);				
		if ($params['description'])
			$this->setUserDescription($params['description']);
		if ($params['date_completed'])
			$this->setDateCompleted($params['date_completed']);
		if ($params['location'])
			$this->setLocation($params['location']);
		
		$updateParams = $this->userAchievementParams();
		$this->db->insert('achievements_users', $updateParams);
		
		$user = User_model::byID($this->session->userdata('user_id'));
		$user->updatePoints();
	}
    /*
	***********************************************************************************
	SECTION: GET_FUNCTIONS
	***********************************************************************************
	*/
	public function getUserAchID(){
		return $this->userAch_id;
	}
	public function getAchievementID(){
	    return $this->achievement_id;
	}
	public function getUserID(){
	   return $this->user_id;
	}
	public function getUserName(){
		return $this->user_name;
	}
	public function getUserDescription(){
	   return $this->user_description;
	}
	public function getDate(){
	   return $this->date_completed;
	}
	public function getLocation(){
		return $this->location;
	}
	public function getTotalAchievements($userID){
		$this->db->select('achievement_id');
		$this->db->from('achievements_users')->where('user_id',$userID);
		return $this->db->count_all_results();
	}
	public function getUserAvatarIMG($size,$style = NULL, $alt = NULL){
		return "<img src='/life/assets/img/userAch/{$size}/{$this->getUserAchID()}.jpg' style='{$style}' alt='{$alt}'>";
	}
    /*
	***********************************************************************************
	SECTION: SET_FUNCTIONS
	***********************************************************************************
	*/
	function setUserAchID($userAchID){
		$this->userAch_id = $userAchID;
	}
	function setAchievementID($id) {
		$this->achievement_id = $id;
	}
	function setUserID($user_id){
		$this->user_id = $user_id;
	}
	function setUserName($userName){
		$this->user_name = $userName;
	}
	function setUserDescription($description) {
		$this->user_description = $description;
	}
	function setDateCompleted($date) {
		$this->date_completed = $date;
	}
	function setLocation($location){
		$this->location = $location;
	}
    /*
	***********************************************************************************
	SECTION: COMPUTE_FUNCTIONS
	***********************************************************************************
	*/
	function canEdit()
	{
		if (($this->getUserID() == $this->session->userdata('user_id')) || ($this->session->userdata('privileges') > 5))
			return true;
		else
			return false;
	}
	function uploadUserAvatar()
	{
		$config['upload_path'] 		= 	'./assets/img/achievements/';
		$config['allowed_types']	= 	'gif|jpg|png|jpeg';
		$config['max_size']			= 	'5120';
		$config['max_width']  		= 	'1000';
		$config['max_height']  		= 	'1000';

		$this->upload->initialize($config);

		if ($this->upload->do_upload())
		{
			$this->load->library('image_lib');
			// upload thumbnail
			$imgData = $this->upload->data();
			$config['image_library'] = 'gd2';
			$config['create_thumb'] = TRUE;
			$config['thumb_marker']= "";			
			$config['source_image'] = $imgData['full_path'];
			$config['new_image'] = './assets/img/userAch/thumb/'.$this->getUserAchID().'.jpg';
			$config['width'] = 100;
			$config['height'] = 100;			
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
			// upload larger image
			$config['new_image'] = './assets/img/userAch/large/'.$this->getUserAchID().'.jpg';
			$config['width'] = 500;
			$config['height'] = 500;
			$config['maintain_ratio'] = TRUE;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			
			// delete original
			unlink($config['source_image']);
		}
	}	
}
?>