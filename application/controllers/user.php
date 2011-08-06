<?php

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->fb_data = $this->session->userdata('fb_data'); // This array contains all the user FB information
        $this->user_id = $this->session->userdata('user_id'); // This array contains all the user FB information
        $this->data['fb_data'] = $this->fb_data;
	}
	function profile($user_id)
	{	        		
		if ($user_id != NULL)
			$this->data['user'] = User_model::byID($user_id);			
		if (!is_object($this->data['user']))
			redirect('/user/displayUsers'); // redirect to their profile.
		
		// Builds all of the information to be used else where
		$userAch = Userach_model::byUserID($user_id); // finds all user specific achievements
		$arrayID = Userach_model::getArrayofID($userAch); //  builds an array of the achievement ids to search through achievements	
		$this->data['achievementArray'] = Achievement_model::userAchievements($arrayID); // now finds the given achievements	
		
		$this->data['friendsArray'] = $this->data['user']->getFriendsInDatabase(); // get friends
			
		$this->template->write('title', "{$this->data['user']->getName()}'s Achievements");
		$this->template->write_view('holder', 'user/userInfo',$this->data);	
		$this->template->write_view('holder', 'user/achievements',$this->data);	
		$this->template->write_view('holder', 'user/comments',$this->data);	
		$this->template->write_view('holder', 'user/friends',$this->data);	
		$this->template->render();
	}
 	function displayUsers() 
 	{       
        $data = array(
          	'userArray' => User_model::getUsers(),
			'fb_data' => $this->fb_data,
		);
		$this->template->write('title', 'Active Users');
		$this->template->write_view('content', 'user/main/user_list',$data);		
		$this->template->render();
    }

}
?>