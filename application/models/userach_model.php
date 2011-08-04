<?php

class Userach_model extends Achievement_model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public $achievement_id;
    public $user_id;
    public $user_description;
    public $user_picture;
    public $date_completed;
    
    /*
	***********************************************************************************
	SECTION: BUILD_USER
	***********************************************************************************
	*/
	public function Select()
	{
		 $this->db->select('users.user_id AS user_id, achievements.achievement_id AS achievement_id, achievements_users.picture, achievements_users.date_completed, '.
		 				   'achievements_users.description AS user_description ,achievements.name, achievements.description AS ach_description, achievements.description, achievements.badge_picture, achievements.point,'.
		 				   'achievements.category_id, achievement_categories.name ');
	}
	public function byUserID($user_id)
	{
	    $this->Userach_model->Select();
	    $this->db->from('achievements_users');
	    $this->db->join('achievements', 'achievements.achievement_id = achievements_users.achievement_id');
	    $this->db->join('achievement_categories', 'achievements.category_id = achievement_categories.category_id');
	    $this->db->join('users', 'achievements_users.user_id = users.user_id');
	    $this->db->where('users.user_id', $user_id);
	    $query = $this->db->get();
	    
	    return $this->Userach_model->getNew($query,true);		
	}
	private function getNew($query, $array = false)
	{
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$tempUserach = new Userach_model();
				$tempUserach->setAchievementID($row->achievement_id);
				$tempUserach->setUserID($row->user_id);
				$tempUserach->setUserAvatar($row->picture);
				$tempUserach->setUserDescription($row->user_description);
				$tempUserach->setDateCompleted($row->date_completed);
				
				// set achievement specific things
				$tempUserach->setName($row->name);
				$tempUserach->setDescription($row->ach_description);
				$tempUserach->setAvatar($row->badge_picture);
				$tempUserach->setPoint($row->point);
				
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
    
    /*
	***********************************************************************************
	SECTION: GET_FUNCTIONS
	***********************************************************************************
	*/
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
	public function getAchivements($user_id)
	{
	    $this->db->select('users.user_id AS user_id, achievements.achievement_id AS achievement_id, achievements_users.picture, achievements_users.date_completed, achievements_users.description ')->from('achievements_users');
	    $this->db->join('achievements', 'achievements.achievement_id = achievements_users.achievement_id');
	    $this->db->join('users', 'achievements_users.user_id = users.user_id');
	    $this->db->where('users.user_id', $user_id);
	    $query = $this->db->get();
	    
	    return $this->getNew($query,true);
	}
	// returns an array of all achievement ID's
	public function getArrayofID($userAch)
	{
		foreach($userAch as $id)
		{
			$arrayID[] = $id->getAchievementID();
		}
		return $arrayID;
	}
    /*
	***********************************************************************************
	SECTION: SET_FUNCTIONS
	***********************************************************************************
	*/
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
}
?>