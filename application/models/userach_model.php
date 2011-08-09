<?php

class Userach_model extends Achievement_model {

    public function __construct()
    {
        parent::__construct();
    }
    public $userAch_id;
    public $achievement_id;
    public $user_id;
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
		 					achievement_categories.name as category, userAch_id, achievements_users.location '
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
				$tempUserach->setID($row->userAch_id);
				$tempUserach->setAchievementID($row->achievement_id);
				$tempUserach->setUserID($row->user_id);
				$tempUserach->setUserAvatar($row->picture);
				$tempUserach->setUserDescription($row->user_description);
				$tempUserach->setDateCompleted($row->date_completed);
				$tempUserach->setLocation($row->location);
				
				// set achievement specific things
				$tempUserach->setName($row->name);
				$tempUserach->setDescription($row->ach_description);
				$tempUserach->setAvatar($row->badge_picture);
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
	    				'location' => $this->getLocation(),
	    				'date_completed' => $this->getDate(),
	    				'description'=>$this->getUserDescription(), 
	    				'picture'=> $this->getUserAvatar(),
	    				);
	}
	// update the user achievement 
	public function update($params = array()) { 
		if ($params['achievement'])
			$this->setAchievementID($params['achievement']);
		if ($params['description'])
			$this->setUserDescription($params['description']);
		if ($params['badgePic'])
			$this->setUserAvatar($params['badgePic']);	
		if ($params['date_completed'])
			$this->setDateCompleted($params['date_completed']);
		if ($params['location'])
			$this->setLocation($params['location']);
		
		$updateParams = $this->userAchievementParams();
	    $this->db->update('achievements_users', $updateParams, "userAch_id = ".$this->getID());
	    
		$user = User_model::byID($this->session->userdata('user_id'));
		$user->updatePoints();	    
	}
	// insert a new user achievement
	public function insert($params = array()) {
		if ($params['achievement'])
			$this->setAchievementID($params['achievement']);
		if ($params['description'])
			$this->setUserDescription($params['description']);
		if ($params['badgePic'])
			$this->setUserAvatar($params['badgePic']);	
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
	public function getID(){
		return $this->userAch_id;
	}
	public function getAchievementID(){
	    return $this->achievement_id;
	}
	public function getUserID(){
	   return $this->user_id;
	}
	public function getUserDescription(){
	   return $this->user_description;
	}
	public function getUserAvatar(){
	   return $this->user_picture;
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
    /*
	***********************************************************************************
	SECTION: SET_FUNCTIONS
	***********************************************************************************
	*/
	function setID($userAchID){
		$this->userAch_id = $userAchID;
	}
	function setAchievementID($id) {
		$this->achievement_id = $id;
	}
	function setUserID($user_id){
		$this->user_id = $user_id;
	}
	function setUserDescription($description) {
		$this->user_description = $description;
	}
	function setUserAvatar($avatar){
		$this->user_picture = $avatar;
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
}
?>