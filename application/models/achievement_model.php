<?php

class Achievement_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public $achievement_id;
    public $name;
    public $description;
  	public $badge_picture;
  	public $categoryName;
  	public $category_id;
  	public $point;

	/*
	***********************************************************************************
	SECTION: BUILD_ACHIEVEMENTS
	***********************************************************************************
	*/
  	public function Select()
  	{
		$this->db->select('achievement_id, achievements.category_id AS category_id, achievements.name, description, badge_picture, achievement_categories.name AS category, point');
		$this->db->from('achievements');
		$this->db->join('achievement_categories', 'achievement_categories.category_id = achievements.category_id');
		return $this->db;
  	}
	public function byID($achievementID)
	{
		$achievementID = (int)$achievementID;
		$this->Achievement_model->Select();
		$this->db->where('achievement_id', $achievementID);
		$query = $this->db->get();
		return Achievement_model::getNew($query);
	}
	public function userAchievements($achievementArrayID){
		$this->Achievement_model->Select();
		$this->db->where_in('achievement_id', $achievementArrayID);
		$query = $this->db->get();
		return Achievement_model::getNew($query,true);		
	}
	private function getNew($query, $array = false)
	{
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$tempAchievement = new Achievement_model();
				$tempAchievement->setID($row->achievement_id);
				$tempAchievement->setName($row->name);
				$tempAchievement->setDescription($row->description);
                $tempAchievement->setAvatar($row->badge_picture);
                $tempAchievement->setCategory($row->category);
                $tempAchievement->setCategoryID($row->category_id);
                $tempAchievement->setPoint($row->point);

				
				// This allows for the function to either return an array of achievements or a single achievement
				if ($array == false)
					$achievement = $tempAchievement;
				else
					$achievement[] = $tempAchievement;
			}
				return $achievement;
		}
		else
				return false;
	}
	/*
	***********************************************************************************
	SECTION: BUILD_METHODS
	***********************************************************************************
	*/
	public function achievementParams(){ // used to prep the achievement table for modification
	    return  array(
	    				'name'=>$this->getName(),
	    				'category_id'=>$this->getCategoryID(), 
	    				'description'=>$this->getDescription(), 
	    				'badge_picture'=> $this->getAvatar(),
	    				'point'=>$this->getPoint(),
	    				);
	}
	public function update($params = array()) { // updates the achievement object if a post value has been set and then updates the database
		if ($params['name'])
			$this->setName($params['name']);
		if ($params['description'])
			$this->setDescription($params['description']);
		if ($params['badgePic'])
			$this->setAvatar($params['badgePic']);
		if ($params['category'])
			$this->setCategoryID($params['category']);
		if ($params['point'])
			$this->setPoint($params['point']);
		
		$updateParams = $this->achievementParams();
	    $this->db->update('achievements', $updateParams, "achievement_id = ".$this->getID()); // go ahead and finalize the database
	}
	public function insert($params = array()) {
		if ($params['name'])
			$this->setName($params['name']);
		if ($params['description'])
			$this->setDescription($params['description']);
		if ($params['badgePic'])
			$this->setAvatar($params['badgePic']);
		if ($params['category'])
			$this->setCategoryID($params['category']);
		if ($params['point'])
			$this->setPoint($params['point']);
		
		$updateParams = $this->achievementParams();
		$this->db->insert('achievements', $updateParams); // Go ahead and add it to the database   
	}
	/*
	***********************************************************************************
	SECTION: GET_METHODS
	***********************************************************************************
	*/
	public function getID(){
		return $this->achievement_id;
	}
	public function getName(){
		return $this->name;
	}
	public function getDescription(){
		return $this->description;
	}
  	public function getAvatar(){
    	return $this->badge_picture;
  	}
  	public function getCategory(){
    	return $this->category;
  	}
  	public function getCategoryID(){
    	return $this->category_id;
  	}
  	public function getPoint(){
  	    return $this->point;
  	}
	public function getAllAchievements()
	{
		$this->Achievement_model->Select();
		$this->db->order_by("name", "ASC"); 
		$query = $this->db->get();
        return Achievement_model::getNew($query,true);
	}
	public function getCategoryByID($categoryID)
	{
		$category = array();
	    $query = $this->db->get_where('achievement_categories', array('category_id' => $categoryID), 1);
	    if ($query->num_rows() > 0)
		{
   			$row = $query->row();
			$category[$row->category_id] = $row->name;
			return $category;
		}
		else
			return false;
	}
	public function getCategories()
	{
		$categoryArray = array();
		$this->db->order_by('name','ASC');
	    $query =  $this->db->get('achievement_categories');
	    foreach($query->result() as $row)
		{
			$categoryArray[$row->category_id] = $row->name;
			
		}
		return $categoryArray;
	}
	public function getAvatarSmallURL(){
		return base_url()."assets/img/achievements/small/".$this->getAvatar().".jpg";
	}
	public function getAvatarLargeURL(){
		return base_url()."assets/img/achievements/large/".$this->getAvatar().".jpg";
	}
	/*
	***********************************************************************************
	SECTION: SET_METHODS
	***********************************************************************************
	*/
	function setID($achievement_id) {// 20
		$this->achievement_id = $achievement_id;
	}
	function setName($name) {// Sky diving
		$this->name = $name;
	}
	function setDescription($description) {// Skydiving is a sport of planes and parachutes. Either way you look at it your getting to the ground.
		$this->description = $description;
	}
  	function setAvatar($badgePic) {// skydivePic.jpg
		$this->badge_picture = $badgePic;
	}
  	function setCategory($category) {// Sports
		$this->category = $category;
	}
  	function setCategoryID($categoryID) {// 1
		$this->category_id = $categoryID;
	}
	function setPoint($point){
	    $this->point = $point;
	}
}
?>