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

    function Achievement($params = NULL)
	{
		if(is_array($params))
		{
			$this->setID                ($params['achievement_id']);
			$this->setName           	($params['name']);
			$this->setDescription		($params['description']);
            $this->setAvatar			($params['badgePic']);	
            $this->setCategory			($params['category']);	
            $this->categoryID			($params['categoryID']);	
		}
	}
	/*
	***********************************************************************************
	SECTION: BUILD_ACHIEVEMENTS
	***********************************************************************************
	*/
	public function byID($achievement_id)
	{
		$this->db->select('achievement_id, achievement.category_id AS category_id, achievement.name, description, badge_picture, achievement_category.name AS category');
		$this->db->from('achievement');
		$this->db->join('achievement_category', 'achievement_category.category_id = achievement.category_id');
		$this->db->where('achievement_id', $achievement_id);
		$query = $this->db->get();
		return Achievement_model::getNew($query);
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
	public function update($params = array()) { // updates the achievement object if a post value has been set and then updates the database
		if ($params['name'])
			$this->setName($params['name']);
		if ($params['description'])
			$this->setDescription($params['description']);
		if ($params['badgePic'])
			$this->setAvatar($params['badgePic']);
		if ($params['category'])
			$this->setCategoryID($params['category']);
		
		$updateParams = array('name'=>$this->getName(),'category_id'=>$this->getCategoryID(), 'description'=>$this->getDescription(), 'badge_picture'=> $this->getAvatar());
	    $this->db->update('achievement', $updateParams, "achievement_id = ".$this->getID()); // go ahead and finalize the database
	}
	public function insert($parmas = array()) {
		if ($params['name'])
			$this->setName($params['name']);
		if ($params['description'])
			$this->setDescription($params['description']);
		if ($params['badgePic'])
			$this->setAvatar($params['badgePic']);
		if ($params['category'])
			$this->setCategoryID($params['category']);
		
		$updateParams = array('name'=>$this->getName(),'category_id'=>$this->getCategoryID(), 'description'=>$this->getDescription(), 'badge_picture'=> $this->getAvatar());
		$this->db->insert('achievement', $updateParams); // Go ahead and add it to the database   
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
	public function getAllAchievements()
	{
		$this->db->select('achievement_id, achievement.category_id AS category_id, achievement.name, description, badge_picture, achievement_category.name AS category');
		$this->db->from('achievement');
		$this->db->join('achievement_category', 'achievement_category.category_id = achievement.category_id');
		$this->db->order_by("name", "ASC"); 
		$query = $this->db->get();
        return Achievement_model::getNew($query,true);
	}
	public function getCategoryByID($categoryID)
	{
		$category = array();
	    $query = $this->db->get_where('achievement_category', array('category_id' => $categoryID), 1);
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
	    $query =  $this->db->get('achievement_category');
	    foreach($query->result() as $row)
		{
			$categoryArray[$row->category_id] = $row->name;
			
		}
		return $categoryArray;
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
}
?>